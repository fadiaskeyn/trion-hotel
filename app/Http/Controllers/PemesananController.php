<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Visitor;
use Illuminate\Http\Request;

class PemesananController extends Controller
{

    public function index()
    {
        return response()->json(Order::with('visitor')->get());
    }


    public function showIndexView()
    {
        return Inertia::render('Pemesanan/index');
    }



        public function create(string $id)
        {
            $visitor = Visitor::find($id);
            return Inertia::render('Pemesanan/create', ['visitor' => $visitor]);
        }

        public function store(Request $request)
        {
            $request->validate([
                'visitor_id' => 'required|exists:visitors,id',
                'checkin' => 'required|date',
                'checkout' => 'required|date',
                'extra_bed' => 'nullable|integer',
                'rooms' => 'required|integer',
                'amount' => 'required|numeric',
            ]);
            
            Order::create([
                'invoice' => 'INV-' . time(),
                'visitor_id' => $request->visitor_id,
                'checkin' => $request->checkin,
                'checkout' => $request->checkout,
                'extra_bed' => $request->extra_bed,
                'rooms' => $request->rooms,
                'amount' => $request->amount,
            ]);
            return response()->json(['Success' => 'Data Kamar Berhasil Ditambahkan'], 200);
        }


        public function destroy(string $id)
        {
            $order = Order::findOrFail($id);
            $order->delete();
            return response()->json(['success' => 'Data pemesanan berhasil dihapus'], 200);
        }



        public function edit(string $id)
{
    $order = Order::with('visitor')->findOrFail($id);
    return Inertia::render('Pemesanan/edit', ['order' => $order]);
}

public function update(Request $request, string $id)
{
    $request->validate([
        'visitor_id' => 'required|exists:visitors,id',
        'checkin' => 'required|date',
        'checkout' => 'required|date',
        'extra_bed' => 'nullable|integer',
        'rooms' => 'required|integer',
        'amount' => 'required|numeric',
    ]);

    $order = Order::findOrFail($id);
    $order->update([
        'visitor_id' => $request->visitor_id,
        'checkin' => $request->checkin,
        'checkout' => $request->checkout,
        'extra_bed' => $request->extra_bed,
        'rooms' => $request->rooms,
        'amount' => $request->amount,
    ]);
    return redirect()->route('orders.index')->with('success', 'Data pemesanan berhasil diperbarui');
}

    }

