<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Cashout;
use App\Models\Payment;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Storage;

class CashoutController extends Controller
{


    public function index()
    {
        $cashouts = Cashout::with('user')->get();
        return Inertia::render('Cashout/index', ['cashouts' => $cashouts]);
    }


    public function show($id)
    {
        $payment = Cashout::where('id', $id)->firstOrFail();
        $proofUrl = Storage::url($payment->bukti);
        return response()->json(['proof_url' => $proofUrl]);
    }



    public function create() {
        return Inertia::render('Cashout/create');
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'tanggal' => 'required|date',
                'keterangan' => 'required|string|max:255',
                'total' => 'required|numeric',
                'bukti' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048'
            ]);

            $filePath = $request->file('bukti')->store('bukti', 'public');

            Cashout::create([
                'user_id' => auth()->user()->id,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'nominal' => $request->total,
                'bukti' => $filePath
            ]);

            return redirect()->route('cashout.index')->with('success', 'Pengeluaran berhasil ditambahkan');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }



    public function edit(string $id)
{
    $cashout = Cashout::findOrFail($id);
    return Inertia::render('Cashout/edit', ['cashout' => $cashout]);
}

public function update(Request $request, string $id)
{
    $request->validate([
        'tanggal' => 'required|date',
        'keterangan' => 'required|string|max:255',
        'total' => 'required|numeric',
        'bukti' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048'
    ]);

    $cashout = Cashout::findOrFail($id);
    $data = [
        'tanggal' => $request->tanggal,
        'keterangan' => $request->keterangan,
        'nominal' => $request->total
    ];

    if ($request->hasFile('bukti')) {
        if ($cashout->bukti) {
            Storage::disk('public')->delete($cashout->bukti);
        }
        $filePath = $request->file('bukti')->store('bukti', 'public');
        $data['bukti'] = $filePath;
    }

    $cashout->update($data);

    return response()->json(['message' => 'Pengeluaran berhasil diubah']);
}


    public function destroy(string $id){
        try {
            $cashout = Cashout::findOrFail($id);
            Storage::disk('public')->delete($cashout->bukti);
            $cashout->delete();
            return response()->json(['succsess' => 'Pengeluaran berhasil dihapus'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function report(string $id) {
        $payment = Payment::findOrFail($id);
        $order = Order::findOrFail($payment->order_id);
        $visitor = Visitor::findOrFail($order->visitor_id); // Sesuaikan dengan relasi yang Anda miliki

        return view('report', ['payment' => $payment, 'order' => $order, 'visitor' => $visitor]);
    }

}
