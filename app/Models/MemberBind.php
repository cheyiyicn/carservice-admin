<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberBind extends Model
{
    use HasFactory;

    public function belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null)
    {
        $this->belongsTo(Member::class);
    }
}
