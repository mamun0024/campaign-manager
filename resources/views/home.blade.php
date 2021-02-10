@extends('layout')
@section('title')
Campaign Lists
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h2>Campaign Lists</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="#" class="btn btn btn-dark rounded-0">Create Campaign</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="campaign-list"></div>
    </div>
@endsection
