@extends('layouts.layout')
<style>
    .dataTables_scroll{
        overflow: hidden !important;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class=" card-header d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title">{{ __('Customers') }}</span>
                    </div>
                    <div class="">
                        @if (check_access(['A_ADD_CUSTOMER'], true))
                            <a href="{{ route('add_customer') }}" role="button"
                                class="btn btn-primary">{{ __('New Customer') }}</a>
                        @endif
                    </div>
                </div>

                <div class="my-4">
                    <table id="listing-table" class="table display nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created On') }}</th>
                                <th>{{ __('Updated On') }}</th>
                                <th>{{ __('Created By') }}</th>
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
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/pages/customers.js') }}"></script>
    <script>
        'use strict';
        var customers = new Customers();
        customers.load_listing_table();
    </script>
@endpush
<style scoped>
    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, .03);
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }


    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: 10px !important;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        margin-left: 18px;
    }
    #listing-table_wrapper{
        width: 96% !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }
    .dataTables_scrollHeadInner{
        width: none !important;
    }
</style>
