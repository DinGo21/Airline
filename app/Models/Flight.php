<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function airplane(): BelongsTo
    {
        return $this->belongsTo(Airplane::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "flight_user");
    }
}
