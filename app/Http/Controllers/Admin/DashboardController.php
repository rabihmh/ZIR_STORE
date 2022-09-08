<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth']);
        //$this->middleware(['auth'])->only('index');
        // $this->middleware(['auth'])->except('index');


    }

    public function index()
    {
        return view('admin.index');
        //or=>   return View::make('dashboard');
        //or=>        return response()->view('dashboard');
        //or=>          return Response::view('dashboard');
    }
}
