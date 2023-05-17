<div class="modal fade" id="major-modal" data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('major.store') }}" class="form needs-validation" id="major-form" autocomplete="off" novalidate>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form {{ $view }}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">

                    <div class="mb-10 fv-row">
                        <label for="name" class="required form-label">Parent</label>
                        <select class="form-control form-control-solid" name="parent_id">
                            <option value="">--tanpa parent-- </option>
                            @foreach ($major as $itemMajor)
                                <option value="{{ $itemMajor->id}}" >{{ $itemMajor->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-10 fv-row">
                        <label for="name" class="required form-label">Name</label>
                        <input type="text" class="form-control form-control-solid" name="name" placeholder="Name" required/>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-clean font-weight-bold" data-dismiss="modal">Close</button>
                    <button class="btn btn-light-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>