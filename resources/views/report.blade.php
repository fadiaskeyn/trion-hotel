<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.11.0/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/report.css') }}">
</head>
<body>
    <div class="container px-5 pt-5 max-w-2xl m-auto">
        <header class="flex justify-between items-center">
            <h1 class="text-4xl font-bold">INVOICE</h1>

            <div class="flex items-center">
                <img src="{{ asset('build/assets/images/logo-trion.png') }}" alt="Trion" width="80">
                <p class="text-4xl font-bold m-0">TRION</p>
            </div>
        </header>

        <hr class="border-2 border-black my-4">

        <main>
            <div class="flex justify-between">
                <div>
                    <p class="m-0 font-bold text-lg">KEPADA:</p>
                    <p class="m-0 text-gray-700">{{ $visitor->name }}</p>
                </div>

                <div class="flex flex-col gap-2">
                    <div>
                        <p class="m-0 font-bold text-lg">TANGGAL:</p>
                        <p class="m-0 text-gray-700">{{ \Carbon\Carbon::parse($payment->payment_date)->format('l, d F Y') }}</p>
                    </div>
                    <div>
                        <p class="m-0 font-bold text-lg">NO INVOICE:</p>
                        <p class="m-0 text-gray-700">{{ $order->invoice }}</p>
                    </div>
                </div>
            </div>

            <table class="w-full mt-5 items-table">
                <thead>
                    <tr>
                        <th>NAMA</th>
                        <th>CHECK IN</th>
                        <th>CHECK OUT</th>
                        <th>HARGA</th>
                        <th>JML</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $visitor->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->checkin)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->checkout)->format('d/m/Y') }}</td>
                        <td>RP {{ number_format($order->amount, 0, ',', '.') }}</td>
                        <td>1</td>
                        <td>RP {{ number_format($order->amount, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-between items-center mt-2">
                <div class="text-sm">
                    <p class="m-0 font-bold">RECEPTIONIS: {{ $order->receptionist->name }}</p> <!-- Sesuaikan dengan field yang ada -->
                    <p class="m-0">Metode Pembayaran: {{ $payment->payment_method }}</p>
                </div>

                <table>
                    <tr>
                        <td>SUB TOTAL</td>
                        <td>: RP {{ number_format($order->amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>PPN</td>
                        <td>: RP 0</td>
                    </tr>
                    <tr class="font-bold">
                        <td>TOTAL</td>
                        <td>: RP {{ number_format($order->amount, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>

            <p class="m-0 font-bold mt-8">TERIMA KASIH ATAS PEMESANAN ANDA</p>
        </main>

        <div class="flex justify-end mt-4 print:hidden">
            <button class="bg-blue-800 text-white rounded-lg px-4 py-1 text-lg" id="btn-print"><i class="ti ti-printer"></i> Print</button>
        </div>
    </div>

    <script>
        document.getElementById('btn-print').addEventListener('click', function() {
            window.print();
        });
    </script>
</body>
</html>
