<?php

namespace App;
use App\BookItem;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $guarded = [];

	public function bookItem()
    {
    	return $this->hasOne(BookItem::class, 'id', 'book_item_id');
    }

    public function lender()
    {
    	return $this->belongsTo(User::class, 'borrowed_by');
    }
}
