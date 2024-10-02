<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    function index()
    {
        $books = Book::where('id',1)->withTrashed()->restore();
        return view('books.index', ['books' => $books]);
        // return view('books.index')->with('books',$books);
        // return view('books.index', compact('books'));
    }

    function show($id)
    {
        // $book = Book::findOrFail($id);
        $book = Book::find($id);
        dD($book);
        return view('books.show', ['book' => $book]);
    }

    function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('books.create', ['authors' => $authors, 'categories' => $categories]);
    }

    function store(Request $request)
    {
        // $data = $request->all();
        // validate
        // display error
        // php artisan lang:publish
        $request->validate([
            'title' => "required|string|max:100",
            'description' => "required|string",
            // "image" => "required|image|mimes:png,jpg|max:1024",
            // 'author_id' => "required|exists:authors,id",
        ], [
            'title.required' => "the title is Req.",
            'title.max' => "max char",
        ]);
        // $name_img = time() . "_book_" . $request->file('image')->getClientOriginalName();
        // $path_img = Storage::disk('public')->putFileAs('images/books', $request->image, $name_img);

        // DB::insert('insert into books (title, decs, img) values (?, ?, ?)', ["$request->title", "$request->description", "$path_img"]);


        $book = new Book();
        $book->title = $request->title;
        $book->decs  = $request->description;
        // $book->img   = $path_img;
        // $book->author_id   = $request->author_id;
        $book->save();
        // foreach ($request->category_id as $cat_id) {
        //     $book->categories()->attach($cat_id, ['qty_books' => 5]);
        //     // id = 1
        //     // book_id = 10
        //     // category_id = 1
        // }
        // return back();
        // Book::create([
        //     'title' => $request->title,
        //     'decs' => $request->description,
        // ]);
        // return redirect('/books');
        // return redirect()->route('books');
    }

    function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        $categories = Category::all();
        return view('books.edit', ['book' => $book, 'authors' => $authors, 'categories' => $categories]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'title' => "required|string|max:100",
            'description' => "required|string",
            'image' => "nullable|mimes:png,jpg|max:1024",
        ]);
        $book = Book::findOrFail($id);
        $old_img = $book->img;
        if ($request->hasFile('image')) {
            if ($old_img !== null  && Storage::disk('public')->exists($old_img)) {
                Storage::disk('public')->delete($old_img);
            }
            $name_img = time() . "_book_" . $request->file('image')->getClientOriginalName();
            $path_img = Storage::disk('public')->putFileAs('images/books', $request->image, $name_img);
        }
        $book->update([
            'title' => $request->title,
            'decs' => $request->description,
            'img' => $path_img ?? $old_img,
        ]);
        foreach ($request->category_id as $cat_id) {
            if ($book->categories()->where('category_id', $cat_id)->exists()) {
                $book->categories()->updateExistingPivot($cat_id, ['qty_books' => 12]);
            } else {
                $book->categories()->attach($cat_id, ['qty_books' => 10]);
            }
        }
        // $book->title = $request->title;
        // $book->decs = $request->description;
        // $book->save();
        return to_route('books');
    }

    function delete($id)
    {
        // Book::destroy($id);
        $book = Book::find($id);
        if ($book->img && Storage::disk('public')->exists($book->img)) {
            Storage::disk('public')->delete($book->img);
        }
        $book->delete();
        return to_route('books');



        try {
            //code...
        } catch (\Throwable $th) {
            Log::error($th->getMessage() . $th->getLine() . $th->file());
        }
    }
}
