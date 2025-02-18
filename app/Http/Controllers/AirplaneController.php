<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AirplaneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $airplanes = Airplane::all();
        
        if (!Auth::user()->admin)
        {
            return Redirect::to(route("index"));
        }
        return view("airplanes", compact("airplanes"));
    }
}
