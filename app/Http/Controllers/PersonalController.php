<?php

namespace App\Http\Controllers;

use App\Models\personal;
use File;
use Illuminate\Http\Request;
use Str;
use Validator;

class PersonalController extends Controller
{
    public function indexUser()
    {
        $personal = personal::where('user_id', auth()->user()->id)->get();
        return view('personales', ['personal'=> $personal]);
    }

    public function index()
    {
        
        // return $this->sendResponse(PeResource::collection($personal), 'Reportes encontrados.');
    }


    public function getFile(string $id){
        $archivo = Personal::find($id);

        if ($archivo) {
            $ruta = $archivo->file;
            return 'Ruta del archivo: ' . $ruta;
        } else {
            return 'Archivo no encontrado';
        }
    }

    public function store(Request $request)
    {
        $request -> validate([
            'address' => 'required',
            'brtDay' => 'required',
            'gen' => 'required',
            'file' => 'required'
        ]);

        $input = $request->all();

        if ($request->hasFile('file')) {
            $archivo = $request->file('file');
            $nombreArchivo = uniqid() . '.pdf';

            $archivo->storeAs('', $nombreArchivo . '.pdf','public');
            $input['file'] = $nombreArchivo;
        }

        if (auth()->user()) {
            $user = auth()->user();
            $input['user_id'] = $user->id;
            $input['verif'] = false;
        } else {
            // El usuario no está autenticado
            $input['user_id'] = null; // o cualquier otro valor predeterminado que desees
        }
        $personal = Personal::create($input);
        return redirect() -> route('personales') -> with('correcto', 'Se guardaron los datos correctamente');
    }

    public function show(string $id)
    {
        $personal = Personal::find($id);
        if (is_null($personal)) {
            return $this->sendError('No existe.');
        }
        return view('edit-personales', ['personal'=> $personal]);
    }

    public function destroy(Personal $personal)
    {
        $personal->delete();
        return $this->sendResponse([], 'Registro Borrado.');
    }

    public function update(Request $request, $id)
    {
        $personal = personal::find($id);
        $request -> validate([
            'address' => 'required',
            'brtDay' => 'required',
            'gen' => 'required',
            'file' => 'required'
        ]);
        
        $personal->address = $request['address'];
        $personal->brtDay = $request['brtDay'];
        $personal->gen = $request['gen'];
        if ($request->hasFile('file')) {
            $archivo = $request->file('file');
            $nombreArchivo = uniqid() . '.pdf';

            $archivo->storeAs('', $nombreArchivo,'public');
            $personal->file = $nombreArchivo;
        }
        $personal->save();
        
        return redirect() -> route('personales') -> with('correcto',  'Datos actualizados');
    }

    public function down($rutaDeArchivo){
        return response()->download($rutaDeArchivo);
    }
}
