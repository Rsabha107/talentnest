@extends('projects.admin.layout.admin_template')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->


    <div class="container-fluid">
        <div class="mb-2">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="{{route('tracki.employee.dashboard')}}"><?= get_label('home', 'Home') ?></a>
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
                <h2 class="mb-0">Tasks</h2>
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
                <div>
                    <select class="form-select select-appearance" id="tasks_project_filter" aria-label="Default select example">
                        <option value="" selected><?= get_label('select_project', 'Select project') ?></option>
                        @foreach ($projects as $key)
                        <option value="{{$key->id}}">{{$key->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select class="form-select select-appearance" id="tasks_department_filter" aria-label="Default select example">
                        <option value="" selected><?= get_label('select_department', 'Select department') ?></option>
                        @foreach ($departments as $key)
                        <option value="{{$key->id}}">{{$key->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select class="form-select select-appearance" id="tasks_employee_filter" aria-label="Default select example">
                        <option value="" selected><?= get_label('select_employee', 'Select employee') ?></option>
                        @foreach ($employees as $key)
                        <option value="{{$key->id}}">{{$key->first_name}} {{$key->last_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select class="form-select select-appearance" id="task_status_filter" aria-label="Default select example">
                        <option value="" selected><?= get_label('select_status', 'Select status') ?></option>
                        @foreach ($statuses as $key)
                        <option value="{{$key->id}}">{{$key->title}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- <div >
                    <select class="form-select select-appearance" id="active_archived_filter" aria-label="Default select example">
                        <option value=""><?= get_label('active_archived', 'Select Active or Archived') ?></option>
                        <option value="N" $selected>Active</option>
                        <option value="Y" >Archived</option>
                    </select>
                </div> -->

                <div class="ms-xxl-auto">
                    <!-- <button class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span>Export</button> -->
                    <!-- <button class="btn btn-primary" id="addBtn"><span class="fas fa-plus me-2"></span>Add product</button> -->
                    @if (Auth::user()->can('task.create'))
                    <a href="#!" id="add_employee" data-action="store" data-source="manage" data-type="add" data-table="task_table" data-id="0">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_task', 'Create task') ?>">
                            <i class="bx bx-plus"></i>
                        </button>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <x-admin-tasks-card projectId=""/>
    </div>

    <script src="{{asset('assets/js/pages/project/admin/tasks.js')}}"></script>

    @endsection

    @push('script')


    @endpush