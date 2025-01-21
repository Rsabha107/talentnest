@extends('projects.admin.layout.admin_template')
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
                            <a href="{{route('hr.admin.dashboard')}}"><?= get_label('home', 'Home') ?></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('hr.admin.employee')}}">
                                <?= get_label('employees', 'Employees') ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= get_label('project_category', 'Category') ?>
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
            <a href="#!" id="add_project_category" data-table="project_category_table" data-id="0">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_project_category', 'Create Category') ?>">
                    <i class="bx bx-plus"></i>
                </button>
            </a>
        </div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-auto">
            <h2 class="mb-0">Category</h2>
        </div>
    </div>
        <x-projects.settings.category-card />
</div>

<script src="{{asset('assets/js/pages/project/setting/category.js')}}"></script>

@endsection

@push('script')


@endpush

