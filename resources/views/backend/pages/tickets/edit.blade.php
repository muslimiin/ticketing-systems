@extends('backend.layouts.master')

@section('title')
    Edit Ticket - Ticketing System
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
                    <h4 class="page-title pull-left">Edit Ticket</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.tickets.index') }}">All Tickets</a></li>
                        <li><span>Edit Ticket</span></li>
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
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Edit Ticket</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="event_id">Nama Event</label>
                                    <select name="event_id" id="event_id" class="form-control select2">
                                        <option value="">Pilih Event</option>
                                        @foreach ($events as $event)
                                            <option value="{{ $event->id }}"
                                                {{ $ticket->event_id == $event->id ? 'selected' : '' }}>
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $ticket->name }}" placeholder="Masukkan Nama">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="price">Harga</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="{{ $ticket->price }}" placeholder="Masukkan Harga">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="quota">Kuota</label>
                                    <input type="number" class="form-control" id="quota" name="quota"
                                        value="{{ $ticket->quota }}" placeholder="Masukkan Kuota">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Keterangan</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Masukkan Keterangan">{{ $ticket->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="max_purchase">Maksimal Pembelian</label>
                                <input type="number" class="form-control" id="max_purchase" name="max_purchase"
                                        value="{{ $ticket->max_purchase }}" placeholder="Masukkan Maksimal Pembelian">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Ticket</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>
@endsection

@section('scripts')
    @include('backend.pages.tickets.partials.scripts')
@endsection
