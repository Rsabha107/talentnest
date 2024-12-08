@extends('admin.admin_dashboard')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<nav class="mb-3" aria-label="breadcrumb">
  <ol class="breadcrumb mb-0">
    <li class="breadcrumb-item"><a href="#!">Page 1</a></li>
    <li class="breadcrumb-item"><a href="#!">Page 2</a></li>
    <li class="breadcrumb-item active">Default</li>
  </ol>
</nav>
<div class="border-bottom border-translucent mb-7 mx-n3 px-2 mx-lg-n6 px-lg-6">
  <div class="row">
    <div class="col-xl-9">
      <div class="d-sm-flex justify-content-between">
        <h2 class="mb-4">Create a new lead</h2>
        <div class="d-flex mb-3">
          <button class="btn btn-phoenix-primary me-2 px-6">Cancel</button>
          <button class="btn btn-primary">Create lead</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-9">
    <div class="d-flex align-items-end position-relative mb-7">
      <input class="d-none" id="upload-avatar" type="file" />
      <div class="hoverbox" style="width: 150px; height: 150px">
        <div class="hoverbox-content rounded-circle d-flex flex-center z-1" style="--phoenix-bg-opacity: .56;"><span class="fa-solid fa-camera fs-1 text-body-quaternary"></span></div>
        <div class="position-relative bg-body-quaternary rounded-circle cursor-pointer d-flex flex-center mb-xxl-7">
          <div class="avatar avatar-5xl"><img class="rounded-circle" src="{{ asset ('fnx/assets/img/team/150x150/58.webp')}}" alt="" /></div>
          <label class="w-100 h-100 position-absolute z-1" for="upload-avatar"></label>
        </div>
      </div>
    </div>

    <!--   //////////// Goal Option /////////////// -->
    <h4 class="mb-3">Element Assignment </h4>

    <div class="card">
      <div class="card-body">
        <div class="row g-3 add_item">
          <div class="col-sm-6 col-lg-6">
            <!-- <label class="fw-bold text-body-tertiary mb-1" for="checkIn">Element</label> -->
            <div class="form-icon-container flatpickr-input-container">
              <input class="form-control form-icon-input" type="text" name="course_goals[]" id="goals" placeholder="Goals ">
            </div>
          </div>

          <div class="col-sm-auto ms-auto align-self-end">
            <a class="btn btn-primary w-100 addeventmore"><i class="fa fa-plus-circle"></i> Add more</a>
          </div>
        </div>
      </div>
    </div>


    <div class="row add_item">

      <div class="col-md-6">
        <div class="mb-3">
          <label for="goals" class="form-label"> Goals </label>

          <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals ">
        </div>
      </div>
      <div class="form-group col-md-6" style="padding-top: 30px;">
        <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
      </div>
    </div> <!---end row-->
    <!--   //////////// /End Goal Option /////////////// -->



  </div>
</div>


<!--========== Start of add multiple class with ajax ==============-->
<div style="visibility: hidden">
  <div class="whole_extra_item_add" id="whole_extra_item_add">
    <div class="whole_extra_item_delete" id="whole_extra_item_delete">
      <div class="container mt-2">
        <div class="row">
          <div class="form-group col-md-6">
            <!-- <label for="goals">Goals</label> -->
            <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals  ">
          </div>
          <div class="form-group col-md-6" style="padding-top: 20px">
            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
            <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var counter = 0;
    $(document).on("click", ".addeventmore", function() {
      var whole_extra_item_add = $("#whole_extra_item_add").html();
      $(this).closest(".add_item").append(whole_extra_item_add);
      counter++;
    });
    $(document).on("click", ".removeeventmore", function(event) {
      $(this).closest("#whole_extra_item_delete").remove();
      counter -= 1
    });
  });
</script>

<!----For Section-------->

<script src="{{asset('assets/js/pages/element/element_sets.js')}}"></script>
@endsection

@push('script')


@endpush