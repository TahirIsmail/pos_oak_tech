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
                    <div class="col-sm-12 col-md-2 mt-2">
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
                                        <a href="{{ route('staff.generatePayroll', ['slack' => $staff['slack'], 'month' => $month, 'year' => $year ]) }}">
                                            <button class="btn btn-primary" style="line-height: 0.5!important;">Generate Payroll</button>
                                        </a>
                                    </td>
                                </tr>

                                @php $count++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>







    @push('scripts')
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- DataTables Buttons PDF extension JavaScript -->
        <!-- DataTables Buttons extension CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">


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
        </script>
    @endpush
@endsection
