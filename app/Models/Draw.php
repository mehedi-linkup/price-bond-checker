<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Draw extends Model
{
    use HasFactory, SoftDeletes;
    public function pricewinner() {
        return $this->hasMany(PriceWinner::class);
    }
}
