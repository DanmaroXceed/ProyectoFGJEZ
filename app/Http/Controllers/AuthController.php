<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Validator;

class AuthController extends Controller
{
    public function signin(Request $request)
    {
        $credenciales = request()->only('email', 'password');
        $recordar = request()->filled('recuerdame');
        if(Auth::attempt($credenciales, $recordar)){
            request()->session()->regenerate(); 
            $authUser = Auth::user(); 
            $success['name'] =  $authUser->name;
            $success['type'] =  $authUser->type;

            return redirect() -> intended('home');
        } 
        else{ 
            throw ValidationException::withMessages([
                'error'=> __('auth.failed'),
            ]);
        } 
    }

    public function signup(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['type'] = 0;
        try {
            $user = User::create($input);
            // Otras operaciones aquí
            return redirect()->route('login')->with('correcto', 'Usuario creado satisfactoriamente');
        } catch (\Illuminate\Database\QueryException $ex) {
                return back()->with('error', 'El correo electrónico ya está en uso. Por favor, elige otro correo electrónico.');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect() -> route('login');
    }
}
