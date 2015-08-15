<?php

namespace App\Http\Controllers;

use App\Estar\Excel\TableExport;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home.employee');
    }

    public function show()
    {
        return view('home.employeeShow');
    }

    public function export(TableExport $export)
    {
        return $export->sheet('人员',function($sheet){
        })->download('xls');
    }

}
