<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book = new Book();
        $book->title = "book one";
        $book->decs = "book one book one book one book one book one";
        $book->save();

        $book = new Book();
        $book->title = "book one";
        $book->decs = "book one book one book one book one book one";
        $book->save();
        $book = new Book();
        $book->title = "book one";
        $book->decs = "book one book one book one book one book one";
        $book->save();
        $book = new Book();
        $book->title = "book one";
        $book->decs = "book one book one book one book one book one";
        $book->save();
        $book = new Book();
        $book->title = "book one";
        $book->decs = "book one book one book one book one book one";
        $book->save();

    }
}
