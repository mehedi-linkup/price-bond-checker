<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceList;
use App\Models\Draw;
use App\Models\PriceWinner;
use Illuminate\Support\Facades\Redirect;

class PrizeWinnerController extends Controller
{
    public function index () {
        $winner = PriceWinner::with('pricelist', 'draw')->get();
        $draw = Draw::latest()->get();
        $pricelist = PriceList::all();
        return view('pages.admin.pricebond.price-winner-list', compact('winner', 'pricelist', 'draw'));
    }
    public function store(Request $request) {
        $request->validate([
            'draw_id' => 'required|numeric',
            'price_list_id' => 'required|numeric',
            'bond_number' => 'required|numeric|digits:7|unique:price_winners',
            'draw_date' => 'required'
        ]);
        try {            
            $pricewinner = new PriceWinner();
            $pricewinner->draw_id = $request->draw_id;
            $pricewinner->price_list_id = $request->price_list_id;
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
        $draw = Draw::latest()->get();
        $pricelist = PriceList::all();
        return view('pages.admin.pricebond.price-winner-list', compact('winnerData', 'winner', 'pricelist', 'draw'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'draw_id' => 'required|numeric',
            'price_list_id' => 'required|numeric',
            'bond_number' => 'required|numeric|digits:7',
            'draw_date' => 'required'
        ]);
    
        try {
            $pricewinner = PriceWinner::find($id);
            $pricewinner->draw_id = $request->draw_id;
            $pricewinner->price_list_id = $request->price_list_id;
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
