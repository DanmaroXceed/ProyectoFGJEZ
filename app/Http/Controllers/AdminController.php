<?php

namespace App\Http\Controllers;

use App\Models\extravio;
use DB;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function indexUsers( ){
        $users = user::join("personals","users.id","=","personals.user_id")
                    ->where('type', '0')
                    ->get();

        return view('revision', ['users'=> $users]);
    }

    public function verifData($id){
        DB::table('personals')
            ->where('user_id', $id)
            ->update(['verif' => 1]);

        return redirect() -> route('revision') -> with('correcto', 'Se verificaron los datos correctamente');
    }

    public function indexreports($id){
        $reports = extravio::where('user_id', $id)
                    ->get();

        return view('view-reports', ['reports'=> $reports]);
    }

    public function verifreport($id){
        DB::table('extravios')
            ->where('id', $id)
            ->update(['verif' => 1]);
        
        //generar reporte

        return redirect() -> route('view-reports') -> with('correcto', 'Se genero el reporte correctamente correctamente');
    }

    public function down($rutaDeArchivo){
        return response()->redirect()->route('revision')->download($rutaDeArchivo);
    }

}
