<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Borrow;
use App\Models\Genre;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'book_id');
    }

    public function activeBorrows()
    {
        return $this->getAllBorrows()->where('status', '=', 'ACCEPTED');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
