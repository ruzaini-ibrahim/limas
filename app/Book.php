<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BookCategory;
use App\BookItem;

class Book extends Model
{
    protected $fillable = [
        'isbn','title','publisher','category_id','type','status','image_path', 'image_url'
    ];

    public function category()
    {
    	return $this->belongsTo(BookCategory::class, 'category_id');
    }

    public function bookItem()
    {
    	return $this->hasMany(BookItem::class, 'book_id');
    }
}
