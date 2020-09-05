@extends('layouts.main')

@section('content')
    <div class="row mt-3">
        <div class="col-11">
            <h3>{{ __('main.companies') }}</h3>
        </div>
        <div class="col-1">
            <a href="{{ route('companies.create') }}" class="btn btn-success btn rounded-1" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('main.add_company') }}"><i class="fa fa-plus"></i></a>
        </div>
    </div>

    <table class="table mt-3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('main.name') }}</th>
            <th scope="col">{{ __('main.email') }}</th>
            <th scope="col">{{ __('main.website') }}</th>
            <th scope="col">{{ __('main.created') }}</th>
            <th scope="col">{{ __('main.actions') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach($companies as $company)
            <tr>
                <th scope="row">{{ $company->id }}</th>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->website }}</td>
                <td>{{ $company->created_at }}</td>
                <td>
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-success btn-sm rounded-1" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('main.show_company') }}"><i class="fa fa-eye"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning btn-sm rounded-1" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('main.edit') }}"><i class="fa fa-edit"></i></a>
                        </li>
                        <li class="list-inline-item">

                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="delete_company_form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-1 delete_company" data-id="{{ $company->id }}" data-toggle="tooltip" data-placement="top" title="{{ __('main.delete') }}"><i class="fa fa-trash"></i></button>

{{--                                <button type="submit" class="btn btn-danger">Delete</button>--}}
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $companies->onEachSide(1)->links() }}
@endsection

@push('scripts')
    <script !src="">
        $(function () {
            $('.delete_company_form').on('submit', deleteCompany);

            function deleteCompany(event) {
                if (!confirm("{{ __('main.company_delete_answer') }}")) {
                    event.preventDefault();
                }
            }
        });
    </script>
@endpush
