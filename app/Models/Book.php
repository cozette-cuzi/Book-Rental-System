<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Borrow;
use App\Models\Genre;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['available'];

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function getAvailableAttribute()
    {
        return $this->in_stock - $this->borrows->where('status', '=', 'ACCEPTED')->count();
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($books) {
            foreach ($books->borrows()->get() as $borrow) {
                $borrow->delete();
            }
        });
    }
}
