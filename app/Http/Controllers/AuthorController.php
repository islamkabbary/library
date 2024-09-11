<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    function index()
    {
        $authors = Author::paginate(3);
        return view('authors.index', ['authors' => $authors]);
    }

    function show($id)
    {
        $author = Author::find($id);
        return view('authors.show', ['author' => $author]);
    }

    function create()
    {
        return view('authors.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:100",
        ]);
        $author = new Author();
        $author->name = $request->name;
        $author->save();
        return back();
    }

    function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', ['author' => $author]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required|string|max:100",
        ]);
        $author = Author::findOrFail($id);
        $author->update([
            'name' => $request->name,
        ]);
        return to_route('authors');
    }

    function delete($id)
    {
        $author = Author::find($id);
        $author->delete();
        return to_route('authors');
    }
}
