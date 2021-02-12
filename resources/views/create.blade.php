@extends('layout')
@section('title')
    Create Campaign
@endsection
@section('content')
    <div class="row header-margin">
        <div class="col-md-6">
            <h2>Create Campaign</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('campaign.list') }}" class="btn btn btn-dark rounded-0"><i class="fa fa-angle-left" aria-hidden="true"></i> Campaign Lists</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="create-campaign"></div>
    </div>
@endsection
