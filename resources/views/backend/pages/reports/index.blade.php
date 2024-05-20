@extends('backend.layouts.master')

@section('title')
    Laporan Pembelian Tiket - Ticketing System
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection

@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Laporan Pembelian Tiket</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>Laporan Pembelian Tiket</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->

    <div class="main-content-inner">
        <div class="row">
            <!-- filter form start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Filter Laporan</h4>
                        <form action="{{ route('admin.reports.index') }}" method="GET">
                            <div class="form-row">
                                <div class="col">
                                    <select name="event_id" class="form-control">
                                        <option value="">Pilih Event</option>
                                        @foreach ($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="date" name="start_date" class="form-control"
                                        placeholder="Tanggal Mulai">
                                </div>
                                <div class="col">
                                    <input type="date" name="end_date" class="form-control"
                                        placeholder="Tanggal Selesai">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- filter form end -->

            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left">Laporan Pembelian Tiket</h4>
                        <p class="float-right mb-2">
                            <a class="btn btn-danger text-white"
                                href="{{ route('admin.reports.pdf', request()->query()) }}">Cetak PDF</a>
                        </p>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            @include('backend.layouts.partials.messages')
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
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
                                            <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('j F Y H:i:s') }}
                                            </td>
                                            <td>{{ $transaction->quantity }}</td>
                                            <td>{{ $transaction->total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection

@section('scripts')
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script>
        /*================================
            datatable active
            ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
    </script>
@endsection
