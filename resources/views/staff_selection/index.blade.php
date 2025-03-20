@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center card">
            <div class="">
                <div class="card-header">
                    <h5>{{ __('Staff Selection') }}</h5>
                </div>
            </div>
            <div class="mt-5 p-4">
                <div class="w-100 d-flex justify-content-end mb-2">
                    <a href="{{ route('selection.form') }}" type="button" class="btn btn-primary">Add New</a>
                </div>
                <table id="staff_selection" class="table">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Applied Post</th>
                        <th>Selection</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($interviewDetails as $key => $interviewDetail)
                            <tr id="interview-detail-{{ $interviewDetail->id }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $interviewDetail->name }}</td>
                                <td>{{ $interviewDetail->position }}</td>
                                <td>
                                    <!-- Display 'Selected' or 'Not Selected' with respective colors -->
                                    <span
                                        class="badge 
                                        @if ($interviewDetail->selected) badge-success 
                                        @else 
                                            badge-danger @endif">
                                        @if ($interviewDetail->selected)
                                            Selected
                                        @else
                                            Not Selected
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <!-- Action button to toggle selection -->
                                    <button
                                        class="btn btn-sm 
                                        @if ($interviewDetail->selected) btn-danger 
                                        @else 
                                            btn-success @endif"
                                        data-id="{{ $interviewDetail->id }}"
                                        id="toggleSelectionBtn-{{ $interviewDetail->id }}">
                                        @if ($interviewDetail->selected)
                                            Mark as Not Selected
                                        @else
                                            Mark as Selected
                                        @endif
                                    </button>


                                    <!-- View Details Button (Toggle collapse) -->
                                    <button class="btn btn-sm btn-info" data-id="{{ $interviewDetail->id }}"
                                        id="viewDetailsBtn-{{ $interviewDetail->id }}">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                            <!-- Collapsible row with interview and office use details -->
                            <tr id="details-row-{{ $interviewDetail->id }}" class="collapse">
                                <td colspan="5">
                                    <h5>Interview Details:</h5>
                                    <ul>
                                        <li><strong>Name:</strong> {{ $interviewDetail->name }}</li>
                                        <li><strong>Position Applied:</strong> {{ $interviewDetail->position }}</li>
                                        <li><strong>Experience:</strong> {{ $interviewDetail->experience }}</li>
                                        <li><strong>Personality:</strong> {{ $interviewDetail->personality }}</li>
                                        <li><strong>Job Stability:</strong> {{ $interviewDetail->job_stability }}</li>
                                        <li><strong>Willingness:</strong> {{ $interviewDetail->willingness }}</li>
                                    </ul>

                                    <h5>Office Use:</h5>
                                    <ul>
                                        <li><strong>Approved By:</strong>
                                            {{ $interviewDetail->officeUse ? $interviewDetail->officeUse->approved_by : 'N/A' }}
                                        </li>
                                        <li><strong>Salary:</strong>
                                            {{ $interviewDetail->officeUse ? $interviewDetail->officeUse->salary : 'N/A' }}
                                        </li>
                                        <li><strong>Joining Date:</strong>
                                            {{ $interviewDetail->officeUse ? $interviewDetail->officeUse->joining_date : 'N/A' }}
                                        </li>
                                        <li><strong>Probation Period:</strong>
                                            {{ $interviewDetail->officeUse ? $interviewDetail->officeUse->probation_period : 'N/A' }}
                                        </li>
                                        <li><strong>Increment on Probation:</strong>
                                            {{ $interviewDetail->officeUse ? $interviewDetail->officeUse->increment_probation : 'N/A' }}
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>



    </div>




    @push('scripts')
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
            integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
        </script>
        <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.pdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>





        <script>
            $(document).ready(function() {
                // Event listener for the "View Details" button
                $('button[id^="viewDetailsBtn-"]').on('click', function() {
                    var interviewDetailId = $(this).data('id');
                    var detailsRow = $('#details-row-' + interviewDetailId);

                    // Toggle the collapse of the details row
                    detailsRow.toggleClass('collapse');
                });
            });
        </script>




        <script>
            $(document).ready(function() {
                // Event listener for the selection toggle button
                $('button[id^="toggleSelectionBtn-"]').on('click', function() {
                    var interviewDetailId = $(this).data('id');
                    var currentSelectionStatus = $(this).text().trim() === 'Mark as Selected';

                    // Get form data using FormData
                    var formData = new FormData();

                    // Append the interview detail id and selected value
                    formData.append("interview_detail_id", interviewDetailId);
                    formData.append("selected", currentSelectionStatus ? 1 : 0);
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content')); // CSRF token

                    // AJAX request to toggle selection
                    $.ajax({
                        url: "{{ route('selection.toggleSelection') }}", // Define a route to handle this request
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                // Update the row in the table
                                if (currentSelectionStatus) {
                                    $('#interview-detail-' + interviewDetailId).find(
                                            'td:eq(3) span')
                                        .removeClass('badge-danger').addClass('badge-success')
                                        .text('Selected');
                                    $('#toggleSelectionBtn-' + interviewDetailId)
                                        .removeClass('btn-success').addClass('btn-danger')
                                        .text('Mark as Not Selected');
                                } else {
                                    $('#interview-detail-' + interviewDetailId).find(
                                            'td:eq(3) span')
                                        .removeClass('badge-success').addClass('badge-danger')
                                        .text('Not Selected');
                                    $('#toggleSelectionBtn-' + interviewDetailId)
                                        .removeClass('btn-danger').addClass('btn-success')
                                        .text('Mark as Selected');
                                }
                                alert('Selection updated successfully!');
                            } else {
                                alert('Something went wrong. Please try again.');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + xhr.responseText);
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                var table = $('#staff_selection').DataTable({
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
                        $('#Staff_id').val(result[0].id);
                        $('#net_salary').val(result[0]['staff_payrolls'][0]['net_salary']);
                        $('#month_year').val(result[0]['staff_payrolls'][0]['month'] + '-' + year);
                        $('paymentmonth').val(result[0]['staff_payrolls'][0]['month']);
                        $('paymentyear').val(year);
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
                // alert($('#net_salary').val());
                $.ajax({
                    url: " {{ route('staff.updatePayroll') }}",
                    type: 'POST',
                    data: {
                        staff_id: $('#Staff_id').val(),
                        net_salary: $('#net_salary').val(),
                        paymentyear: $('#month_year').val(),
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


            function revertPayroll(payroll_id) {
                // alert(payroll_id);
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
