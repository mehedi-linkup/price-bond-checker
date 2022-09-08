<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lot;
use App\Models\PriceWinner;
use App\Models\UserBond;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $userbond = UserBond::count();
        $totalvalue = UserBond::sum('price');
        $pricewinner = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->count();
        $lot = Lot::count();
        return view('pages.admin.home', compact('userbond', 'totalvalue', 'pricewinner', 'lot'));
    }
}
