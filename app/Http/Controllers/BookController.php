<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;

use App\Book;
use App\BookItem;
use App\BookCategory;
use App\Media;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;

class BookController extends Controller
{
    public function index()
    {
        // Session::forget('test_delete');
        // dd(Session::all());
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
                '<a href="book/' . $book['id'] . '" class="mx-1"><i class="fa fa-eye color-main"></i></a>
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

    public function coverAdd(Request $request)
    {
        if ($request->file('files')) {
            $request_type = 'create';
            if($request->has('book_id')){
                $request_type = 'update'; //later for delete image
            }
            $this->upload_file($request, $request_type);
            
        }
    }

    private function upload_file(Request $request, $request_type = "")
    {
        $message = [];
        $images = $request->file('files');
        $data = [];
        $sessionParams = [];
    // dd($request->all(),$_FILES['files'], $request_type);
    // dd(count($images), $_FILES['files']);
        foreach ($images as $index => $image) {
            $imageExt = $image->getClientOriginalExtension();
            $path = Storage::disk('book')->path('');
            $hashStr = Hash::make(Str::random(5));
            $imageName = Carbon::now()->format('Ymd') . '-' . time() . '-' .Str::random(5) . '.' . $imageExt;
            $imagePath = $path . $imageName;
            $imageUrl = url('/storage/book_cover/' . $imageName);
            $imageSize = $_FILES['files']['size'][$index];
            // Storage::disk('book')->put($imageName,  File::get($image));
            $data[] = $_FILES['files']['name'][$index];
            if(move_uploaded_file($_FILES['files']['tmp_name'][$index], $imagePath)){
                $imageData['file_name'] = $imageName;
                $imageData['file_path'] = $imagePath;
                $imageData['file_url'] = $imageUrl;
                $imageData['file_size'] = $imageSize;

                $sessionParams[] = $imageData;
                $message['status'] = true;
            }else{
                $message['status'] = false;
                $message['message'] = "Failed to upload file. Somthing is happening!";
            }
        }
        // dd($imageName, $imagePath, $imageUrl);
        // $data['image_url'] = $imageUrl;    
        if($message['status']){
            Session::put('book_images', $sessionParams);
        }
        return response()->json($message);
    }

    public function create()
    {
        $categories = BookCategory::all();
        return view('book.add', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->session()->all());
        $validateForm = $request->validate([
            'isbn' => ['required','max:50'],
            'title' => ['required','max:50'],
            'publisher' => ['required','max:50'],
            'category_id' => ['required'],
            'type' => ['required'],
            'status' => ['required'],
        ]);
        $data = $request->except('_token');

        //create book
        $book = Book::create($data);
        
        //create book items
        $itemData = [];
        $itemTotal = (int) $request->get('book_total');
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

        //create book  media
        if($images_file = $request->session()->get('book_images')){
            foreach ($images_file as $index => $image) {
                $images_file[$index]['belongs_to'] = $book->id;
                $images_file[$index]['type'] = 'book';
            }

            $media = Media::insert($images_file);
            // dd($images_file);
            $request->session()->pull('book_images', 'default'); //delete session
        }


        return redirect()->route('book.index')->with('success','Book Successfully created');
        // return redirect()->back()->with('success','Book Successfully created');
    }

    public function show($id)
    {
        $book = Book::find($id);
        $categories = BookCategory::all();
        $bookMedias = $book->bookMedia;
        $bookItems = $book->bookItem;
        // dd($bookItems);
        return view('book.show', compact('book','categories','bookMedias','bookItems'));
    }

    public function showBookItemRecords($id)
    {
        $bookItem = BookItem::find($id);
        $bookCheckouts = $bookItem->checkoutRecord()->paginate(2);
        // dd(url('/test'), url()->current() . '?page=');
        // dd($bookItem, $bookCheckouts[0]->lender);
        // dd("ok");
        return view('book.form.bookRecords', compact('bookItem','bookCheckouts'));
    }

    public function test(Request $request, $id)
    {
        $books = Book::paginate(2);
        // dd(url('/test'), url()->current() . '?page=');
        // dd($request->all());
        return view('book.test',['books'=>$books]);
    }

    public function edit($id)
    {
        $book = Book::find($id);
        $categories = BookCategory::all();
        $bookMedias = $book->bookMedia;
        return view('book.edit', compact('book','categories','bookMedias'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $book = Book::find($id);
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
        // update book
        $update = $book->update($form);

        //create book  media
        if($images_file = $request->session()->get('book_images')){
            foreach ($images_file as $index => $image) {
                $images_file[$index]['belongs_to'] = $book->id;
                $images_file[$index]['type'] = 'book';
            }

            $media = Media::insert($images_file);

            $request->session()->pull('book_images', 'default'); //delete session
        }
        return redirect()->route('book.index')->with('success','Book Successfully updated');
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        // $bookMedia = $book->bookMedia()->get()->toArray();

        //delete book media storage
        $bookMedia = $book->bookMedia()->pluck('file_name')->all();
        foreach ($bookMedia as $index => $fileName) {
            Storage::disk('book')->delete($fileName);
        }

        //delete book media 
        $book->bookMedia()->delete();

        //delete book
        $book->delete();
        return response()->json(['status' => true, 'message' => 'Book successfully deleted!']);
    }
}
