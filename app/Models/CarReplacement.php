<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Encore\Admin\Traits\ModelTree;

class CarReplacement extends Model
{
    use HasFactory;
    use ModelTree;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('title');
    }

    public function carReplacements(): HasMany {
        return $this->hasMany(CarReplacement::class, "parent_id", "id");
    }

    public function carReplacement(): BelongsTo {
        return $this->belongsTo(CarReplacement::class, "parent_id", "id");
    }
}
