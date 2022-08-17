<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBond extends Model
{
    use HasFactory;
    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    public function userbond()
    {
        return $this->belongsTo(UserBond::class);
    }

}
