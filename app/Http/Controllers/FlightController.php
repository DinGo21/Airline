<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Airplane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::where("status", "1")
                            ->where("date", ">=", now())
                            ->orderBy("date", "asc")->get();

        return (view("index", compact("flights")));
    }

    public function book(Flight $flight, int $userId)
    {
        $flight->users()->attach($userId);
        $flight->update([
            "available_places" => $flight->available_places - 1
        ]);
    }

    public function debook(Flight $flight, int $userId)
    {
        $flight->users()->detach($userId);
        $flight->update([
            "available_places" => $flight->available_places + 1
        ]);
    }

    public function show(Request $request, string $id)
    {
        $flight = Flight::find($id);
        $isBooked = count($flight->users()->where("user_id", Auth::id())->get());

        if ($request->action === "book" && !$isBooked)
        {
            $this->book($flight, Auth::id());
            return (Redirect::to(route("show", $flight->id)));
        }
        if ($request->action == "debook" && $isBooked)
        {
            $this->debook($flight, Auth::id());
            return (Redirect::to(route("show", $flight->id)));
        }
        return (view("show", compact("flight", "isBooked")));
    }

    public function store(Request $request)
    {
        $airplane = Airplane::find($request->airplane);
        $flight = Flight::create([
            "date" => $request->date,
            "departure" => $request->departure,
            "arrival" => $request->arrival,
            "image" => $request->image,
            "airplane_id" => $airplane->id,
            "available_places" => $airplane->max_places,
            "status" => $request->status
        ]);

        return ($flight);
    }

    public function create(Request $request)
    {
        $airplanes = Airplane::all();

        if (!Auth::user()->admin)
        {
            return (Redirect::to(route("index")));
        }
        if ($request->method() === "POST")
        {
            $this->store($request);
            return (Redirect::to(route("flights")));
        }
        return (view("admin.flights.flightsCreate", compact("airplanes")));
    }

    public function update(Request $request, Flight $flight)
    {
        $airplane = Airplane::find($request->airplane);

        $flight->update([
            "date" => $request->date,
            "departure" => $request->departure,
            "arrival" => $request->arrival,
            "image" => $request->image,
            "airplane_id" => $airplane->id,
            "available_places" => $airplane->max_places,
            "status" => $request->status
        ]);
        return ($flight);
    }

    public function edit(Request $request, string $id)
    {
        $flight = Flight::find($id);
        $airplanes = Airplane::all();

        if (!Auth::user()->admin)
        {
            return (Redirect::to(route("index")));
        }
        if ($request->method() === "POST")
        {
            $this->update($request, $flight);
            return (Redirect::to(route("flights")));
        }
        return (view("admin.flights.flightsEdit", compact("flight", "airplanes")));
    }

    public function destroy(string $id)
    {
        Flight::find($id)->delete();
    }

    public function flights(Request $request)
    {
        $flights = Flight::all();

        if (!Auth::user()->admin)
        {
            return (Redirect::to(route("index")));
        }
        if ($request->action == "delete")
        {
            $this->destroy($request->id);
            return (Redirect::to("flights"));
        }
        return (view("admin.flights.flights", compact("flights")));
    }
}
