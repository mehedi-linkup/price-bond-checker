<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BondSeries;
use Illuminate\Support\Facades\Redirect;

class BondSeriesController extends Controller
{
    
    public function index() {
        $bondseries = BondSeries::get();
        return view('pages.admin.pricebond.series', compact('bondseries'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'series' => 'required|max:2|min:2',
        ]);
        try {
            $bondseries = new BondSeries();
            $bondseries->series = $request->series;
            $bondseries->save();
            return Redirect()->back()->with('success', 'Insert Successful!');
        } catch (\Throwable $th) {
            // throw $th;
            return Redirect()->back()->with('error', 'Insert Failed!');
        }
    }
    public function edit($id)
    {
        $bondseries = BondSeries::get();
        $bondData = BondSeries::find($id);
        return view('pages.admin.pricebond.series', compact('bondseries', 'bondData'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'series' => 'required|max:2|min:2',
        ]);
        try {
            //     $bondseries_list = explode(',', $bondseries->series);
            //     $newBondseries = [];
            //    foreach($bondseries_list as $item) {
            //         $letters = trim($item);
            //         array_push($newBondseries, $letters);
            //    }
            //    return $newBondseries;
            $bondseries = BondSeries::find($id);
            $bondseries->series = $request->series;
            $bondseries->save();
            return Redirect()->back()->with('success', 'Update Successful!');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect()->back()->with('error', 'Update Failed!');
        }
    }
    public function delete($id) {
        try {
            $bondseries = BondSeries::find($id);
            $bondseries->delete();
            return Redirect()->back()->with('success', 'Delete Successful!');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect()->back()->with('error', 'Delete Failed!');
        }
    }
}
