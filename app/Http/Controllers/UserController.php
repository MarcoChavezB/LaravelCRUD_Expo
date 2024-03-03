<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return response()->json([
            'Users' => User::all()
        ]);
    }

    public function store(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json([
            'message' => 'User created successfully'
        ], 201);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->input('name', $user->name);
        $user->email = $request->input('email', $user->email);
        $user->password = $request->input('password', $user->password);
        $user->save();
        return response()->json([
            'message' => 'User updated successfully'
        ], 200);
    }
    
}
