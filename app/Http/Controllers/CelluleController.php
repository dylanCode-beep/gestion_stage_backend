<?php

namespace App\Http\Controllers;

use App\Models\Cellule;
use Illuminate\Http\Request;

class CelluleController extends Controller
{
    public function index()
    {
        return Cellule::all();
    }

    public function create(Request $request)
    {
       $data =  $request->validate([
            'code' => 'required|string|min:3',
            'nom' => 'required|string',
            'description' => 'required|string',
        ]);

        $cellule = Cellule::create($data);
        return response()->json($cellule,201);
    }

    public function update(Request $request , $id)
    {
        $cellule = Cellule::findOrFail($id);

        $request->validate([
            'code' => 'required|string|',
            'nom' => 'required|string',
            'description' => 'required|string'
        ]);

        $cellule->update($request->only(['nom','code','description']));

        return response()->json([
            'message' => 'Cellule mise a jour avec success',
            'cellule' => $cellule
        ]);
    }

    public function destroy($id)
    {
        $cellule = Cellule::findOrFail($id);
        $cellule->delete();
        
        return response()->json([
            'message' => 'Cellule supprimee avec success',
        ], 204);
    }
}
