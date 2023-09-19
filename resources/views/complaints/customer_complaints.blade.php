@extends('layouts.layout')

@section("content")
<div class="row">
    <div class="col-md-12">
        
        <div class="d-flex flex-wrap mb-4">
            <div class="mr-auto">
                <span class="text-title">{{ __("Complaints") }}</span>
            </div>
            <div class="">
                @if (check_access(array('A_ADD_CUSTOMER_COMPLAINT'), true))
                    <a href="{{ route('add_complaints')}}" role="button" class="btn btn-primary">{{ __("New Customer Complaint") }}</a>
                @endif
            </div>
        </div>

        <div class="table-responsive">
            <table id="listing" class="table display nowrap w-100">
                <thead>
                    <tr>

                        <th>{{ __("Complaint Reference No") }}</th>
                        <th>{{ __("Complaint Status") }}</th>
                        <th>{{ __("Assigned To")}}</th>
                        <th>{{ __("Complaint By")}}</th>         
                        <th>{{__("Created By")}}</th>              
                        <th>{{__("Updated By")}}</th>
                        <th>{{ __("Action") }}</th>
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
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/pages/complaints.js') }}"></script>
    <script>
        'use strict';
        var complaints = new Complaints();
        complaints.load_customer_complaint_listing_table();
    </script>
@endpush