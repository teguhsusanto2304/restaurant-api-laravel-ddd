<?php

namespace App\Modules\Reservation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\DiningTable\DiningTable;
use App\Models\User;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;
    public function diningtable():BelongsTo
    {
        return $this->belongsTo(DiningTable::class,"dining_table_id","id");
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
}
