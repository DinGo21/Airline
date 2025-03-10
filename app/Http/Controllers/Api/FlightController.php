<?php

namespace App\Http\Controllers\Api;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Airplane;
use DateTime;
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
        $airplane = Airplane::find($request->airplaneId);
        $places = $request->availablePlaces;
        $status = $request->status;

        if ($request->availablePlaces > $airplane->max_places)
        {
            $places = $airplane->max_places;
        }
        if (new DateTime($request->date) < now())
        {
            $status = 0;
        }
        $flight = Flight::create([
            "date" => $request->date,
            "departure" => $request->departure,
            "arrival" => $request->arrival,
            "image" => $request->image,
            "airplane_id" => $request->airplaneId,
            "available_places" => $places,
            "status" => $status
        ]);
        return (response()->json($flight, 200));
    }

    public function update(Request $request, string $id)
    {
        $flight = Flight::find($id);
        $places = $request->availablePlaces;
        $status = $request->status;

        if ($request->availablePlaces > $flight->airplane->max_places)
        {
            $places = $flight->airplane->max_places;
        }
        if (new DateTime($request->date) < now())
        {
            $status = 0;
        }
        $flight->update([
            "date" => $request->date,
            "departure" => $request->departure,
            "arrival" => $request->arrival,
            "image" => $request->image,
            "airplane_id" => $request->airplaneId,
            "available_places" => $places,
            "status" => $status
        ]);
        return (response()->json($flight, 200));
    }

    public function destroy(string $id)
    {
        Flight::find($id)->delete();
    }
}
