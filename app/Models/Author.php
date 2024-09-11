<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    function books()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }

    function profile() {
        return $this->hasOne(Profile::class, 'author_id', 'id');
    }
}
