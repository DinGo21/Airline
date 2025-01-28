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
        $flight->users()->attach([$userId]);
        $flight->airplane->update(
            [
                "places" => $flight->airplane->places - 1
            ]
        );

        if ($flight->airplane->places === 0 && $flight->status != 0)
        {
            $flight->update(
                [
                    "status" => 0
                ]
            );
        }
        return (Redirect::to(route("show", $flight->id)));
    }

    public function show(Request $request, string $id)
    {
        $flight = Flight::find($id);
        $isBooked = count($flight->users()->where("user_id", Auth::id())->get());
    
        if ($request->action === "book")
        {
            return ($this->book($flight, Auth::id()));
        }
        return (view("show", compact("flight", "isBooked")));
    }
}
