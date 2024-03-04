<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        return response()->json([
            'Users' => User::all()
        ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ],
        [
            'name.required' => 'El campo nombre es requerido',
            'name.min' => 'El campo nombre debe tener al menos 3 caracteres',
            'name.max' => 'El campo nombre debe tener máximo 255 caracteres',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email debe ser un email válido',
            'email.unique' => 'El campo email ya está en uso',
            'password.required' => 'El campo password es requerido',
            'password.min' => 'El campo password debe tener al menos 8 caracteres'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'message' => 'User created successfully'
        ], 201);
    }

    public function login(Request $request){

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return response()->json([
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        if(! $user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'msg' => 'Contraseña incorrecta'
            ], 401);
        }

        $token = $user->createToken('Accesstoken')->plainTextToken;

        return response()->json([
            'msg' => 'Se ha logeado correctamente',
            'data' => $user,
            'jwt' => $token,
            'token_type' => 'Bearer',
        ]);
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
