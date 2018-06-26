<?php

namespace Modules\SMS\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\SMS\Entities\Sms;
use Illuminate\Support\Facades\Session;
use Modules\SMS\Entities\SMSType;
use Modules\SMS\Entities\Status;
use Modules\SMS\Libraries\FileUtils;
use Modules\SMS\Libraries\SMSMobileFilter;

class SMSController extends Controller
{

    private function messages()
    {
        $messages = array(
            'phones.required_if'    => 'Please enter phone numbers',
            'phones.regex'  => 'Phone numbers contain invalid characters',
            'phone-file.required_if' => 'Please upload phone file',
            'phone-file.mimes' => 'Phone file must be txt or csv',
            'sms-content.required' => 'Please enter sms content',
            'sms-content.min' => 'sms content at least 2 characters',
            'sms-content.max' => 'sms content up to 160 characters'
        );

        return $messages;
    }

    private function validateSms(Request $request) {

        $validator = Validator::make($request->all(), [
            'phones' => 'nullable|required_if:sms-type,0|regex:(^[\d+ \,]*$)',
            'phone-file' => 'required_if:sms-type,1|mimes:txt,csv',
            'sms-content' => 'required|min:2|max:160',
        ], $this->messages());

        $content = $request['sms-content'];

        if ($content != strip_tags($content)) {
            $validator->errors()->add('sms-content', 'SMS content contain invalid tag, please use text');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        return true;

    }

    private function getMobileList($request)
    {
        $phoneArr = [];

        if (SMSType::getType($request['sms-type']) == SMSType::INPUT) {
            $phoneInput = preg_replace('/,+/', ',', ($request['phones']));
            $phoneInput = preg_replace('/ +/', '', $phoneInput);
            $phoneArr = explode(',', $phoneInput);
        } else {
            $phoneFile = $request->file('phone-file');
            if ($phoneFile != null) {
                if ($phoneFile->getClientOriginalExtension() == 'txt') {
                    $phoneArr = FileUtils::readTxt($phoneFile->getRealPath());
                }
                else {
                    $phoneArr = FileUtils::readCsv($phoneFile->getRealPath());
                }
            }
        }

        return $phoneArr;
    }

    public function index(Request $request)
    {
        return view('sms::index');
    }

    public function smsAjaxList(Request $request)
    {
        try {
            $columns = array(
                0 => "id",
                1 => "created_at",
                2 => "content",
                3 => "phones",
                4 => "invalid_phones",
                5 => "duplicate_phones",
                6 => "status",
            );

            $conditions = '';
            if (!empty($request->input('search.value'))) {
                $search = addslashes($request->input('search.value'));
                $conditions .= ' AND (content like "%'.$search.'%" OR phones like "%'.$search.'%" OR invalid_phones like "%'.$search.'%" OR duplicate_phones like "%'.$search.'%")';
            }
            if (!empty($request->input('columns.4.search.value'))) {
                $statusFilter = addslashes($request->input('columns.4.search.value'));
                $conditions .= ' AND (status like "'. $statusFilter .'")';
            }
            if (!empty($conditions)) {
                $conditions = substr($conditions, 4);
            } else {
                $conditions = 'true';
            }

            $limit = !empty($request->length) ? $request->input('length') : 10;
            $start = !empty($request->start) ? $request->input('start') : 0;
            $order = !empty($request->input('order.0.column')) ? $columns[$request->input('order.0.column')] : 1;
            $dir = !empty($request->input('order.0.dir')) ? $request->input('order.0.dir') : 'desc';
            $draw = !empty($request->draw) ? $request->input('draw') : 0;

            $messages = Sms::whereRaw($conditions)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalData = Sms::all()->count();
            $totalFiltered = Sms::whereRaw($conditions)->count();

            $json_data = array(
                "draw" => intval($draw),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $this->transform($messages)
            );

        } catch (\Exception $exception) {
            Log::error('[SMS - smsAjaxList] respond json error => ' .$exception->getMessage());
            $json_data = array(
                "draw" => intval(0),
                "recordsTotal" => intval(0),
                "recordsFiltered" => intval(0),
                "data" => []
            );

        }

        return response()->json($json_data);
    }

    public function showSend()
    {
        return view('sms::send');
    }

    public function send(Request $request)
    {
        $returnedResponse = $this->validateSms($request);
        if ($returnedResponse !== TRUE) {
            return $returnedResponse;
        }

        $phones = $this->getMobileList($request);

        try {
            $filter = (new SMSMobileFilter($phones))->doFilter();

            if (!$filter->isHasValidPhones()) {
                Session::flash('error_message', '[SMS send] All phone numbers invalid. Please try again!');
                return redirect()->back()->withInput();
            }

            $this->doSendSms($request, $filter);

            $notification = 'SMS successfully saved';
            if (count($filter->getInvalid())) {
                $notification.= '<br> - ' . count($filter->getInvalid()) .' invalid phone number(s)';
            }
            if (count($filter->getDuplicate())) {
                $notification .= '<br> - ' .count($filter->getDuplicate()) .' duplicate phone number(s)';
            }

            Session::flash('flash_message', $notification);

            return redirect('sms');
        }
        catch (\Exception $e) {
            Log::error('[SMS - send]  => ' .$e->getMessage());
            Session::flash('error_message', '[SMS send] exception: '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $sms = Sms::find($id);

        return view('sms::view')->with('sms', $sms);
    }

    /**
     * @param Request $request
     * @param SMSMobileFilter $filter
     * @throws \Exception
     */
    private function doSendSms(Request $request, SMSMobileFilter $filter): void
    {
        $phoneUniqueList = $filter->getValid();
        $phoneErrList = $filter->getInvalid();
        $phoneDupList = $filter->getDuplicate();

        $content = strip_tags($request['sms-content']);

        $status = Status::TESTING;
        $returnedMsg = '';
        if (!env('TESTING')) {
            $client = new Client();

            $res = $client->request('POST', env('SMS_COMMZ_URL'), [
                'form_params' => [
                    'ID' => env('SMS_COMMZ_ID'),
                    'Password' => env('SMS_COMMZ_PWD'),
                    'Mobile' => implode(',', $phoneUniqueList),
                    'Type' => 'A',
                    'Message' => $content,
                    'Batch' => 'true',
                    'OperatorID' => env('SMS_COMMZ_OPERATOR_ID')
                ]
            ]);

            $returnedMsg = $res->getBody();
            $returnArr = explode(',', $returnedMsg);
            $status = $returnArr[0] == "01010" ? Status::SUCCESS : Status::FAILED;
            Log::info("[SMS - send] sent at " . Carbon::createFromFormat('Y-m-d H:i:s', now())->setTimezone(config('app.display_timezone'))->toDateTimeString() . " => " . $res->getBody());
        }

        /** @var Sms $sms */
        $sms = new Sms();
        $sms->phones = implode(', ', $phoneUniqueList);
        $sms->invalid_phones = implode(', ', $phoneErrList);
        $sms->duplicate_phones = implode(', ', $phoneDupList);
        $sms->content = strip_tags($content);
        $sms->status = $status;
        $sms->returned_msg = $returnedMsg;

        if (!$sms->save()) {
            throw new \Exception('Unable to save sms to db');
        }
    }

    private function transform($smsList)
    {
        $index = 0;
        return array_map(function ($sms) use (&$index)
        {
            $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', $sms['created_at']);
            $createdAt->setTimezone(config('app.display_timezone'));
            $link = link_to(url('sms', $sms['id']).'/show', $createdAt);

            return [
                'index' => ++$index,
                'created_at' => $link->toHtml(),
                'content' => html_entity_decode($sms['content']),
                'phones' => Sms::ellipsis($sms['phones']),
                'invalid_phones' => Sms::ellipsis($sms['invalid_phones']),
                'duplicate_phones' => Sms::ellipsis($sms['duplicate_phones']),
                'status' => $sms['status']
            ];
        }, $smsList->toArray());
    }
}
