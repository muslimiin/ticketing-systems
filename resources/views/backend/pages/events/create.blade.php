@extends('backend.layouts.master')

@section('title')
    Event Create - Ticketing System
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
                    <h4 class="page-title pull-left">Event Create</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.events.index') }}">All Event</a></li>
                        <li><span>Create Event</span></li>
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
                        <h4 class="header-title">Create New Event</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.events.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Event</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan Nama Event">
                            </div>
                            <div class="form-group">
                                <label for="location">Lokasi Event</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Masukkan Lokasi Event">
                            </div>
                            <div class="form-group">
                                <label for="province">Provinsi</label>
                                <input type="text" class="form-control" id="province" name="province"
                                    placeholder="Masukkan Provinsi">
                            </div>
                            <div class="form-group">
                                <label for="category">Kategori Event</label>
                                <input type="text" class="form-control" id="category" name="category"
                                    placeholder="Masukkan Kategori Event">
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi Event</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Masukkan Deskripsi Event"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="information">Informasi Event</label>
                                <textarea class="form-control" id="information" name="information" placeholder="Masukkan Informasi Event"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Gambar Event</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <label for="start_time">Mulai Event</label>
                                <input type="datetime-local" class="form-control" id="start_time" name="start_time">
                            </div>
                            <div class="form-group">
                                <label for="end_time">Akhir Event</label>
                                <input type="datetime-local" class="form-control" id="end_time" name="end_time">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Event</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection

@section('scripts')
    @include('backend.pages.events.partials.scripts')
@endsection
