<?php

namespace Modules\Parking\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ParkingController extends Controller
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

    private function validateParking(Request $request) {

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function ajaxParkingList(Request $request)
    {
        try {
            $columns = array(
                0 => "id",
                1 => "parkingName",
                2 => "openTime",
                3 => "closeTime",
                4 => "status",
                5 => "addressFull",
            );

            $conditions = '';
            if (!empty($request->input('search.value'))) {
                $search = addslashes($request->input('search.value'));
                $conditions .= ' AND (parkingName like "%'.$search.'%" OR addressFull like "%'.$search.'%")';
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

            $client = new Client();

            $response = $client->request('GET', env('CMS_HOST') .'parking/all');
            $messages = json_decode($response->getBody());

            $totalData = count($messages);
            $totalFiltered = count($messages);

            $json_data = [
                "draw"              => intval($draw),
                "recordsTotal"      => intval($totalData),
                "recordsFiltered"   => intval($totalFiltered),
                "data"              => $this->transform($messages),
            ];

        } catch (\Exception $exception) {
            Log::error('[Parking - ajaxParkingList] respond json error => ' .$exception->getMessage());
            $json_data = [
                "draw"              => intval(0),
                "recordsTotal"      => intval(0),
                "recordsFiltered"   => intval(0),
                "data"              => [],
            ];
        }

        return response()->json($json_data);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('parking::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $districts = json_decode(file_get_contents(storage_path('app/public/hcm_area.json')));

        return view('parking::create')->with('districts', $districts);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('parking::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('parking::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    private function transform($parkingArr)
    {
        $index = 0;
        return array_map(function ($parking) use (&$index)
        {
            $link = link_to(url('parking', $parking->id).'/show', $parking->parkingName);

            return [
                'index' => ++$index,
                'parkingName' => $link->toHtml(),
                'photo' => $parking->photo,
                'minPrice' => isset($parking->minPrice) ? $parking->minPrice : '',
                'maxPrice' => isset($parking->maxPrice) ? $parking->maxPrice : '',
                'addressFull' => isset($parking->addressFull) ? $parking->addressFull : '',
                'status' => isset($parking->status) ? $parking->status : '',
            ];
        }, $parkingArr);
    }
}
