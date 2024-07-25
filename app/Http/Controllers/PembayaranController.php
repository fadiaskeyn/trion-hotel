<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Payment;
use Finller\Invoice\Invoice;
use Finller\Invoice\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{

    public function index()
    {
        return response()->json(Payment::with('order.visitor')->get());
    }

    public function showIndexView()
    {
        return Inertia::render('Pembayaran/index');
    }

    public function create($id)
    {
        $order = Order::with('visitor')->findOrFail($id);
        return Inertia::render('Pembayaran/create', ['order' => $order]);
    }


    public function show($id)
    {
        $payment = Payment::where('id', $id)->firstOrFail();
        $proofUrl = Storage::url($payment->buktibayar);

        return response()->json(['proof_url' => $proofUrl]);
    }




    public function store(Request $request, $id)
    {
        try {

        $request->validate([
            'payment_method' => 'required|string',
            'payment_date' => 'required|date',
            'buktibayar' => 'required|file|mimes:jpg,png,pdf',
        ]);

        $payment = new Payment();
        $payment->order_id = $id;
        $payment->payment_method = $request->payment_method;
        $payment->payment_date = $request->payment_date;

        if ($request->hasFile('buktibayar')) {
            $path = $request->file('buktibayar')->store('payments', 'public');
            $payment->buktibayar = $path;
        }
        $url = asset('storage/' . $payment->buktibayar);
        $payment->save();
        return redirect()->route('payment.index')->with('success', 'Pembayaran berhasil disimpan');
        } catch (\Exception $te) {
            dd($te->getMessage());
        }
    }

    public function destroy(string $id){
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return response()->json(['success' => 'Pembayaran berhasil dihapus'], 200);
    }


    public function edit($id)
{
    $payment = Payment::with('order')->findOrFail($id);
    return Inertia::render('Pembayaran/edit', [
        'payment' => $payment,
        'order' => $payment->order
    ]);
}


public function update(Request $request, $id)
{
    $request->validate([
        'payment_method' => 'required|string',
        'payment_date' => 'required|date',
        'buktibayar' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $payment = Payment::findOrFail($id);
    $data = $request->only('payment_method', 'payment_date');

    if ($request->hasFile('buktibayar')) {
        // Delete old proof if exists
        if ($payment->proof_url) {
            Storage::delete($payment->proof_url);
        }

        $filePath = $request->file('buktibayar')->store('proofs', 'public');
        $data['proof_url'] = $filePath;
    }

    $payment->update($data);

    return response()->json(['message' => 'Payment updated successfully']);
}

}




