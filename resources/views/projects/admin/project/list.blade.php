@extends('projects.admin.layout.admin_template')
@section('main')

    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><?= get_label('home', 'Home') ?></a></li>
            <li class="breadcrumb-item"><a href="{{ route('projects.admin.project') }}">
                    <?= get_label('projects', 'Projects') ?></a></li>
            <li class="breadcrumb-item active">Default</li>
        </ol>
    </nav>
    <div class="row gx-6 gy-3 mb-4 align-items-center">
        <div class="col-auto">
            <h2 class="mb-0">Projects<span class="fw-normal text-body-tertiary ms-3">({{ $project_data->count() }})</span>
            </h2>
        </div>
    </div>
    <div class="row justify-content-between align-items-end mb-4 g-3">
        <div class="col-12 col-sm-auto">
            <div class="btn-group position-static" role="group">
                <div class="py-0 me-2">
                    <select class="form-select form-select-sm py-2 ms-n2 border-0 shadow-none" id="project_filter">
                        <option value="" selected>Filter by Event .... </option>
                        @foreach ($project_data as $key => $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-0 me-2">
                    <select class="form-select form-select-sm py-2 ms-n2 border-0 shadow-none" id="project_status_filter">
                        <option value="" selected>Filter by Status .... </option>
                        @foreach ($project_status as $key => $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-0">
                    <select class="form-select form-select-sm py-2 ms-n2 border-0 shadow-none" id="project_venue_filter">
                        <option value="" selected>Filter by venue</option>
                        @foreach ($event_venue as $key => $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-0">
                    <select class="form-select form-select-sm py-2 ms-n2 border-0 shadow-none" id="project_venue_filter">
                        <option value="" selected>Filter by Functional Area</option>
                        @foreach ($event_venue as $key => $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-sm btn-phoenix-secondary px-7 flex-shrink-0">More filters</button>
            </div>

        </div>

        <div class="col-12 col-sm-auto">
            <div class="d-flex align-items-center">
                {{-- <div class="search-box me-3"> --}}
                <a href="#!" id="add_project" data-table="employee_address_table" data-id="0">
                    <button type="button" class="btn btn-primary px-5" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-original-title=" <?= get_label('add_new_project', 'Add new project') ?>">
                        <i class="fa-solid fa-plus me-2"></i>Add new project
                    </button>
                </a>

            </div>
        </div>
    </div>

    <x-admin-projects-card/>
@endsection

@push('script')
    <script src="{{ asset('assets/js/pages/project/admin/projects.js') }}"></script>
@endpush
