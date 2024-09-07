<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    function index()
    {
        // dd(Book::all());
        $books = Book::where('id','!=',3)->orderBy('decs')->first();
        // dd($books);
        return view('books.index', ['books' => $books]);
        // return view('books.index')->with('books',$books);
        // return view('books.index', compact('books'));
    }
}
