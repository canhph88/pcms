<?php

namespace Modules\Book\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Book\Entities\Book;
use Modules\Author\Entities\Author;
use Modules\Excel\Entities\BooksExcel;
use Modules\Genre\Entities\Genre;

class BookController extends Controller
{
    /** @var BooksExcel */
    private $booksExcel;

    public function __construct()
    {
        $this->middleware('auth');

        $this->booksExcel = app()->make('BooksExcel');

    }

    public function messages()
    {
        $messages = array(
            'name.required'    => 'Vui lòng nhập tên sách',
            'quantity.integer' => 'Số lượng phải là số nguyên lớn hơn 0',
            'quantity.size'    =>  'Số lượng phải là số nguyên lớn hơn 0',
            'price.size'    =>  'Số lượng phải là số nguyên lớn hơn 0'
        );

        return $messages;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search == null) {
            $books = Book::orderBy('updated_at', 'desc')->paginate(15);
        } else {
            $books = Book::where('name', 'like', '%' . $search . '%')
                ->orWhereHas('authors', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('genres', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orderBy('updated_at', 'desc')
                ->paginate(15);
        }

        return view('book::index')->with('books', $books);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $books = Book::where('name', 'like', '%' . $search . '%')->get();

        return view('book::index')->with('books', $books);
    }

    public function create(Request $request)
    {
        $book = new Book();
        $authors = Author::all();
        $genres = Genre::all();

        return view('book::create')->with('book', $book)->with('authors', $authors)->with('genres', $genres);
    }

    public function store(Request $request)
    {
        $book = new Book();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'nullable|integer|min:1|digits_between:0,4',
            'price' => 'nullable|min:1|digits_between:1,10'
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $image = $request->file('image-test');
        if ($image != null) {
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/books');
//        $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $book->image = $name;
        } else {
            $book->image = 'no-image.png';
        }

        $book->name = $request->name;
        $book->quantity = $request->quantity;
        $book->price = $request->price;
        $book->description = $request->description;

        $book->save();

        $book->authors()->sync($request->authors);

        $book->genres()->sync($request->genres);

        return redirect('/book')->with('message', 'store book successfully!');
    }

    public function show($book)
    {
        return view('book::show')->with('book', $book);
    }

    public function edit($book)
    {
        $authors = Author::all();
        $genres = Genre::all();

        return view('book::edit')->with('book', $book)->with('authors', $authors)->with('genres', $genres);
    }

    public function update(Request $request, Book $book)
    {
        $oldBook = Book::findOrNew($request->get('id'));

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'nullable|integer|min:1|digits_between:0,4',
            'price' => 'nullable|min:1|digits_between:1,10'
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $image = $request->file('image-test');
        if ($image != null) {
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/books');
//        $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $oldBook->image = $name;
        }

        $oldBook->name = $request->name;
        $oldBook->quantity = $request->quantity;
        $oldBook->price = $request->price;
        $oldBook->description = $request->description;

//        $oldBook->usesTimestamps();

        $oldBook->touch();

        $oldBook->save();

        $oldBook->authors()->sync($request->authors);
        $oldBook->genres()->sync($request->genres);

//        Session::flash('message', 'This is a message!');

        return redirect('/book')->with('message', 'update book successfully!');
    }

    public function destroy($book, Request $request)
    {
        $book->delete();

        return redirect('/book')->with('message', 'delete book successfully!');
    }

    public function destroyMultiple(Request $request)
    {
        $ids = $request->get('ids');

        DB::transaction(function () use ($ids) {
            foreach($ids as $id) {
                $book = Book::find($id);
                $book->delete();
            }
        });

        return redirect('/book')->with('message', 'delete books successfully!');
    }

    public function showDownload()
    {
        $downloadList = collect([]);
        $files = Storage::disk('local')->files('');
        foreach ($files as $file) {
            $extension = File::extension($file);
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                $timestamp =  filemtime(storage_path("/app/").$file);
//                echo $file->getFilename(). ' &' .date("F d Y H:i:s.",$timestamp);
//                echo date("F d Y H:i:s.",$timestamp);
                $downloadList->push($file);
            }
        }

        /** @var File */
        $downloadList = $downloadList->sortByDesc(function ($file) {
            return filectime(storage_path("/app/").$file);
        });

        return view('book::download')->with('list', $downloadList);
    }

    public function download(Response $response, $file)
    {
        return response()->download(storage_path("/app/").$file);

    }

    public function export()
    {
        return $this->booksExcel->export();
    }

    public function import(Request $request)
    {
        $this->validate($request, array(
            'import_file' => 'required'
        ));

        if ($request->hasFile('import_file')) {
            $file = $request->import_file;
            $message = $this->booksExcel->import($file);
            return redirect('book')->with('message', $message);

        }
    }

}
