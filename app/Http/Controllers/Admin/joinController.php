<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBond;
use App\Models\PriceWinner;

class joinController extends Controller
{
    public function index()
    {
        $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->get();
        return view('pages.admin.pricebond.match', compact('data'));
    }

}
