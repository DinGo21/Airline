<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        "date",
        "departure",
        "arrival",
        "image",
        "airplane_id",
        "status"
    ];

    public function airplane()
    {
        return $this->belongsTo(Airplane::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "flight_user");
    }
}
