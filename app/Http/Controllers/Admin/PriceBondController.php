<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PriceList;
use App\Models\Draw;
use Illuminate\Http\Request;
use App\Models\PriceWinner;
use Illuminate\Support\Facades\Redirect;

class PriceBondController extends Controller
{
    public function priceWinner() {

        $winner = PriceWinner::all();
        $draw = Draw::latest()->get();
        $pricelist = PriceList::all();
        return view('pages.admin.pricebond.price-winner-list', compact('winner', 'pricelist', 'draw'));
    }
    public function store(Request $request) {
        $request->validate([
            'draw_id' => 'required',
            'price_sl_id' => 'numeric',
            'bond_number' => 'required|numeric|digits:7|unique:price_winners',
            'draw_date' => 'required'
        ]);
        try {            
            $pricewinner = new PriceWinner();
            $pricewinner->draw_No = $request->draw_No;
            $pricewinner->price_sl_id = $request->price_sl_id;
            $pricewinner->bond_number = $request->bond_number;
            $pricewinner->draw_date = $request->draw_date;
            $pricewinner->save();
            return Redirect()->back()->with('success', 'Insert Success!');
        } catch (\Throwable $th) {
            throw $th;
            return Redirect()->back()->with('error', 'Insert Failed!');
        }
    }
    public function edit($id) {
        $winnerData = PriceWinner::find($id);
        $winner = PriceWinner::all();
        $list = PriceList::all();
        return view('pages.admin.pricebond.price-winner-list', compact('winnerData', 'winner', 'list'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'draw_No' => 'required|numeric|digits_between:2,3',
            'price_sl_id' => 'required|numeric',
            'bond_number' => 'required|numeric|digits_between:6,7',
            'draw_date' => 'required'
        ]);
        
        try {
            $pricewinner = PriceWinner::find($id);
            $pricewinner->draw_No = $request->draw_No;
            $pricewinner->price_sl_id = $request->price_sl_id;
            $pricewinner->bond_number = $request->bond_number;
            $pricewinner->draw_date = $request->draw_date;
            $pricewinner->save();
            return Redirect()->back()->with('success', 'Update Successful!');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', 'Update Failed!');
        }
    }
    public function delete($id) {
        try {
            $pricewinner = PriceWinner::find($id);
            $pricewinner->delete();
            return Redirect()->back()->with('success', 'Delete Successful!');
        } catch (\Throwable $th) {
            // throw $th;
            return Redirect()->back()->with('error', 'Delete Successful!');

        }
    }
}
