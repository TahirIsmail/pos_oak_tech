@extends('layouts.layout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container-fluid">
        <div class="row justify-content-center card">
            <div class="">
                <div class="card-header">
                    <h5>{{ __('Selection Form') }}</h5>
                </div>
            </div>
            <div class="mt-5 p-4">

                <form>
                    <div class="row row_data">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="position" class="form-label">Position Applied For</label>
                                <input type="text" class="form-control" id="position" name="position"
                                    placeholder="Enter position">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 ml-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter name">
                            </div>
                        </div>
                    </div>

                    <div class="section-title">Relative Experience</div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="experience" id="experienceGood" value="good">
                        <label class="form-check-label" for="experienceGood">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="experience" id="experienceFair" value="fair">
                        <label class="form-check-label" for="experienceFair">No</label>
                    </div>

                    <div class="section-title">Interpersonal Skills/Personality</div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="personality" id="personalityGood"
                            value="good">
                        <label class="form-check-label" for="personalityGood">Good</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="personality" id="personalityFair"
                            value="fair">
                        <label class="form-check-label" for="personalityFair">Fair</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="personality" id="personalityPoor"
                            value="poor">
                        <label class="form-check-label" for="personalityPoor">Poor</label>
                    </div>

                    <div class="section-title">Job Stability</div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jobStability" id="jobStabilityYes"
                            value="yes">
                        <label class="form-check-label" for="jobStabilityYes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jobStability" id="jobStabilityNo"
                            value="no">
                        <label class="form-check-label" for="jobStabilityNo">No</label>
                    </div>

                    <div class="section-title">Willing to join / Needy</div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="willingness" id="willingnessHigh"
                            value="high">
                        <label class="form-check-label" for="willingnessHigh">High</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="willingness" id="willingnessMedium"
                            value="medium">
                        <label class="form-check-label" for="willingnessMedium">Medium</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="willingness" id="willingnessLow"
                            value="low">
                        <label class="form-check-label" for="willingnessLow">Low</label>
                    </div>

                    <div class="section-title">Family Background</div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="familyBackground" id="familyBackgroundGood"
                            value="yes">
                        <label class="form-check-label" for="familyBackgroundGood">Good</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="familyBackground" id="familyBackgroundFair"
                            value="no">
                        <label class="form-check-label" for="familyBackgroundFair">Fair</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="familyBackground" id="familyBackgroundPoor"
                            value="no">
                        <label class="form-check-label" for="familyBackgroundPoor">Poor</label>
                    </div>

                    <div class="section-title">Conveyance</div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="conveyance" id="conveyanceYes"
                            value="yes">
                        <label class="form-check-label" for="conveyanceYes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="conveyance" id="conveyanceNo"
                            value="no">
                        <label class="form-check-label" for="conveyanceNo">No</label>
                    </div>

                    <div class="section-title">Application / NIC / Photograph / Document Attached</div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="documentAttached" id="documentAttachedYes"
                            value="a">
                        <label class="form-check-label" for="documentAttachedYes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="documentAttached" id="documentAttachedNo"
                            value="b">
                        <label class="form-check-label" for="documentAttachedNo">No</label>
                    </div>

                    <div class="section-title">Grading</div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="grading" id="gradingA" value="gradingA">
                        <label class="form-check-label" for="gradingA">A</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="grading" id="gradingB" value="gradingB">
                        <label class="form-check-label" for="gradingB">B</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="grading" id="gradingC" value="gradingC">
                        <label class="form-check-label" for="gradingC">C</label>
                    </div>

                    <div class="section-title">Last Salary</div>
                    <input type="number" class="form-control" id="lastSalary" name="lastSalary"
                        placeholder="Enter last salary">

                    <div class="row row_data">
                        <div class="col-md-6">
                            <div class="section-title">Salary Agreed</div>
                            <input type="number" class="form-control" id="salaryAgreed" name="salaryAgreed"
                                placeholder="Enter agreed salary">
                        </div>
                        <div class="col-md-6">
                            <div class="section-title">Expected Salary</div>
                            <input type="number" class="form-control" id="ExpectedAgreed" name="ExpectedAgreed"
                                placeholder="Enter expected salary">
                        </div>
                    </div>

                    <div class="section-title">Interview Taken and Recommended</div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="interviewTaken" id="interviewTakenHigh"
                            value="high">
                        <label class="form-check-label" for="interviewTakenHigh">High</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="interviewTaken" id="interviewTakenMedium"
                            value="medium">
                        <label class="form-check-label" for="interviewTakenMedium">Medium</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="interviewTaken" id="interviewTakenLow"
                            value="low">
                        <label class="form-check-label" for="interviewTakenLow">Low</label>
                    </div>

                    <div class="center-text section-title">For Office Use Only</div>
                    <div class="row row-2-cols">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="approval" class="form-label">Approved By</label>
                                <input type="text" class="form-control" id="approval" name="approval"
                                    placeholder="Enter approver name">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="salary" class="form-label">Salary Rs.</label>
                                <input type="number" class="form-control" id="salary" name="salary"
                                    placeholder="Enter salary">
                            </div>
                        </div>
                    </div>

                    <div class="row row-2-cols">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="joiningDate" class="form-label">Joining Date</label>
                                <input type="date" class="form-control" id="joiningDate" name="joiningDate">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="probationPeriod" class="form-label">Probationary Period</label>
                                <input type="text" class="form-control" id="probationPeriod" name="probationPeriod"
                                    placeholder="Enter probation period">
                            </div>
                        </div>
                    </div>

                    <div class="row row-2-cols">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="incrementProbation" class="form-label">Increment on Probation</label>
                                <input type="text" class="form-control" id="incrementProbation"
                                    name="incrementProbation" placeholder="Enter increment details">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>


            </div>



        </div>
    @endsection


    @push('scripts')
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/datatable.js') }}"></script>


        <script>
            $(document).ready(function() {
                $('form').on('submit', function(e) {
                    e.preventDefault();

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Gather form data
                    var formData = new FormData(this);
                    formData.append("access_token", window.settings.access_token);

                    // Clear previous error messages
                    $('.alert-danger').remove();

                    $.ajax({
                        url: "{{ route('submit.interview') }}", // The URL to your Laravel route
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the header
                        },
                        success: function(response) {
                            if (response.success) {
                                alert("Form submitted successfully!");
                                $('form')[0].reset(); // Reset the form
                            } else {
                                alert("Something went wrong. Please try again.");
                            }
                        },
                        error: function(xhr, status, error) {
                            // Check if the response contains validation errors
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                var errors = xhr.responseJSON.errors;
                                var errorMessages = '<div class="alert alert-danger"><ul>';

                                // Iterate through the errors and display them
                                for (var field in errors) {
                                    errors[field].forEach(function(message) {
                                        errorMessages += '<li>' + message + '</li>';
                                    });
                                }

                                errorMessages += '</ul></div>';

                                // Display the error messages at the top of the form
                                $('form').before(errorMessages);
                                $('html, body').animate({ scrollTop: 0 }, 'slow');
                            } else {
                                alert("Error: " + xhr.responseText);
                            }
                        }
                    });
                });
            });
        </script>
    @endpush

    <style scoped>
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 40px auto;
        }

        h3 {
            text-align: center;
            margin-bottom: 30px;

            font-weight: bold;
        }

        .section-title {
            margin-bottom: 10px;
            font-weight: bold;
            margin-top: 25px;
            font-size: 18px;
            color: #333;
            padding-bottom: 8px;
            border-bottom: 2px solid #f4f4f4;
        }

        .form-check-label {
            margin-left: 10px;
            color: #555;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 18px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-submit {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 12px;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .d-flex-end {
            display: flex;
            justify-content: flex-end;
        }

        .row-2-cols {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .row-2-cols .col-md-5 {
            width: 48%;
        }

        .center-text {
            text-align: center;
        }

        .form-check {
            margin-bottom: 12px;
        }

        .form-check-input {
            margin-top: 0.3em;
        }

        .row_data {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .ml-3 {
            margin-left: 10px;
        }
    </style>
