@extends('layout.app')

@section('content')
<div class="card">
    <div class="card-header border-0 pt-6 d-flex justify-content-end">   
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#student-modal">
            <i class="la la-plus"></i>Create
        </button>
    </div>
    <!--begin::Card body-->
    <div class="card-body py-4">
        <div class="table table-responsive">
            <!--begin: Datatable-->
            <table class="student-table table table-stripped table-hover table-checkable" id="kt-datatable" aria-describedby="kt_datatable_info">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>NIS</th>
                        <th>Rayon</th>
                        <th>Major</th>
                        <th>JK</th>
                        <th>DOB</th>
                        <th>No Telepon</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card body-->
</div>

<div class="modal fade modal-image-preview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <img src="" class="modal-show-image img img-responsive">
        </div>
    </div>
</div>

@include($view.'form')
@endsection

@push('script')
    @include($view.'script')
@endpush