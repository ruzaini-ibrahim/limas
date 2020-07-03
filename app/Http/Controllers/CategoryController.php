<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookCategory;
use Validator;

class CategoryController extends Controller
{
    
    public function index()
    {
        return view('category.index');
    }

    public function records(Request $request)
    {
        $query = BookCategory::select('*');
        $count = $query->count();
        $query = $query->get();
        // dd($query->toarray(), $count);
        $responseTable = [];
        foreach ($query as $key => $category) {
            $data = [
                $category['id'],
                $category['name'],
                '<a onclick="showCategory(' . $category['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-eye color-main"></i></a>
                <a onclick="editCategory(' . $category['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-edit color-main"></i></a>
                <a onclick="deleteCategory(' . $category['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-trash-alt color-main"></i></a>',
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
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:50','unique:book_categories,name'],
        ]);


        $validateResponse = json_decode(validator_message($validator));

        if($validateResponse->error){
            return response()->json(['status' => false, 'message' => $validateResponse->message]);
        }
        
        $data = $request->except('_token');

        $category = BookCategory::create($data);

        return response()->json(['status' => true, 'message' => 'Category ' . $data['name'] . ' is successfully created!']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = BookCategory::find($id);
        return view('category.form._add', compact('category'));
    }

    
    public function update(Request $request, $id)
    {
        $data = BookCategory::find($id);
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:50', 'unique:book_categories,name,'.$data->name],
        ]);
        $validateResponse = json_decode(validator_message($validator));

        if($validateResponse->error){
            return response()->json(['status' => false, 'message' => $validateResponse->message]);
        }
        $form = $request->except('_method','_token');
        // dd($data);
        $update = $data->update($form);
        return response()->json(['status' => true, 'message' => 'Category successfully updated!']);
    }

    public function destroy($id)
    {
        $data = BookCategory::find($id);
        $data->delete();
        return response()->json(['status' => true, 'message' => 'Category successfully deleted!']);
    }
}
