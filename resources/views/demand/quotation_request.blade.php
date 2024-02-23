@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title">{{ __('Quotation Request') }}</span>
                    </div>
                    <div class="">
                        @if (check_access(['A_ADD_QUOTATION_REQUEST'], true))
                            <a href="{{ route('add_quotation_request') }}" role="button"
                                class="btn btn-primary">{{ __('New Quotation Request') }}</a>
                        @endif
                    </div>
                </div>

                <div class="my-4">
                    <table id="quotation_request" class="table display nowrap w-100">
                        <thead>
                           <th>Customer</th>
                           <th>Ref No#</th>
                           <th>Item Details</th>
                           <th>Quantity</th>
                           <th>Payment Term</th>
                           <th>Delivery Term</th>
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
    {{-- <script src="{{ asset('js/pages/quotations.js') }}"></script> --}}
    <script src="{{ asset('js/pages/demand_form.js') }}"></script>
    <script>
        'use strict';
        var demand_form = new DemandForm();
        demand_form.load_quotation_request_data();
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
