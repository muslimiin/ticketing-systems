<!-- resources/views/reports/purchases.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Laporan Pembelian Tiket</h1>

        <form method="GET" action="{{ route('reports.purchases') }}">
            <div class="row">
                <div class="col-md-4">
                    <label for="event">Event</label>
                    <select id="event" name="event" class="form-control">
                        <option value="">Semua Event</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}" {{ request('event') == $event->id ? 'selected' : '' }}>
                                {{ $event->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="start_date">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" class="form-control"
                        value="{{ request('start_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date">Tanggal Selesai</label>
                    <input type="date" id="end_date" name="end_date" class="form-control"
                        value="{{ request('end_date') }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nama Pembeli</th>
                    <th>Email Pembeli</th>
                    <th>Nama Event</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jumlah Tiket</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->buyer_name }}</td>
                        <td>{{ $transaction->buyer_email }}</td>
                        <td>{{ $transaction->event->name }}</td>
                        <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                        <td>{{ $transaction->ticket_quantity }}</td>
                        <td>{{ $transaction->total_price }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data pembelian tiket.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
