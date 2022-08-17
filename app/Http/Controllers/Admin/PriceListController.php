<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PriceList;
use Illuminate\Support\Facades\Redirect;

class PriceListController extends Controller
{
    public function index() {
        $pricelist = PriceList::all();
        return view('pages.admin.pricebond.price-list', compact('pricelist'));
    }
    public function store(Request $request) {
        $request->validate([
            'price_sl' => 'required|numeric|unique:price_lists',
            'amount' => 'required|numeric'
        ]);
        
        try {
            $pricelist = new PriceList();
            $pricelist->price_sl = $request->price_sl;
            $pricelist->amount = $request->amount;
            $pricelist->save();
            return redirect()->back()->with('success', 'Insert Successful!');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', 'Insert Failed!');
        }
    }
    public function edit($id) {
        $priceData = PriceList::find($id);
        $pricelist = PriceList::all();
        return view('pages.admin.pricebond.price-list', compact('priceData', 'pricelist'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'price_sl' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);
        
        try {
            $priceData = PriceList::find($id);
            $priceData->price_sl = $request->price_sl;
            $priceData->amount = $request->amount;
            $priceData->save();
            return Redirect()->back()->with('success', 'Update Successful!');
        } catch (\Throwable $th) {
            throw $th;
            // return redirect()->back()->with('error', 'Update Failed!');
        }
    }
    public function delete($id) {
        try {
            $priceData = PriceList::find($id);
            $priceData->delete();
            return Redirect()->back()->with('success', 'Delete Successful!');
        } catch (\Throwable $th) {
            // throw $th;
            return Redirect()->back()->with('error', 'Delete Successful!');

        }
    }
}
