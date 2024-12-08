@extends('hr.admin.layout.admin_template')
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
                            <a href="{{route('hr.admin.dashboard')}}"><?= get_label('home', 'Home') ?></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('hr.admin.employee')}}">
                                <?= get_label('letter', 'Letter') ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= get_label('generate', 'Generate') ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">Generate</h2>
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


                <div class="ms-xxl-auto">
                    <!-- <button class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span>Export</button> -->
                    <!-- <button class="btn btn-primary" id="addBtn"><span class="fas fa-plus me-2"></span>Add product</button> -->
                    <a href="{{ route('hr.admin.letter.generate.create') }}" target="_blank">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee_leave', 'Create employee_leave') ?>">
                            <i class="bx bx-plus"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>


        <!-- </div> -->
        <x-admin-generated-letter-template-card employeeid="" />
    </div>


    <script src="{{asset('assets/js/pages/hr/admin/admin_employees_letter.js')}}"></script>

    @endsection

    @push('script')

    @endpush