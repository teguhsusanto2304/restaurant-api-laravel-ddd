<?php

namespace App\Modules\DiningTable;

use App\Modules\Reservation\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiningTable extends Model
{
    use HasFactory;
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class); // Has many relationship
    }
}
