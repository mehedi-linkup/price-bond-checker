<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Lot;
use App\Models\Draw;
use App\Models\Client;
use App\Models\UserBond;
use App\Models\BondSeries;
use App\Models\PriceWinner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Source;
use Illuminate\Support\Facades\Redirect;

class UserBondController extends Controller
{
    public function index() {
        $series = BondSeries::latest()->get();
        $lot = Lot::latest()->get();
        $source = Source::latest()->get();
        $lotwithBond = Lot::with('userbond')->get();
        $bondlist = UserBond::latest()->get();
        return view('pages.admin.pricebond.user-bond', compact('bondlist', 'series', 'lot', 'lotwithBond', 'source'));
    }
    public function store(Request $request) {
        $request->validate([
            'purchase_date' => 'required|date',
            'lot_id'        => 'required',
            'series_id'     => 'required',
            'bond_number'   => 'required|numeric|digits:7',
            'price'         => 'required|numeric|digits_between:2,3',
        ]);
        $check_exist = UserBond::where('series_id',$request->series_id)->where('bond_number',$request->bond_number)->first();
        if($check_exist) {
            if($check_exist->status == 's') {
                $check_exist->status = 'a';
                $check_exist->update();
                return redirect()->back()->with('info', 'Bond\'s Status Has Been Changed!');
            } else {
                return redirect()->back()->with('error', 'Duplicate Entry!');
            }
        }
        try { 
            $userBond = new UserBond();
            $userBond->bond_number = $request->bond_number;
            $userBond->purchase_date = $request->purchase_date;
            $userBond->lot_id = $request->lot_id;
            $userBond->series_id = $request->series_id;
            $userBond->price = $request->price;
            $userBond->source_id = $request->source_id;
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
        $source = Source::latest()->get();
        $series = BondSeries::all();
        $lot = Lot::all();
        $lotwithBond = Lot::with('userbond')->get();
        return view('pages.admin.pricebond.user-bond', compact('bondData', 'bondlist', 'series', 'lot',  'lotwithBond', 'source'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'bond_number' => 'required|numeric|digits:7',
            'purchase_date' => 'required|date',
            'lot_id' => 'required',
            'series_id' => 'required',
            'price' => 'required|numeric|digits_between:2,3'
        ]);

        $check_exist = UserBond::where('series_id',$request->series_id)->where('bond_number', $request->bond_number)->where('id', '!=', $id)->first();
        if($check_exist) {
            // if($check_exist->status == 's') {
            //     $check_exist->status = 'a';
            //     $check_exist->update();
            //     return redirect()->back()->with('info', 'Bond\'s Status Has Beed Changed!');
            // } else {
                return redirect()->back()->with('error', 'Duplicate Entry!');
            // }
        }
        
        try {
            $userBond = UserBond::find($id);
            $userBond->bond_number = $request->bond_number;
            $userBond->purchase_date = $request->purchase_date;
            $userBond->lot_id = $request->lot_id;
            $userBond->series_id = $request->series_id;
            $userBond->price = $request->price;
            $userBond->source_id = $request->source_id;
            $userBond->update();
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

    //For Lot List page
    public function lotlist() {
        $lot = Lot::latest()->get();
        return view('pages.admin.pricebond.lot-list', compact('lot'));
    }


    public function allbond() {
        $lot = Lot::latest()->get();
        $draw = Draw::latest()->get();
        $userbond = UserBond::with('lot', 'bondseries', 'source')->latest()->get();
        $userbondStatus = new UserBond;
        $totalprice = $userbondStatus->sum('price');
        $totalstock = $userbondStatus->count();
        return view('pages.admin.report.allbond', compact('userbond', 'lot', 'draw', 'totalprice', 'totalstock'));
    }

    // Ajax request
    public function reportallFilter(Request $request) {
        $lot = Lot::latest()->get();
        $draw = Draw::latest()->get();
        // $userbond = UserBond::with('lot', 'bondseries')->latest()->get();
        $query = [];
        if(isset($request->lot_id) && $request->lot_id != null) {
            $query += ['lot' => $request->lot_id];
        }
        if(isset($request->status) && $request->status != null)  {
            $query += ['status' => $request->status];
        }

        @$lot_id =$query['lot'];
        @$status = $query['status'];
        $userbond = UserBond::with('lot', 'bondseries')
            ->when($lot_id, function ($query, $lot_id) {
                return $query->where('lot_id', $lot_id);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()->get();  
        $totalprice = $userbond->sum('price');
        $totalstock = $userbond->count();
        return view('pages.admin.loadpage.allbondfilter', compact('lot', 'draw', 'userbond', 'totalprice', 'totalstock'));
    }

    public function bondWithLot($id) {
        $lot = Lot::with('userbond')->find($id);
        return view('pages.admin.pricebond.user-lot-bond', compact('lot'));
    }

    public function sales() {
        $series = BondSeries::all();
        $lot = Lot::all();
        $bondlist = UserBond::where('status', 'a')->latest()->get();
        $client = Client::latest()->get();
        return view('pages.admin.pricebond.sales', compact('bondlist', 'series', 'lot', 'client'));
    }
    public function sold() {
        $series = BondSeries::all();
        $lot = Lot::all();
        $bondlist = UserBond::with('client')->where('status', 's')->latest()->get();
        $client = Client::latest()->get();
        return view('pages.admin.pricebond.sold', compact('bondlist', 'series', 'lot', 'client'));
    }
    public function salesWithLot($id = null) {
        if($id == null) {
            // $lot = Lot::with('userbond')->latest()->get();
            $bondlist = UserBond::where('status', 'a')->latest()->get();
            // $data = ['data' => $bondlist];
            // return response()->json($data);
            return view('pages.admin.loadpage.saleswithlot', compact('bondlist'));
        } else {
            // $id = [$id];
            // $lot = Lot::with('userbond')->find($id);
            // $data = ['data' => $lot];
            // return response()->json($data);
            // return response()->json($lot[0]->userbond);
            $bondlist = UserBond::where('status', 'a')->where('lot_id', $id)->get();
            return view('pages.admin.loadpage.saleswithlot', compact('bondlist'));
        }
    }
    public function status(Request $request) {
        $request->validate([
            'client_id'=> 'required',

        ]);
        $value = $request->value;
        if(empty($value)) {
            return Redirect()->back()->with('error', 'You have not selected any bonds!');
        }
        try {
            foreach ($value as $key => $item) {
                 $userbond = UserBond::find($item);
                 $userbond->client_id = $request->client_id;
                 $userbond->sold_date = Carbon::now();
                 $userbond->status = 's';
                 $userbond->update();
            }
            return Redirect()->back()->with('success', 'Selected Bonds Sold!');
        } catch (\Throwable $th) {
            return Redirect()->back()->with('error', 'Selected Bonds Unsold!');
        }
    } 
    public function allstock(Request $request) {
        $lot = Lot::latest()->get();
        $draw = Draw::latest()->get();
        $userbond = UserBond::with('lot', 'bondseries', 'source')->latest()->get();
        $userbondStatus = new UserBond;
        $totalprice = $userbondStatus->sum('price');
        $totalstock = $userbondStatus->count();
        return view('pages.admin.stock.all', compact('userbond', 'lot', 'draw', 'totalprice', 'totalstock'));
    }
}