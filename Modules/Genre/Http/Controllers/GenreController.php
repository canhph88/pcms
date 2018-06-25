<?php

namespace Modules\Genre\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Book\Entities\Book;
use Modules\Genre\Entities\Genre;

class GenreController extends Controller
{

    public function messages()
    {
        $messages = array(
            'name.required' => 'Vui lòng nhập tên thể loại',
            'name.unique' => 'Tên thể loại không được trùng'
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
            $genres = Genre::orderBy('updated_at', 'desc')->paginate(15);
        } else {
            $genres = Genre::where('name', 'like', '%'.$search.'%')
                ->orWhere('displayName', 'like', '%'.$search.'%')
                ->orderBy('updated_at', 'desc')
                ->paginate(15);
        }

        return view('genre::index')->with('genres', $genres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genre = new Genre();
        $books = Book::all();

        return view('genre::create')->with('genre', $genre)->with('books', $books);
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
            'name' => 'bail|required|unique:genres',
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $genre =  new Genre();

        $genre->name = $request->name;
        $genre->description = $request->description;

        $genre->save();

        return redirect('/genre')->with('message', 'store genre successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show($genre)
    {
        return view('genre::show')->with('genre', $genre);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit($genre)
    {
        $books = Book::all();

        return view('genre::edit')->with('genre',$genre)->with('books',$books);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $id = $request->get('id');

        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|unique:genres,name,'.$id,
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $oldGenre =  Genre::findOrNew($request->get('id'));

        $oldGenre->name = $request->name;
        $oldGenre->description = $request->description;

        $oldGenre->touch();

        $oldGenre->save();

        return redirect('/genre')->with('message', 'update genre successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy($genre)
    {
        $genre->delete();

        return redirect('/genre')->with('message', 'delete genre successfully!');
    }

    public function destroyMultiple(Request $request)
    {
        $ids = $request->get('ids');

        DB::transaction(function () use ($ids) {
            foreach($ids as $id){
                $genre = Genre::find($id);
                $genre -> delete();
            }
        });

        return redirect('/genre')->with('message', 'delete genres successfully!');
    }
}
