<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BookCheckout;
use App\Book;
use App\BookItem;
use App\BookCategory;
use App\User;
use App\Fine;
use Validator;

class ReturnController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $users = User::all();
        // dd(date('Y-m-d h:s:i'));
        return view('return.index', compact('books','users'));
    }

    public function recordsLender(Request $request)
    {
        // dd($request->all());
        $column = $request->order[0]['column'];
        $order  = $request->order[0]['dir'];


        // $query = BookCheckout::where('status','borrowed')->with(['bookItem' => function ($query) {

        //     // $query->orderBy('refNo', "asc");
        // }]);
        $query = BookCheckout::select('book_checkouts.*','book_items.refNo','book_items.book_id','book_items.status as book_items_status','books.isbn','books.title','books.publisher','users.name as user_name','users.email')->leftjoin('book_items','book_checkouts.book_item_id','book_items.id')->leftjoin('books','book_items.book_id','books.id')->leftjoin('users','book_checkouts.borrowed_by','users.id')->where('book_checkouts.status','=','borrowed');

        $count = $query->count();

        $query = $query->get();
        // dd($query[0]->lender->name, $count);
        $responseTable = [];
        foreach ($query as $key => $book) {
            $data = [
                $book->id,
                $book->refNo,
                $book->isbn,
                $book->title,
                $book->user_name,
                date_format($book->created_at,"d-m-Y") ?? "null",
                dateFormatDMY($book->due_date) ?? "null",
                $book['status'],
                '<a onclick="addReturn(' . $book['id'] . ')" href="javascript:void(0)" type="button" class="btn btn-main btn-xs btn-round waves-effect waves-classic">
                    <span><i class="icon fas fa-caret-down" aria-hidden="true"></i>Issue</span>
                  </a>',
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

    public function recordsReturn(Request $request)
    {
        $column = $request->order[0]['column'];
        $order  = $request->order[0]['dir'];


        $query = BookCheckout::where('status','!=','borrowed')->with(['bookItem' => function ($query) {

            // $query->orderBy('refNo', "asc");
        }]);


        $count = $query->count();

        $query = $query->get();
        // dd($query->toArray(), $count);
        $responseTable = [];
        foreach ($query as $key => $book) {
            $status = $book->status == 'returned' ? '<span class="badge badge-round badge-success">Returned</span>' : ($book->status == 'delayed'  ? '<span class="badge badge-round badge-warning">Delayed</span>' : '<span class="badge badge-round badge-danger">Error</span>');
            $data = [
                $book['id'],
                $book->bookItem->refNo,
                $book->bookItem->book->isbn,
                $book->bookItem->book_title,
                $book->lender->name,
                date_format($book->created_at,"Y-m-d H:i:s") ?? "null",
                dateFormatDMY($book->due_date) ?? "null",
                dateFormatDMY($book->return_date) ?? "null",
                $status,
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

    public function showCreateModal($id)
    {
        $books = Book::all();
        $bookCheckout = BookCheckout::find($id);
        return view('return.form._add', compact('books','bookCheckout'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'return_date' => ['required'],
        ]);


        $validateResponse = json_decode(validator_message($validator));

        if($validateResponse->error){
            return response()->json(['status' => false, 'message' => $validateResponse->message]);
        }

        $bookCheckout = BookCheckout::find($request->checkout_id);
        $dueDate = $bookCheckout->due_date;
        $returnDate = dateFormatYMD($request->get('return_date'));
        
        $data = [
            'return_date' => dateFormatYMD($request->get('return_date')),
            'status' => 'returned',
        ];
        // dd($returnDate , $dueDate, $returnDate > $dueDate);
        if($returnDate > $dueDate){
            $data['status'] = 'delayed';
            $fine = Fine::create([
                'book_item_id' => $bookCheckout->book_item_id,
                'borrowed_by' => $bookCheckout->borrowed_by,
                'due_date' => $bookCheckout->due_date,
                'return_date' => $data['return_date'],
            ]);
        }
        $bookReturn = BookCheckout::updateorcreate(['id' => $request->checkout_id], $data);
        $bookItem = BookItem::find($bookCheckout->book_item_id)->updateStatus("available");
        
        return response()->json(['status' => true, 'message' => 'Successfully updated returned book!']);
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
}
