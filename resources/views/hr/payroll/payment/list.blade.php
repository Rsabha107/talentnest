@extends('hr.emp.layout.emp_template')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<div class="content">
    <div class="container-fluid">
        <div class="mb-2">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}"><?= get_label('home', 'Home') ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= get_label('employees', 'Employees') ?>
                        </li>

                    </ol>
                </nav>
            </div>
            <div class="d-flex justify-content-center">
                <div id="cover-spin" style="display:none;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">Payment File</h2>
            </div>
        </div>
        <div class="mb-4 mt-4">
            <div class="d-flex flex-wrap gap-3">
                <!-- <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search products" aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>

                    </form>
                </div> -->
                <div class="col-md-2">
                    <select class="form-select select-appearance" id="timesheet_period_filter" aria-label="Default select example">
                        <option value="" selected><?= get_label('select_timesheet_period', 'Select month') ?></option>
                        @foreach ($timesheet_periods as $employee_timesheet)
                        <option value="{{$employee_timesheet->timesheet_period}}">{{$employee_timesheet->timesheet_period}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="ms-xxl-auto">

                </div>
            </div>
        </div>
        <x-payroll-payment-list-card />
    </div>

    <script src="{{asset('assets/js/pages/payroll_payment.js')}}"></script>

    @endsection

    @push('script')


    @endpush
