<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\Datatables;
use App\Local;

class LocalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('local.index');
    }
    public function lista()
    {
        return Datatables\Datatables::of(Local::query())
            ->addColumn('distrito_name', function($row){
                return $row->distrito->nombre;
            })
            ->make(true);
    }
}
