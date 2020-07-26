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

class FineController extends Controller
{
    //  public function index_test()
    // {
    //     $data = [9,7,5,3,0];
    //     $count = count($data) -1;
    //     $max = $count;
    //     for($j = 0; $j < $count; $j++){
    //         $node = $max;
    //         for($i = 0; $i < $count; $i++)
    //         {
    //             if($node > 0)
    //             {
    //                 [$data[$i], $data[$i+1]] = [$data[$i+1], $data[$i]];

    //             }
    //             echo implode('&nbsp', $data) . '<br>';
    //             $node--;
    //         }
    //         $max--;
    //         echo "<br>";
    //     }
    // }

    public function index()
    {
        // $book = BookCheckout::find(4);
        // dd($book->return_date);
        // $diff = date_diff(date_create($book->return_date),date_create($book->due_date));
        // dd($diff);
        $books = Book::all();
        $users = User::all();
        // date_default_timezone_set("Asia/Kuala_Lumpur");
        // dd(date('Y-m-d H:i:s'));
        return view('fine.index', compact('books','users'));
    }

    public function recordsLender(Request $request)
    {
        // dd($request->all());
        $column = $request->order[0]['column'];
        $order  = $request->order[0]['dir'];

        $query = Fine::select('fines.*','book_items.refNo','book_items.book_id','book_items.status as book_items_status','books.isbn','books.title','books.publisher','users.name as user_name','users.email')->leftjoin('book_items','fines.book_item_id','book_items.id')->leftjoin('books','book_items.book_id','books.id')->leftjoin('users','fines.borrowed_by','users.id')->where('fines.status','=','not paid');

        $count = $query->count();

        $query = $query->get();
        // dd($query, $count);
        $responseTable = [];
        foreach ($query as $key => $book) {
            $data = [
                $book->id,
                $book->refNo,
                $book->isbn,
                $book->title,
                $book->user_name,
                // date_format($book->created_at,"d-m-Y") ?? "null",
                dateFormatDMY($book->due_date) ?? "null",
                dateFormatDMY($book->return_date) ?? "null",
                calcFine($book->return_date, $book->due_date),
                '<div class="border-w-0 checkbox-custom checkbox-main checkbox-item">
                      <input type="checkbox" name="selectPay[]" id="'. $book->refNo .'" value="'.$book->id.'">
                      <label for="'. $book->refNo .'">Select</label>
                    </div>',
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

    public function recordsFine(Request $request)
    {
        $column = $request->order[0]['column'];
        $order  = $request->order[0]['dir'];


        $query = Fine::select('fines.*','book_items.refNo','book_items.book_id','book_items.status as book_items_status','books.isbn','books.title','books.publisher','users.name as user_name','users.email')->leftjoin('book_items','fines.book_item_id','book_items.id')->leftjoin('books','book_items.book_id','books.id')->leftjoin('users','fines.borrowed_by','users.id')->where('fines.status','=','paid');


        $count = $query->count();

        $query = $query->get();
        // dd($query->toArray(), $count);
        $responseTable = [];
        foreach ($query as $key => $book) {
            $status = $book->status == 'paid' ? '<span class="badge badge-round badge-success">paid</span>' : ($book->status == 'not paid'  ? '<span class="badge badge-round badge-warning">not paid</span>' : '<span class="badge badge-round badge-danger">Error</span>');
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

    public function store(Request $request)
    {
        $fines_id = $request->get('fines_id');
        $batch_fines = Fine::find($fines_id);
        foreach ($batch_fines as $index => $fine) {
            $fine_val = calcFine($fine->return_date, $fine->due_date);
            $fine->paid_value = $fine_val;
            $fine->status = "paid";
            $fine->paid_date = date('Y-m-d');
            $fine->save();
        }
        
        return response()->json(['status' => true, 'message' => 'Payment successfully paid!']);
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

    public function showPaymentModal(Request $request)
    {
        $data = $request->only('batch_payment');
        $fine_ids = explode(',', $data['batch_payment']);
        $fines = Fine::find($fine_ids);
        $get_fine_id = array_column($fines->toarray(), 'id');
        // dd($get_fine_id);
        // $get_fine_unique_id = array_unique($get_fine_id);
        $group_data = array();
        $total_payment = 0;
        $total_book = count($fines);
        foreach ($fines as $key => $fine) {
            $group_data[$fine->borrowed_by]['name'] = $fine->lender->name;
            $group_data[$fine->borrowed_by]['data'][$key] = $fine;
            $total_payment += calcFine($fine->return_date, $fine->due_date);
        }
        return view('fine.form.batch_payment', compact("group_data","total_payment","total_book","get_fine_id"));
    }
}
