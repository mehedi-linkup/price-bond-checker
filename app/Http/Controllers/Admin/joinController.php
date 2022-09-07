<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lot;
use App\Models\Draw;
use App\Models\UserBond;
use App\Models\PriceWinner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PriceList;

class joinController extends Controller
{
    public function index()
    {
        // $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->get();
        // return view('pages.admin.pricebond.match', compact('data'));
    }

    // public function drawWithLot($id) {
    //     $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('lot_id', $id)->get();
    //     return view('pages.admin.pricebond.match', compact('data'));
    // }
    public function reportDraw() {
        $lot = Lot::latest()->get();
        $draw = Draw::latest()->get();
        $data =[];
        // $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->get();
        return view('pages.admin.report.result', compact('lot', 'draw', 'data'));
    }
    public function reportLoad(Request $request) {

        $lot = Lot::latest()->get();
        $draw = Draw::latest()->get();

        // if(empty($request->lot_id) && empty($request->draw_id) && empty($request->status)) {
        //     $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number");
        // }
        // if(isset($request->lot_id) && $request->lot_id != null) {
        //     $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('lot_id', $request->lot_id);
           
        // }
        // if(isset($request->draw_id) && $request->draw_id != null) {
        //     $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('draw_id', $request->draw_id);
        // }
        // if(isset($request->status) && $request->status != null)  {
        //     $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('status', $request->status);
        // }
        // $data = $data->get();
        // return view('pages.admin.report.result', compact('data', 'lot', 'draw'));
        
        $query = [];
        if(isset($request->lot_id) && $request->lot_id != null) {
            $query += ['lot' => $request->lot_id];
        }
        if(isset($request->draw_id) && $request->draw_id != null) {
            $query += ['draw' => $request->draw_id];
        }
        if(isset($request->status) && $request->status != null)  {
            $query += ['status' => $request->status];
        }

        @$lot_id =$query['lot'];
        @$draw_id =$query['draw'];
        @$status = $query['status'];
        $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")
            ->when($lot_id, function ($query, $lot_id) {
                return $query->where('lot_id', $lot_id);
            })
            ->when($draw_id, function ($query, $draw_id) {
                return $query->where('draw_id', $draw_id);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            });
           $data1 = $data;
        $totalStock = $data->count();
        // Table::select('name','surname')->where('id', 1)->get();
        $data = $data->get();
        $priceListIdArr = $data1->select('price_list_id')->get();
        $totalAmount = 0;
        foreach ($priceListIdArr as $key => $item) {
            $pricelist = PriceList::find($item->price_list_id);
            $totalAmount += $pricelist->amount;
        }
        $totalArray = ['totalStock' => $totalStock, 'totalAmount' => $totalAmount];
        return view('pages.admin.report.result', compact('data', 'lot', 'draw', 'totalArray'));
    }
}
