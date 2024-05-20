@extends('backend.layouts.master')

@section('title')
    Create Transaction - Ticketing System
@endsection
@section('styles')
    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endsection

@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Transaction Create</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.transactions.index') }}">All Transaction</a></li>
                        <li><span>Create Transaction</span></li>
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
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Create New Transaction</h4>
                        @include('backend.layouts.partials.messages')
                        <form action="{{ route('admin.transactions.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="event_id">Event</label>
                                <select name="event_id" id="event_id" class="form-control" required>
                                    <option value="">Pilih Event</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ticket_id">Ticket</label>
                                <select name="ticket_id" id="ticket_id" class="form-control" required>
                                    <option value="">Pilih Ticket</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input type="number" name="price" id="price" class="form-control" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Jumlah</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" name="total" id="total" class="form-control" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="buyer_name">Nama Pembeli</label>
                                <input type="text" name="buyer_name" id="buyer_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="buyer_email">Email Pembeli</label>
                                <input type="email" name="buyer_email" id="buyer_email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="buyer_phone">Nomor Telepon</label>
                                <input type="number" name="buyer_phone" id="buyer_phone" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Transaction</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('backend.pages.transactions.partials.scripts')
@endsection
