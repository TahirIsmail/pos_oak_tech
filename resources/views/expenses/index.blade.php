@extends('layouts.layout')

@section('content')
    <div class="col-md-12 mb-2">
        <div class="row justify-content-between">


            <div class="d-flex align-items-start justify-content-between flex-column p-1 mb-1 col-md-3 box">
                <div class="dashboard_row col-14  bg-white rounded custom-border-light">
                    <div class="d-flex align-items-center flex-column box-content">
                        <div class="dashboard_title text-subhead p-2">
                            Total Expense
                        </div>


                        <div class="mt-auto p-4">
                            <span>

                                <div class="d-flex flex-column align-items-center">
                                    <h1>{{ $total_expense }}</h1>

                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box">
                <div class="dashboard_row col-14  bg-white rounded custom-border-light">
                    <div class="d-flex align-items-center flex-column box-content">
                        <div class="dashboard_title text-subhead p-2">Staff Expense</div>

                        <div class="mt-auto p-4">
                            <span>

                                <div class="d-flex flex-column align-items-center">

                                    <h1>{{ $staff_expense }}</h1>

                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box">
                <div class="dashboard_row col-14 bg-white rounded custom-border-light">
                    <div class="d-flex align-items-center flex-column box-content">
                        <div class="dashboard_title text-subhead p-2">
                            Travel Expense
                        </div>

                        <div class="mt-auto p-4">
                            <span>

                                <div class="d-flex flex-column align-items-center">
                                    <h1>{{ $travel_expense }}</h1>

                            </span>
                        </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                    <span class="text-title">{{ __('Expenses') }}</span>
                </div>
                <div class="">
                    {{-- @if (check_access(['A_ADD_EXPENSE'], true)) --}}
                    <a href="{{ route('add_expense') }}" role="button" class="btn btn-primary">{{ __('New Expense') }}</a>
                    {{-- @endif --}}
                </div>
                {{-- <div class=""> --}}
                    {{-- @if (check_access(['A_ADD_EXPENSE_CATEGORY'], true)) --}}
                    {{-- <a href="" role="button" class="btn btn-primary">{{ __('New Expense Category') }}</a> --}}
                    {{-- @endif --}}
                {{-- </div> --}}
            </div>

            <div class="table-responsive">


                <table id="Expense_listing" class="table display nowrap w-100">
                    <thead>
                        <tr>
                            <th>{{ __('Expense Date') }}</th>
                            <th>{{ __('Expense Name') }}</th>
                            <th>{{ __('Expense Category ') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Notes') }}</th>
                            <th>{{ __('Status')}} </th>
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
@endsection

@push('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/pages/expenses.js') }}"></script>
    <script>
        'use strict';
        var expenses = new Expenses();

        expenses.load_expenses_listing_table();
    </script>
@endpush
