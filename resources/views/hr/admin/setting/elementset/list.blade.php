@extends('hr.admin.layout.admin_template')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->


<div class="container-fluid">
    <div class="d-flex justify-content-between m-2">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{url('/home')}}"><?= get_label('home', 'Home') ?></a>
                    </li>
                    <li class="breadcrumb-item active">
                        <?= get_label('element_set', 'Element Set') ?>
                    </li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#create_elementset_modal"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_element', 'Create Element') ?>"><i class="bx bx-plus"></i></button></a>
        </div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-auto">
            <h2 class="mb-0">Element Sets</h2>
        </div>
    </div>
    <x-element-set-card />
</div>


<script>
    var label_update = '<?= get_label('update', 'Update') ?>';
    var label_delete = '<?= get_label('delete', 'Delete') ?>';
</script>
<script src="{{asset('assets/js/pages/hr/setting/element/elementsets.js')}}"></script>
@endsection

@push('script')


@endpush