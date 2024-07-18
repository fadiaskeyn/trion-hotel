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
            $orders = Order::with('visitor')->get();
            return Inertia::render('Pemesanan/index', ['orders' => $orders]);
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
                'payment_method' => 'required|string',
            ]);

            Order::create([
                'invoice' => 'INV-' . time(),
                'visitor_id' => $request->visitor_id,
                'checkin' => $request->checkin,
                'checkout' => $request->checkout,
                'extra_bed' => $request->extra_bed,
                'rooms' => $request->rooms,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'payment_date' => $request->payment_date,
            ]);

            return redirect()->route('order.index')->with('success', 'Data pemesanan berhasil ditambahkan');
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
                'payment_method' => 'required|string',
            ]);

            $order = Order::findOrFail($id);
            $order->update([
                'visitor_id' => $request->visitor_id,
                'checkin' => $request->checkin,
                'checkout' => $request->checkout,
                'extra_bed' => $request->extra_bed,
                'rooms' => $request->rooms,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'payment_date' => $request->payment_date,
            ]);
            return redirect()->route('order.index')->with('success', 'Data pemesanan berhasil diubah');
        }
    }

