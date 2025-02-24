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
        $flights = Flight::All();

        return (view("index", compact("flights")));
    }

    public function book(Flight $flight, int $userId)
    {
        if ($flight->airplane->places === 0)
        {
            return;
        }
        $flight->users()->attach($userId);
        $flight->airplane->update(
            [
                "places" => $flight->airplane->places - 1
            ]
        );
        if ($flight->airplane->places === 0 && $flight->status)
        {
            $flight->update(
                [
                    "status" => 0
                ]
            );
        }
    }

    public function debook(Flight $flight, int $userId)
    {
        if ($flight->airplane->places === 200)
        {
            return;
        }
        $flight->users()->detach($userId);
        $flight->airplane->update(
            [
                "places" => $flight->airplane->places + 1
            ]
        );
        if (!$flight->status)
        {
            $flight->update(
                [
                    "status" => 1
                ]
            );
        }
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
