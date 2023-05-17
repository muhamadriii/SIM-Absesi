@extends('layout.app')

@section('content')
<div class="card">
    <div class="card-header border-0 pt-6 d-flex justify-content-end">   
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#major-modal">
            <i class="la la-plus"></i>Create
        </button>
    </div>
    <!--begin::Card body-->
    <div class="card-body py-4">

        <!--begin::Table-->
        <div class="table-responive">
            <!--begin: Datatable-->
            <table class="major-table table table-stripped table-hover table-checkable" id="">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Parent</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
            <!--end: Datatable-->

        </div>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>

@include($view.'form')
@endsection

@push('script')
    @include($view.'script')
@endpush