@extends('admin.admin_dashboard')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->



    <div class="container-fluid">
        <!-- <div class="d-flex justify-content-between mb-2 mt-4"> -->
        <!-- <div class="d-flex justify-content-center m-2"> -->
        <div class="mb-2">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="{{route('tracki.employee.dashboard')}}"><?= get_label('home', 'Home') ?></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('tracki.employee.letter.generate')}}">
                                <?= get_label('generate', 'Generate') ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= get_label('letter', 'Letter') ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div id="cover-spin" style="display:none;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">Generate</h2>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="card border border-primary mb-3">
                    <div class="card-body">
                        <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_letter_form" novalidate="" action="{{ route ('tracki.employee.letter.generate.store') }}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <select class="form-select" id="letter_type" name="letter_type" aria-label="Default select example" required>
                                    <option value="" selected><?= get_label('select_leave_type', 'Select letter') ?></option>
                                    @foreach ($letters as $key)
                                    <option value="{{$key->id}}">{{$key->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" id="template_employee_id" name="employee_id" aria-label="Default select example" required>
                                    <option value="" selected><?= get_label('select_leave_type', 'Select leave type') ?></option>
                                    @foreach ($employees as $key)
                                    <option value="{{$key->id}}">{{$key->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <textarea class="tinymce" id="content" data-tinymce="{}"></textarea>
                                <textarea name="content" id="content_text" class='d-none' ></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                        </form>
                    </div>
                </div>
                <div class="card border border-primary">
                    <div class="card-body">
                        <div class="row p-20">
                            <div class="col-12">
                                <h4 class="pl-2 mb-2 f-18 font-weight-normal text-capitalize">
                                    Available Variables : </h4>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-current_date">
                                        <i class="fa fa-copy"></i></span> <span id="letter-variable-current_date">##CURRENT_DATE##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-employee_id">
                                        <i class="fa fa-copy"></i></span>
                                    <span id="letter-variable-employee_id">##EMPLOYEE_ID##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-employee_name">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-employee_name">##EMPLOYEE_NAME##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-employee_address">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-employee_address">##EMPLOYEE_ADDRESS##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-employee_joining_date">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-employee_joining_date">##EMPLOYEE_JOINING_DATE##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-employee_exit_date">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-employee_exit_date">##EMPLOYEE_EXIT_DATE##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-employee_probation_end_date">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-employee_probation_end_date">##EMPLOYEE_PROBATION_END_DATE##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-employee_notice_period_start_date">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-employee_notice_period_start_date">##EMPLOYEE_NOTICE_PERIOD_START_DATE##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-employee_notice_period_end_date">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-employee_notice_period_end_date">##EMPLOYEE_NOTICE_PERIOD_END_DATE##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-employee_dob">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-employee_dob">##EMPLOYEE_DOB##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-employee_department">
                                        <i class="fa fa-copy"></i></span>
                                    <span id="letter-variable-employee_department">##EMPLOYEE_DEPARTMENT##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-employee_designation">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-employee_designation">##EMPLOYEE_DESIGNATION##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-signatory">
                                        <i class="fa fa-copy"></i></span>
                                    <span id="letter-variable-signatory">##SIGNATORY##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-signatory_designation">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-signatory_designation">##SIGNATORY_DESIGNATION##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-signatory_department">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-signatory_department">##SIGNATORY_DEPARTMENT##</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                                    <span role="button" class="btn-copy rounded" data-toggle="tooltip" data-original-title="Click to copy" data-clipboard-target="#letter-variable-company_name">
                                        <i class="fa fa-copy"></i></span><span id="letter-variable-company_name">##COMPANY_NAME##</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="card border border-secondary">
                    <div class="card-body">
                        <h4 class="card-title">Preview Letter </h4>
                        <div id="preview_letter"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="{{asset('assets/js/pages/employees_letter_generate.js')}}"></script> -->

    @endsection

    @push('script')

    <script src="{{asset('assets/js/pages/employees_letter_generate.js')}}"></script>
    

    @endpush