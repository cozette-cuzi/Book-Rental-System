<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Book;

class Borrow extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reader()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function returnManagedBy()
    {
        return $this->belongsTo(User::class, 'return_managed_by');
    }

    public function requestManagedBy()
    {
        return $this->belongsTo(User::class, 'request_managed_by');
    }
}
