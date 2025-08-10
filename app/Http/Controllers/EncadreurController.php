<?php

namespace App\Http\Controllers;

use App\Models\Encadreur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class EncadreurController extends Controller
{
    public function index()
    {
        $encadreurs = User::role('encadreur')->with('encadreur')->get();
        return response()->json($encadreurs);
    }


    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'num_cni' => 'required|string',
        'telephone' => 'required',
       ]);

       $passowrd = Str::random(8);

       $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($passowrd)
       ]);

       $encadreurs = new Encadreur([
        'num_cni' => $request->num_cni,
        'telephone' => $request->telephone,
       ]);

       $user->assignRole('encadreur');

       $user->encadreur()->save($encadreurs);
       return response()->json([
        'message' => 'Encadreur cree avec success',
        'encadreur' => $encadreurs
       ],201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $encadreurs = $user->encadreur;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $encadreurs->update([
            'num_cni' => $request->num_cni,
            'telephone' => $request->telephone,
        ]);

        return response()->json([
            'message' => 'encadreur mis a jour avec success',
        ]);

    }

     public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'Encadreur supprimé']);
    }
}
