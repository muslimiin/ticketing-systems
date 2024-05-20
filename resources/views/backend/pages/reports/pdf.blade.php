<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pembelian Tiket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        @page {
            size: landscape;
            margin: 20mm;
        }
    </style>
</head>

<body>
    <h2>Laporan Pembelian Tiket</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Email Pembeli</th>
                <th>Telepon Pembeli</th>
                <th>Nama Tiket</th>
                <th>Event</th>
                <th>Tanggal Transaksi</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $transaction->buyer_name }}</td>
                    <td>{{ $transaction->buyer_email }}</td>
                    <td>{{ $transaction->buyer_phone }}</td>
                    <td>{{ $transaction->ticket->name }}</td>
                    <td>{{ $transaction->event->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('j F Y H:i:s') }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
