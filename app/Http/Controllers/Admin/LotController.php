<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lot;

class LotController extends Controller
{
    public function index() {
        $lot = Lot::get();
        return view('pages.admin.pricebond.lot', compact('lot'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|unique:lots|numeric|digits_between:1,5',
        ]);
        try {
            $lot = new Lot();
            $lot->number = $request->number;
            $lot->save();
            return Redirect()->back()->with('success', 'Insert Successful!');
        } catch (\Throwable $th) {
            // throw $th;
            return Redirect()->back()->with('error', 'Insert Failed!');
        }
    }
    public function edit($id)
    {
        $lot = Lot::get();
        $lotData = Lot::find($id);
        return view('pages.admin.pricebond.lot', compact('lot', 'lotData'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'lot' => 'required|max:2|min:2',
        ]);
        try {
            $lot = Lot::find($id);
            $lot->lot = $request->lot;
            $lot->save();
            return Redirect()->back()->with('success', 'Update Successful!');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect()->back()->with('error', 'Update Failed!');
        }
    }
    public function delete($id) {
        try {
            $lot = Lot::find($id);
            $lot->forceDelete();
            return Redirect()->back()->with('success', 'Delete Successful!');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect()->back()->with('error', 'Delete Failed!');
        }
    }
}
