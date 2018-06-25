<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Book\Entities\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books 	= Book::paginate(15);
        return view('book::index')->with('books',$books);
    }

    public function logout()
    {
        auth()->logout();

        session()->flash('message', 'some goodbye message');

        return redirect('/login');
    }
}
