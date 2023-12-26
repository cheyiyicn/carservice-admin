<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarBrandSeries extends Model
{
    use HasFactory;

    protected $primaryKey = 'brand_id';

    public function brand(): BelongsTo {
        return $this->belongsTo(CarBrand::class, "brand_id", "brand_id");
    }

    public function userOrder(): BelongsTo {
        return $this->belongsTo(UserOrder::class, "series_id");
    }
}
