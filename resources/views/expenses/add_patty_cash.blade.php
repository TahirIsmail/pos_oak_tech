@extends('layouts.layout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-fluid">
        <div class="row justify-content-center card">
            <div class="">
                <div class="card-header">
                    <h5>{{ __('Patty Cash') }}</h5>
                </div>
            </div>
            <div class="mt-5 p-4">
                <div class="mt-5 p-4">
                    <form id="pattyCashForm">
                        <div class="form-group">
                            <label for="amount">{{ __('Amount') }}</label>
                            <input type="number" id="amount" name="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="month">{{ __('Month') }}</label>
                            <select id="month" name="month" class="form-control" required>
                                @foreach (range(1, 12) as $month)
                                    <option value="{{ $month }}">
                                        {{ \Carbon\Carbon::create()->month($month)->format('F') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">{{ __('Year') }}</label>
                            <input type="number" id="year" name="year" class="form-control"
                                value="{{ date('Y') }}" required>
                        </div>
                        <button type="submit" id="savePattyCash" class="btn btn-primary">{{ __('Save') }}</button>
                    </form>
                </div>


                <table id="" class="table display nowrap w-100">
                    <thead>
                        <tr>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Month') }}</th>
                            <th>{{ __('Year') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patty_cash as $patty)
                            <tr>
                                <td>{{ $patty->amount }}</td>
                                <td>{{ \Carbon\Carbon::create()->month($patty->month)->format('F') }}</td>
                                <td>{{ $patty->year }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <script>
                    $(document).ready(function() {
                        $('#pattyCashForm').submit(function(e) {
                            e.preventDefault(); // Prevent form from submitting normally

                            // Create FormData object
                            var formData = new FormData();

                            // Append form data to FormData object
                            formData.append('amount', $('#amount').val());
                            formData.append('month', $('#month').val());
                            formData.append('year', $('#year').val());

                            // Append CSRF token to FormData
                            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                            // AJAX request to send data
                            $.ajax({
                                url: '{{ route('patty_cash.store') }}', // The URL to send the request to
                                type: 'POST',
                                data: formData,
                                processData: false, // Prevent jQuery from automatically transforming the data into a query string
                                contentType: false, // Don't set content type, let FormData handle it
                                success: function(response) {
                                    alert(response.success);
                                    $('#pattyCashForm')[0].reset(); // Reset form after success
                                },
                                error: function(xhr) {
                                    var error = xhr.responseJSON.error;
                                    alert(error); // Show error message if any
                                }
                            });
                        });

                    });
                </script>



            </div>



        </div>
    @endsection


    @push('scripts')
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/datatable.js') }}"></script>

        <script>
            $('#patty_cash_table').DataTable();
        </script>
    @endpush
