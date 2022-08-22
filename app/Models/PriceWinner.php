<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceWinner extends Model
{
    use HasFactory, SoftDeletes;
    public function pricelist()
    {
        return $this->belongsTo(PriceList::class, 'price_list_id', 'id');
    }
    public function draw() {
        return $this->belongsTo(Draw::class, 'draw_id', 'id');
    }

}
