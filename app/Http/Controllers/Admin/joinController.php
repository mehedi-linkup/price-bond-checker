<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBond;
use App\Models\Lot;
use App\Models\PriceWinner;

class joinController extends Controller
{
    public function index()
    {
        $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->get();
        return view('pages.admin.pricebond.match', compact('data'));
    }

    public function drawWithLot($id) {
        $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('lot_id', $id)->get();
        return view('pages.admin.pricebond.match', compact('data'));
    }
    public function reportDraw() {
        $lot = Lot::latest()->get();
        $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->get();
        return view('pages.admin.report.result', compact('data', 'lot'));
    }
    public function reportLoad(Request $request) {
        $lot = Lot::latest()->get();
        if(empty($request->lot_id) && empty($request->draw_id) && empty($request->status)) {
            $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number");
        }
        if(isset($request->lot_id) && $request->lot_id != null) {
            $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('lot_id', $request->lot_id);
        }
        if(isset($request->draw_id) && $request->draw_id != null) {
            $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('draw_id', $request->draw_id);
        }
        if(isset($request->status) && $request->status != null)  {
            $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('status', $request->status);
        }
       $data = $data->get();

        return view('pages.admin.report.result', compact('data', 'lot'));
    }
}
