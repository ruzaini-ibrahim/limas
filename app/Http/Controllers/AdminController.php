<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function index()
    {
        return view('admin.index');
    }

    public function records(Request $request)
    {
        $query = Admin::select('id','name','email');
        $count = $query->count();
        $query = $query->get();
        // dd($query, $count);
        $responseTable = [];
        foreach ($query as $key => $admin) {
            $data = [
                $admin['id'],
                $admin['name'],
                $admin['email'],
                '<a onclick="showAdmin(' . $admin['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-eye color-main"></i></a>
                <a onclick="editAdmin(' . $admin['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-edit color-main"></i></a>
                <a onclick="deleteAdmin(' . $admin['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-trash-alt color-main"></i></a>',
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
            'name' => ['required','max:50'],
            'email' => ['required','email','unique:admins,email'],
            'password' => ['required','min:6'],
        ]);

        $validateMessage = "<b class='font-weight-700 mt-2'>Please check your form!</b>";
        if($validator->fails()){
            $error = $validator->messages()->toArray();
            foreach ($error as $messages) {
                foreach ($messages as $message) {
                    $validateMessage .= "<li>" . $message . "</li>";
                }
            }
            return response()->json(['status' => false, 'message' => $validateMessage]);
        }
        
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);

        $admin = Admin::create($data);

        return response()->json(['status' => true, 'message' => 'Admin ' . $data['name'] . ' successfully created!']);
    }
     
    public function show($id)
    {
        //
    }
     
    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.form._add', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:50'],
            'email' => ['required','email','unique:admins,email,'.$admin->id],
        ]);
        $validateMessage = "<b class='font-weight-700 mt-2'>Please check your form!</b>";
        if($validator->fails()){
            $error = $validator->messages()->toArray();
            foreach ($error as $messages) {
                foreach ($messages as $message) {
                    $validateMessage .= "<li>" . $message . "</li>";
                }
            }
            return response()->json(['status' => false, 'message' => $validateMessage]);
        }
        $data = $request->except('_method','_token');
        // dd($data);
        $update = $admin->update($data);
        return response()->json(['status' => true, 'message' => 'User successfully updated!']);
    }
     
    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return response()->json(['status' => true, 'message' => 'User successfully deleted!']);
    }
}
