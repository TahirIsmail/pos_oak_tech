@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header  d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title">{{ __('Suppliers Performance') }}</span>
                    </div>
                    <div class="">
                        @if (check_access(['A_ADD_SUPPLIER'], true))
                            <a href="{{ route('add_supplier_performa') }}" role="button"
                                class="btn btn-primary">{{ __('Add Supplier Performa') }}</a>
                        @endif
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="listing_performance_table" class="table display nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Supplier Name') }}</th>
                                <th>{{ __('Deliver Timeline') }}</th>
                                <th>{{ __('Product Quality') }}</th>
                                <th>{{ __('Responsiveness') }}</th>
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
    <script src="{{ asset('js/pages/suppliers.js') }}"></script>
    <script>
        'use strict';
        var suppliers = new Suppliers();

        suppliers.load_suppliers_performance_listing_table();
        //console.info(suppliers.load_listing_table());
    </script>
@endpush
