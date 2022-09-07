<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function index() {
        $source = Source::latest()->get();
        return view('pages.admin.pricebond.source', compact('source'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        try {
            $source = new Source();
            $source->name = $request->name;
            $source->save();
            return Redirect()->back()->with('success', 'Insert Successful!');
        } catch (\Throwable $th) {
            // throw $th;
            return Redirect()->back()->with('error', 'Insert Failed!');
        }
    }
    public function edit($id)
    {
        $source = Source::latest()->get();
        $sourceData = source::find($id);
        return view('pages.admin.pricebond.source', compact('source', 'sourceData'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        try {
            $source = Source::find($id);
            $source->name = $request->name;
            $source->save();
            return Redirect()->back()->with('success', 'Update Successful!');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect()->back()->with('error', 'Update Failed!');
        }
    }
    public function delete($id) {
        try {
            $source = Source::find($id);
            $source->forceDelete();
            return Redirect()->back()->with('success', 'Delete Successful!');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect()->back()->with('error', 'Delete Failed!');
        }
    }
}
