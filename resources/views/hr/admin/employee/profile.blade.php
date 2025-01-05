@extends('hr.admin.layout.admin_template')
@section('main')
    {{-- <div class="content kanban-deals-content"> --}}
    <nav class="mb-3 crm-deals-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#!">Employee</a></li>
            <li class="breadcrumb-item"><a href="#!">Profile</a></li>
            <li class="breadcrumb-item active">{{ $employee_data?->full_name }}</li>
        </ol>
    </nav>
    <div>
        <div class="px-4 px-lg-6">
            <h2 class="mb-5">Profile Detail</h2>
        </div>
        <div class="px-4 px-lg-6 scrollbar">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 row-cols-xxl-3 g-3 mb-9">

                {{-- // Personal Infromation --}}
                {{-- // start of card --}}
                <div class="">
                    <div class="scrollbar deals-items-container">
                        <div class="">
                            <div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <a class="dropdown-indicator-icon text-body-tertiary position-absolute top-0 end-0 mt-4 me-4"
                                            href="#collapseWidthDeals-1" role="button" data-bs-toggle="collapse"
                                            aria-expanded="false" aria-controls="collapseWidthDeals-1"><span
                                                class="fa-solid fa-angle-down"></span></a>
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex"><span class="me-2" data-feather="user"
                                                    style="stroke-width:2;"></span>
                                                <p class="mb-0 fs-9 fw-semibold text-body-tertiary date">Personal<span
                                                        class="text-body-quaternary"> Information</span></p>
                                            </div>
                                        </div>
                                        <div class="deals-items-head d-flex align-items-center mb-2"><a
                                                class="text-primary fw-bold line-clamp-1 me-3 mb-0 fs-7"
                                                href="#">{{ $employee_data?->full_name }}</a>
                                            <p class="deals-category fs-10 mb-0 mt-1 d-none"><span
                                                    class="me-1 text-body-quaternary" data-feather="grid"
                                                    style="stroke-width:2; height: 12px; width: 12px"></span>Financial</p>
                                            <p class="ms-auto fs-9 text-body-emphasis fw-semibold mb-0 deals-revenue">
                                                {{ $employee_data?->employee_number }}
                                            </p>
                                        </div>
                                        <div class="deals-company-agent d-flex flex-between-center">
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-envelope me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                    {{ $employee_data?->work_email_address }}
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-hard-hat me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                    {{ $employee_data?->designation->name }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseWidthDeals-1">
                                            <!-- <div class="d-flex gap-2 mb-5"><span
                                                    class="badge badge-phoenix badge-phoenix-info">new</span><span
                                                    class="badge badge-phoenix badge-phoenix-danger">Urgent</span>
                                            </div> -->
                                            <div class="table-responsive">
                                                <table class="mb-4 w-100 table-stats table-stats">
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="hash"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Employee
                                                                    Number</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ $employee_data?->employee_number }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="mail"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Email
                                                                    Address
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis d-flex align-items-center gap-2">
                                                                {{ $employee_data?->work_email_address }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="phone"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Phone
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis d-flex align-items-center gap-2">
                                                                {{ $employee_data?->phone_number }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary" data-feather="x"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Gender
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis d-flex align-items-center gap-2">
                                                                {{ $employee_data?->genders->title }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="calendar"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Date of
                                                                    Birth</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ format_date($employee_data?->date_of_birth) }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="user-plus"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Reporting
                                                                    To</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ $employee_data?->managers?->full_name }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="calendar"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Contract
                                                                    Start</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ format_date($employee_data?->contract_start_date) }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="calendar"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Contract
                                                                    End</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ format_date($employee_data?->contract_end_date) }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="dollar-sign"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Net
                                                                    Salary
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ $employee_data?->salaries?->net_salary }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            {{-- <p class="fs-9 mb-1"> Probability:</p> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- // end of card --}}

                {{-- // Address information --}}
                {{-- // start of card --}}
                <div class="">
                    <div class="scrollbar deals-items-container">
                        <div class="">
                            <div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <a class="dropdown-indicator-icon text-body-tertiary position-absolute top-0 end-0 mt-4 me-4"
                                            href="#collapseWidthDeals-2" role="button" data-bs-toggle="collapse"
                                            aria-expanded="false" aria-controls="collapseWidthDeals-2"><span
                                                class="fa-solid fa-angle-down"></span></a>
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex"><span class="me-2" data-feather="user"
                                                    style="stroke-width:2;"></span>
                                                <p class="mb-0 fs-9 fw-semibold text-body-tertiary date">Address<span
                                                        class="text-body-quaternary"> Information</span></p>
                                            </div>
                                        </div>

                                        @foreach ($employee_data->addresses as $key => $item)
                                            @if ($item->primary_address == 'Y')
                                                <div class="deals-items-head d-flex align-items-center mb-2"><a
                                                        class="text-primary fw-bold line-clamp-1 me-3 mb-0 fs-7"
                                                        href="#">{{ $item->country?->country_name }}</a>
                                                    <p class="deals-category fs-10 mb-0 mt-1 d-none"><span
                                                            class="me-1 text-body-quaternary" data-feather="grid"
                                                            style="stroke-width:2; height: 12px; width: 12px"></span>Detail
                                                    </p>
                                                    <p
                                                        class="ms-auto fs-9 text-body-emphasis fw-semibold mb-0 deals-revenue">
                                                        {{ $item->address_types?->title }}
                                                    </p>
                                                </div>
                                                <div class="deals-company-agent d-flex flex-between-center">
                                                    <div class="d-flex align-items-center"><span
                                                            class="uil uil-envelope me-2"></span>
                                                        <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                            {{ $item->city }}
                                                        </p>
                                                    </div>
                                                    <div class="d-flex align-items-center"><span
                                                            class="uil uil-hard-hat me-2"></span>
                                                        <p class="text-body-secondary fw-bold fs-9 mb-0"></p>
                                                    </div>
                                                </div>
                                                <div class="collapse" id="collapseWidthDeals-2">
                                                    <!-- <div class="d-flex gap-2 mb-5"><span
                                                    class="badge badge-phoenix badge-phoenix-info">new</span><span
                                                    class="badge badge-phoenix badge-phoenix-danger">Urgent</span>
                                            </div> -->
                                                    <div class="table-responsive">
                                                        <table class="mb-4 w-100 table-stats table-stats">
                                                            <tr>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Type</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->address_types?->title }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Address 1
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis d-flex align-items-center gap-2">
                                                                        {{ $item->address1 }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Address 2
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis d-flex align-items-center gap-2">
                                                                        {{ $item->address2 }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            City
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis d-flex align-items-center gap-2">
                                                                        {{ $item->city }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            State</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->state }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Zipcode</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->zipcode }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Country</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->country?->country_name }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    {{-- <p class="fs-9 mb-1"> Probability:</p> --}}

                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- // end of card --}}

                {{-- // Bank Information                --}}
                {{-- // start of card --}}
                <div class="">
                    <div class="scrollbar deals-items-container">
                        <div class="">
                            <div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <a class="dropdown-indicator-icon text-body-tertiary position-absolute top-0 end-0 mt-4 me-4"
                                            href="#collapseWidthDeals-3" role="button" data-bs-toggle="collapse"
                                            aria-expanded="false" aria-controls="collapseWidthDeals-1"><span
                                                class="fa-solid fa-angle-down"></span></a>
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex"><span class="me-2" data-feather="bookmark"
                                                    style="stroke-width:2;"></span>
                                                <p class="mb-0 fs-9 fw-semibold text-body-tertiary date">Bank<span
                                                        class="text-body-quaternary"> Information</span></p>
                                            </div>
                                        </div>
                                        <div class="deals-items-head d-flex align-items-center mb-2"><a
                                                class="text-primary fw-bold line-clamp-1 me-3 mb-0 fs-7"
                                                href="#">{{ $employee_data->banks?->bank_branch_name }}</a>
                                            <p class="deals-category fs-10 mb-0 mt-1 d-none"><span
                                                    class="me-1 text-body-quaternary" data-feather="grid"
                                                    style="stroke-width:2; height: 12px; width: 12px"></span>Financial</p>
                                            <p class="ms-auto fs-9 text-body-emphasis fw-semibold mb-0 deals-revenue">
                                                {{ $employee_data->banks?->bank_account_name }}
                                            </p>
                                        </div>
                                        <div class="deals-company-agent d-flex flex-between-center">
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-envelope me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                    {{ $employee_data?->work_email_address }}
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-hard-hat me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                    {{ $employee_data?->designation->name }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseWidthDeals-3">
                                            <!-- <div class="d-flex gap-2 mb-5"><span
                                                    class="badge badge-phoenix badge-phoenix-info">new</span><span
                                                    class="badge badge-phoenix badge-phoenix-danger">Urgent</span>
                                            </div> -->
                                            <div class="table-responsive">
                                                <table class="mb-4 w-100 table-stats table-stats">
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Branch Name</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ $employee_data->banks?->bank_branch_name }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Account
                                                                    Name
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis d-flex align-items-center gap-2">
                                                                {{ $employee_data->banks?->bank_account_name }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">IBAN
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis d-flex align-items-center gap-2">
                                                                {{ $employee_data->banks?->iban }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">SWIFT
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis d-flex align-items-center gap-2">
                                                                {{ $employee_data->banks?->swift_code }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            {{-- <p class="fs-9 mb-1"> Probability:</p> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- // end of card --}}

                {{-- // Emergency Contact --}}
                {{-- // start of card --}}
                <div class="">
                    <div class="scrollbar deals-items-container">
                        <div class="">
                            <div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <a class="dropdown-indicator-icon text-body-tertiary position-absolute top-0 end-0 mt-4 me-4"
                                            href="#collapseWidthDeals-5" role="button" data-bs-toggle="collapse"
                                            aria-expanded="false" aria-controls="collapseWidthDeals-5"><span
                                                class="fa-solid fa-angle-down"></span></a>
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex"><span class="me-2" data-feather="users"
                                                    style="stroke-width:2;"></span>
                                                <p class="mb-0 fs-9 fw-semibold text-body-tertiary date">Emergency<span
                                                        class="text-body-quaternary"> Contacts</span></p>
                                            </div>
                                        </div>

                                        <div class="deals-items-head d-flex align-items-center mb-2"><a
                                                class="text-primary fw-bold line-clamp-1 me-3 mb-0 fs-7"
                                                href="#">Contacts
                                                <span>({{ $employee_data->emergency_contacts?->count() }})</span></a>
                                            <p class="deals-category fs-10 mb-0 mt-1 d-none"><span
                                                    class="me-1 text-body-quaternary" data-feather="grid"
                                                    style="stroke-width:2; height: 12px; width: 12px"></span>Detail
                                            </p>
                                            <p class="ms-auto fs-9 text-body-emphasis fw-semibold mb-0 deals-revenue">

                                            </p>
                                        </div>
                                        <div class="deals-company-agent d-flex flex-between-center">
                                            <div class="d-flex align-items-center">
                                                <!-- <span class="uil uil-stopwatch me-2"></span> -->
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">

                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-hard-hat me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0"></p>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseWidthDeals-5">
                                            <div class="border-top border-bottom border-translucent"
                                                id="customerOrdersTable"
                                                data-list='{"valueNames":["name","relationship","contact_number","workded","leaves","unpaid"],"page":6,"pagination":true}'>
                                                <div class="table-responsive scrollbar">
                                                    <table class="table table-sm fs-9 mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th class="sort white-space-nowrap align-middle ps-0 pe-3"
                                                                    scope="col" data-sort="name" style="width:10%;">
                                                                    NAME</th>
                                                                <th class="sort align-middle text-end pe-7" scope="col"
                                                                    data-sort="relationship" style="width:10%;">
                                                                    RELATIONSHIP</th>
                                                                <th class="sort align-middle white-space-nowrap pe-3"
                                                                    scope="col" data-sort="contact_number"
                                                                    style="width:15%;">CONTACTS</th>
                                                                <!-- <th class="sort text-end align-middle pe-0 ps-5" scope="col"></th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody class="list" id="customer-order-table-body">

                                                            @foreach ($employee_data->emergency_contacts as $key => $item)
                                                                <tr
                                                                    class="hover-actions-trigger btn-reveal-trigger position-static">
                                                                    <td class="name align-middle white-space-nowrap ps-0">
                                                                        <a class="fw-semibold"
                                                                            href="#!">{{ $item->first_name }}
                                                                            {{ $item->last_name }}</a></td>
                                                                    <td
                                                                        class="relationship align-middle text-end fw-semibold pe-7 text-body-highlight">
                                                                        {{ $item->relationships->title }}</td>
                                                                    <td
                                                                        class="contact_number align-middle text-end fw-semibold pe-7 text-body-highlight">
                                                                        {{ $item->contact_number }}</td>

                                                                    <!-- <td class="align-middle white-space-nowrap text-end pe-0 ps-5">
                                                                    <div class="btn-reveal-trigger position-static">
                                                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                                                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                                                        </div>
                                                                    </div>
                                                                </td> -->
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                                                    <div class="col-auto d-flex">
                                                        <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body"
                                                            data-list-info="data-list-info"></p><a class="fw-semibold"
                                                            href="#!" data-list-view="*">View all<span
                                                                class="fas fa-angle-right ms-1"
                                                                data-fa-transform="down-1"></span></a><a
                                                            class="fw-semibold d-none" href="#!"
                                                            data-list-view="less">View Less<span
                                                                class="fas fa-angle-right ms-1"
                                                                data-fa-transform="down-1"></span></a>
                                                    </div>
                                                    <div class="col-auto d-flex">
                                                        <button class="page-link" data-list-pagination="prev"><span
                                                                class="fas fa-chevron-left"></span></button>
                                                        <ul class="mb-0 pagination"></ul>
                                                        <button class="page-link pe-0" data-list-pagination="next"><span
                                                                class="fas fa-chevron-right"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- // end of card --}}

                {{-- // Timesheets --}}
                {{-- // start of card --}}
                <div class="">
                    <div class="scrollbar deals-items-container">
                        <div class="">
                            <div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <a class="dropdown-indicator-icon text-body-tertiary position-absolute top-0 end-0 mt-4 me-4"
                                            href="#collapseWidthDeals-6" role="button" data-bs-toggle="collapse"
                                            aria-expanded="false" aria-controls="collapseWidthDeals-6"><span
                                                class="fa-solid fa-angle-down"></span></a>
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex"><span class="me-2" data-feather="clock"
                                                    style="stroke-width:2;"></span>
                                                <p class="mb-0 fs-9 fw-semibold text-body-tertiary date">Timesheet<span
                                                        class="text-body-quaternary"> Information</span></p>
                                            </div>
                                        </div>

                                        <div class="deals-items-head d-flex align-items-center mb-2"><a
                                                class="text-primary fw-bold line-clamp-1 me-3 mb-0 fs-7"
                                                href="#">Timesheets
                                                <span>({{ $employee_data->timesheets?->count() }})</span></a>
                                            <p class="deals-category fs-10 mb-0 mt-1 d-none"><span
                                                    class="me-1 text-body-quaternary" data-feather="grid"
                                                    style="stroke-width:2; height: 12px; width: 12px"></span>Detail
                                            </p>
                                            <p class="ms-auto fs-9 text-body-emphasis fw-semibold mb-0 deals-revenue">

                                            </p>
                                        </div>
                                        <div class="deals-company-agent d-flex flex-between-center">
                                            <div class="d-flex align-items-center">
                                                <!-- <span class="uil uil-hard-hat me-2"></span> -->
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">

                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-hard-hat me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0"></p>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseWidthDeals-6">
                                            <div class="border-top border-bottom border-translucent"
                                                id="customerOrdersTable"
                                                data-list='{"valueNames":["month","payment","timesheet_status","workded","leaves","unpaid"],"page":6,"pagination":true}'>
                                                <div class="table-responsive scrollbar">
                                                    <table class="table table-sm fs-9 mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th class="sort white-space-nowrap align-middle ps-0 pe-3"
                                                                    scope="col" data-sort="month" style="width:10%;">
                                                                    MONTH</th>
                                                                <th class="sort align-middle text-end pe-7" scope="col"
                                                                    data-sort="payment" style="width:10%;">PAYMENT</th>
                                                                <th class="sort align-middle white-space-nowrap pe-3"
                                                                    scope="col" data-sort="timesheet_status"
                                                                    style="width:15%;">STATUS</th>
                                                                <th class="sort align-middle white-space-nowrap text-start pe-3"
                                                                    scope="col" data-sort="workded"
                                                                    style="width:10%;">WORKED</th>
                                                                <th class="sort align-middle white-space-nowrap text-start pe-3"
                                                                    scope="col" data-sort="leaves" style="width:10%;">
                                                                    LEAVES</th>
                                                                <th class="sort align-middle white-space-nowrap text-start pe-3"
                                                                    scope="col" data-sort="unpaid" style="width:10%;">
                                                                    UNPAID</th>

                                                                {{-- <th class="sort text-end align-middle pe-0 ps-5" scope="col"></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody class="list" id="customer-order-table-body">

                                                            @foreach ($employee_data->timesheets as $key => $item)
                                                                @php
                                                                    $entries_count = $item->entries->count();
                                                                @endphp

                                                                @if ($entries_count)
                                                                    @php
                                                                        $status =
                                                                            '<span class="badge badge-phoenix fs--2 badge-phoenix-' .
                                                                            $item->leave_statuses->color .
                                                                            ' " style="cursor: not-allowed;"><span class="badge-label">' .
                                                                            $item->leave_statuses->title .
                                                                            '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: not-allowed;"></span></span>';
                                                                        $status =
                                                                            '<td class="timesheet_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary"><span class="badge badge-phoenix fs-10 badge-phoenix-' .
                                                                            $item->leave_statuses?->color .
                                                                            '"><span class="badge-label">' .
                                                                            $item->leave_statuses?->title .
                                                                            '</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>';

                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $status =
                                                                            '<span class="badge badge-phoenix fs--2 badge-phoenix-secondary" style="cursor: not-allowed;"><span class="badge-label">' .
                                                                            'Incomplete</span><span class="ms-1 fa-regular fa-circle-xmark text-danger" style="height:12.8px;width:12.8px;cursor: not-allowed;"></span></span>';
                                                                        $status =
                                                                            '<td class="timesheet_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary"><span class="badge badge-phoenix fs-10 badge-phoenix-secondary" style="cursor: not-allowed;"><span class="badge-label">Incomplete</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;cursor: not-allowed;"></span></span></td>';

                                                                    @endphp
                                                                @endif

                                                                <tr
                                                                    class="hover-actions-trigger btn-reveal-trigger position-static">
                                                                    <td class="month align-middle white-space-nowrap ps-0">
                                                                        <a class="fw-semibold"
                                                                            href="#!">{{ $item->timesheet_period }}</a>
                                                                    </td>
                                                                    <td
                                                                        class="payment align-middle text-end fw-semibold pe-7 text-body-highlight">
                                                                        {{ $item->total_payments }}</td>
                                                                    {!! $status !!}
                                                                    <td
                                                                        class="workded align-middle text-end fw-semibold pe-7 text-body-highlight">
                                                                        {{ $item->days_worked }}</td>
                                                                    <td
                                                                        class="leaves align-middle text-end fw-semibold pe-7 text-body-highlight">
                                                                        {{ $item->leave_taken }}</td>
                                                                    <td
                                                                        class="unpaid align-middle text-end fw-semibold pe-7 text-body-highlight">
                                                                        {{ $item->unpaid_leave_taken }}</td>
                                                                    {{-- <td class="align-middle white-space-nowrap text-end pe-0 ps-5">
                                                                <div class="btn-reveal-trigger position-static">
                                                                    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                                                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </td> --}}
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                                                    <div class="col-auto d-flex">
                                                        <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body"
                                                            data-list-info="data-list-info"></p><a class="fw-semibold"
                                                            href="#!" data-list-view="*">View all<span
                                                                class="fas fa-angle-right ms-1"
                                                                data-fa-transform="down-1"></span></a><a
                                                            class="fw-semibold d-none" href="#!"
                                                            data-list-view="less">View Less<span
                                                                class="fas fa-angle-right ms-1"
                                                                data-fa-transform="down-1"></span></a>
                                                    </div>
                                                    <div class="col-auto d-flex">
                                                        <button class="page-link" data-list-pagination="prev"><span
                                                                class="fas fa-chevron-left"></span></button>
                                                        <ul class="mb-0 pagination"></ul>
                                                        <button class="page-link pe-0" data-list-pagination="next"><span
                                                                class="fas fa-chevron-right"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- // end of card --}}

            </div>
        </div>

        {{-- big card --}}
        <div class="px-4 px-lg-6">
            <h2 class="mb-5">Projects/Tasks Detail</h2>
        </div>
        <div class="px-4 px-lg-6 scrollbar">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-2 row-cols-xxl-1 g-2 mb-9">

                {{-- // Projects --}}
                {{-- // start of card --}}
                <div class="">
                    <div class="scrollbar deals-items-container">
                        <div class="">
                            <div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <a class="dropdown-indicator-icon text-body-tertiary position-absolute top-0 end-0 mt-4 me-4"
                                            href="#collapseProjects" role="button" data-bs-toggle="collapse"
                                            aria-expanded="false" aria-controls="collapseProjects"><span
                                                class="fa-solid fa-angle-down"></span></a>
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex"><span class="me-2" data-feather="clock"
                                                    style="stroke-width:2;"></span>
                                                <p class="mb-0 fs-9 fw-semibold text-body-tertiary date">Project<span
                                                        class="text-body-quaternary"> Information</span></p>
                                            </div>
                                        </div>

                                        <div class="deals-items-head d-flex align-items-center mb-2"><a
                                                class="text-primary fw-bold line-clamp-1 me-3 mb-0 fs-7"
                                                href="#">Projects
                                                <span>({{ $employee_data->projects?->count() }})</span></a>
                                            <p class="deals-category fs-10 mb-0 mt-1 d-none"><span
                                                    class="me-1 text-body-quaternary" data-feather="grid"
                                                    style="stroke-width:2; height: 12px; width: 12px"></span>Detail
                                            </p>
                                            <p class="ms-auto fs-9 text-body-emphasis fw-semibold mb-0 deals-revenue">

                                            </p>
                                        </div>
                                        <div class="deals-company-agent d-flex flex-between-center">
                                            <div class="d-flex align-items-center">
                                                <!-- <span class="uil uil-hard-hat me-2"></span> -->
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">

                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-hard-hat me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0"></p>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseProjects">
                                            <div class="employee-address">

                                                <x-admin-employee-projects-card :empId='$employee_data->id'
                                                    :projectCount='$employee_data->projects?->count()'></x-admin-employee-projects-card>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- // end of card --}}

                                {{-- // Tasks --}}
                {{-- // start of card --}}
                <div class="">
                    <div class="scrollbar deals-items-container">
                        <div class="">
                            <div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <a class="dropdown-indicator-icon text-body-tertiary position-absolute top-0 end-0 mt-4 me-4"
                                            href="#collapseTasks" role="button" data-bs-toggle="collapse"
                                            aria-expanded="false" aria-controls="collapseTasks"><span
                                                class="fa-solid fa-angle-down"></span></a>
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex"><span class="me-2" data-feather="clock"
                                                    style="stroke-width:2;"></span>
                                                <p class="mb-0 fs-9 fw-semibold text-body-tertiary date">Task<span
                                                        class="text-body-quaternary"> Information</span></p>
                                            </div>
                                        </div>

                                        <div class="deals-items-head d-flex align-items-center mb-2"><a
                                                class="text-primary fw-bold line-clamp-1 me-3 mb-0 fs-7"
                                                href="#">Tasks
                                                <span>({{ $employee_data->tasks?->count() }})</span></a>
                                            <p class="deals-category fs-10 mb-0 mt-1 d-none"><span
                                                    class="me-1 text-body-quaternary" data-feather="grid"
                                                    style="stroke-width:2; height: 12px; width: 12px"></span>Detail
                                            </p>
                                            <p class="ms-auto fs-9 text-body-emphasis fw-semibold mb-0 deals-revenue">

                                            </p>
                                        </div>
                                        <div class="deals-company-agent d-flex flex-between-center">
                                            <div class="d-flex align-items-center">
                                                <!-- <span class="uil uil-hard-hat me-2"></span> -->
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">

                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-hard-hat me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0"></p>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseTasks">
                                            <div class="employee-address">

                                                <x-admin-employee-tasks-card :empId='$employee_data->id'
                                                    :projectCount='$employee_data->projects?->count()'></x-admin-employee-projects-card>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- // end of card --}}

            </div>
        </div>

    </div>

    <script src="{{ asset('assets/js/pages/project/admin/projects.js') }}"></script>
@endsection

@push('script')
@endpush
