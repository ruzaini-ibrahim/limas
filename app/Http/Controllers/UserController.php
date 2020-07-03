<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        // dd(auth()->guard());
        // ddd(User::all()->toarray());
        return view('user.index');
    }

    public function records(Request $request)
    {
        $query = User::select('id','name','email');
        $count = $query->count();
        $query = $query->get()->toarray();
        // dd($query, $count);
        $responseTable = [];
        foreach ($query as $key => $user) {
            $data = [
                $user['id'],
                $user['name'],
                $user['email'],
                '<a onclick="showUser(' . $user['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-eye color-main"></i></a>
                <a onclick="editUser(' . $user['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-edit color-main"></i></a>
                <a onclick="deleteUser(' . $user['id'] . ')" href="javascript:void(0)" class="mx-1"><i class="fa fa-trash-alt color-main"></i></a>',
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
            'email' => ['required','email','unique:users,email'],
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

        // $user = User::where('email', $data['email'])->first();
        // $check = Hash::check($request->get('password'), $user->password);
        // dd($data);

        $user = User::create($data);

        return response()->json(['status' => true, 'message' => 'User ' . $data['name'] . ' successfully created!']);
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.form._add', compact('user'));
    }

    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:50'],
            'email' => ['required','email','unique:users,email,'.$user->id],
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
        $update = $user->update($data);
        return response()->json(['status' => true, 'message' => 'User successfully updated!']);
    }

    
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['status' => true, 'message' => 'User successfully deleted!']);
    }
}
