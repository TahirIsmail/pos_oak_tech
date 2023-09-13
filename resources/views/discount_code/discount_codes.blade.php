@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title">{{ __('Discount Codes') }}</span>
                    </div>
                    <div class="">
                        @if (check_access(['A_ADD_DISCOUNTCODE'], true))
                            <a href="{{ route('add_discount_code') }}" role="button"
                                class="btn btn-primary">{{ __('New Discount Code') }}</a>
                        @endif
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="listing-table" class="table display nowrap w-100">
                        <thead>
                            <tr>
                                <th>{{ __('Label') }}</th>
                                <th>{{ __('Discount Code') }}</th>
                                <th>{{ __('Discount Percentage') }}</th>
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
    <script src="{{ asset('js/pages/discountcodes.js') }}"></script>
    <script>
        'use strict';
        var discountcodes = new Discountcodes();
        discountcodes.load_listing_table();
    </script>
@endpush
