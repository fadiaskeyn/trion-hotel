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
    public function index(){
        $payments = Payment::with('order.visitor')->get();
        return Inertia::render('Pembayaran/index', ['payments' => $payments]);
    }

    public function create($id)
    {
        $order = Order::with('visitor')->findOrFail($id);
        return Inertia::render('Pembayaran/create', ['order' => $order]);
    }


    public function show($id)
    {
        $payment = Payment::where('order_id', $id)->firstOrFail();
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
}

//     public function createInvoice(string $id)
//     {
//         $order = Order::with('visitor')->findOrFail($id);

//         $clientAddress = new InvoiceAddress([
//             'line_1' => $order->visitor->name,
//             'city' => '',
//             'postal_code' => '',
//             'country' => 'Indonesia',
//         ]);

//         $companyAddress = new InvoiceAddress([
//             'line_1' => 'TRION',
//             'line_2' => 'Jl. Example',
//             'city' => 'Jakarta',
//             'postal_code' => '12345',
//             'country' => 'Indonesia',
//         ]);

//         $items = [
//             new InvoiceItem([
//                 'title' => 'Kamar',
//                 'description' => 'Check In: ' . $order->checkin . ', Check Out: ' . $order->checkout,
//                 'quantity' => 1,
//                 'price_per_unit' => $order->amount,
//                 'sub_total' => $order->amount,
//             ])
//         ];

//         $invoice = Invoice::make()
//             ->series('TRION')
//             ->sequence(1001)
//             ->date(now())
//             ->buyer($clientAddress)
//             ->seller($companyAddress)
//             ->currencySymbol('Rp')
//             ->currencyCode('IDR')
//             ->currencyFormat('{SYMBOL}{VALUE}')
//             ->addItems($items)
//             ->taxRate(0)
//             ->notes('Terimakasih atas pemesanan anda')
//             ->payUntilDays(0)
//             ->filename('invoice_' . $order->id)
//             ->save('public/invoices');

//         return $invoice->toResponse();
//     }
// }



