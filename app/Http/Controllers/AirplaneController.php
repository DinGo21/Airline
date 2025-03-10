<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AirplaneController extends Controller
{
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
        if ($request->method() === "POST")
        {
            $this->store($request);
            return (Redirect::to(route("planes")));
        }
        return (view("admin.airplanes.airplanesCreate"));
    }

    public function update(Request $request, Airplane $airplane)
    {
        $airplane->update([
            "name" => $request->name,
            "max_places" => $request->max_places
        ]);
        foreach ($airplane->flights as $flight)
        {
            if ($flight->available_places > $airplane->max_places)
            {
                $flight->update([
                    "available_places" => $airplane->max_places
                ]);
            }
        }
        return ($airplane);
    }

    public function edit(Request $request, string $id)
    {
        $airplane = Airplane::find($id);

        if ($request->method() === "POST")
        {
            $this->update($request, $airplane);
            return (Redirect::to(route("planes")));
        }
        return (view("admin.airplanes.airplanesEdit", compact("airplane")));
    }

    public function destroy(string $id)
    {
        Airplane::find($id)->delete();
    }

    public function index(Request $request)
    {
        $airplanes = Airplane::all();
        
        if ($request->action == "delete")
        {
            $this->destroy($request->id);
            return (Redirect::to(route("planes")));
        }
        return (view("admin.airplanes.airplanes", compact("airplanes")));
    }
}
