@extends('layouts.main')

@section('content')
    <div class="row mt-3">
        <div class="col-11">
            <h3>{{ __('main.employees') }}</h3>
        </div>
        <div class="col-1">
            <a href="{{ route('employees.create') }}" class="btn btn-success btn rounded-1" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('main.add_employee') }}"><i class="fa fa-plus"></i></a>
        </div>
    </div>

    <table class="table mt-3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('main.first_name') }}</th>
            <th scope="col">{{ __('main.last_name') }}</th>
            <th scope="col">{{ __('main.company_name') }}</th>
            <th scope="col">{{ __('main.email') }}</th>
            <th scope="col">{{ __('main.phone') }}</th>
            <th scope="col">{{ __('main.created') }}</th>
            <th scope="col">{{ __('main.actions') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach($employees as $employee)
            <tr>
                <th scope="row">{{ $employee->id }}</th>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->company_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->created_at }}</td>
                <td>
                    <ul class="list-inline m-0">
                        <li class="list-inline-item">
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-success btn-sm rounded-1" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('main.show_employee') }}"><i class="fa fa-eye"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm rounded-1" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('main.edit') }}"><i class="fa fa-edit"></i></a>
                        </li>
                        <li class="list-inline-item">

                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="delete_employee_form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-1" data-id="{{ $employee->id }}" data-toggle="tooltip" data-placement="top" title="{{ __('main.delete') }}"><i class="fa fa-trash"></i></button>

                                {{--                                <button type="submit" class="btn btn-danger">Delete</button>--}}
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $employees->onEachSide(1)->links() }}
@endsection

@push('scripts')
    <script !src="">
        $(function () {
            $('.delete_employee_form').on('submit', deleteEmployee);

            function deleteEmployee(event) {
                if (!confirm("{{ __('main.employee_delete_answer') }}")) {
                    event.preventDefault();
                }
            }
        });
    </script>
@endpush
