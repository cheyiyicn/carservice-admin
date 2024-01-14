<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarOwnerInfo extends Model
{
    use HasFactory;

    public function userOrder(): BelongsTo {
        return $this->belongsTo(UserOrder::class, "user_order_id", "id");
    }
}
