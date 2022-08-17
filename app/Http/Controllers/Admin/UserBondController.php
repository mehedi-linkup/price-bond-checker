<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BondSeries;
use App\Models\Lot;
use Illuminate\Http\Request;
use App\Models\UserBond;

class UserBondController extends Controller
{
    public function index() {
        $series = BondSeries::all();
        $lot = Lot::all();
        $bondlist = UserBond::latest()->get();
        return view('pages.admin.pricebond.user-bond', compact('bondlist', 'series', 'lot'));
    }
    public function store(Request $request) {
        $request->validate([
            'bond_number' => 'required|numeric|digits:7',
            'date' => 'required|date',
            'lot_number' => 'required',
            'series_no' => 'required',
            'price' => 'required|numeric|digits_between:2,3'
        ]);
        try {            
            $userBond = new UserBond();
            $userBond->bond_number = $request->bond_number;
            $userBond->date = $request->date;
            $userBond->lot_number = $request->lot_number;
            $userBond->series_no = $request->series_no;
            $userBond->price = $request->price;
            $userBond->save();
            return Redirect()->back()->with('success', 'Insert Success!');
        } catch (\Throwable $th) {
            // throw $th;
            return Redirect()->back()->with('error', 'Insert Failed!');
        }
    }
    public function edit($id) {
        $bondData = UserBond::find($id);
        $bondlist = UserBond::latest()->get();
        $series = BondSeries::all();
        $lot = Lot::all();
        return view('pages.admin.pricebond.user-bond', compact('bondData', 'bondlist', 'series', 'lot'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'bond_number' => 'required|numeric|digits:7',
            'date' => 'required|date',
            'lot_number' => 'required',
            'series_no' => 'required',
            'price' => 'required|numeric|digits_between:2,3'
        ]);
        
        try {
            $userBond = UserBond::find($id);
            $userBond->bond_number = $request->bond_number;
            $userBond->date = $request->date;
            $userBond->lot_number = $request->lot_number;
            $userBond->series_no = $request->series_no;
            $userBond->price = $request->price;
            $userBond->save();
            return Redirect()->back()->with('success', 'Update Successful!');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', 'Update Failed!');
        }
    }
    public function delete($id) {
        try {
            $bondno = UserBond::find($id);
            $bondno->delete();
            return Redirect()->back()->with('success', 'Delete Successful!');
        } catch (\Throwable $th) {
            // throw $th;
            return Redirect()->back()->with('error', 'Delete Successful!');

        }
    }

    public function bondinLots($id) {
        $lot = Lot::with('userbond')->find($id);
        return view('pages.admin.pricebond.user-lot-bond', compact('lot'));
    }
}
