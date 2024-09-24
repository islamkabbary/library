<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::get();
        return $this->apiResponse(BookResource::collection($books), "show all books");
    }

    public function show($id)
    {
        $book = Book::find($id);
        if ($book) {
            return $this->apiResponse(new BookResource($book), "show book");
        }
        return $this->apiResponse(null, "not found", 404);
    }

    public function store(Request $request)
    {
        // DB::transaction(function () use($request) {
        // $request->validate([
        //     "title" => $request->title,
        //     "decs" => $request->decs,
        // ]);
        // $book = new Book;
        // $book->title = $request->title;
        // $book->decs = $request->decs;
        // $book->save();
        //     return $this->apiResponse(new BookResource($book), "add book");
        // });


        try {
            DB::beginTransaction();
            $book = new Book;
            $book->title = $request->title;
            $book->decs = $request->decs;
            $book->save();
            DB::commit();
            return $this->apiResponse(new BookResource($book), "add book");
        } catch (\Throwable $th) {
            DB::rollBack();
            throw Log::info($th->getMessage());
            return $this->apiResponse(null, "error");
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $book = Book::find($id);
            $book->title = $request->title;
            $book->decs = $request->decs;
            $book->save();
            DB::commit();
            return $this->apiResponse(new BookResource($book), "add book");
        } catch (\Throwable $th) {
            DB::rollBack();
            throw Log::info($th->getMessage());
            return $this->apiResponse(null, "error");
        }
    }


    function delete($id)
    {
        $book = Book::find($id);
        $book->delete();
        return $this->apiResponse(null, "book deleted");
    }

    // validation
    // put
    // patch
    // route resource
    // uploadImg
    // auth
}
