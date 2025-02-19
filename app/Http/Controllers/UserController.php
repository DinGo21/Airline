<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function debook(User $user, string $id)
    {
        $flight = $user->flights()->where("flight_id", $id)->first();
        
        $user->flights()->detach($id);
        $flight->update([
            "available_places" => $flight->available_places + 1
        ]);
    }

    public function bookings(Request $request)
    {
        $user = Auth::user();

        if ($request->action == "debook" && $request->id)
        {
            $this->debook($user, $request->id);
            return Redirect::to(route("userBookings"));
        }
        return view("bookings", compact("user"));
    }

    public function users()
    {
        $users = User::all();

        if (!Auth::user()->admin)
        {
            return (Redirect::to(route("index")));
        }
        return (view("users", compact("users")));
    }
}
