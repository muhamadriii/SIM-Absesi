<div class="modal fade" id="menu-modal" data-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('menu.store') }}" class="form needs-validation" id="menu-form" autocomplete="off" novalidate>
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
                            <option >--tanpa parent-- </option>
                            @foreach ($menu as $itemMenu)
                                <option value="{{ $itemMenu->id}}" >{{ $itemMenu->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="mb-10 fv-row">
                        <label for="name" class="required form-label">Parent</label>
                        <select class="form-control form-control-solid" name="name" placeholder="Name" required>
                            <option >--tanpa parent-- </option>
                        </select>
                    </div> --}}

                    <div class="mb-10 fv-row">
                        <label for="name" class="required form-label">Name</label>
                        <input type="text" class="form-control form-control-solid" name="name" placeholder="Name" required/>
                    </div>

                    <div class="mb-10 fv-row">
                        <label for="route" class="required form-label">Route</label>
                        <input type="text" class="form-control form-control-solid" name="route" placeholder="example:dashboard.index"/>
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