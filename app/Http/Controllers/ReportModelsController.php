<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportModelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('reports.index');
    }

    public function create()
    {
        return view('reports.create');
    }
}
