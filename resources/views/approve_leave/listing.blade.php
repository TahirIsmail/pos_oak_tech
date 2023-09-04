@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                    <span class="text-title">{{ __('APPROVE LEAVES') }}</span>
                </div>
               
            </div>


            <div class="table-responsive">
                <table id="approve_leaves" class="table display nowrap w-100">
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
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>                       
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
    <script src="{{ asset('js/pages/approve_leaves.js') }}"></script>
    <script>
        'use strict';
        var leave = new leaves();
        leave.load_leave_listing_table();

      
    </script>
@endpush
