<div class="modal fade" id="teacher-modal" data-backdrop="static" tabindex="-2" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('teacher.store') }}" class="form needs-validation" id="teacher-form" autocomplete="on" novalidate enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Teacher</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">

                    <span class="text-black-50 h6">Data Diri</span>
                    <hr>

                    <div class="d-flex my-5 justify-content-center">
                        <div class="image-input image-input-outline" id="kt_image_1">
                            <div class="image-input-wrapper" style="background-image: url(assets/media/users/blank.png)"></div>
                           
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg ,.svg"/>
                                <input type="hidden" name=""/>
                            </label>
                           
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-10 fv-row">
                        <label for="name" class="required form-label">Name</label>
                        <input type="text" class="form-control form-control-solid" name="name" placeholder="Name" required/>
                    </div>

                    <div class="mb-10 fv-row">
                        <label for="nip" class="required form-label">NIP</label>
                        <div class="">
                            <input class="form-control form-control-solid" id="kt_inputmask_18" type="text" name="nip" required/>
                            <span class="form-text text-muted">length
                            <code>18</code>character</span>
                        </div>
                    </div>

                    <div class="mb-10 fv-row">
                        <label for="jk" class="required form-label">Gender</label>
                        <select class="form-control form-control-solid" name="jk">
                            <option value="laki-laki">laki-laki</option>
                            <option value="perempuan">perempuan</option>
                        </select>
                    </div>

                    <div class="mb-10 fv-row">
                        <label for="dob" class="required form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control form-control-solid" id="kt_datepicker_3_moda" />
                    </div>

                    <div class="mb-10 fv-row">
                        <label for="telp" class="required form-label">No Telepon</label>
                        <div class="input-group date">
                            <input type="text" name="telp" class="form-control form-control-solid" id="kt_inputmask_3" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-10 fv-row">
                        <label for="address">Address</label></label>
                        <textarea class="form-control form-control-solid" name="address" rows="3"></textarea>
                    </div>

                    <span class="text-black-50 h6">Account</span>
                    <hr>
                    
                    <div class="mb-10 fv-row">
                        <label for="role" class="required form-label">Role</label>
                        <select class="form-control form-control-solid" name="role">
                            <option value="admin">admin</option>
                            <option value="guru">guru</option>
                        </select>
                    </div>

                    
                    <div class="mb-10 fv-row">
                        <label for="email" class="required form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-solid" id="kt_datepicker_3_moda" />
                    </div>
                    
                    <div class="mb-10 fv-row">
                        <label for="passwor" class="required form-label">Password</label>
                        <input type="password" name="password" class="form-control form-control-solid" id="kt_datepicker_3_moda" />
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