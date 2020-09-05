@extends('layouts.main')
@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <h3>{{ __('main.show_company') }}</h3>
        </div>
    </div>

    <div class="row border-bottom">
        <div class="col-3">{{ __('main.name') }}: </div>
        <div class="col-9">{{ $company->name }}</div>
    </div>
    <div class="row border-bottom">
        <div class="col-3">{{ __('main.email') }}: </div>
        <div class="col-9">{{ $company->email }}</div>
    </div>
    <div class="row border-bottom">
        <div class="col-3">{{ __('main.website') }}: </div>
        <div class="col-9">{{ $company->website }}</div>
    </div>
    <div class="row border-bottom">
        <div class="col-3">{{ __('main.created') }}: </div>
        <div class="col-9">{{ $company->created_at }}</div>
    </div>

    <div class="row">
        <div class="col-3">{{ __('main.logo') }}</div>
        <div class="col-9">
            <img src="{{ asset($company->logo) }}" alt="logo" width="300">
        </div>
    </div>
@endsection
