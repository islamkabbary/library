<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Storage;
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
        $validation = Validator::make($request->all(), [
            'title' => "required",
            'decs' => "required",
            'image' => "required",
        ]);
        if ($validation->fails()) {
            $data = [
                'data' => null,
                "errors" => $validation->errors(),
            ];
            return $this->apiResponse($data, "errors validation" , 425);
        }
        try {
            $name_img = time() . "_book_" . $request->file('image')->getClientOriginalName();
            $path_img = Storage::disk('public')->putFileAs('images/books', $request->image, $name_img);
            DB::beginTransaction();
            $book = new Book;
            $book->title = $request->title;
            $book->decs = $request->decs;
            $book->img = $path_img;
            $book->save();
            DB::commit();
            return $this->apiResponse(new BookResource($book), "add book");
        } catch (\Throwable $th) {
            DB::rollBack();
            throw Log::info($th->getMessage());
            return $this->apiResponse(null, "error");
        }


        // DB::transaction(function () use($request) {
        // $book = new Book;
        // $book->title = $request->title;
        // $book->decs = $request->decs;
        // $book->save();
        //     return $this->apiResponse(new BookResource($book), "add book");
        // });
    }

    public function update(Request $request, $id)
    {
        $data = Validator::make($request->all(), [
            'title' => "sometimes|required",
            'decs' => "sometimes|required",
        ]);
        if ($data->fails()) {
            $data = [
                'data' => null,
                "errors" => $data->errors(),
            ];
            return $this->apiResponse($data, "errors validation");
        }

        try {
            $book = Book::find($id);
            // $book->title = $request->title ?? $book->title;
            // $book->decs = $request->decs ?? $book->decs;
            // $book->save();
            $book->update($request->only(['title', 'decs']));
            return $this->apiResponse(new BookResource($book), "update book");
        } catch (\Throwable $th) {
            throw Log::info($th->getMessage());
            return $this->apiResponse(null, "error");
        }
    }


    function destroy($id)
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
