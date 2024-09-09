<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function index()
    {
        // dd(Book::all());
        $books = Book::where('id', '>', 1)->paginate(1);
        return view('books.index', ['books' => $books]);
        // return view('books.index')->with('books',$books);
        // return view('books.index', compact('books'));
    }

    function show($id)
    {
        // $book = Book::find($id);
        $book = Book::findOrFail($id);
        return view('books.show', ['book' => $book]);
    }

    function create()
    {
        return view('books.create');
    }

    function store(Request $request)
    {
        // $data = $request->all();
        // validate
        // display error
        $request->validate([
            'title' => "required|string|max:100|unique:books",
            'description' => "required|string",
        ], [
            'title.required' => "the title is Req.",
            'title.max' => "max char",
        ]);
        // Book::create([
        //     'title' => $request->title,
        //     'decs' => $request->description,
        // ]);

        // $book = new Book();
        // $book->title = $request->title;
        // $book->decs = $request->description;
        // $book->save();
        // return back();
        // return redirect('/books');
        // return redirect()->route('books');
    }

    function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', ['book' => $book]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => "required|string|max:100",
            'description' => "required|string",
        ]);
        $book = Book::findOrFail($id);
        $book->update([
            'title' => $request->title,
            'decs' => $request->description,
        ]);
        // $book->title = $request->title;
        // $book->decs = $request->description;
        // $book->save();
        return to_route('books');
    }
}
