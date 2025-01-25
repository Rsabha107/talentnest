@extends('projects.admin.layout.admin_template')
@section('main')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#!">Page 1</a></li>
            <li class="breadcrumb-item"><a href="#!">Page 2</a></li>
            <li class="breadcrumb-item active">Default</li>
        </ol>
    </nav>
    <h2 class="mb-4">Duplicate a project</h2>
    <div class="row">
        <div class="col-xl-9">
            <form class="row g-3 mb-6 px-3 needs-validation" novalidate="" action="{{ route('project.store') }}"
                method="POST">
                @csrf
                <div class="col-sm-6 col-md-8">
                    <div class="form-floating">
                        <input class="form-control" name="name" id="floatingInputGrid" type="text"
                            placeholder="Project title"  value="{{ $project->name }}"/>
                        <label for="floatingInputGrid">Project title</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <select name="location_id" class="form-select" id="add_project_location" required>
                            <option selected="selected" value="">Select...</option>
                            @foreach ($event_location as $key => $item)
                                    <option value="{{ $item->id }}" {{ ($project->location_id === $item->id)? 'selected' : ''}}>
                                        {{ $item->name }}
                                    </option>
                            @endforeach
                        </select>
                        <label for="floatingSelectTask">Location</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <select name="project_type_id" class="form-select" id="add_project_project_type" required>
                            <option selected="selected" value="">Select...</option>
                            @foreach ($project_type as $key => $item)
                                    <option value="{{ $item->id }}" {{ ($project->project_type_id === $item->id)? 'selected' : ''}}>
                                        {{ $item->name }}
                                    </option>
                            @endforeach
                        </select>
                        <label for="floatingSelectPrivacy">Project type</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <select name="category_id" class="form-select" id="add_project_category" required>
                            <option selected="selected" value="">Select...</option>
                            @foreach ($event_category as $key => $item)
                                    <option value="{{ $item->id }}" {{ ($project->category_id === $item->id)? 'selected' : ''}}>
                                        {{ $item->name }}
                                    </option>
                            @endforeach
                        </select>
                        <label for="floatingSelectTeam">Category </label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <select name="audience_id" class="form-select" id="add_project_audience" required>
                            <option selected="selected" value="">Select...</option>
                            @foreach ($event_audience as $key => $item)
                                    <option value="{{ $item->id }}" {{ ($project->audience_id === $item->id)? 'selected' : ''}}>
                                        {{ $item->name }}
                                    </option>
                            @endforeach
                        </select>
                        <label for="floatingSelectAssignees">Audience </label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <select name="client_id" class="form-select" id="add_project_client" required>
                            <option selected="selected" value="">Select...</option>
                            @foreach ($clients as $key => $item)
                                <option value="{{ $item->id }}" {{ ($project->client_id === $item->id)? 'selected' : ''}}>
                                    {{ $item->first_name . ' ' . $item->last_name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="floatingSelectAdmin">Cleint</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="flatpickr-input-container">
                        <div class="form-floating">
                            <input class="form-control datetimepicker" id="floatingInputStartDate" type="text"
                                placeholder="dd/mm/yyyy" placeholder="start date" name="start_date" value="{{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}"
                                data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required />
                            <label class="ps-6" for="floatingInputStartDate">Start date</label><span
                                class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="flatpickr-input-container">
                        <div class="form-floating">
                            <input class="form-control datetimepicker" id="floatingInputDeadline" type="text"
                                placeholder="dd/mm/yyyy" placeholder="deadline" name="end_date" value="{{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}"
                                data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required />
                            <label class="ps-6" for="floatingInputDeadline">Deadline</label><span
                                class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 gy-3">
                    <div class="form-floating">
                        <textarea   class="form-control" name="description" id="floatingProjectOverview" 
                                    placeholder="Leave a comment here" 
                                    style="height: 100px" required>{{ $project->description }}
                        </textarea>
                        <label for="floatingProjectOverview">project overview</label>
                    </div>
                </div>
                <div class="col-md-6 gy-3">
                    <div class="form-floating">
                        <input name="budget_allocation" class="form-control" id="floatingInputBudget" type="number"
                            value="{{ $project->budget_allocation }}" step="0.01" placeholder="Budget" required />
                        <label for="floatingInputBudget">Attendance forcast</label>
                    </div>
                </div>
                <div class="col-md-6 gy-3">
                    <div class="form-floating">
                        <input name="attendance_forcast" class="form-control" id="floatingInputBudget" type="number"
                        value="{{ $project->attendance_forcast }}" step="0.01" placeholder="Budget" required />
                        <label for="floatingInputBudget">Budget</label>
                    </div>
                </div>
                <div class="col-12 gy-3">
                    <div class="form-floating form-floating-advance-select">
                        <label>Add Venues</label>
                        <select name="venue_id[]" class="form-select" id="organizerMultiple" data-choices="data-choices"
                            multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                            {{-- <option value="">Select venues</option> --}}
                            @foreach ($event_venue as $key => $item)
                                @foreach ($project->venues as $pvKey => $pvItem)
                                    @if ($pvItem->id === $item->id)
                                        <option value="{{ $item->id }}" selected>
                                            {{ $item->name }}
                                        </option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 gy-3">
                    <div class="form-floating form-floating-advance-select">
                        <label>Add Functional Areas</label>
                        <select name="functional_area_id[]" class="form-select" id="organizerMultiple"
                            data-choices="data-choices" multiple="multiple"
                            data-options='{"removeItemButton":true,"placeholder":true}'>
                            {{-- <option value="">Select venues</option> --}}
                            @foreach ($functional_areas as $key => $item)
                                @foreach ($project->functional_areas as $pvKey => $pvItem)
                                    @if ($pvItem->id === $item->id)
                                        <option value="{{ $item->id }}" selected>
                                            {{ $item->name }}
                                        </option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 gy-3">
                    <div class="form-floating form-floating-advance-select">
                        <label>Add Resources</label>
                        <select name="assignment_to_id[]" class="form-select" id="organizerMultiple"
                            data-choices="data-choices" multiple="multiple"
                            data-options='{"removeItemButton":true,"placeholder":true}'>
                            {{-- <option value="">Select venues</option> --}}
                            @foreach ($employees as $key => $item)
                                @foreach ($project->employees as $pvKey => $pvItem)
                                    @if ($pvItem->id === $item->id)
                                        <option value="{{ $item->id }}" selected>
                                            {{ $item->full_name }}
                                        </option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 gy-3">
                    <div class="form-floating form-floating-advance-select">
                        <label>Add Tags</label>
                        <select name="tag_id[]" class="form-select" id="organizerMultiple" data-choices="data-choices"
                            multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                            {{-- <option value="">Select venues</option> --}}
                            @foreach ($tags as $key => $item)
                                @foreach ($project->tags as $pvKey => $pvItem)
                                    @if ($pvItem->id === $item->id)
                                        <option value="{{ $item->id }}" selected>
                                            {{ $item->title }}
                                        </option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 gy-3">
                    <div class="row g-3 justify-content-end">
                        <a href="{{ route('projects.admin.project') }}" class="col-auto" >
                            <button type="button" class="btn btn-phoenix-danger px-5" data-bs-toggle="tooltip" data-bs-placement="right"
                                data-bs-original-title=" <?= get_label('add_new_project', 'Add new project') ?>">
                                Cancel
                            </button>
                        </a>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-5 px-sm-15">Create Project</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/pages/project/admin/projects.js') }}"></script>
@endpush
