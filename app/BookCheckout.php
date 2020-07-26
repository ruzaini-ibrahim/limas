<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BookItem;
use App\User;

class BookCheckout extends Model
{
    protected $fillable = [
    	'book_item_id','status','borrowed_date','borrowed_by','due_date','return_date'
    ];

    public function bookItem()
    {
    	return $this->hasOne(BookItem::class, 'id', 'book_item_id');
    }

    public function lender()
    {
    	return $this->belongsTo(User::class, 'borrowed_by');
    }

    public function getDueDate()
    {
        return dateFormatDMY($this->due_date);
    }

}
