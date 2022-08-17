<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BondSeries extends Model
{
    use HasFactory;

    public function userbond() {
        return $this->hasMany(UserBond::class);
    }
}
