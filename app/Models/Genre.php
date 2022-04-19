<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($genre) {
            foreach ($genre->books()->get() as $book) {
                $book->genres()->detach($genre->id);
            }
        });
    }
}
