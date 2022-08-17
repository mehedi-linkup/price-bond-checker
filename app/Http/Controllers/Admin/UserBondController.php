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
            'series_no' => 'required|max:2',
            'price' => 'required|numeric|digits:3'
            
        ]);
        return $request;
        try {            
            $bondno = new UserBond();
            $bondno->bond_number = $request->bond_number;
            $bondno->save();
            return Redirect()->back()->with('success', 'Insert Success!');
        } catch (\Throwable $th) {
            // throw $th;
            return Redirect()->back()->with('error', 'Insert Failed!');
        }
    }
    public function edit($id) {
        $bondData = UserBond::find($id);
        $bondlist = UserBond::all();
        $series = BondSeries::all();
        $lot = Lot::all();
        return view('pages.admin.pricebond.user-bond', compact('bondData', 'bondlist', 'series', 'lot'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'bond_number' => 'required|numeric|digits_between:6,7',
        ]);
        
        try {
            $bondno = UserBond::find($id);
            $bondno->bond_number = $request->bond_number;
            $bondno->save();
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
}
