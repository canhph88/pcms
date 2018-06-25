<?php

namespace Modules\Author\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Author\Entities\Author;
use Modules\Excel\Entities\AuthorsExport;
use Modules\Excel\Entities\BooksExcel;
use Webpatser\Countries\Countries;

class AuthorController extends Controller
{

    public function messages()
    {
        $messages = array(
            'name.required'    => 'Vui lòng nhập tên tác giả',
            'birthday.date' => 'Ngày sinh phải hợp lệ'
        );

        return $messages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search == null) {
            $authors = Author::orderBy('updated_at', 'desc')->paginate(15);
        } else {
            $authors = Author::where('name', 'like', '%'.$search.'%')
                ->orWhere('fullName', 'like', '%'.$search.'%')
                ->orWhere('country', 'like', '%'.$search.'%')
                ->orderBy('updated_at', 'desc')
                ->paginate(15);
        }

        return view('author::index')->with('authors',$authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $author = new Author();
        $countries = Countries::all()->pluck('name')->toArray();

        return view('author::create')->with('author',$author)->with('countries', $countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'birthday' => 'nullable|date'
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $author =  new Author();

        $author->name = $request->name;
        $author->fullName = $request->fullName;
        $author->birthday = $request->birthday;
        $author->hometown = $request->hometown;
        $author->country = $request->country;
        $author->description = $request->description;

        $author->save();

        return redirect('/author')->with('message', 'store author successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show($author)
    {
//        $author = Author::find($id);

        return view('author::show')->with('author', $author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit($author)
    {
//        $author = Author::find($id);
        $countries = Countries::all()->pluck('name')->toArray();

        return view('author::edit')->with('author', $author)->with('countries', $countries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'birthday' => 'nullable|date'
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $oldAuthor =  Author::findOrNew($request->get('id'));

        $oldAuthor->name = $request->name;
        $oldAuthor->fullName = $request->fullName;
        $oldAuthor->birthday = $request->birthday;
        $oldAuthor->hometown = $request->hometown;
        $oldAuthor->country = $request->country;
        $oldAuthor->description = $request->description;

        $oldAuthor->touch();

        $oldAuthor->save();

        return redirect('/author')->with('message', 'update author successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($author)
    {
//        $author = Author::find($id);
        $author->delete();

        return redirect('/author')->with('message', 'delete author successfully!');
    }

    public function destroyMultiple(Request $request)
    {
        $ids = $request->get('ids');

        DB::transaction(function () use ($ids) {
            foreach($ids as $id) {
                $author = Author::find($id);
                $author -> delete();
            }
        });

        return redirect('/author')->with('message', 'delete authors successfully!');
    }

}
