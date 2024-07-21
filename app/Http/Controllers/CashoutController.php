<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Cashout;
use Illuminate\Http\Request;
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


    public function destroy(string $id){
        try {
            $cashout = Cashout::findOrFail($id);
            Storage::disk('public')->delete($cashout->bukti);
            $cashout->delete();
            return redirect()->route('cashout.index')->with('success', 'Pengeluaran berhasil dihapus');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
