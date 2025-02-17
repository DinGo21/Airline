<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::where("status", "1")->orderBy("date", "desc")->get();

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
}
