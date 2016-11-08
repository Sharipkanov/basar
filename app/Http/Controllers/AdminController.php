<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Интерфейс панели управления
    public function dashboard()
    {

        return view('admin.pages.dashboard');
    }

    // Интерфейс страницы пользователя
    public function profile()
    {

        return view('admin.pages.profile');
    }

    // Интерфейс страницы пользователей
    public function users()
    {

        return view('admin.pages.users');
    }

    // Вывод всех пользователей
    public function usersAll() {
        $users = User::all();

        echo json_encode($users);
    }

    // Добавление нового пользователя
    public function addUser(Request $request)
    {
        $token = Hash::make('StringCanContainsAnyMessange' . $request->input('email'));
        $token = str_replace('/', '', $token);
        $token = str_replace('.', '', $token);

        $user = new User;

        $user->email = $request->input('email');
        $user->name = 'Новый';
        $user->surname = 'Пользователь';
        $user->thumbnail = '/cms-templates/light-bootstrap-dashboard-master/assets/img/faces/no-profile-img.gif';
        $user->password = '';
        $user->permissions = '';
        $user->activation_hash = $token;
        $userSuccess = $user->save();

        if($userSuccess) :
            $returnData['status'] = 1;
            $returnData['data'] = url('/') .'/passwordActivation/' . $token;

            echo json_encode($returnData);
        else :
            $returnData['status'] = 2;
            echo json_encode($returnData);
        endif;
    }

    public function userRegistrationMail(Request $request) {
        if($request->input('email')) {
            $data = "Ссылка для установки пароля: {$request->input('route')}";
            Mail::raw($data, function ($message) use ($request) {
                $message->from('sharipkanov@gmail.com', 'Установка пароля');
                $message->to($request->input('email'))->subject('Установка пароля');
                $responseTxt['messange'] = "Пользователю было отправлено сообщение";
                $responseTxt['status'] = 1;
                echo json_encode($responseTxt);
            });
        }
    }
}
