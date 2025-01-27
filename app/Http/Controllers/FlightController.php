<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::All();

        return (view("index", compact("flights")));
    }

    public function show(string $id)
    {
        $flight = Flight::find($id);

        return (view("show", compact("flight")));
    }
}
