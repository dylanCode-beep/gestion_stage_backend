<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
       $request->validate([
        'name' => 'required|string|min:5',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8'
       ]);

       $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
       ]);

       return response()->json([
        'message' => 'Utilisateur creer avec success',
       ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=> 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email',$request->email)->first();
        if (! $user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants sont incorrects'],
            ]);
        }

        return response()->json([
            'message'=> 'Connexion reussie',
            'user' => $user,
            'roles' => $user->getRoleNames()
        ]);

    }

    public function logout(Request $request)
    {
        auth()->logout();
        return response()->json(['message'=> 'Deconnecte']);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
