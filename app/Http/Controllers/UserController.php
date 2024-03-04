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

    public function login(Request $request){
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json([
            'message' => 'User created successfully'
        ], 201);
    }
}
