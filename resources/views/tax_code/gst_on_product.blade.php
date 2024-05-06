@extends('layouts.layout')
<style>
</style>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title">{{ __('GST On Product') }}</span>
                    </div>
                </div>
                <div class="my-2">
                    <div class="w-100 d-flex justify-content-end mb-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Adjust GST</button>
                    </div>
                    <div id="paid_gst" style="display: block">
                        <table id="gst_listing" class="table display nowrap w-100">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Product Serial No#') }}</th>
                                    <th>{{ __('GST  Rate (%)') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Status') }}</th>
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

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Adjust Gst In Cash Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="invoice">Invoice</label>
                                        <select class="form-control select2 w-100" id="invoice" style="width: 100%;"
                                            onchange="fetchCashProducts()">
                                            <option selected disabled>Please Select Invoice...</option>
                                            @foreach ($invoices as $invoice)
                                                <option value="{{ $invoice['slack'] }}">{{ $invoice['invoice_number'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="product_serial">Product Serial No#</label>
                                        <select class="form-control select2 w-100" id="product_serial" style="width: 100%;">
                                            <option selected disabled>Please Select Product Serial...</option>                                           
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="gst_amount">GST Amount</label>
                                        <input type="number" class="form-control" id="gst_amount" placeholder="GST Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="save_adjust_gst_cash_product()">Save changes</button>
                            </div>
                        </div>
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
        taxcodes.load_gst_listing();
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("exampleModal");
            modal.style.setProperty('display', 'none', 'important');
        });
    </script>
    <script>
        function showPaidGST() {
            $("#paid_gst").css('display', 'block');
            $("#receiving_gst").css('display', 'none');
            $("#paid_gst_button").addClass("active");
            $("#receiving_gst_button").removeClass("active");
        }

        function showReceivingGST() {
            $("#paid_gst").css('display', 'none');
            $("#receiving_gst").css('display', 'block');
            $("#paid_gst_button").removeClass("active");
            $("#receiving_gst_button").addClass("active");
        }

        function updateGstStatus(gstId) {
            var formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            formData.append("gst_id", gstId);
            $.ajax({
                url: 'api/update-gst-status',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if (response.status == 'Success') {
                        window.location.reload();
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function fetchCashProducts() {
            invoice_slack = $('#invoice').val();
            var formData = new FormData();
            formData.append("access_token", window.settings.access_token);
            formData.append("invoice_slack", invoice_slack);
            $.ajax({
                url: 'api/fetch_cash_products',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    var selectElement = document.getElementById("product_serial");
                    selectElement.innerHTML =
                        '<option selected disabled>Please Select Product Serial...</option>';
                    response.data.forEach(function(product) {
                        var option = document.createElement("option");
                        option.value = product.product.id; 
                        option.textContent = product.product_code;
                        selectElement.appendChild(option);
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function save_adjust_gst_cash_product(){
            invoice = $('#invoice').val();
            product_serial = $('#product_serial').val();
            gst_amount = $('#gst_amount').val();
            if(invoice && product_serial && gst_amount){
                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("invoice_slack", invoice);
                formData.append("product_id", product_serial);
                formData.append("gst_amount", gst_amount);

                $.ajax({
                    url: 'api/save_adjust_gst_cash_product',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status_code == 200) {
                            window.location.reload();
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
            else{
                alert('Please fill All fields');
            }
           
        }
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
        width: 100% !important;
    }
    .active {
        background: red !important;
    }
</style>
