<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

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

    public function getTables()
    {
        $alltables = DB::select('SHOW TABLES');

        $i = 0;

        foreach($alltables as $key => $value) :
            $tableName = $value->Tables_in_host1344755_basa;

//            if($tableName !== 'migrations' && $tableName !== 'password_resets' && $tableName !== 'users') {
                $returnTables[$i]['name'] = $tableName;
                $returnTables[$i]['checked'] = false;
                $returnTables[$i]['primary'] = '';

                $tableInfo = DB::getSchemaBuilder()->getColumnListing($tableName);

                foreach ($tableInfo as $key2 => $value2) {
                    $returnTables[$i]['rows'][$key2]['name'] = $value2;
                    $returnTables[$i]['rows'][$key2]['checked'] = false;
                }

                $i++;
//            }
        endforeach;

        echo json_encode($returnTables);
    }

    public function tables() {

        return view('admin.pages.tables');
    }
}
