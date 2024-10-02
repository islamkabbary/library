<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;

    // protected $fillable = ['title', 'decs', 'img'];
    // protected $guarded = ['id'];
    // protected $hidden = ['title'];
    // protected $table = 'my_books';
    // protected $primaryKey = 'flight_id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    // public $timestamps = false;
    // protected $connection = 'mysql2'
    // protected $with = ['author'];




    function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('qty_books');
    }

    function getBookDetailAttribute() {
        return "title => " . $this->title . " " . "decs => " . $this->decs;
    }

    protected function title() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value)
        );
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
