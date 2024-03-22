<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        return view('item.index');
    }
    public function store(Request $request)
    {
        if (Auth::user()) {
            Item::create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'user_id' => Auth::user()->id,
            ]);

            return redirect()->route('dashboard')->with('status', 'Silakan login untuk melanjutkan.');
        }

        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|string',
        ]);

        $item = [
            'name' => $request->name,
            'quantity' => $request->quantity,
        ];

        session()->put('item', $item);

        return redirect()->route('login')->with('status', 'Silakan login untuk melanjutkan.');
    }

    public function storeAfterLogin(Request $request)
    {
        $item = session()->get('item');

        Item::create([
            'name' => $item['name'],
            'quantity' => $item['quantity'],
            'user_id' => Auth::user()->id,
        ]);

        session()->forget('item');
        return redirect()->route('dashboard')->with('status', 'Data barang berhasil disimpan.');
    }
}
