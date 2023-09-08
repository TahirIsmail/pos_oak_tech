@extends('layouts.layout')

@section('content')

    <div class="container">
        <div class="row justify-content-center card">
            <div class="">
                <div class="card-header">
                    <h5>{{ __('Select Category') }}</h5>
                </div>
            </div>


            <form action="{{ route('payroll.search_staff') }}" method="post">

                @csrf
                <div class="row card-body">
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="role">Role <span style="color:red">*</span></label>
                            <select id="role" class="form-control" name="role">
                                <option value="">Select Role...</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role['id'] }}" {{ old('role') == $role['id'] ? 'selected' : '' }}
                                        {{ isset($role_id) ? ($role_id == $role['id'] ? 'selected' : '') : '' }}>
                                        {{ $role['label'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="alert text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label for="month">Month <span style="color:red">*</span></label>
                            <select id="month" class="form-control" name="month">
                                <option value="">Select Month...</option>
                                @foreach (range(1, 12) as $monthNumber)
                                    <option value="{{ $monthNumber }}" {{ old('month') == $monthNumber ? 'selected' : '' }}
                                        {{ isset($month) ? ($month == $monthNumber ? 'selected' : '') : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $monthNumber, 1)) }}

                                    </option>
                                @endforeach
                            </select>
                            @error('month')
                                <div class="alert text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 mt-2">
                        <div class="mt-4">
                            <button type="submit mt-2" class="btn btn-primary w-100">Search Staff List</button>
                        </div>
                    </div>
                </div>

            </form>
            <br>


            @if ($users)
                <div class="table-responsive mt-5 p-4">
                    <table id="staff_listing" class="table">
                        <thead>
                            <th>#</th>
                            <th>Staff Name</th>
                            <th>Staff Code</th>
                            <th>Staff Email</th>
                            <th>Staff Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php $count = 1; @endphp
                            @foreach ($users as $staff)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $staff['fullname'] }}</td>
                                    <td>{{ $staff['user_code'] }}</td>
                                    <td>{{ $staff['email'] }}</td>
                                    <td>{{ $staff['role']['label'] }}</td>
                                    <td>
                                        @if (isset($staff['staffPayrolls'][0]))
                                            <span class="bg bg-success p-1 text-white rounded">
                                                {{ isset($staff['staffPayrolls'][0]) ? $staff['staffPayrolls'][0]['status'] : '' }}

                                            </span>
                                        @endif
                                    </td>
                                    <td>

                                        @if (!isset($staff['staffPayrolls'][0]))
                                            <a
                                                href="{{ route('staff.generatePayroll', ['slack' => $staff['slack'], 'month' => $month, 'year' => $year]) }}">
                                                <button class="btn btn-primary" style="line-height: 0.5!important;">Generate
                                                    Payroll</button>
                                            </a>
                                        @else
                                            @if (check_access(['A_REVERT_STAFF_PAYROLL'], true))
                                                
                                                    <a onclick="revertPayroll({{ $staff['staffPayrolls'][0]['id'] }})" style="cursor:pointer;">
                                                        ↺
                                                    </a>
                                               
                                            @endif
                                            @if (check_access(['A_VIEW_STAFF_PAYROLL'], true))
                                                @php
                                                    $monthName = $staff['staffPayrolls'][0]['month'];
                                                    $numericMonth = date('n', strtotime($monthName));
                                                @endphp
                                                <a
                                                    onclick="viewPayroll({{ $staff['id'] }}, {{ $numericMonth }}, {{ $staff['staffPayrolls'][0]['year'] }})">
                                                    <button class="btn"
                                                        style="line-height: 0.5!important;background:#222533;color:white">View
                                                        Payroll
                                                    </button>
                                                </a>
                                            @endif
                                            @if (check_access(['A_PROCEED_STAFF_PAYROLL'], true))
                                                @if (!$staff['staffPayrolls'][0]['status'] == 'Paid')
                                                    @php
                                                        $monthName = $staff['staffPayrolls'][0]['month'];
                                                        $numericMonth = date('n', strtotime($monthName));
                                                    @endphp
                                                    <a
                                                        onclick="getRecord({{ $staff['id'] }}, {{ $numericMonth }}, {{ $staff['staffPayrolls'][0]['year'] }})">
                                                        <button class="btn"
                                                            style="line-height: 0.5!important;background:#222533;color:white;cursor:pointer">Proceed
                                                            Payroll</button>
                                                    </a>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>

                                @php $count++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif




        </div>

        <div class="modal" id="proceedtopay" tabindex="-1" style="display: none;">
            <div class="modal-dialog modal-dialog2 modal-lg">
                <div class="modal-content" style="background:#fcfcfc;">
                    <div class="modal-header d-flex justify-content-between">
                        <h4 class="modal-title">Proceed To Pay</h4>
                        <button type="button" class="close" data-dismiss="modal" onclick="crossModal()">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="schsetting_form" action="">
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                    <label for="staff_name">Staff Name</label>
                                    <input type="text" name="staff_name" readonly class="form-control" id="staff_name">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                    <label for="net_salary">Payment Amount</label>
                                    <input type="text" name="net_salary" readonly class="form-control" id="net_salary">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                    <label for="exampleInputEmail1">Month and Year</label>
                                    <input id="month_year" name="month" readonly placeholder="" type="text"
                                        class="form-control" />
                                    <input id="paymentmonth" placeholder="" type="hidden" class="form-control" />
                                    <input id="paymentyear" placeholder="" type="hidden" class="form-control" />
                                    <input id="paymentid" placeholder="" type="hidden" class="form-control" />
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                    <label for="exampleInputEmail1">Payment Mode</label>
                                    <small class="req"> *</small><br /><span id="remark"></span>
                                    <select name="payment_mode" id="payment_mode" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Bank Account">Bank Account</option>
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                    <label for="exampleInputEmail1">Payment Date</label><br /><span id="remark">
                                    </span>
                                    <input type="text" name="payment_date" id="payment_date" class="form-control"
                                        value="">
                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                    <label for="exampleInputEmail1">Note</label><br /><span id="remark"> </span>
                                    <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"
                                    style="display: flex; justify-content:end;">
                                    <button type="button" class="btn btn-primary submit_schsetting pull-right"
                                        data-loading-text="Processing" onclick="payrollProceedToPay()">Proceed To
                                        Pay</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <div id="payslipview" class="modal" tabindex="-1" style="display: none;">

            <div class="modal-dialog modal-dialog2 modal-lg" style="">
                <div class="modal-content" style="background:#fcfcfc;">
                    <div class="modal-header d-flex justify-content-between">
                        <h4 class="modal-title">Details<span id="print1"></span></h4>
                        <button type="button" class="close" data-dismiss="modal"
                            onclick="closeModal()">&times;</button>
                    </div>
                    <div class="modal-body" id="testdata">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <div class="">
                                    <table width="100%">

                                        <tr>
                                            <td align="center">
                                                <h3 style="margin: 10px 0 20px;" id="v_main_heading"></h3>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="100%" class="paytable2">
                                        <tr>
                                            <th>Payslip #ID</th>
                                            <td id="v_payslipId"></td>
                                            <th class="text-right"></th>
                                            <th class="text-right">Payment date: <span id="v_payment_date"></span></th>
                                        </tr>
                                    </table>
                                    <hr />
                                    <table width="100%" class="paytable2">
                                        <tr>
                                            <th width="25%">Staff ID</th>
                                            <td width="25%" id="v_staff_id"></td>
                                            <th width="25%">Name</th>
                                            <td width="25%" id="v_staff_name"></td>
                                        </tr>
                                        <tr>
                                            <!-- Optional: Department and Designation -->
                                            <th>Designation</th>
                                            <td id="v_role_name"></td>

                                        </tr>
                                    </table>
                                    <br />
                                    <table class="earntable table table-striped table-responsive">
                                        <tr>
                                            <th width="33%">Earning</th>
                                            <th width="33%" class="pttright reborder">Amount(<span
                                                    id="v_total_amount"></span>)</th>
                                            <th width="33%" class="pttleft">Deduction</th>
                                            <th width="33%" class="text-right">Amount(<span
                                                    id="v_total_deduction"></span>)</th>
                                        </tr>
                                        <!-- Loop through earnings and deductions here -->
                                        <tr>
                                            <td id="v_allownace_name"></td>
                                            <td class="pttright reborder" id="v_allownace_amount"></td>
                                            <td class="pttleft" id="v_deduction_name"></td>
                                            <td class="text-right" id="v_deduction_amount"></td>
                                        </tr>
                                        <!-- ... Repeat as needed ... -->
                                        {{-- <tr>
                                            <th>Total Earning</th>
                                            <th class="pttright reborder">TOTAL_EARNING_AMOUNT_HERE</th>
                                            <th class="pttleft">Total Deduction</th>
                                            <th class="text-right">TOTAL_DEDUCTION_AMOUNT_HERE</th>
                                        </tr> --}}
                                    </table>
                                    <table class="totaltable table table-striped table-responsive">
                                        <tr>
                                            <th width="100%">Payment Mode</th>
                                            <td class="text-right" id="v_payment_mode"></td>
                                        </tr>
                                        {{-- <tr>
                                            <th width="20%">Total PF(CURRENCY_SYMBOL_HERE)</th>
                                            <td class="text-right">TOTAL_PF_HERE</td>
                                        </tr> --}}
                                        <tr>
                                            <th width="100%">Basic Salary(Rs.)</th>
                                            <td class="text-right" id="v_basic_salary"></td>
                                        </tr>
                                        <!-- Optional: Display Tax if available -->
                                        <tr>
                                            <th width="100%">Tax(Rs.)</th>
                                            <td class="text-right" id="v_total_tax"></td>
                                        </tr>
                                        <tr>
                                            <th width="100%">Net Salary(Rs.)</th>
                                            <td class="text-right" id="v_net_salary"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%">
                                                <p>This payslip is computer generated hence no signature is required.</p>

                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!--/.col (left) -->
                        </div>


                    </div>
                </div>
            </div>
        </div>


    </div>









    @push('scripts')
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- DataTables Buttons PDF extension JavaScript -->
        <!-- DataTables Buttons extension CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">


        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
            integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
        </script>
        <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.pdf.min.js"></script>
        {{-- <script src="{{ asset('js/datatable.js') }}"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                var table = $('#staff_listing').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'pdf',
                        text: 'Save current page',
                        exportOptions: {
                            modifier: {
                                page: 'current'
                            }
                        }
                    }],

                });
                // Check the data format
                if (table.rows().count() === 0) {
                    console.error('No data found in the table.');
                }
                $('.select2').select2();
            });

            function getRecord(staff_id, month, year) {
                var csrfToken = $('input[name="_token"]').val();
                $.ajax({
                    url: " {{ route('staff.searchPayroll') }}",
                    type: 'POST',
                    data: {
                        staff_id: staff_id,
                        month: month,
                        year: year
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    success: function(result) {
                        console.log(result[0]['staff_payrolls'][0]['id']);
                        $('#staff_name').val(result[0].fullname + '(' + result[0].user_code + ')');
                        $('#net_salary').val(result[0]['staff_payrolls'][0]['net_salary']);
                        $('#month_year').val(result[0]['staff_payrolls'][0]['month'] + '-' + year);
                        $('#paymentid').val(result[0]['staff_payrolls'][0]['id']);
                        var currentDate = new Date().toISOString().slice(0, 10);
                        $('#payment_date').val(currentDate);
                        $('#proceedtopay').css('display', 'block');
                    }
                });

            }

            function crossModal() {
                $('#proceedtopay').css('display', 'none');
            }

            function closeModal() {
                $('#payslipview').css('display', 'none');
            }


            function payrollProceedToPay() {
                var csrfToken = $('input[name="_token"]').val();

                $.ajax({
                    url: " {{ route('staff.updatePayroll') }}",
                    type: 'POST',
                    data: {
                        staff_id: $('#staff_id').val(),
                        paymentmonth: $('#paymentmonth').val(),
                        paymentyear: $('#paymentyear').val(),
                        payment_mode: $('#payment_mode').val(),
                        payment_date: $('#payment_date').val(),
                        remarks: $('#remarks').val(),
                        paymentid: $('#paymentid').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    success: function(result) {
                        if (result.data) {
                            window.location.reload();
                        }

                    }
                });





            }

            function viewPayroll(staff_id, month, year) {
                var csrfToken = $('input[name="_token"]').val();
                $.ajax({
                    url: " {{ route('staff.searchPayroll') }}",
                    type: 'POST',
                    data: {
                        staff_id: staff_id,
                        month: month,
                        year: year
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    success: function(result) {

                        $('#v_main_heading').text(
                            `Payslip for the period of ${result[0]['staff_payrolls'][0]['month']} ${result[0]['staff_payrolls'][0]['year']}`
                        );
                        $('#v_staff_name').text(result[0].fullname + '(' + result[0].user_code + ')');
                        $('#v_net_salary').text(result[0]['staff_payrolls'][0]['net_salary']);
                        $('#v_basic_salary').text(result[0]['staff_payrolls'][0]['basic']);
                        $('#v_total_tax').text(result[0]['staff_payrolls'][0]['tax']);
                        $('#v_month_year').text(result[0]['staff_payrolls'][0]['month'] + '-' + year);
                        $('#v_staff_id').text(result[0].user_code);
                        $('#v_payslipId').text(result[0].id);
                        $('#v_payment_date').text(result[0]['staff_payrolls'][0]['payment_date']);
                        $('#v_role_name').text(result[0]['role']['label']);
                        $('#v_payment_mode').text(result[0]['staff_payrolls'][0]['payment_mode']);

                        $('#payslipview').css('display', 'block');
                    }
                });
            }


            function revertPayroll(payroll_id){
                alert(payroll_id);
                var csrfToken = $('input[name="_token"]').val();
                $.ajax({
                    url: " {{ route('staff.revertPayroll') }}",
                    type: 'POST',
                    data: {
                        payroll_id: payroll_id,
                       
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    success: function(result) {
                        if (result.data) {
                            window.location.reload();
                        }                       
                    }
                });
            }
        </script>
    @endpush
@endsection


<style>
    #testdata {
        max-height: 80vh;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .tddata {
        width: 100%;
    }
</style>
