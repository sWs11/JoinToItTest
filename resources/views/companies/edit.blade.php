@extends('layouts.main')

@section('content')
    <div class="container mt-3">
        @if(session()->get('success'))
            <div class="row">
                <div class="col">
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('main.edit_company') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('main.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $company->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('main.email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $company->email }}" autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('main.website') }}</label>

                                <div class="col-md-6">
                                    <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $company->website }}" autocomplete="website">

                                    @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('main.logo') }}</label>

                                <div class="col-md-6" id="logo_image_wr" @if(empty($company->logo)) style="display: none;" @endif>
                                    <img src="{{ asset($company->logo) }}" alt="logo" width="300">

                                    <ul class="list-inline mb-0 mt-3">
                                        <li class="list-inline-item">
                                            <button type="button" class="btn btn-warning btn-sm rounded-1" id="edit_logo" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('main.edit') }}"><i class="fa fa-edit"></i></button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6" id="logo_input_wr" @if(!empty($company->logo)) style="display: none;" @endif>

                                    <div class="custom-file">
                                        <input id="logo" type="file" class="custom-file-input @error('logo') is-invalid @enderror" name="logo">
                                        <label class="custom-file-label" for="validatedCustomFile">{{ __('main.choose_file') }}</label>
                                        <input type="hidden" id="exist_image_path" name="exist_image" value="{{ $company->logo }}" />

                                        @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('main.save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(function () {
            const logo_image_wr = $('#logo_image_wr');
            const logo_input_wr = $('#logo_input_wr');
            const edit_logo_btn = $('#edit_logo');
            const logo_input = $('#logo');
            const exist_image_path = $('#exist_image_path');

            edit_logo_btn.on('click', editLogo);

            function editLogo(event) {
                logo_input.attr('type', 'file');
                exist_image_path.val('');
                logo_image_wr.hide();
                logo_input_wr.show();
            }
        });
    </script>
@endpush
