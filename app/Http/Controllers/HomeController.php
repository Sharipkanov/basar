<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function alltables()
    {
        $alltables = DB::select('SHOW TABLES');

        foreach($alltables as $key => $value) :
            $tableName = $value->Tables_in_basar;

            $tableInfo = DB::getSchemaBuilder()->getColumnListing($tableName);

            print_r($tableInfo);
        endforeach;
    }
}
