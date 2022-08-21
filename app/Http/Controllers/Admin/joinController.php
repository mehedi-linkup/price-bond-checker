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
        $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('lot_number', $id)->get();
        return view('pages.admin.pricebond.match', compact('data'));
    }
    public function report() {
        $data = UserBond::with('lot', 'bondseries')->latest()->get();        
        return view('pages.admin.report.allbond', compact('data'));
    }
    public function reportResult() {
        $lot = Lot::latest()->get();
        $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->get();
        return view('pages.admin.report.result', compact('data', 'lot'));
    }
    public function reportLoad(Request $request) {
        $lot = Lot::latest()->get();
        if(empty($request->lot_number) && empty($request->draw_No) && empty($request->status)) {
            $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number");
        }
        if(isset($request->lot_number) && $request->lot_number != null) {
            $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('lot_number', $request->lot_number);
        }
        if(isset($request->draw_No) && $request->draw_No != null) {
            $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('draw_No', $request->draw_No);
        }
        if(isset($request->status) && $request->status != null)  {
            $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('status', $request->status);
        }
       $data = $data->get();

        return view('pages.admin.report.result', compact('data', 'lot'));
    }
}
