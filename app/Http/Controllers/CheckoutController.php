<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BookCheckout;
use App\Book;
use App\BookItem;
use App\BookCategory;

class CheckoutController extends Controller
{
    
    public function index()
    {
        $books = Book::all();
        return view('checkout.index', compact('books'));
    }

    public function records(Request $request)
    {
        // dd($request->all());
        $column = $request->order[0]['column'];
        $order  = $request->order[0]['dir'];


        $query = BookCheckout::with(['bookItem' => function ($query) {

            // $query->orderBy('refNo', "asc");
        }]);


        $count = $query->count();

        $query = $query->get();
        // dd($query->toArray(), $count);
        $responseTable = [];
        foreach ($query as $key => $book) {
            $data = [
                $book['id'],
                $book->bookItem->refNo,
                $book->bookItem->book->isbn,
                $book->bookItem->book_title,
                $book->borrowed_by,
                date_format($book->created_at,"Y-m-d H:i:s") ?? "null",
                $book->due_date ?? "null",
                $book->return_date ?? "null",
                $book['status'],
                '<a class="mx-1"><i class="fa fa-eye color-main"></i></a>
                <a href="book/' . $book['id'] . '/edit" class="mx-1"><i class="fa fa-edit color-main"></i></a>
                <a onclick="deleteBook(' . $book['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-trash-alt color-main"></i></a>',
            ];
            // array_push($responseTable, $data);
            $responseTable[] = $data;
        }
        // dd($responseTable);
        return json_encode(array(
            'iTotalRecords' => $count,
            'iTotalDisplayRecords' => $count,
            'aaData' => $responseTable
        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getBookItem(Request $request)
    {
        $id = $request->get('bookItemId');
        // $bookItem = BookItem::find($id);
        $bookItem = Book::with('bookItem')->where('id',$id)->get();
        // dd($request->all(), count($bookItem),$bookItem);
        return response()->json(['status' => true, 'bookItem' => $bookItem]);
    }
}
