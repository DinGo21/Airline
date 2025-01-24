<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    protected $fillable = [
        "name",
        "places"
    ];
    
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
