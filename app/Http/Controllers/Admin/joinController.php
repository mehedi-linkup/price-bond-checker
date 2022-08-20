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
       return $lot->map(function($value){
        return  $value->id == 1;
            })->all();
        //    array_merge($query, array('0' => $request->lot_number));
            // $query += ['lot' => $request->lot_number];
            // $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")->where('lot_number', $request->lot_number)->get();
        
    //     if(isset($request->draw_No) && $request->draw_No != null) {
    //         $query += ['draw' => $request->draw_No];
    //     }
    //     if(isset($request->status) && $request->status != null)  {
    //         $query += ['status' => $request->status];
    //     }
    //     // return $query;
    //     // $queyArr = explode('%', $query);

    //     // return $query;

    // //     $newArray = "";
    // //    foreach($query as $key => $item) {
    // //     $newArray .= [$key => $item];
    // //    }
    // //    return $newArray;
    //     @$anything =$query['lot'];
    //     @$anything1 =$query['draw'];
    //     @$anything2 = $query['status'];
    //     $data = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")
    //             // ->where('lot_number', $query['lot'])
    //             // ->where('draw_No', $query['draw'])
    //             // ->where('status', $query['status'])
    //             ->when($anything, function ($query, $anything) {
    //                 return $query->where('lot_number', $anything);
    //             })
    //             ->when($anything1, function ($query, $anything1) {
    //                 return $query->where('draw_No', $anything1);
    //             })
    //             ->when($anything2, function ($query, $anything2) {
    //                 return $query->where('status', $anything2);
    //             })
    //             ->get();                
    //     // $data1 = PriceWinner::join("user_bonds", "user_bonds.bond_number", "=", "price_winners.bond_number")
    //     // ->where('draw_No', $query['draw'])->get();
    //     // $merged = $data1->merge($data);
        
    //     // $merged = array_merge($data, $data1);

    //     // $result = $merged->all();
    //     return view('pages.admin.report.result', compact('data', 'lot'));
    }
}
