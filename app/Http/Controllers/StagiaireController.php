<?php

namespace App\Http\Controllers;

use App\Models\Stagiaire;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class StagiaireController extends Controller
{
    public $stagiaire;
    
    public function index()
    {
        $stagiaire = User::role('stagiaire')
        ->with('stagiaire')->get();

        return response()->json($stagiaire);
    }


public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'etablissement' => 'required|string',
            'filiere' => 'required|string',
            'niveau' => 'required|',
            'sexe' => 'required',
            'datenaissance' => 'required|',
            'telephone' => 'required',
        ]);
        
        $password = Str::random(8);
        $year = now()->year;
        $count = Stagiaire::whereYear('created_at', $year)->count() + 1;
        $code = 'GST'.$year.'-'.str_pad($count, 3, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        $stagiaire = new Stagiaire([
            'code' => $code,
            'etablissement' => $request->etablissement,
            'filiere' => $request->filiere,
            'niveau' => $request->niveau,
            'sexe' => $request->sexe,
            'datenaissance' => $request->datenaissance,
            'telephone' => $request->telephone,
        ]);

        $user->assignRole('stagiaire');

        $user->stagiaire()->save($stagiaire);

        return response()->json([
            'message' => 'stagiaire creer avec succees',
            'stagiaire' => $stagiaire,
        ]);

    }
        
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $stagiaire = $user->stagiaire;

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $stagiaire->update([
            'etablissement' => $request->etablissement,
            'filiere' => $request->filiere,
            'niveau' => $request->niveau,
            'sexe' => $request->sexe,
            'datenaissance' => $request->datenaissance,
            'telephone' => $request->telephone,
        ]);

        return response()->json(['message' => 'Stagiaire mis à jour']);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'Stagiaire supprimé']);
    }
}
