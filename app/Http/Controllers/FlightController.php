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

    public function show(Request $request, string $id)
    {
        $flight = Flight::find($id);
        $isBooked = count($flight->users()->where("user_id", Auth::id())->get());

        if ($request->action === "book")
        {
            $flight->users()->attach([Auth::id()]);
            return Redirect::to(route("show", $id));
        }
        return (view("show", compact("flight", "isBooked")));
    }
}
