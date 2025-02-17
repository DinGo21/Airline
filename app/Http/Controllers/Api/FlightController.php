<?php

namespace App\Http\Controllers\Api;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    public function index()
    {
        return (response()->json(Flight::All(), 200));
    }

    public function show(string $id)
    {
        return (response()->json(Flight::find($id), 200));
    }

    public function store(Request $request)
    {
        $flight = Flight::create([
            "date" => $request->date,
            "departure" => $request->departure,
            "arrival" => $request->arrival,
            "image" => $request->image,
            "airplane_id" => $request->airplaneId,
            "available_places" => $request->availablePlaces,
            "status" => $request->status
        ]);

        if ($flight->available_places > $flight->airplane->max_places)
        {
            $flight->update([
                "available_places" => $flight->airplane->max_places
            ]);
        }
        return (response()->json($flight, 200));
    }

    public function update(Request $request, string $id)
    {
        $flight = Flight::find($id);
        $flight->update([
            "date" => $request->date,
            "departure" => $request->departure,
            "arrival" => $request->arrival,
            "image" => $request->image,
            "airplane_id" => $request->airplaneId,
            "available_places" => $request->availablePlaces,
            "status" => $request->status
        ]);

        if ($flight->available_places > $flight->airplane->max_places)
        {
            $flight->update([
                "available_places" => $flight->airplane->max_places
            ]);
        }
        return (response()->json($flight, 200));
    }

    public function destroy(string $id)
    {
        Flight::find($id)->delete();
    }
}
