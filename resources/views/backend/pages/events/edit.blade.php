@extends('backend.layouts.master')

@section('title')
    Event Edit - Ticketing System
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
                    <h4 class="page-title pull-left">Event Edit - {{ $event->name }}</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.events.index') }}">All Event</a></li>
                        <li><span>Edit Event</span></li>
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
                        <h4 class="header-title">Edit Event</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.events.update', $event->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="name">Nama Event</label>
                                    <input type="text" class="form-control" id="name" value="{{ $event->name }}"
                                        name="name" placeholder="Enter Event Name">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="location">Lokasi Event</label>
                                    <input type="text" class="form-control" id="location" value="{{ $event->location }}"
                                        name="location" placeholder="Enter Event Location">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="province">Provinsi</label>
                                    <input type="text" class="form-control" id="province" value="{{ $event->province }}"
                                        name="province" placeholder="Enter Province">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="category">Kategori Event</label>
                                    <input type="text" class="form-control" id="category" value="{{ $event->category }}"
                                        name="category" placeholder="Enter Event Category">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi Event</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter Event Description">{{ $event->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="information">Informasi Event</label>
                                <textarea class="form-control" id="information" name="information" placeholder="Enter Event Information">{{ $event->information }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Gambar Event</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}"
                                    style="max-width: 200px; margin-top: 10px;">
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="start_time">Mulai Event</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time"
                                        value="{{ date('Y-m-d\TH:i', strtotime($event->start_time)) }}">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="end_time">Akhir Event</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                                        value="{{ date('Y-m-d\TH:i', strtotime($event->end_time)) }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Event</button>
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
