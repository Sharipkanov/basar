<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ИНТЕРФЕЙСЫ */

    // Интерфейс страницы пользователей
    public function users()
    {
        if(Auth::user()->is_admin) return view('admin.pages.users');
        else return redirect('/admin/profile');
    }

    // Интерфейс страницы пользователя
    public function profile()
    {

        return view('admin.pages.profile');
    }

    // Интерфейс страницы пользователя для администратора
    public function userProfile($email) {
        $user = User::where('email', $email)->first();

        return view('admin.pages.profile-admin-view', ['user' => $user]);
    }

    /* РАБОТА С ЗАПРОСАМИ */

    // Вывод всех пользователей
    public function usersAll() {
        $users = User::select('id', 'name', 'surname', 'thumbnail', 'email', 'is_active')->where('is_admin', 0)->get();

        echo json_encode($users);
    }

    // Добавление нового пользователя
    public function addUser(Request $request)
    {
        $token = Hash::make('StringCanContainsAnyMessange' . $request->input('email'));
        $token = str_replace('/', '', $token);
        $token = str_replace('.', '', $token);

        $alltables = DB::select('SHOW TABLES');

        $i = 0;

        foreach($alltables as $key => $value) :
            $tableName = $value->Tables_in_host1344755_basa;

            if($tableName !== 'migrations' && $tableName !== 'password_resets' && $tableName !== 'users') {
                $returnTables[$i]['name'] = $tableName;
                $returnTables[$i]['checked'] = false;
                $returnTables[$i]['primary'] = '';

                $tableInfo = DB::getSchemaBuilder()->getColumnListing($tableName);

                foreach ($tableInfo as $key2 => $value2) {
                    $returnTables[$i]['rows'][$key2]['name'] = $value2;
                    $returnTables[$i]['rows'][$key2]['checked'] = 0;
                }

                $i++;
            }
        endforeach;

        $user = new User;

        $user->email = $request->input('email');
        $user->name = 'Новый';
        $user->surname = 'Пользователь';
        $user->thumbnail = '/cms-templates/light-bootstrap-dashboard-master/assets/img/faces/no-profile-img.gif';
        $user->password = '';
        $user->permissions = json_encode($returnTables);
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

    // Письмо для установки пароля и активации пользователя
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

    // Удаление пользователя
    public function removeUser(Request $request) {
        $user = User::where('email', $request->input('email'))->first();

        if($user):
            if ($user->delete()) echo 1;
            else echo 0;
        else :
            echo 0;
        endif;
    }

    public function userInfo($email)
    {
        $user = User::select('id', 'email', 'name', 'surname', 'address', 'city', 'country', 'permissions', 'phone', 'thumbnail', 'is_active')->where('email', $email)->first();

        echo json_encode($user);
    }

    public function userInfoUpdate(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        $newUserData = $request->all();

        foreach ($newUserData as $key => $value):
            if($key == 'permissions') $value = json_encode($value);
            $user[$key] = $value;
        endforeach;

        $userSaved = $user->save();

        if($userSaved) echo 1;
        else echo 0;
    }

    public function profileTables()
    {
        $permissions  = json_decode(Auth::user()->permissions);

        foreach($permissions as $key => $value) :
            if($value->checked) {
                $tables[$key] = $value->name;
            }
        endforeach;

        echo json_encode($tables);
    }

    public function profileTableInfo($table)
    {
        $permissions  = json_decode(Auth::user()->permissions);
        $tablePrimaryKey = "";
        $rows = array();
        foreach($permissions as $key => $value) :
            if($value->name == $table) {
                $tablePrimaryKey = $value->primary;
                foreach ($value->rows as $key2 => $value2) :
                    if($value2->checked) {
                        array_push($rows, $value2->name);
                    }
                endforeach;
            }
        endforeach;

        $data = DB::table($table)->select($rows)->paginate(15);

        return view('admin.pages.table', ['tableInfo' => $data, 'tableRows' => $rows, 'tableName' => $table, 'tablePrimaryKey' => $tablePrimaryKey]);
    }

    public function profileTableInfoGet($table)
    {
        $permissions  = json_decode(Auth::user()->permissions);

        $rows = array();
        $checkTypes = array();
        foreach($permissions as $key => $value) :
            if($value->name == $table) {
                foreach ($value->rows as $key2 => $value2) :
                    if($value2->checked) {
                        array_push($rows, $value2->name);
                        array_push($checkTypes, $value2->checked);
                    }
                endforeach;
            }
        endforeach;

        $data = DB::table($table)->select($rows)->paginate(15);

        $retunData['data'] = $data;
        $retunData['checkTypes'] = $checkTypes;

        echo json_encode($retunData);
    }

}
