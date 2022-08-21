<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Draw;

class DrawController extends Controller
{
    public function index() {
        $draw = Draw::latest()->get();
        return view('pages.admin.pricebond.draw', compact('draw'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'draw' => 'required|unique:draws|numeric|digits_between:1,5',
        ]);
        try {
            $draw = new Draw();
            $draw->draw = $request->draw;
            $draw->save();
            return Redirect()->back()->with('success', 'Insert Successful!');
        } catch (\Throwable $th) {
            // throw $th;
            return Redirect()->back()->with('error', 'Insert Failed!');
        }
    }
    public function edit($id)
    {
        $draw = Draw::latest()->get();
        $drawData = draw::find($id);
        return view('pages.admin.pricebond.draw', compact('draw', 'drawData'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'draw' => 'required|numeric|digits_between:1,5',
        ]);
        try {
            $draw = Draw::find($id);
            $draw->draw = $request->draw;
            $draw->save();
            return Redirect()->back()->with('success', 'Update Successful!');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect()->back()->with('error', 'Update Failed!');
        }
    }
    public function delete($id) {
        try {
            $draw = draw::find($id);
            $draw->forceDelete();
            return Redirect()->back()->with('success', 'Delete Successful!');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect()->back()->with('error', 'Delete Failed!');
        }
    }
}
