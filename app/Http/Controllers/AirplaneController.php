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

    public function store(Request $request)
    {
        $airplane = Airplane::create([
            "name" => $request->name,
            "max_places" => $request->max_places
        ]);

        return ($airplane);
    }

    public function create(Request $request)
    {
        if ($request->method() == "POST")
        {
            $this->store($request);
            return (Redirect::to(route("planes")));
        }
        return (view("airplanesCreate"));
    }

    public function destroy(string $id)
    {
        Airplane::find($id)->delete();
    }

    public function index(Request $request)
    {
        $airplanes = Airplane::all();
        
        if (!Auth::user()->admin)
        {
            return (Redirect::to(route("index")));
        }
        if ($request->action == "delete")
        {
            $this->destroy($request->id);
            return (Redirect::to(route("planes")));
        }
        return (view("airplanes", compact("airplanes")));
    }
}
