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
        $soldbond = UserBond::where('status', 's')->count();
        $pricewinner = PriceWinner::count();
        $lot = Lot::count();
        return view('pages.admin.home', compact('userbond', 'soldbond', 'pricewinner', 'lot'));
    }
}
