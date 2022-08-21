<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
        $client = Client::latest()->get();
        return view('pages.admin.pricebond.client', compact('client'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        try {
            $client = new Client();
            $client->name = $request->name;
            $client->save();
            return Redirect()->back()->with('success', 'Insert Successful!');
        } catch (\Throwable $th) {
            // throw $th;
            return Redirect()->back()->with('error', 'Insert Failed!');
        }
    }
    public function edit($id)
    {
        $client = Client::latest()->get();
        $clientData = Client::find($id);
        return view('pages.admin.pricebond.client', compact('client', 'clientData'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        try {
            $client = Client::find($id);
            $client->name = $request->name;
            $client->save();
            return Redirect()->back()->with('success', 'Update Successful!');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect()->back()->with('error', 'Update Failed!');
        }
    }
    public function delete($id) {
        try {
            $client = Client::find($id);
            $client->forceDelete();
            return Redirect()->back()->with('success', 'Delete Successful!');
        } catch (\Throwable $th) {
            //throw $th;
            return Redirect()->back()->with('error', 'Delete Failed!');
        }
    }
}
