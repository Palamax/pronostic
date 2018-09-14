<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated( \Illuminate\Http\Request $request, \App\User $user ) 
    {
        $retard = DB::table('retardataire') ->where('id', '=', auth()->user()->id)->get();
        if (count($retard) > 0){
            return redirect()->intended($this->redirectPath())
            ->with('success','Bienvenue '.auth()->user()->prenom.' '.auth()->user()->nom)
        ->with('error','Pensez à pronostiquer J et J+1');
        }else{
            return redirect()->intended($this->redirectPath())
            ->with('success','Bienvenue '.auth()->user()->prenom.' '.auth()->user()->nom);
        }
    }
}
