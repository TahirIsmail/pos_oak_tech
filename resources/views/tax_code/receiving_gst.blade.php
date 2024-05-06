@extends('layouts.layout')
<style>

</style>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title">{{ __('RECEIVING GST') }}</span>
                    </div>
                </div>

                <div class="my-4">                    
                    <div id="paid_gst" style="display: block">
                        <table id="receiving_gst_table" class="table display nowrap w-100">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Product Serial No#') }}</th>
                                    <th>{{ __('GST  Rate (%)') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td id="">Total GST: {{ $total_gst }} </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>

                </div>



            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="{{ asset('js/pages/taxcodes.js') }}"></script>
    <script>
        'use strict';
        var taxcodes = new Taxcodes();
        taxcodes.receiving_gst();
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
        padding: 10px;
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

    #listing-table_wrapper {
        width: 96% !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }

    .dataTables_scrollHeadInner {
        width: 100%!important;
    }
    .active{
        background:red !important;
    }
</style>
