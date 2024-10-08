<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bio',
        'email',
        'image',
    ];

    public function book()
    {
        return $this->hasMany(Book::class, 'books');
    }
}
