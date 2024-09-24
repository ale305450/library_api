<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable=[
        'length',
        'book_id',
        'user_id'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class,'book_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_id');
    }
}
