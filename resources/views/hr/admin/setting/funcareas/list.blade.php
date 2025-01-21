@extends('hr.admin.layout.admin_template')
@section('main')
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->

    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-2 mt-2">
            <div class="d-flex justify-content-between m-2">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1">
                            <li class="breadcrumb-item">
                                <a href="{{ route('hr.admin.dashboard') }}"><?= get_label('home', 'Home') ?></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('hr.admin.employee') }}">
                                    <?= get_label('employees', 'Employees') ?></a>
                            </li>
                            <li class="breadcrumb-item active">
                                <?= get_label('project_category', 'Functional Area') ?>
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
            <div>
                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#create_funcareas_modal"><button
                        type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-original-title=" <?= get_label('create_funcarea', 'Create Venue') ?>"><i
                            class="bx bx-plus"></i></button></a>
                {{-- <a href="#!" id="add_project_category" data-table="project_category_table" data-id="0">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_project_category', 'Create Category') ?>">
                    <i class="bx bx-plus"></i>
                </button>
            </a> --}}
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">Functional Area</h2>
            </div>
        </div>
        <x-functional-area-card :funcareas="$funcareas" />
    </div>

    <script>
        var label_update = '<?= get_label('update', 'Update') ?>';
        var label_delete = '<?= get_label('delete', 'Delete') ?>';
        var label_not_assigned = '<?= get_label('not_assigned', 'Not assigned') ?>';
        var label_duplicate = '<?= get_label('duplicate', 'Duplicate') ?>';
    </script>
    <script src="{{ asset('assets/js/pages/hr/setting/functional_area.js') }}"></script>
@endsection

@push('script')
@endpush
