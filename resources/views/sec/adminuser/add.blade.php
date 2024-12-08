@extends('hr.admin.layout.admin_template')
@section('main')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('hr.admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sec.adminuser.list') }}">All Users</a></li>
            <li class="breadcrumb-item active">new user</li>
        </ol>
    </nav>
    <h2 class="mb-4">Create a User</h2>
    <div class="row">
        {{-- <div class="col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ !empty($user->photo) ? url('upload/admin_images/' . $user->photo) : url('upload/no_image.jpg') }}"
                            alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                        <div class="mt-3">
                            <h4>{{ $user->name }}</h4>
                            <p class="text-secondary mb-1">{{ $user->username }}</p>
                            <p class="text-muted font-size-sm">{{ $user->email }}</p>
                            <button class="btn btn-primary">Follow</button>
                            <button class="btn btn-outline-primary">Message</button>
                        </div>
                    </div>
                    <hr class="my-4" />
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-globe me-2 icon-inline">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>Website</h6>
                            <span class="text-secondary">https://codervent.com</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-8">
            <form method="POST" action="{{ route('sec.adminuser.create') }}"
                class="row g-3 mb-6 needs-validation validatedForm" novalidate enctype="multipart/form-data">
                @csrf
                <div class="col-sm-6 col-md-8">
                    <div class="form-floating">
                        <input class="form-control" name="username" id="user_name" type="text" placeholder="User Name"
                            value="{{ old('user_name') }}" required />
                        <label for="floatingInputGrid">User Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-8">
                    <div class="form-floating">
                        <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                            value="{{ old('name') }}" required>
                        <label for="floatingInputGrid">Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-8">
                    <div class="form-floating">
                        <input class="form-control" id="email" name="email" type="email"
                            placeholder="name@example.com" value="{{ old('email') }}" required>
                        <label for="floatingInputGrid">Email Address</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-8">
                    <div class="form-floating">
                        <input class="form-control" id="phone" name="phone" type="phone" placeholder="phone number"
                            value="{{ old('phone') }}" required>
                        <label for="floatingInputGrid">Phone</label>
                    </div>
                </div>
                <div class="row g-2 mb-3">
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="">
                        <?= get_label('require_email_verification', 'Require email verification?') ?>
                        <i class='bx bx-info-circle text-primary' data-bs-toggle="tooltip" data-bs-placement="top"
                            title="If 'Yes' is selected, user will receive a verification link via email. Please ensure that email settings are configured and operational."></i>
                    </label>
                    <div class="">
                        <div class="btn-group btn-group d-flex justify-content-center" role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" id="require_ev_yes" name="require_ev" value="1"
                                checked>
                            <label class="btn btn-outline-primary"
                                for="require_ev_yes"><?= get_label('yes', 'Yes') ?></label>
                            <input type="radio" class="btn-check" id="require_ev_no" name="require_ev"
                                value="0">
                            <label class="btn btn-outline-primary"
                                for="require_ev_no"><?= get_label('no', 'No') ?></label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label" for=""><?= get_label('status', 'Status') ?> (<small
                            class="text-muted mt-2">If Deactive, user won't be able to log into their
                            account</small>)</label>
                    <div class="">
                        <div class="btn-group btn-group d-flex justify-content-center" role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" id="user_active" name="status" value="1" checked>
                            <label class="btn btn-outline-primary"
                                for="user_active"><?= get_label('active', 'Active') ?></label>
                            <input type="radio" class="btn-check" id="user_deactive" name="status" value="0"
                                >
                            <label class="btn btn-outline-primary"
                                for="user_deactive"><?= get_label('deactive', 'Deactive') ?></label>

                        </div>
                    </div>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for=""><?= get_label('user_type', 'User Type') ?> </label>
                    <div class="">
                        <div class="btn-group btn-group d-flex justify-content-center" role="group"
                            aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" id="userUser" name="usertype" value="user"
                                checked>
                            <label class="btn btn-outline-primary" for="userUser"><?= get_label('user', 'User') ?></label>
                            <input type="radio" class="btn-check" id="adminUser" name="usertype" value="admin">
                            <label class="btn btn-outline-primary"
                                for="adminUser"><?= get_label('admin', 'Admin') ?></label>

                        </div>
                    </div>
                </div>
            </div>
                {{-- <div class="mb-3 col-md-8">
                <!-- <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="faUser" type="radio" name="usertype" value="functional" checked="checked" required/>
                                                <label class="form-check-label" for="inlineRadio1">Functional
                                                    Area</label>
                                            </div> -->
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="userUser" type="radio" name="usertype" value="user" checked="checked" required />
                    <label class="form-check-label" for="inlineRadio2">User</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="adminUser" type="radio" name="usertype" value="admin" required />
                    <label class="form-check-label" for="inlineRadio2">Admin</label>
                </div>
            </div> --}}
                {{-- <div class="mb-2 col-md-8" id="WorkspaceSelect">
                <label class="form-label" for="email">Initial Workspace</label>
                <select name="workspace_id" class="form-select" id="floatingSelectWorkspace">
                    <option selected="selected" value=""> Select workspace
                    </option>
                    @foreach ($workspace as $key => $item)
                    @if (Request::old('id') == $item->id)
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->title }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->title }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-0 col-md-8" id="DepartmentSelect">
                <label class="form-label" for="email">Department</label>
                <select name="department_id" class="form-select" id="floatingSelectDepartment">
                    <option selected="selected" value=""> Select department </option>
                    @foreach ($departments as $key => $item)
                    @if (Request::old('id') == $item->id)
                    <option value="{{ $item->id}}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id}}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div> --}}
                <div class="row g-2 mb-3">
                    <div class="col-xl-4">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control form-icon-input" name="password" id="password" type="password"
                            placeholder="Password" required>
                    </div>
                    <div class="col-xl-4">
                        <label class="form-label" for="password_confirmation">Confirm
                            Password</label>
                        <input class="form-control form-icon-input" type="password" id="password_confirmation"
                            name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 mb-3">
                    <label class="form-label" for="photo"><?= get_label('photo', 'photo') ?></label>
                    <input class="form-control" id="profile_image" name="photo" type="file" placeholder="photo">
                </div>
                <div class="col-sm-4 text-secondary">
                    <img src="{{ !empty($user->photo) ? url('upload/admin_images/' . $user->photo) : url('upload/no_image.jpg') }}"
                        alt="Admin" class="rounded-circle p-1 bg-primary" width="80" id="showImage">
                </div>
                <div class="col-sm-6 col-md-9">
                    @foreach ($roles as $key => $item)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" id="inlineCheckbox{{ $item->id }}" type="checkbox"
                                name="roles[]" value="{{ $item->id }}"
                                >
                            <label class="form-check-label"
                                for="inlineCheckbox{{ $item->id }}">{{ $item->name }}</label>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-primary mb-3" type="submit">Update now</button>
                {{-- <!-- <div class="text-center"><a class="fs-9 fw-bold" href="{{route('auth.login')}}">Sign in to an existing account</a></div> --> --}}
                <div class="text-center"><a class="fs-9 fw-bold" href="{{ route('sec.adminuser.list') }}">Go back to
                        list</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    {{-- <script>
    $(document).ready(function() {
        console.log('fauser checked ')
        $("#WorkspaceSelect").show();
        $("#DepartmentSelect").show();
        $("#floatingSelectDepartment").prop('required', true);
        $("#floatingSelectWorkspace").prop('required', true);
        $("input[name=usertype]").change(function() {
            console.log('usertype changing')
            if ($("#userUser").is(':checked')) {
                $("#WorkspaceSelect").show();
                $("#DepartmentSelect").show();
                $("#floatingSelectDepartment").prop('required', true);
                $("#floatingSelectWorkspace").prop('required', true);

            } else {
                $("#DepartmentSelect").hide();
                $("#WorkspaceSelect").hide();
                $("#floatingSelectWorkspace").prop('required', false);
                $("#floatingSelectDepartment").prop('required', false);
            }
        });
    });
</script> --}}
@endpush
