<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManager extends Controller
{
    public function index()
    {
       return User::with('roles')->get();
    }
    

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);  
         $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function show(User $user)
    {
        return $user;
    }

   public function update(Request $request, User $user)
   {
    $data = $request->validate([
        'name' => 'sometimes|required',
        'email' => 'sometimes|required|email|unique:users,email'. $user->id,
        'password' => 'nullabl|min:6',
    ]);

     if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return $user;

   }

   public function destroy(User $user)
   {
        $user->delete();
        return response()->json(['message' => 'Deleted']);
   }
    





}