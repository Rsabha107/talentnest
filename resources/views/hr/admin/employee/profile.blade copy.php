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
            <div class="d-xl-flex justify-content-between">
                <div class="mb-3">
                    <button class="btn btn-primary me-4" type="button" data-bs-toggle="modal"
                        data-bs-target="#addDealModal" aria-haspopup="true" aria-expanded="false"
                        data-bs-reference="parent"><span class="fas fa-plus me-2"></span>Add Deal</button>
                    <button class="btn btn-link text-body px-0"><span
                            class="fa-solid fa-file-export fs-9 me-2"></span>Export</button>
                </div>
                <div class="d-flex mb-4">
                    <div class="search-box">
                        <form class="position-relative">
                            <input class="form-control search-input search" type="search" placeholder="Search by name"
                                aria-label="Search" />
                            <span class="fas fa-search search-box-icon"></span>

                        </form>
                    </div>
                    <select class="form-select w-auto mx-2" id="select-deals">
                        <option>Deals</option>
                    </select>
                    <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="modal"
                        data-bs-target="#reportsFilterModal" aria-haspopup="true" aria-expanded="false"
                        data-bs-reference="parent"><span class="fa-solid fa-filter text-primary"
                            data-fa-transform="down-3"></span></button>
                </div>
            </div>
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
                                                {{ $employee_data?->employee_number }}</p>
                                        </div>
                                        <div class="deals-company-agent d-flex flex-between-center">
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-envelope me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                    {{ $employee_data?->work_email_address }}</p>
                                            </div>
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-hard-hat me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                    {{ $employee_data?->designation->name }}</p>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseWidthDeals-1">
                                            <div class="d-flex gap-2 mb-5"><span
                                                    class="badge badge-phoenix badge-phoenix-info">new</span><span
                                                    class="badge badge-phoenix badge-phoenix-danger">Urgent</span>
                                            </div>
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
                                                                {{ $employee_data?->employee_number }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary" data-feather="mail"
                                                                    style="width:16px; height:16px"></span>
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
                                                                    class="me-2 text-body-tertiary" data-feather="phone"
                                                                    style="width:16px; height:16px"></span>
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
                                                                    class="me-2 text-body-tertiary" data-feather="x"
                                                                    style="width:16px; height:16px"></span>
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
                                                                    data-feather="calendar"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Date of
                                                                    Birth</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ format_date($employee_data?->date_of_birth) }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="user-plus"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Reporting
                                                                    To</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ $employee_data->managers?->full_name }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="calendar"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Contract
                                                                    Start</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ format_date($employee_data?->contract_start_date) }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="calendar"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Contract
                                                                    End</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ format_date($employee_data?->contract_end_date) }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="dollar-sign"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Net
                                                                    Salary
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ $employee_data->salaries?->net_salary }}</p>
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
                                                        {{ $item->address_types?->title }}</p>
                                                </div>
                                                <div class="deals-company-agent d-flex flex-between-center">
                                                    <div class="d-flex align-items-center"><span
                                                            class="uil uil-envelope me-2"></span>
                                                        <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                            {{ $item->city }}</p>
                                                    </div>
                                                    <div class="d-flex align-items-center"><span
                                                            class="uil uil-hard-hat me-2"></span>
                                                        <p class="text-body-secondary fw-bold fs-9 mb-0"></p>
                                                    </div>
                                                </div>
                                                <div class="collapse" id="collapseWidthDeals-2">
                                                    <div class="d-flex gap-2 mb-5"><span
                                                            class="badge badge-phoenix badge-phoenix-info">new</span><span
                                                            class="badge badge-phoenix badge-phoenix-danger">Urgent</span>
                                                    </div>
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
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Type</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->address_types?->title }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="mail"
                                                                            style="width:16px; height:16px"></span>
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
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="phone"
                                                                            style="width:16px; height:16px"></span>
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
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="x"
                                                                            style="width:16px; height:16px"></span>
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
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="calendar"
                                                                            style="width:16px; height:16px"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            State</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->state }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="user-plus"
                                                                            style="width:16px; height:16px"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Zipcode</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->zipcode }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="calendar"
                                                                            style="width:16px; height:16px"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Country</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->country?->country_name }}</p>
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
                                            <div class="d-flex"><span class="me-2" data-feather="user"
                                                    style="stroke-width:2;"></span>
                                                <p class="mb-0 fs-9 fw-semibold text-body-tertiary date">Bank<span
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
                                                {{ $employee_data?->employee_number }}</p>
                                        </div>
                                        <div class="deals-company-agent d-flex flex-between-center">
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-envelope me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                    {{ $employee_data?->work_email_address }}</p>
                                            </div>
                                            <div class="d-flex align-items-center"><span
                                                    class="uil uil-hard-hat me-2"></span>
                                                <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                    {{ $employee_data?->designation->name }}</p>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseWidthDeals-3">
                                            <div class="d-flex gap-2 mb-5"><span
                                                    class="badge badge-phoenix badge-phoenix-info">new</span><span
                                                    class="badge badge-phoenix badge-phoenix-danger">Urgent</span>
                                            </div>
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
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Employee
                                                                    Number</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ $employee_data?->employee_number }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary" data-feather="mail"
                                                                    style="width:16px; height:16px"></span>
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
                                                                    class="me-2 text-body-tertiary" data-feather="phone"
                                                                    style="width:16px; height:16px"></span>
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
                                                                    class="me-2 text-body-tertiary" data-feather="x"
                                                                    style="width:16px; height:16px"></span>
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
                                                                    data-feather="calendar"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Date of
                                                                    Birth</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ format_date($employee_data?->date_of_birth) }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="user-plus"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Reporting
                                                                    To</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ $employee_data->managers?->full_name }}<< /p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="calendar"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Contract
                                                                    Start</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ format_date($employee_data?->contract_start_date) }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="calendar"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Contract
                                                                    End</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ format_date($employee_data?->contract_end_date) }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="dollar-sign"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Net
                                                                    Salary
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                {{ $employee_data->salaries?->net_salary }}</p>
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
                                            href="#collapseWidthDeals-4" role="button" data-bs-toggle="collapse"
                                            aria-expanded="false" aria-controls="collapseWidthDeals-4"><span
                                                class="fa-solid fa-angle-down"></span></a>
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex"><span class="me-2" data-feather="user"
                                                    style="stroke-width:2;"></span>
                                                <p class="mb-0 fs-9 fw-semibold text-body-tertiary date">Emergency Contact<span
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
                                                        {{ $item->address_types?->title }}</p>
                                                </div>
                                                <div class="deals-company-agent d-flex flex-between-center">
                                                    <div class="d-flex align-items-center"><span
                                                            class="uil uil-envelope me-2"></span>
                                                        <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                            {{ $item->city }}</p>
                                                    </div>
                                                    <div class="d-flex align-items-center"><span
                                                            class="uil uil-hard-hat me-2"></span>
                                                        <p class="text-body-secondary fw-bold fs-9 mb-0"></p>
                                                    </div>
                                                </div>
                                                <div class="collapse" id="collapseWidthDeals-4">
                                                    <div class="d-flex gap-2 mb-5"><span
                                                            class="badge badge-phoenix badge-phoenix-info">new</span><span
                                                            class="badge badge-phoenix badge-phoenix-danger">Urgent</span>
                                                    </div>
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
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Type</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->address_types?->title }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="mail"
                                                                            style="width:16px; height:16px"></span>
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
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="phone"
                                                                            style="width:16px; height:16px"></span>
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
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="x"
                                                                            style="width:16px; height:16px"></span>
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
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="calendar"
                                                                            style="width:16px; height:16px"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            State</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->state }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="user-plus"
                                                                            style="width:16px; height:16px"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Zipcode</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->zipcode }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="calendar"
                                                                            style="width:16px; height:16px"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Country</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->country?->country_name }}</p>
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

                {{-- // Timesheets --}}
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
                                                        {{ $item->address_types?->title }}</p>
                                                </div>
                                                <div class="deals-company-agent d-flex flex-between-center">
                                                    <div class="d-flex align-items-center"><span
                                                            class="uil uil-envelope me-2"></span>
                                                        <p class="text-body-secondary fw-bold fs-9 mb-0">
                                                            {{ $item->city }}</p>
                                                    </div>
                                                    <div class="d-flex align-items-center"><span
                                                            class="uil uil-hard-hat me-2"></span>
                                                        <p class="text-body-secondary fw-bold fs-9 mb-0"></p>
                                                    </div>
                                                </div>
                                                <div class="collapse" id="collapseWidthDeals-5">
                                                    <div class="d-flex gap-2 mb-5"><span
                                                            class="badge badge-phoenix badge-phoenix-info">new</span><span
                                                            class="badge badge-phoenix badge-phoenix-danger">Urgent</span>
                                                    </div>
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
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Type</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->address_types?->title }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="mail"
                                                                            style="width:16px; height:16px"></span>
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
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="phone"
                                                                            style="width:16px; height:16px"></span>
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
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="x"
                                                                            style="width:16px; height:16px"></span>
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
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="calendar"
                                                                            style="width:16px; height:16px"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            State</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->state }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="user-plus"
                                                                            style="width:16px; height:16px"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Zipcode</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->zipcode }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-1">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="me-2 text-body-tertiary"
                                                                            data-feather="calendar"
                                                                            style="width:16px; height:16px"></span>
                                                                        <p
                                                                            class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                            Country</p>
                                                                    </div>
                                                                </td>
                                                                <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                                <td class="py-1">
                                                                    <p
                                                                        class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                        {{ $item->country?->country_name }}</p>
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

            </div>
        </div>
    </div>
    {{-- </div> --}}
    {{-- <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#!">Pages</a></li>
            <li class="breadcrumb-item active">Pricing-grid</li>
        </ol>
    </nav>
    <div class="pb-9">
        <h2 class="mb-7">Pricing</h2>
        <div class="row">
            <div class="col-xl-12 col-xxl-9 mb-1">
                <div class="tabs mb-7">
                    <ul class="nav nav-underline fs-9 mb-3" id="nav-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-year-tab" data-bs-toggle="pill" data-bs-target="#pills-year"
                                type="button" role="tab" aria-controls="pills-year"
                                aria-selected="false">Yearly</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-month-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-month" type="button" role="tab" aria-controls="pills-month"
                                aria-selected="true">Monthly</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-month" role="tabpanel"
                            aria-labelledby="pills-month-tab">
                            <div class="row g-3">

                                <div>
                                    <div class="card mb-3">
                                        <div class="card-body"><a
                                                class="dropdown-indicator-icon position-absolute text-body-tertiary"
                                                href="#collapseWidthDeals-1" role="button" data-bs-toggle="collapse"
                                                aria-expanded="false" aria-controls="collapseWidthDeals-1"><span
                                                    class="fa-solid fa-angle-down"></span></a>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex"><span class="me-2" data-feather="clock"
                                                        style="stroke-width:2;"></span>
                                                    <p class="mb-0 fs-9 fw-semibold text-body-tertiary date">Dec 30,
                                                        2022<span class="text-body-quaternary"> . 2:15 PM</span></p>
                                                </div>
                                            </div>
                                            <div class="deals-items-head d-flex align-items-center mb-2"><a
                                                    class="text-primary fw-bold line-clamp-1 me-3 mb-0 fs-7"
                                                    href="../../apps/crm/deal-details.html">Jo_Td01</a>
                                                <p class="deals-category fs-10 mb-0 mt-1 d-none"><span
                                                        class="me-1 text-body-quaternary" data-feather="grid"
                                                        style="stroke-width:2; height: 12px; width: 12px"></span>Financial
                                                </p>
                                                <p class="ms-auto fs-9 text-body-emphasis fw-semibold mb-0 deals-revenue">
                                                    $14,000.00</p>
                                            </div>
                                            <div class="deals-company-agent d-flex flex-between-center">
                                                <div class="d-flex align-items-center"><span
                                                        class="uil uil-user me-2"></span>
                                                    <p class="text-body-secondary fw-bold fs-9 mb-0">Knitkake.inc</p>
                                                </div>
                                                <div class="d-flex align-items-center"><span
                                                        class="uil uil-headphones me-2"></span>
                                                    <p class="text-body-secondary fw-bold fs-9 mb-0">Ally Aagaard</p>
                                                </div>
                                            </div>
                                            <div class="collapse" id="collapseWidthDeals-1">
                                                <div class="d-flex gap-2 mb-5"><span
                                                        class="badge badge-phoenix badge-phoenix-info">new</span><span
                                                        class="badge badge-phoenix badge-phoenix-danger">Urgent</span></div>
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
                                                                    data-feather="dollar-sign"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Expected
                                                                    Revenue</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                $14,000.00</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary" data-feather="user"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Company
                                                                    Name</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis d-flex align-items-center gap-2">
                                                                Knitkake.inc<a href="#!"> <span
                                                                        class="fa-solid fa-square-phone text-body-tertiary"></span></a><a
                                                                    href="#!"> <span
                                                                        class="fa-solid fa-square-envelope text-body-tertiary"></span></a><a
                                                                    href="#!"> <span
                                                                        class="fab fa-whatsapp-square text-body-tertiary"></span></a>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="calendar"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">Closing
                                                                    Date &amp; Time</p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <p
                                                                class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                27-12-2022<span> . 11:19 PM</span></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><span
                                                                    class="me-2 text-body-tertiary"
                                                                    data-feather="headphones"
                                                                    style="width:16px; height:16px"></span>
                                                                <p class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                    Assigned Agent </p>
                                                            </div>
                                                        </td>
                                                        <td class="py-1 d-none d-sm-block pe-sm-2">:</td>
                                                        <td class="py-1">
                                                            <select
                                                                class="form-select form-select-sm py-0 ms-n3 border-0 shadow-none">
                                                                <option selected="selected">Ally Aagaard</option>
                                                                <option>Lonnie Kub</option>
                                                                <option>Aida Moen</option>
                                                                <option>Niko Koss</option>
                                                                <option>Alec Haag</option>
                                                                <option>Ola Smith</option>
                                                                <option>Leif Walsh</option>
                                                                <option>Brain Cole</option>
                                                                <option>Reese Mann</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <p class="fs-9 mb-1"> Probability:</p>
                                                <div class="progress" style="height:8px">
                                                    <div class="progress-bar rounded-pill bg-info" role="progressbar"
                                                        style="width: 20%" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 col-lg-12 col-xl-4">
                                    <div class="h-100">
                                        <input class="card-form-check-input d-none" type="radio" name="pricingMonthly"
                                            id="startup" checked="checked" />
                                        <div class="position-relative h-100">
                                            <label class="stretched-link" for="startup">
                                            </label>
                                            <div class="card h-100 overflow-hidden cursor-pointer">
                                                <div class="bg-holder d-dark-none"
                                                    style="background-image:url({{ asset('fnx/assets/img/bg/8.png') }});background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div class="bg-holder d-light-none"
                                                    style="background-image:url({{ asset('fnx/assets/img/bg/8-dark.png') }});background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div
                                                    class="card-body d-flex flex-column justify-content-between position-relative">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="mb-5 mb-md-0 mb-lg-5 me-3">
                                                            <div class="d-sm-flex align-items-center mb-3">
                                                                <h3 class="mb-0">Profile</h3>
                                                            </div>
                                                            <p class="fs-9 text-body-tertiary">For individuals who are
                                                                interested <br> in giving it a shot first.</p>
                                                            <div class="collapse show" id="collapseWidthDeals-1"
                                                                style="">
                                                                <div class="d-flex gap-2 mb-5"><span
                                                                        class="badge badge-phoenix badge-phoenix-info">new</span><span
                                                                        class="badge badge-phoenix badge-phoenix-danger">Urgent</span>
                                                                </div>
                                                                <table class="mb-4 w-100 table-stats table-stats">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="py-1">
                                                                                <div class="d-flex align-items-center"><svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16px" height="16px"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        stroke="currentColor"
                                                                                        stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        class="feather feather-dollar-sign me-2 text-body-tertiary">
                                                                                        <line x1="12"
                                                                                            y1="1" x2="12"
                                                                                            y2="23">
                                                                                        </line>
                                                                                        <path
                                                                                            d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6">
                                                                                        </path>
                                                                                    </svg>
                                                                                    <p
                                                                                        class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                                        Expected Revenue</p>
                                                                                </div>
                                                                            </td>
                                                                            <td class="py-1 d-none d-sm-block pe-sm-2">:
                                                                            </td>
                                                                            <td class="py-1">
                                                                                <p
                                                                                    class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                                    $14,000.00</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="py-1">
                                                                                <div class="d-flex align-items-center"><svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16px" height="16px"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        stroke="currentColor"
                                                                                        stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        class="feather feather-user me-2 text-body-tertiary"
                                                                                        style="width:16px; height:16px">
                                                                                        <path
                                                                                            d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2">
                                                                                        </path>
                                                                                        <circle cx="12"
                                                                                            cy="7" r="4"></circle>
                                                                                    </svg>
                                                                                    <p
                                                                                        class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                                        Company Name</p>
                                                                                </div>
                                                                            </td>
                                                                            <td class="py-1 d-none d-sm-block pe-sm-2">:
                                                                            </td>
                                                                            <td class="py-1">
                                                                                <p
                                                                                    class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis d-flex align-items-center gap-2">
                                                                                    Knitkake.inc<a href="#!"
                                                                                        draggable="false"> <svg
                                                                                            class="svg-inline--fa fa-square-phone text-body-tertiary"
                                                                                            aria-hidden="true"
                                                                                            focusable="false"
                                                                                            data-prefix="fas"
                                                                                            data-icon="square-phone"
                                                                                            role="img"
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            viewBox="0 0 448 512"
                                                                                            data-fa-i2svg="">
                                                                                            <path fill="currentColor"
                                                                                                d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm90.7 96.7c9.7-2.6 19.9 2.3 23.7 11.6l20 48c3.4 8.2 1 17.6-5.8 23.2L168 231.7c16.6 35.2 45.1 63.7 80.3 80.3l20.2-24.7c5.6-6.8 15-9.2 23.2-5.8l48 20c9.3 3.9 14.2 14 11.6 23.7l-12 44C336.9 378 329 384 320 384C196.3 384 96 283.7 96 160c0-9 6-16.9 14.7-19.3l44-12z">
                                                                                            </path>
                                                                                        </svg><!-- <span class="fa-solid fa-square-phone text-body-tertiary"></span> Font Awesome fontawesome.com --></a><a
                                                                                        href="#!" draggable="false">
                                                                                        <svg class="svg-inline--fa fa-square-envelope text-body-tertiary"
                                                                                            aria-hidden="true"
                                                                                            focusable="false"
                                                                                            data-prefix="fas"
                                                                                            data-icon="square-envelope"
                                                                                            role="img"
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            viewBox="0 0 448 512"
                                                                                            data-fa-i2svg="">
                                                                                            <path fill="currentColor"
                                                                                                d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM218 271.7L64.2 172.4C66 156.4 79.5 144 96 144H352c16.5 0 30 12.4 31.8 28.4L230 271.7c-1.8 1.2-3.9 1.8-6 1.8s-4.2-.6-6-1.8zm29.4 26.9L384 210.4V336c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V210.4l136.6 88.2c7 4.5 15.1 6.9 23.4 6.9s16.4-2.4 23.4-6.9z">
                                                                                            </path>
                                                                                        </svg><!-- <span class="fa-solid fa-square-envelope text-body-tertiary"></span> Font Awesome fontawesome.com --></a><a
                                                                                        href="#!" draggable="false">
                                                                                        <svg class="svg-inline--fa fa-square-whatsapp text-body-tertiary"
                                                                                            aria-hidden="true"
                                                                                            focusable="false"
                                                                                            data-prefix="fab"
                                                                                            data-icon="square-whatsapp"
                                                                                            role="img"
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            viewBox="0 0 448 512"
                                                                                            data-fa-i2svg="">
                                                                                            <path fill="currentColor"
                                                                                                d="M92.1 254.6c0 24.9 7 49.2 20.2 70.1l3.1 5-13.3 48.6L152 365.2l4.8 2.9c20.2 12 43.4 18.4 67.1 18.4h.1c72.6 0 133.3-59.1 133.3-131.8c0-35.2-15.2-68.3-40.1-93.2c-25-25-58-38.7-93.2-38.7c-72.7 0-131.8 59.1-131.9 131.8zM274.8 330c-12.6 1.9-22.4 .9-47.5-9.9c-36.8-15.9-61.8-51.5-66.9-58.7c-.4-.6-.7-.9-.8-1.1c-2-2.6-16.2-21.5-16.2-41c0-18.4 9-27.9 13.2-32.3c.3-.3 .5-.5 .7-.8c3.6-4 7.9-5 10.6-5c2.6 0 5.3 0 7.6 .1c.3 0 .5 0 .8 0c2.3 0 5.2 0 8.1 6.8c1.2 2.9 3 7.3 4.9 11.8c3.3 8 6.7 16.3 7.3 17.6c1 2 1.7 4.3 .3 6.9c-3.4 6.8-6.9 10.4-9.3 13c-3.1 3.2-4.5 4.7-2.3 8.6c15.3 26.3 30.6 35.4 53.9 47.1c4 2 6.3 1.7 8.6-1c2.3-2.6 9.9-11.6 12.5-15.5c2.6-4 5.3-3.3 8.9-2s23.1 10.9 27.1 12.9c.8 .4 1.5 .7 2.1 1c2.8 1.4 4.7 2.3 5.5 3.6c.9 1.9 .9 9.9-2.4 19.1c-3.3 9.3-19.1 17.7-26.7 18.8zM448 96c0-35.3-28.7-64-64-64H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96zM148.1 393.9L64 416l22.5-82.2c-13.9-24-21.2-51.3-21.2-79.3C65.4 167.1 136.5 96 223.9 96c42.4 0 82.2 16.5 112.2 46.5c29.9 30 47.9 69.8 47.9 112.2c0 87.4-72.7 158.5-160.1 158.5c-26.6 0-52.7-6.7-75.8-19.3z">
                                                                                            </path>
                                                                                        </svg><!-- <span class="fab fa-whatsapp-square text-body-tertiary"></span> Font Awesome fontawesome.com --></a>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="py-1">
                                                                                <div class="d-flex align-items-center"><svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16px" height="16px"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        stroke="currentColor"
                                                                                        stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        class="feather feather-calendar me-2 text-body-tertiary"
                                                                                        style="width:16px; height:16px">
                                                                                        <rect x="3" y="4" width="18"
                                                                                            height="18" rx="2"
                                                                                            ry="2"></rect>
                                                                                        <line x1="16"
                                                                                            y1="2" x2="16"
                                                                                            y2="6"></line>
                                                                                        <line x1="8"
                                                                                            y1="2" x2="8"
                                                                                            y2="6"></line>
                                                                                        <line x1="3"
                                                                                            y1="10" x2="21"
                                                                                            y2="10"></line>
                                                                                    </svg>
                                                                                    <p
                                                                                        class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                                        Closing Date &amp; Time</p>
                                                                                </div>
                                                                            </td>
                                                                            <td class="py-1 d-none d-sm-block pe-sm-2">:
                                                                            </td>
                                                                            <td class="py-1">
                                                                                <p
                                                                                    class="ps-6 ps-sm-0 fw-semibold fs-9 mb-0 mb-0 pb-3 pb-sm-0 text-body-emphasis">
                                                                                    27-12-2022<span> . 11:19 PM</span></p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="py-1">
                                                                                <div class="d-flex align-items-center"><svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16px" height="16px"
                                                                                        viewBox="0 0 24 24" fill="none"
                                                                                        stroke="currentColor"
                                                                                        stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        class="feather feather-headphones me-2 text-body-tertiary"
                                                                                        style="width:16px; height:16px">
                                                                                        <path d="M3 18v-6a9 9 0 0 1 18 0v6">
                                                                                        </path>
                                                                                        <path
                                                                                            d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z">
                                                                                        </path>
                                                                                    </svg>
                                                                                    <p
                                                                                        class="fw-semibold fs-9 mb-0 text-body-tertiary">
                                                                                        Assigned Agent </p>
                                                                                </div>
                                                                            </td>
                                                                            <td class="py-1 d-none d-sm-block pe-sm-2">:
                                                                            </td>
                                                                            <td class="py-1">
                                                                                <select
                                                                                    class="form-select form-select-sm py-0 ms-n3 border-0 shadow-none">
                                                                                    <option selected="selected">Ally
                                                                                        Aagaard</option>
                                                                                    <option>Lonnie Kub</option>
                                                                                    <option>Aida Moen</option>
                                                                                    <option>Niko Koss</option>
                                                                                    <option>Alec Haag</option>
                                                                                    <option>Ola Smith</option>
                                                                                    <option>Leif Walsh</option>
                                                                                    <option>Brain Cole</option>
                                                                                    <option>Reese Mann</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <p class="fs-9 mb-1"> Probability:</p>
                                                                <div class="progress" style="height:8px">
                                                                    <div class="progress-bar rounded-pill bg-info"
                                                                        role="progressbar" style="width: 20%"
                                                                        aria-valuenow="20" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-end mb-md-5 mb-lg-0">
                                                                <h4 class="fw-bolder me-1">Free</h4>
                                                                <h5 class="fs-9 fw-normal text-body-tertiary ms-1">Forever
                                                                </h5>
                                                            </div>
                                                        </div><img class="d-dark-none"
                                                            src="{{ asset('fnx/assets/img/spot-illustrations/rocket.png') }}"
                                                            width="54" height="54" alt="" /><img
                                                            class="d-light-none"
                                                            src="../../assets/img/spot-illustrations/rocket-dark.png"
                                                            width="54" height="54" alt="" />
                                                    </div>
                                                    <div class="row flex-1 justify-content-end">
                                                        <div class="col-sm-8 col-md-12">
                                                            <div
                                                                class="d-sm-flex d-md-block d-lg-flex justify-content-end align-items-end h-100">
                                                                <ul
                                                                    class="list-unstyled mb-0 border-start-sm border-start-md-0 border-start-lg ps-sm-5 ps-md-0 ps-lg-5 border-translucent">
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Up to 4
                                                                            Members</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">3
                                                                            Collaboration projects</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <div class="h-100">
                                        <input class="card-form-check-input d-none" type="radio" name="pricingMonthly"
                                            id="standard" />
                                        <div class="position-relative h-100">
                                            <label class="stretched-link" for="standard"></label>
                                            <div class="card h-100 overflow-hidden cursor-pointer">
                                                <div class="bg-holder d-dark-none"
                                                    style="background-image:url(../../assets/img/bg/9.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div class="bg-holder d-light-none"
                                                    style="background-image:url(../../assets/img/bg/9-dark.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div
                                                    class="card-body d-flex flex-column justify-content-between position-relative">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="mb-5 mb-md-0 mb-lg-5 me-3">
                                                            <div class="d-sm-flex align-items-center mb-3">
                                                                <h3 class="mb-0">Standard</h3>
                                                            </div>
                                                            <p class="fs-9 text-body-tertiary">For teams that need to
                                                                create <br> project plans with confidence.</p>
                                                            <div class="d-flex align-items-end mb-md-5 mb-lg-0">
                                                                <h4 class="fw-bolder me-1">$14.99</h4>
                                                                <h5 class="fs-9 fw-normal text-body-tertiary ms-1">Per
                                                                    month</h5>
                                                            </div>
                                                        </div><img class="d-dark-none"
                                                            src="../../assets/img/spot-illustrations/bag-2.png"
                                                            width="54" height="54" alt="" /><img
                                                            class="d-light-none"
                                                            src="../../assets/img/spot-illustrations/bag-2-dark.png"
                                                            width="54" height="54" alt="" />
                                                    </div>
                                                    <div class="row flex-1 justify-content-end">
                                                        <div class="col-sm-8 col-md-12">
                                                            <div
                                                                class="d-sm-flex d-md-block d-lg-flex justify-content-end align-items-end h-100">
                                                                <ul
                                                                    class="list-unstyled mb-0 border-start-sm border-start-md-0 border-start-lg ps-sm-5 ps-md-0 ps-lg-5 border-translucent">
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Up to 8
                                                                            Members</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Create &
                                                                            Share libraries</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">10
                                                                            Collaboration projects</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <div class="h-100">
                                        <input class="card-form-check-input d-none pricing-plan-recommended"
                                            type="radio" name="pricingMonthly" id="businessPlus" />
                                        <div class="position-relative h-100">
                                            <label class="stretched-link" for="businessPlus"></label>
                                            <div
                                                class="card h-100 overflow-hidden cursor-pointer bg-warning-subtle border-warning warning-boxshadow pricing-business-plus">
                                                <div class="bg-holder d-dark-none"
                                                    style="background-image:url(../../assets/img/bg/bg-11.png);background-position:left bottom;background-size:auto;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div class="bg-holder d-light-none"
                                                    style="background-image:url(../../assets/img/bg/bg-11-dark.png);background-position:left bottom;background-size:auto;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div
                                                    class="card-body d-flex flex-column justify-content-between position-relative">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="mb-5 mb-md-0 mb-lg-5 me-3">
                                                            <div
                                                                class="d-sm-flex d-md-block d-lg-flex align-items-center mb-3">
                                                                <h3 class="mb-0">Business Plus</h3><span
                                                                    class="badge ms-sm-3 ms-md-0 ms-lg-3 text-uppercase fs-10 text-bg-warning">recommended</span>
                                                            </div>
                                                            <p class="fs-9 text-body-tertiary">For teams that need to
                                                                manage <br> work across initiatives.</p>
                                                            <div class="d-flex align-items-end mb-md-5 mb-lg-0">
                                                                <h4 class="fw-bolder me-1">$49.99</h4>
                                                                <h5 class="fs-9 fw-normal text-body-tertiary ms-1">Per
                                                                    month</h5>
                                                            </div>
                                                        </div><img class="d-dark-none"
                                                            src="../../assets/img/spot-illustrations/star.png"
                                                            width="54" height="54" alt="" /><img
                                                            class="d-light-none"
                                                            src="../../assets/img/spot-illustrations/star-dark.png"
                                                            width="54" height="54" alt="" />
                                                    </div>
                                                    <div class="row flex-1 justify-content-end">
                                                        <div class="col-sm-8 col-md-12">
                                                            <div
                                                                class="d-sm-flex d-md-block d-lg-flex justify-content-end align-items-end h-100">
                                                                <ul
                                                                    class="list-unstyled mb-0 border-start-sm border-start-md-0 border-start-lg ps-sm-5 ps-md-0 ps-lg-5 border-warning-subtle">
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Technical
                                                                            Supports</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Up to 20
                                                                            Members</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Create &
                                                                            Share libraries</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold"><span
                                                                                class="fw-bold">Unlimited</span>
                                                                            Collaboration</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <div class="h-100">
                                        <input class="card-form-check-input d-none" type="radio" name="pricingMonthly"
                                            id="enterprise" />
                                        <div class="position-relative h-100">
                                            <label class="stretched-link" for="enterprise"></label>
                                            <div class="card h-100 overflow-hidden cursor-pointer">
                                                <div class="bg-holder d-dark-none"
                                                    style="background-image:url(../../assets/img/bg/10.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div class="bg-holder d-light-none"
                                                    style="background-image:url(../../assets/img/bg/10-dark.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div
                                                    class="card-body d-flex flex-column justify-content-between position-relative">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="mb-5 mb-md-0 mb-lg-5 me-3">
                                                            <div class="d-sm-flex align-items-center mb-3">
                                                                <h3 class="mb-0">Enterprise</h3>
                                                            </div>
                                                            <p class="fs-9 text-body-tertiary">For organizations that need
                                                                <br> additional security and support.
                                                            </p>
                                                            <div class="d-flex align-items-end mb-md-5 mb-lg-0">
                                                                <h4 class="fw-bolder me-1">$149.99</h4>
                                                                <h5 class="fs-9 fw-normal text-body-tertiary ms-1">Per
                                                                    month</h5>
                                                            </div>
                                                        </div><img class="d-dark-none"
                                                            src="../../assets/img/spot-illustrations/shield-2.png"
                                                            width="54" height="54" alt="" /><img
                                                            class="d-light-none"
                                                            src="../../assets/img/spot-illustrations/shield-2-dark.png"
                                                            width="54" height="54" alt="" />
                                                    </div>
                                                    <div class="row flex-1 justify-content-end">
                                                        <div class="col-sm-8 col-md-12">
                                                            <div
                                                                class="d-sm-flex d-md-block d-lg-flex justify-content-end align-items-end h-100">
                                                                <ul
                                                                    class="list-unstyled mb-0 border-start-sm border-start-md-0 border-start-lg ps-sm-5 ps-md-0 ps-lg-5 border-translucent">
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">24/7 VIP
                                                                            Support</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Automated
                                                                            analytics</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold"><span
                                                                                class="fw-bold">Unlimited</span>
                                                                            Members*</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Create &
                                                                            Share libraries</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Centralized
                                                                            billing</span></li>
                                                                </ul>
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
                    </div>
                    <div class="tab-content" id="pills-tabContentYear">
                        <div class="tab-pane fade" id="pills-year" role="tabpanel" aria-labelledby="pills-year-tab">
                            <div class="row g-3">
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <div class="h-100">
                                        <input class="card-form-check-input d-none" type="radio" name="pricingYearly"
                                            id="startupYearly" checked="checked" />
                                        <div class="position-relative h-100">
                                            <label class="stretched-link" for="startupYearly"></label>
                                            <div class="card h-100 overflow-hidden cursor-pointer">
                                                <div class="bg-holder d-dark-none"
                                                    style="background-image:url(../../assets/img/bg/8.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div class="bg-holder d-light-none"
                                                    style="background-image:url(../../assets/img/bg/8-dark.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div
                                                    class="card-body d-flex flex-column justify-content-between position-relative">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="mb-5 mb-md-0 mb-lg-5 me-3">
                                                            <div class="d-sm-flex align-items-center mb-3">
                                                                <h3 class="mb-0">Startup</h3>
                                                            </div>
                                                            <p class="fs-9 text-body-tertiary">For individuals who are
                                                                interested <br> in giving it a shot first.</p>
                                                            <div class="d-flex align-items-end mb-md-5 mb-lg-0">
                                                                <h4 class="fw-bolder me-1">Free</h4>
                                                                <h5 class="fs-9 fw-normal text-body-tertiary ms-1">Forever
                                                                </h5>
                                                            </div>
                                                        </div><img class="d-dark-none"
                                                            src="../../assets/img/spot-illustrations/rocket.png"
                                                            width="54" height="54" alt="" /><img
                                                            class="d-light-none"
                                                            src="../../assets/img/spot-illustrations/rocket-dark.png"
                                                            width="54" height="54" alt="" />
                                                    </div>
                                                    <div class="row flex-1 justify-content-end">
                                                        <div class="col-sm-8 col-md-12">
                                                            <div
                                                                class="d-sm-flex d-md-block d-lg-flex justify-content-end align-items-end h-100">
                                                                <ul
                                                                    class="list-unstyled mb-0 border-start-sm border-start-md-0 border-start-lg ps-sm-5 ps-md-0 ps-lg-5 border-translucent">
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Up to 4
                                                                            Members</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">3
                                                                            Collaboration projects</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <div class="h-100">
                                        <input class="card-form-check-input d-none" type="radio" name="pricingYearly"
                                            id="standardYearly" />
                                        <div class="position-relative h-100">
                                            <label class="stretched-link" for="standardYearly"></label>
                                            <div class="card h-100 overflow-hidden cursor-pointer">
                                                <div class="bg-holder d-dark-none"
                                                    style="background-image:url(../../assets/img/bg/9.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div class="bg-holder d-light-none"
                                                    style="background-image:url(../../assets/img/bg/9-dark.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div
                                                    class="card-body d-flex flex-column justify-content-between position-relative">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="mb-5 mb-md-0 mb-lg-5 me-3">
                                                            <div class="d-sm-flex align-items-center mb-3">
                                                                <h3 class="mb-0">Standard</h3>
                                                            </div>
                                                            <p class="fs-9 text-body-tertiary">For teams that need to
                                                                create <br> project plans with confidence.</p>
                                                            <div class="d-flex align-items-end mb-md-5 mb-lg-0">
                                                                <h4 class="fw-bolder me-1">$179.88</h4>
                                                                <h5 class="fs-9 fw-normal text-body-tertiary ms-1">Per year
                                                                </h5>
                                                            </div>
                                                        </div><img class="d-dark-none"
                                                            src="../../assets/img/spot-illustrations/bag-2.png"
                                                            width="54" height="54" alt="" /><img
                                                            class="d-light-none"
                                                            src="../../assets/img/spot-illustrations/bag-2-dark.png"
                                                            width="54" height="54" alt="" />
                                                    </div>
                                                    <div class="row flex-1 justify-content-end">
                                                        <div class="col-sm-8 col-md-12">
                                                            <div
                                                                class="d-sm-flex d-md-block d-lg-flex justify-content-end align-items-end h-100">
                                                                <ul
                                                                    class="list-unstyled mb-0 border-start-sm border-start-md-0 border-start-lg ps-sm-5 ps-md-0 ps-lg-5 border-translucent">
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Up to 8
                                                                            Members</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Create &
                                                                            Share libraries</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">10
                                                                            Collaboration projects</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <div class="h-100">
                                        <input class="card-form-check-input d-none pricing-plan-recommended"
                                            type="radio" name="pricingYearly" id="businessPlusYearly" />
                                        <div class="position-relative h-100">
                                            <label class="stretched-link" for="businessPlusYearly"></label>
                                            <div
                                                class="card h-100 overflow-hidden cursor-pointer bg-warning-subtle border-warning warning-boxshadow pricing-business-plus">
                                                <div class="bg-holder d-dark-none"
                                                    style="background-image:url(../../assets/img/bg/bg-11.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div class="bg-holder d-light-none"
                                                    style="background-image:url(../../assets/img/bg/bg-11-dark.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div
                                                    class="card-body d-flex flex-column justify-content-between position-relative">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="mb-5 mb-md-0 mb-lg-5 me-3">
                                                            <div class="d-sm-flex align-items-center mb-3">
                                                                <h3 class="mb-0">Business Plus</h3><span
                                                                    class="badge ms-sm-3 text-uppercase fs-10 text-bg-warning">recommended</span>
                                                            </div>
                                                            <p class="fs-9 text-body-tertiary">For teams that need to
                                                                manage <br> work across initiatives.</p>
                                                            <div class="d-flex align-items-end mb-md-5 mb-lg-0">
                                                                <h4 class="fw-bolder me-1">$599.88</h4>
                                                                <h5 class="fs-9 fw-normal text-body-tertiary ms-1">Per year
                                                                </h5>
                                                            </div>
                                                        </div><img class="d-dark-none"
                                                            src="../../assets/img/spot-illustrations/star.png"
                                                            width="54" height="54" alt="" /><img
                                                            class="d-light-none"
                                                            src="../../assets/img/spot-illustrations/star-dark.png"
                                                            width="54" height="54" alt="" />
                                                    </div>
                                                    <div class="row flex-1 justify-content-end">
                                                        <div class="col-sm-8 col-md-12">
                                                            <div
                                                                class="d-sm-flex d-md-block d-lg-flex justify-content-end align-items-end h-100">
                                                                <ul
                                                                    class="list-unstyled mb-0 border-start-sm border-start-md-0 border-start-lg ps-sm-5 ps-md-0 ps-lg-5 border-translucent">
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Technical
                                                                            Supports</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Up to 20
                                                                            Members</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Create &
                                                                            Share libraries</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold"><span
                                                                                class="fw-bold">Unlimited</span>
                                                                            Collaboration</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <div class="h-100">
                                        <input class="card-form-check-input d-none" type="radio" name="pricingYearly"
                                            id="enterpriseYearly" />
                                        <div class="position-relative h-100">
                                            <label class="stretched-link" for="enterpriseYearly"></label>
                                            <div class="card h-100 overflow-hidden cursor-pointer">
                                                <div class="bg-holder d-dark-none"
                                                    style="background-image:url(../../assets/img/bg/10.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div class="bg-holder d-light-none"
                                                    style="background-image:url(../../assets/img/bg/10-dark.png);background-position:left bottom;background-size:auto;bottom:-1px;">
                                                </div>
                                                <!--/.bg-holder-->

                                                <div
                                                    class="card-body d-flex flex-column justify-content-between position-relative">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="mb-5 mb-md-0 mb-lg-5 me-3">
                                                            <div class="d-sm-flex align-items-center mb-3">
                                                                <h3 class="mb-0">Enterprise</h3>
                                                            </div>
                                                            <p class="fs-9 text-body-tertiary">For organizations that need
                                                                <br> additional security and support.
                                                            </p>
                                                            <div class="d-flex align-items-end mb-md-5 mb-lg-0">
                                                                <h4 class="fw-bolder me-1">$1,799.88</h4>
                                                                <h5 class="fs-9 fw-normal text-body-tertiary ms-1">Per year
                                                                </h5>
                                                            </div>
                                                        </div><img class="d-dark-none"
                                                            src="../../assets/img/spot-illustrations/shield-2.png"
                                                            width="54" height="54" alt="" /><img
                                                            class="d-light-none"
                                                            src="../../assets/img/spot-illustrations/shield-2-dark.png"
                                                            width="54" height="54" alt="" />
                                                    </div>
                                                    <div class="row flex-1 justify-content-end">
                                                        <div class="col-sm-8 col-md-12">
                                                            <div
                                                                class="d-sm-flex d-md-block d-lg-flex justify-content-end align-items-end h-100">
                                                                <ul
                                                                    class="list-unstyled mb-0 border-start-sm border-start-md-0 border-start-lg ps-sm-5 ps-md-0 ps-lg-5 border-translucent">
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">24/7 VIP
                                                                            Support</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Automated
                                                                            analytics</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold"><span
                                                                                class="fw-bold">Unlimited</span>
                                                                            Members*</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Create &
                                                                            Share libraries</span></li>
                                                                    <li class="d-flex align-items-center"><span
                                                                            class="uil uil-check-circle text-success me-2"></span><span
                                                                            class="text-body-tertiary fw-semibold">Centralized
                                                                            billing</span></li>
                                                                </ul>
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
                    </div>
                </div>
                <div>
                    <p class="mb-0">Business Starter, Business Standard, and Business Plus plans can be purchased for a
                        maximum of 300 users. There is no <br class="d-none d-xl-block d-xxl-none" />maximum user limit for
                        Enterprise plans.</p>
                    <p class="fw-semibold">Phoenix customers may have access to additional features for a limited <br
                            class="d-none d-sm-block d-lg-none" />promotional period.</p>
                    <div class="d-grid d-sm-flex">
                        <button
                            class="btn btn-lg btn-primary d-sm-flex align-items-center mb-3 mb-sm-0 me-sm-3 px-sm-8">Subscribe
                            Now<span class="fas fa-angle-right ms-1"></span></button>
                        <button class="btn btn-lg btn-outline-primary px-sm-7">Start 7 days free Trial</button>
                    </div>
                </div>
            </div>
            <div class="col col-xxl-3 mt-8">
                <h3 class="fw-semibold mb-3">Included in our all packages</h3>
                <div class="row">
                    <div class="col-md-6 col-xxl-12">
                        <div class="rounded-3 py-2 px-3 bg-body-emphasis d-flex align-items-center mb-3"><span
                                class="fas fa-check text-primary me-3 fs-9"></span>
                            <p class="mb-0 text-body-secondary">Timeline</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-12">
                        <div class="rounded-3 py-2 px-3 bg-body-emphasis d-flex align-items-center mb-3"><span
                                class="fas fa-check text-primary me-3 fs-9"></span>
                            <p class="mb-0 text-body-secondary">Advanced Search</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-12">
                        <div class="rounded-3 py-2 px-3 bg-body-emphasis d-flex align-items-center mb-3"><span
                                class="fas fa-check text-primary me-3 fs-9"></span>
                            <p class="mb-0 text-body-secondary">Custom fields</p><span
                                class="badge badge-phoenix badge-phoenix-primary ms-2">New</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-12">
                        <div class="rounded-3 py-2 px-3 bg-body-emphasis d-flex align-items-center mb-3"><span
                                class="fas fa-check text-primary me-3 fs-9"></span>
                            <p class="mb-0 text-body-secondary">Task dependencies</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-12">
                        <div class="rounded-3 py-2 px-3 bg-body-emphasis d-flex align-items-center mb-3"><span
                                class="fas fa-check text-primary me-3 fs-9"></span>
                            <p class="mb-0 text-body-secondary">20TB of additional space </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-12">
                        <div class="rounded-3 py-2 px-3 bg-body-emphasis d-flex align-items-center mb-3"><span
                                class="fas fa-check text-primary me-3 fs-9"></span>
                            <p class="mb-0 text-body-secondary">Bandwidth of Upto 1 Gbps</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-12">
                        <div class="rounded-3 py-2 px-3 bg-body-emphasis d-flex align-items-center mb-3"><span
                                class="fas fa-check text-primary me-3 fs-9"></span>
                            <p class="mb-0 text-body-secondary">Private teams & projects</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-12">
                        <div class="rounded-3 py-2 px-3 bg-body-emphasis d-flex align-items-center mb-3"><span
                                class="fas fa-check text-primary me-3 fs-9"></span>
                            <p class="mb-0 text-body-secondary">Customer Support and Training</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
