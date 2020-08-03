<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BookCheckout;
use App\Book;
use App\BookItem;
use App\BookCategory;
use App\User;
use Validator;

class CheckoutController extends Controller
{
    
    public function index()
    {
        $books = Book::all();
        $users = User::all();
        return view('checkout.index', compact('books','users'));
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
                $book->lender->name,
                date_format($book->created_at,"Y-m-d H:i:s") ?? "null",
                $book->due_date ?? "null",
                $book->return_date ?? "null",
                $book['status'],
                '<a class="mx-1"><i class="fa fa-eye color-main"></i></a>
                <a onclick="editCheckout(' . $book['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-edit color-main"></i></a>
                <a onclick="deleteCheckout(' . $book['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-trash-alt color-main"></i></a>',
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

    public function recordsLender(Request $request)
    {
        // dd($request->all());
        $column = $request->order[0]['column'];
        $order  = $request->order[0]['dir'];


        $query = User::with('bookCheckout')->select('*');


        $count = $query->count();

        $query = $query->get();
        // dd($query[0]->bookCheckout[0]->bookItem, $count);
        $responseTable = [];
        foreach ($query as $key => $user) {
            $data = [
                $user['id'],
                $user['name'],
                $user['email'],
                $user->countBookCheckoutLend(),
                '<a onclick="addCheckout(' . $user['id'] . ')" href="javascript:void(0)" type="button" class="btn btn-animate btn-animate-side btn-main btn-xs btn-round waves-effect waves-classic">
                    <span><i class="icon fa fa-plus" aria-hidden="true"></i>Checkout</span>
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

    public function create()
    {
        //
    }

    public function showCreateModal($id)
    {
        $books = Book::all();
        $user = User::find($id);
        return view('checkout.form._add', compact('books','user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lender_name' => ['required'],
            'lender_email' => ['required'],
            'isbn' => ['required'],
            'title' => ['required'],
            'refNo' => ['required'],
            'borrowed_date' => ['required'],
            'due_date' => ['required'],
        ]);


        $validateResponse = json_decode(validator_message($validator));

        if($validateResponse->error){
            return response()->json(['status' => false, 'message' => $validateResponse->message]);
        }

        $formParams = $request->except('_token','lender_name','lender_email');
        $id = $request->get('id');
        $old_book_id = $request->get('old_book');
        $book_id = $request->get('refNo');
        $user = User::find($id);
        $bookItem = BookItem::find($book_id);
        
        $response = [];
        // dd($user->countFine());
        //check current user checkout book. lend > 5 cant lend anymore
        if(!$user->statusBookCheckoutLend()){
            $statusLender = 2; //maximum amount of checkout
        }else if($user->statusFine()){
            $statusLender = 4; //check fine status
            $total_fines = $user->countFine();
        }else if($bookItem->status != "available" && empty($old_book_id)){
            $statusLender = 3; //book not available
            $bookStatus = $bookItem->status ?? "";
        }else if($old_book_id && $book_id != $old_book_id){
            $oldBookItem = BookItem::find($old_book_id)->updateStatus("available");
        }if(!isset($statusLender)){
            $data = [
                'book_item_id' => $book_id,
                'status' => 'borrowed',
                'borrowed_by' => $user->id,
                'borrowed_date' => dateFormatYMD($formParams['borrowed_date']),
                'due_date' => dateFormatYMD($formParams['due_date']),
            ];
            // dd($data);
            $bookCheckout = BookCheckout::updateOrCreate(['id' => $request->get('checkout_id')], $data);

            //update bookitem status
            $bookItem = $bookItem->updateStatus("not available");
            $statusLender = 1; //success checkout
        }

        switch ($statusLender) {
            case 1:
                $response['status'] = true;
                $response['message'] = $old_book_id ? 'Book successfully updated!' : 'Book successfully checked out!';
                break;
            case 2:
                $response['status'] = false;
                $response['message'] = "Failed to checkout! Maximum number of book borrowed!";
                break;
            case 3:
                $response['status'] = false;
                $response['message'] = "Failed to checkout! book is " .$bookStatus. "!";
                break;
            case 4:
                $response['status'] = false;
                $response['message'] = "Failed to checkout! ". $total_fines ." outstanding fines are found!";
                break;
            default:
                $response['status'] = false;
                $response['message'] = "Book cannot be checked out. Something is wrong!";
                break;
        }

        return response()->json($response);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $bookCheckout = BookCheckout::find($id);
        $books = Book::all();
        $bookItems = BookItem::where('book_id',$bookCheckout->bookItem->book_id)->get();
        // dd($bookItems);
        return view('checkout.form._add', compact('bookCheckout','books','bookItems'));
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $data = BookCheckout::find($id);
        $data->delete();
        return response()->json(['status' => true, 'message' => 'Checkout successfully deleted!']);
    }

    public function getBookItem(Request $request)
    {
        $id = $request->get('bookItemId');
        $book = Book::find($id);
        $bookItem =$book->bookItem;
        // $bookItem = Book::with('bookItem')->where('id',$id)->get();
        // dd($book, $bookItem);
        return response()->json(['status' => true,'book' => $book, 'bookItems' => $bookItem]);
    }
}
