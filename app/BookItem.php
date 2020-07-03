<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class BookItem extends Model
{
    protected $fillable = [
        'refNo','book_id','status','borrowed_on','borrowd_by','due_date','reserved_by'
    ];

    protected $appends = ['book_title'];

    public function book()
    {
    	return $this->belongsTo(Book::class, 'book_id');
    }

    function getBookTitleAttribute() {
		return $this->book->title;
	}
}
