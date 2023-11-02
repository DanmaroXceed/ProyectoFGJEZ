<?php

namespace App\Http\Controllers;

use App\Models\extravio;
use Illuminate\Http\Request;
use Validator;

class ExtravioController extends Controller
{
    public function indexUser()
    {
        $extravios = Extravio::where('user_id', auth()->user()->id)->get();
        return view('extravio', ['extravios'=> $extravios]);

    }

    public function index()
    {
        $extravios = extravio::all();
        return redirect() -> route('extravio') -> with('extravios', $extravios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nameDoc' => 'required',
            'docDesc' => 'required',
            'date' => 'required',
            'place' => 'required',
            'escDesc' => 'required'
        ]);
        
        $input = $request->all();

        if (auth()->user()) {
            $user = auth()->user();
            $input['user_id'] = $user->id;
            $input['verif'] = false;
        } else {
            // El usuario no está autenticado
            $input['user_id'] = null; // o cualquier otro valor predeterminado que desees
        }
        $extravio = Extravio::create($input);
        return redirect() -> route('extravio') -> with('correcto', 'Se genero el reporte correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $extravio = Extravio::find($id);

        // dd($extravio);
        return view('edit-extravio', ['extravio'=> $extravio]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $extravio = extravio::find($id);
        $extravio -> delete();
        return redirect() -> route('extravio') -> with('correcto', 'Reporte Eliminado');
    }

    public function update(Request $request, $id)
    {
        $request -> validate([
            'nameDoc' => 'required',
            'docDesc' => 'required',
            'date' => 'required',
            'place' => 'required',
            'escDesc' => 'required'
        ]);
        
        $extravio = extravio::find($id);
        $extravio->nameDoc = $request -> nameDoc;
        $extravio->docDesc = $request -> docDesc;
        $extravio->date = $request -> date;
        $extravio->place = $request -> place;
        $extravio->escDesc = $request -> escDesc;
        $extravio->save();
        
        return redirect() -> route('extravio') -> with('correcto',  'Reporte actualizado');
    }
}
