<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class BookItem extends Model
{
    protected $fillable = [
        'refNo','book_id','status','borrowed_on','borrowd_by','due_date','reserved_by'
    ];

    protected $appends = ['book_title','book_publisher'];

    function getBookTitleAttribute() {
		return $this->book->title;
	}

    function getBookPublisherAttribute() {
        return $this->book->publisher;
    }

    public function book()
    {
    	return $this->belongsTo(Book::class, 'book_id');
    }

    public function updateStatus($status = "")
    {
        $bookItem = $this->update([
                'status' => $status
            ]);
        return $bookItem;
    }

    public function statusAvailable()
    {
        return $this->where('status','available');
    }
}
