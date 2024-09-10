<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pages_count',
        'category_id',
        'author_id',
    ];

    public function categories()
    {
        return $this->belongsTo(category::class,'category_id');
    }

    public function authors()
    {
        return $this->belongsTo(author::class,'author_id');
    }
    public function reservations()
    {
        return $this->hasOne(author::class,'reservations');
    }
}
