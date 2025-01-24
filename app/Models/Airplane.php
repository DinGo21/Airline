<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airplane extends Model
{
    protected $fillable = [
        "name",
        "places"
    ];
    
    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class);
    }
}
