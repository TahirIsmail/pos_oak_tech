@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title">{{ __('Leaves') }}</span>
                    </div>
                    <div>
                        @if (check_access(['A_ADD_LEAVES'], true))
                            <a href="{{ route('add_staff_leave') }}" role="button" class="btn btn-primary">
                                {{ __('Add Leave') }} </a>
                        @endif
                    </div>
                </div>


                <div class="table-responsive">
                    <table id="staff_leaves" class="table display nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Staff Name') }}</th>
                                <th>{{ __('Line Manager') }}</th>
                                <th>{{ __('Leave Type') }}</th>
                                <th>{{ __('Leave From') }}</th>
                                <th>{{ __('Leave To') }}</th>
                                <th>{{ __('Leave Days') }}</th>
                                <th>{{ __('Leave Status') }}</th>
                                <th>{{ __('Applied By') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
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
        leave.load_leave_listing_table();
    </script>
@endpush