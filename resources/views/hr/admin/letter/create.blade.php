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
                        <li class="breadcrumb-item"><a href="{{route('hr.admin.letter')}}">
                                <?= get_label('letter', 'Letter') ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= get_label('template', 'Template') ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">Templates</h2>
            </div>
        </div>


        <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_letter_form" novalidate="" action="{{ route ('hr.admin.letter.store') }}" method="POST">
            @csrf
            <div class="col-md-6">

                <label class="form-label" for="inputEmail4">Title</label>

                <input class="form-control" id="letter_title" name="title" type="text" required>
            </div>

            <div class="col-12">
                <textarea class="tinymce" name="content" data-tinymce="{}"></textarea>
            </div>
            <!-- <div>
                <textarea id="basic-example"></textarea>

            </div> -->

            <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
        </form>
    </div>


    @endsection

    @push('script')

    <!-- <script src="{{asset('assets/js/pages/employees_letter.js')}}"></script> -->

    @endpush