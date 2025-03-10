<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airplane;
use Illuminate\Http\Request;

class AirplaneController extends Controller
{
    public function index()
    {
        return (response()->json(Airplane::All(), 200));
    }

    public function show(string $id)
    {
        return response()->json(Airplane::find($id), 200);
    }

    public function store(Request $request)
    {
        if ($request->maxPlaces < 0 || $request->maxPlaces > 200)
            return (response()->json(["message" => "Invalid parameters."], 400));
        $plane = Airplane::create([
            "name" => $request->name,
            "max_places" => $request->maxPlaces
        ]);
        
        return (response()->json($plane, 200));
    }

    public function update(Request $request, string $id)
    {
        $plane = Airplane::find($id);

        $plane->update([
            "name" => $request->name,
            "max_places" => $request->maxPlaces
        ]);
        foreach ($plane->flights as $flight)
        {
            if ($flight->available_places > $plane->max_places)
            {
                $flight->update([
                    "available_places" => $plane->max_places
                ]);
            }
        }
        return (response()->json($plane, 200));
    }

    public function destroy(string $id)
    {
        Airplane::find($id)->delete();
    }
}
