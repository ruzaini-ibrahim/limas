<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;

use App\Book;
use App\BookItem;
use App\BookCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookController extends Controller
{
    public function index()
    {
        $categories = BookCategory::all();
        return view('book.index', compact("categories"));
    }

    public function records(Request $request)
    {
        $query = Book::with('category');
        $count = $query->count();
        $query = $query->get();
        // dd($query[0]['id'], $count);
        $responseTable = [];
        foreach ($query as $key => $book) {
            $data = [
                $book['id'],
                $book['isbn'],
                $book['title'],
                $book->category->name,
                bookType($book['type']),
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'isbn' => ['required','max:50'],
            'title' => ['required','max:50'],
            'publisher' => ['required','max:50'],
            'category_id' => ['required'],
            'type' => ['required'],
            'status' => ['required'],
            'book_cover' => ['image'],
        ]);

        $validateResponse = json_decode(validator_message($validator));

        if($validateResponse->error){
            return response()->json(['status' => false, 'message' => $validateResponse->message]);
        }
        $data = $request->except('_token','abc');

        if($request->file('book_cover')){
            $image = $request->file('book_cover');
            $imageExt = $image->getClientOriginalExtension();
            $path = Storage::disk('book')->path('');
            $hashStr = Hash::make(Str::random(5));
            $imageName = Carbon::now()->format('Ymd') . $hashStr . '.' . $imageExt;
            $imagePath = $path . $imageName;
            $imageUrl = url('/storage/book_cover/' . $imageName);
            Storage::disk('book')->put($imageName,  File::get($image));
            // dd($imageName, $imagePath, $imageUrl);
            $data['image_path'] = $imagePath;
            $data['image_url'] = $imageUrl;
        }

        $book = Book::create($data);
        
        $itemData = [];
        $itemTotal = (int)$request->get('book_total');
        $refNo = $book->id . substr(time(), -4) . rand(0, 999);
        for ($i = 0; $i < $itemTotal; $i++){
            $tempData = [
                'book_id' => $book->id,
                'refNo' => $refNo . $i,
            ];
            $itemData[] = $tempData;
        }
        // dd($itemData);
        $bookItem = BookItem::insert($itemData);

        return response()->json(['status' => true, 'message' => 'Book is successfully created!']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $book = Book::find($id);
        $categories = BookCategory::all();
        return view('book.edit', compact('book','categories'));
    }

    public function update(Request $request, $id)
    {
        dd($request->all());
        $data = Book::find($id);
        $validator = Validator::make($request->all(), [
            'isbn' => ['required','max:50'],
            'title' => ['required','max:50'],
            'publisher' => ['required','max:50'],
            'category_id' => ['required'],
            'type' => ['required'],
            'status' => ['required'],
        ]);
        $validateResponse = json_decode(validator_message($validator));

        if($validateResponse->error){
            return response()->json(['status' => false, 'message' => $validateResponse->message]);
        }
        $form = $request->except('_method','_token');
        // dd($data);
        $update = $data->update($form);
        return response()->json(['status' => true, 'message' => 'Book successfully updated!']);
    }

    public function destroy($id)
    {
        $data = Book::find($id);
        $data->delete();
        return response()->json(['status' => true, 'message' => 'Book successfully deleted!']);
    }
}
