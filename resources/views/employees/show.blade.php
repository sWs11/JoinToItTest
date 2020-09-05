@extends('layouts.main')
@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <h3>{{ __('main.show_employee') }}</h3>
        </div>
    </div>

    <div class="row border-bottom">
        <div class="col-3">{{ __('main.first_name') }}: </div>
        <div class="col-9">{{ $employee->first_name }}</div>
    </div>
    <div class="row border-bottom">
        <div class="col-3">{{ __('main.last_name') }}: </div>
        <div class="col-9">{{ $employee->last_name }}</div>
    </div>
    <div class="row border-bottom">
        <div class="col-3">{{ __('main.company_name') }}: </div>
        <div class="col-9">{{ $employee->company_name }}</div>
    </div>
    <div class="row border-bottom">
        <div class="col-3">{{ __('main.email') }}: </div>
        <div class="col-9">{{ $employee->email }}</div>
    </div>
    <div class="row border-bottom">
        <div class="col-3">{{ __('main.phone') }}: </div>
        <div class="col-9">{{ $employee->phone }}</div>
    </div>
    <div class="row border-bottom">
        <div class="col-3">{{ __('main.created') }}: </div>
        <div class="col-9">{{ $employee->created_at }}</div>
    </div>
@endsection
