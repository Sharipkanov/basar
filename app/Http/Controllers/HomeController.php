<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function passwordActivation($token)
    {
        if(Auth::user()) {
            Auth::logout();
        }

        $user = User::select('id', 'email', 'activation_hash')->where('activation_hash', $token)->first();

        if(!$user) abort(404);
        else return view('auth.password-reset', ['user' => $user, 'error' => []]);
    }

    public function passwordActivationPost(Request $request)
    {
        if($request->input('password') != $request->input('password_confirmation')) {
            $user = User::select('id', 'email', 'activation_hash')->where('activation_hash', $request->input('activation_hash'))->first();

            $error = 'Пароли не совподают! Проверте правильность заполнения пароля.';
            return view('auth.password-reset', ['user' => $user, 'error' => $error]);
        } else {
            $user = User::where([
                'email' => $request->input('email'),
                'activation_hash' => $request->input('activation_hash')
            ])->first();

            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->password = bcrypt($request->input('password'));
            $user->activation_hash = "";
            $user->is_active = 1;
            $user->save();

            Auth::login($user, true);

            return redirect('/admin/profile');
        }
    }
}
