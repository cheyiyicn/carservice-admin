<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarBrand extends Model
{
    use HasFactory;

    protected $primaryKey = 'brand_id';

    public function brandSeries(): HasMany {
        return $this->hasMany(CarBrandSeries::class, "brand_id", "brand_id");
    }
}
