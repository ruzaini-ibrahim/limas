<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BookItem;

class BookCheckout extends Model
{
    protected $fillable = [
    	'book_id','status','borrowed_by','due_date','return_date'
    ];

    public function bookItem()
    {
    	return $this->belongsTo(BookItem::class, 'book_item_id');
    }
}
