<?php

namespace App\Http\Controllers;

use App\Mail\CorregirReporte;
use App\Mail\SenderMailable;
use App\Models\extravio;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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

        $user = DB::table('personals')
            ->join("users","users.id","=","personals.user_id")
            ->where('user_id', $id)
            ->value('email');

        Mail::to($user)
            ->send(new SenderMailable('Validacion de Datos personales','emails.ValidDP'));

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

        $user = DB::table('extravios')
            ->join("users","users.id","=","extravios.user_id")
            ->where('extravios.id', $id)
            ->value('email');

        $report = DB::table('extravios')
            ->join("users","users.id","=","extravios.user_id")
            ->where('extravios.id', $id)
            ->value('nameDoc');
        
        Mail::to($user)
            ->send(new CorregirReporte('Se verifico su reporte','emails.Repverif', $report));

        return back()-> with(['correcto' => 'Se genero el reporte correctamente']);
    }

    public function down($rutaDeArchivo){
        return response()->redirect()->route('revision')->download($rutaDeArchivo);
    }

    public function mailCorreccionPersonal($mailTo){
        Mail::to($mailTo)
            ->send(new SenderMailable('Correccion a Datos personales','emails.CorregirDP'));
        return back()-> with(['correcto' => 'Se envio el correo correctamente']);
    }

    public function mailCorreccionExtravio($mailTo, $report){
        $user = DB::table('extravios')
                ->join("users","users.id","=","extravios.user_id")
                ->where('user_id', $mailTo)
                ->value('email');
        Mail::to($user)
            ->send(new CorregirReporte('Correccion a Reporte','emails.CorregirReport', $report));
        return back()-> with(['correcto' => 'Se envio el correo correctamente']);
    }
}
