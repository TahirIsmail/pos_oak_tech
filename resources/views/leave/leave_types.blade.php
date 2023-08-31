@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                    <span class="text-title">{{ __('Leave Types') }}</span>
                </div>
                <div>
                    @if (check_access(['A_ADD_LEAVE_TYPE'], true))
                        <a href="{{ route('leaveType.store') }}" role="button" class="btn btn-primary" > {{ __('Add Leave Type') }} </a>
                    @endif
                </div>
            </div>


            <div class="table-responsive">
                <table id="leave_type" class="table display nowrap w-100">
                    <thead>
                        <tr>
                            <th>{{ __('#') }}</th>
                            <th>{{ __('Leave Type') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leave_types as $leave_type)
                            <tr>

                                <td>{{ $leave_type['id'] }}</td>
                                <td>{{ $leave_type['type'] }}</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-success">Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>        

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('js/datatable.js') }}"></script> --}}
    <script src="{{ asset('js/pages/leave.js') }}"></script>
    <script>
        'use strict';
        var leave = new leaves();
        leave.load_leave_table();        
    </script>
@endpush
