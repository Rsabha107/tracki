@if (Request::is('tracki/employee/profile*'))

<div class="modal fade" id="add_employee_file_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Upload File</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form id="fileUploadForm" class="needs-validation form-submit-event" novalidate="" action="{{ route('tracki.employee.files.store') }}" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" name="employee_id" value="{{ $emp->id }}">
                                <input type="hidden" name="table" value="employee_file_table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Name</label>
                                    <input class="form-control" type="file" name="file_name" id="fileupld" required />
                                </div>
                                <div class="form-group">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                </div>
                                <!-- <div class="mb-4">
                                        <label class="text-1000 fw-bold mb-2">Status</label>
                                        <select class="form-select" name="active_flag" id="activeFlag" required>
                                            <option value="" >Select</option>
                                            <option value="1" selected>Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- this is an offcanvas modal  -->
@if (Request::is('tracki/employee'))
<div class="offcanvas offcanvas-end w-70" data-bs-backdrop="static" id="add_employee_modal" tabindex="-1" aria-labelledby="offcanvasWithBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title"><?= get_label('add_employee', 'Add employee') ?></h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST">
            @csrf

            <input type="hidden" id="add_employee_id_h" name="id" value="">
            <input type="hidden" id="add_employee_table_h" name="table" value="employee_table">


            <div class="row">
                <!-- begining of left div -->
                <div class="col-md-8">
                    <div class="mb-3 row">

                        <div class="col-md-6">
                            <label class="form-label" for="inputAddress">Prefix</label>
                            <select name="salutation" class="form-select" id="add_employee_salutation">
                                <option selected="selected" value="">Select...</option>
                                @foreach ($salutations as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="inputEmail4">Entity</label>
                            <select class="form-select" name="entity_id" required>
                                <option value="" selected>Select...</option>
                                @foreach ($entities as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="inputEmail4">First Name</label>
                            <input name="first_name" id="add_employee_first_name" class="form-control" type="text" placeholder="" required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>

                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="inputEmail4">Middle Name</label>
                            <input name="middle_name" id="add_employee_middle_name" class="form-control" type="text" placeholder="">
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="inputEmail4">Last Name</label>
                            <input name="last_name" id="add_employee_last_name" class="form-control" type="text" placeholder="" required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputEmail4">Personal Email</label>
                            <input name="personal_email_address" id="add_employee_email_address" class="form-control" type="text" placeholder="" required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputEmail4">Work Email</label>
                            <input name="work_email_address" id="add_employee_email_address" class="form-control" type="text" placeholder="" required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputEmail4">QID</label>
                            <input name="national_identifier_number" class="form-control" type="text" maxlength="11" placeholder="" required="required">
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputEmail4">QID Expiry Date</label>
                            <input class="form-control datetimepickerstarttoday" data-target="#floatingInputStartDate" name="civil_id_expiry" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputEmail4">Passport</label>
                            <input name="passport_number" class="form-control" type="text" placeholder="" required="required">
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputEmail4">Passport Expiry Date</label>
                            <input class="form-control datetimepickerstarttoday" data-target="#floatingInputStartDate" name="passport_expiry" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputEmail4">Job</label>
                            <select class="form-select" name="designation_id" id="add_designation_id" required>
                                <option value="">Select...</option>
                                @foreach ($designations as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->name }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-6  mb-3">
                            <label class="form-label" for="inputEmail4">Job Level</label>
                            <select class="form-select" name="job_level_id" required>
                                <option value="" selected>Select...</option>
                                @foreach ($job_levels as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label" for="phone_area_code">Code</label>
                            <select class="form-select" name="phone_area_code" required="required">
                                <option value="" selected>Select ...</option>
                                @foreach ($countries as $key => $item )
                                <option value="{{ $item->phonecode  }}">
                                    {{ $item->phonecode }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-4  mb-3">
                            <label class="form-label" for="inputEmail4">Phone</label>
                            <input name="phone_number" id="add_employee_phone_number" class="form-control" type="text" placeholder="" required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label" for="alt_area_code">Code</label>
                            <select class="form-select" name="alt_area_code">
                                <option value="" selected>Select ...</option>
                                @foreach ($countries as $key => $item )
                                <option value="{{ $item->phonecode  }}">
                                    {{ $item->phonecode }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-4  mb-3">
                            <label class="form-label" for="inputEmail4">Alternate Phone</label>
                            <input name="alt_phone_number" id="add_employee_alt_phone_number" class="form-control" type="text" placeholder="">
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="bootstrap-wizard-validation-gender">Sponsorship Type</label>
                            <select class="form-select" name="sponsorship_id" required="required">
                                <option value="" selected>Select ...</option>
                                @foreach ($contract_types as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-6  mb-3">
                            <label class="form-label" for="inputEmail4">Sponsorship Name</label>
                            <input name="sponsorship_name" id="add_sponsorship_name" class="form-control" type="text" placeholder="">
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="bootstrap-wizard-validation-gender">Contract Type</label>
                            <select class="form-select" name="contract_type_id" required="required">
                                <option value="" selected>Select ...</option>
                                @foreach ($contract_types as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="inputEmail4">Contact Start Date</label>
                            <input class="form-control datetimepicker" id="edit_employee_date_of_hire" data-target="#floatingInputStartDate" name="contract_start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="inputEmail4">Contract End Date</label>
                            <input class="form-control datetimepicker" id="edit_employee_join_date" data-target="#floatingInputStartDate" name="contract_end_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                    </div>
                </div>
                <!-- end of left div -->

                <!-- begining of right div -->
                <div class="col-md-4">
                    <div class="form-check form-switch mt-4 mb-4">
                        <input class="form-check-input" id="flexSwitchCheckDefault" name="manager_flag" value="Y" type="checkbox" />
                        <label class="form-check-label" for="flexSwitchCheckDefault">Manager?</label>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="bootstrap-wizard-validation-gender">Directorate</label>
                        <select class="form-select" name="directorate_id" required="required">
                            <option value="" selected>Select ...</option>
                            @foreach ($directorate as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->title }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="inputEmail4">Department</label>
                        <select class="form-select" name="department_id" id="add_department_id" required>
                            <option value="" selected>Select...</option>
                            @foreach ($departments as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="bootstrap-wizard-validation-gender">Functioanl Area</label>
                        <select class="form-select" name="functional_area_id" required="required">
                            <option value="">Select ...</option>
                            @foreach ($functional as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>

                    <div class="mb-3 row">

                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="bootstrap-wizard-validation-gender">Report to</label>
                            <select class="form-select" name="reporting_to_id" id="add_employee_reporting_to_id" required="required">
                                <option value="">Select ...</option>
                                @foreach ($emps as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->first_name}} {{$item->last_name }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->first_name}} {{$item->last_name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="bootstrap-wizard-validation-gender">Gender</label>
                            <select class="form-select" name="gender_id" id="add_employee_gender" required="required">
                                <option value="">Select ...</option>
                                @foreach ($genders as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="bootstrap-wizard-validation-gender">Marital Status</label>
                            <select class="form-select" name="marital_status_id" id="add_employee_marital_status" required="required">
                                <option value="" selected>Select ...</option>
                                @foreach ($marital_statuses as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Birth Date</label>
                            <input class="form-control datetimepicker" id="add_employee_date_of_birth" data-target="#floatingInputStartDate" name="date_of_birth" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="bootstrap-wizard-validation-gender">Country of birth</label>
                            <select class="form-select" name="country_of_birth" id="add_employee_country_of_birth" required="required">
                                <option value="" selected>Select ...</option>
                                @foreach ($countries as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->country_name }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="bootstrap-wizard-validation-gender">Nationality</label>
                            <select class="form-select" name="nationality_id" id="add_employee_nationality" required="required">
                                <option value="">Select ...</option>
                                @foreach ($nationalities as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->nationality }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->nationality }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-auto mb-3">
                            <div class="dz-preview dz-preview-single">
                                <div class="dz-preview-cover d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                    <div class="avatar avatar-4xl"><img id="showImage" class="rounded-circle avatar-placeholder" src="{{(!empty($emp->emp_files->file_name)) ? url($emp->emp_files->file_path.$emp->emp_files->file_name) : url('upload/no_image.jpg')}}" alt="..." data-dz-thumbnail="data-dz-thumbnail" /></div>
                                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input class="form-control form-control-sm" type="file" name="profile_image_name" id="profile_image_name" />
                        </div>
                    </div>
                </div>
                <!-- end of right div -->
            </div>
            <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary me-4" data-bs-dismiss="offcanvas"><?= get_label('close', 'Close') ?></label></button>
                <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
            </div>
        </form>

    </div>
</div>

<div class="offcanvas offcanvas-end w-70" data-bs-backdrop="static" id="edit_employee_modal" tabindex="-1" aria-labelledby="offcanvasWithBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title"><?= get_label('edit_employee', 'Edit employee') ?></h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_form" novalidate="" action="{{ route ('tracki.employee.update') }}" method="POST">
            @csrf
            <div id="employeeEditView"></div>
        </form>
    </div>
</div>

<div class="offcanvas offcanvas-end w-70" data-bs-backdrop="static" id="duplicate_employee_modal" tabindex="-1" aria-labelledby="offcanvasWithBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="duplicate_employee_modal_label"><?= get_label('dublicate_employee', 'Duplicate employee') ?></h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form class="row g-3  px-3 needs-validation form-submit-event" id="duplicate_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST">
            @csrf
            <div id="employeeDuplicateView"></div>
        </form>
    </div>
</div>

@endif
<!-- end of offcanvaas modal -->

@if (Request::is('tracki/employeexxx'))
<div class="modal fade" id="add_employee_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-top modal-dialog-scrollable">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('add_employee', 'Add employee') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <div class="modal-body">
                <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST">
                    @csrf

                    <input type="hidden" id="add_employee_id_h" name="id" value="">
                    <input type="hidden" id="add_employee_table_h" name="table" value="employee_table">


                    <div class="row">
                        <!-- begining of left div -->
                        <div class="col-md-8">
                            <div class="mb-3 row">

                                <div class="col-md-6">
                                    <label class="form-label" for="inputAddress">Prefix</label>
                                    <select name="salutation" class="form-select" id="add_employee_salutation">
                                        <option selected="selected" value="">Select...</option>
                                        @foreach ($salutations as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Entity</label>
                                    <select class="form-select" name="entity_id" required>
                                        <option value="" selected>Select...</option>
                                        @foreach ($entities as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="inputEmail4">First Name</label>
                                    <input name="first_name" id="add_employee_first_name" class="form-control" type="text" placeholder="" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="inputEmail4">Middle Name</label>
                                    <input name="middle_name" id="add_employee_middle_name" class="form-control" type="text" placeholder="">
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="inputEmail4">Last Name</label>
                                    <input name="last_name" id="add_employee_last_name" class="form-control" type="text" placeholder="" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputEmail4">Personal Email</label>
                                    <input name="personal_email_address" id="add_employee_email_address" class="form-control" type="text" placeholder="" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputEmail4">Work Email</label>
                                    <input name="work_email_address" id="add_employee_email_address" class="form-control" type="text" placeholder="" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputEmail4">QID</label>
                                    <input name="national_identifier_number" class="form-control" type="text" maxlength="11" placeholder="" required="required">
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputEmail4">QID Expiry Date</label>
                                    <input class="form-control datetimepickerstarttoday" data-target="#floatingInputStartDate" name="civil_id_expiry" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputEmail4">Passport</label>
                                    <input name="passport_number" class="form-control" type="text" placeholder="" required="required">
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputEmail4">Passport Expiry Date</label>
                                    <input class="form-control datetimepickerstarttoday" data-target="#floatingInputStartDate" name="passport_expiry" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputEmail4">Job</label>
                                    <select class="form-select" name="designation_id" id="add_designation_id" required>
                                        <option value="">Select...</option>
                                        @foreach ($designations as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-6  mb-3">
                                    <label class="form-label" for="inputEmail4">Job Level</label>
                                    <select class="form-select" name="job_level_id" required>
                                        <option value="" selected>Select...</option>
                                        @foreach ($job_levels as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="phone_area_code">Code</label>
                                    <select class="form-select" name="phone_area_code" required="required">
                                        <option value="" selected>Select ...</option>
                                        @foreach ($countries as $key => $item )
                                        <option value="{{ $item->phonecode  }}">
                                            {{ $item->phonecode }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-4  mb-3">
                                    <label class="form-label" for="inputEmail4">Phone</label>
                                    <input name="phone_number" id="add_employee_phone_number" class="form-control" type="text" placeholder="" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="alt_area_code">Code</label>
                                    <select class="form-select" name="alt_area_code">
                                        <option value="" selected>Select ...</option>
                                        @foreach ($countries as $key => $item )
                                        <option value="{{ $item->phonecode  }}">
                                            {{ $item->phonecode }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-4  mb-3">
                                    <label class="form-label" for="inputEmail4">Alternate Phone</label>
                                    <input name="alt_phone_number" id="add_employee_alt_phone_number" class="form-control" type="text" placeholder="">
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Sponsorship Type</label>
                                    <select class="form-select" name="sponsorship_id" required="required">
                                        <option value="" selected>Select ...</option>
                                        @foreach ($contract_types as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-6  mb-3">
                                    <label class="form-label" for="inputEmail4">Sponsorship Name</label>
                                    <input name="sponsorship_name" id="add_sponsorship_name" class="form-control" type="text" placeholder="">
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Contract Type</label>
                                    <select class="form-select" name="contract_type_id" required="required">
                                        <option value="" selected>Select ...</option>
                                        @foreach ($contract_types as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Contact Start Date</label>
                                    <input class="form-control datetimepicker" id="edit_employee_date_of_hire" data-target="#floatingInputStartDate" name="contract_start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Contract End Date</label>
                                    <input class="form-control datetimepicker" id="edit_employee_join_date" data-target="#floatingInputStartDate" name="contract_end_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                            </div>
                        </div>
                        <!-- end of left div -->

                        <!-- begining of right div -->
                        <div class="col-md-4">
                            <div class="form-check form-switch mt-4 mb-4">
                                <input class="form-check-input" id="flexSwitchCheckDefault" name="manager_flag" value="Y" type="checkbox" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Manager?</label>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="bootstrap-wizard-validation-gender">Directorate</label>
                                <select class="form-select" name="directorate_id" required="required">
                                    <option value="" selected>Select ...</option>
                                    @foreach ($directorate as $key => $item )
                                    <option value="{{ $item->id  }}">
                                        {{ $item->title }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="inputEmail4">Department</label>
                                <select class="form-select" name="department_id" id="add_department_id" required>
                                    <option value="" selected>Select...</option>
                                    @foreach ($departments as $key => $item )
                                    <option value="{{ $item->id  }}">
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="bootstrap-wizard-validation-gender">Functioanl Area</label>
                                <select class="form-select" name="functional_area_id" required="required">
                                    <option value="">Select ...</option>
                                    @foreach ($functional as $key => $item )
                                    <option value="{{ $item->id  }}">
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>

                            <div class="mb-3 row">

                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Report to</label>
                                    <select class="form-select" name="reporting_to_id" id="add_employee_reporting_to_id" required="required">
                                        <option value="">Select ...</option>
                                        @foreach ($emps as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->first_name}} {{$item->last_name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->first_name}} {{$item->last_name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Gender</label>
                                    <select class="form-select" name="gender_id" id="add_employee_gender" required="required">
                                        <option value="">Select ...</option>
                                        @foreach ($genders as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Marital Status</label>
                                    <select class="form-select" name="marital_status_id" id="add_employee_marital_status" required="required">
                                        <option value="" selected>Select ...</option>
                                        @foreach ($marital_statuses as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="inputEmail4">Birth Date</label>
                                    <input class="form-control datetimepicker" id="add_employee_date_of_birth" data-target="#floatingInputStartDate" name="date_of_birth" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Country of birth</label>
                                    <select class="form-select" name="country_of_birth" id="add_employee_country_of_birth" required="required">
                                        <option value="" selected>Select ...</option>
                                        @foreach ($countries as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->country_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Nationality</label>
                                    <select class="form-select" name="nationality_id" id="add_employee_nationality" required="required">
                                        <option value="">Select ...</option>
                                        @foreach ($nationalities as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->nationality }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->nationality }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-auto mb-3">
                                    <div class="dz-preview dz-preview-single">
                                        <div class="dz-preview-cover d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                            <div class="avatar avatar-4xl"><img id="showImage" class="rounded-circle avatar-placeholder" src="{{(!empty($emp->emp_files->file_name)) ? url($emp->emp_files->file_path.$emp->emp_files->file_name) : url('upload/no_image.jpg')}}" alt="..." data-dz-thumbnail="data-dz-thumbnail" /></div>
                                            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input class="form-control form-control-sm" type="file" name="profile_image_name" id="profile_image_name" />
                                </div>
                            </div>
                        </div>
                        <!-- end of right div -->
                    </div>
                    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                        <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_employee_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('edit_employee', 'Edit employee') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_form" novalidate="" action="{{ route ('tracki.employee.update') }}" method="POST">
                @csrf
                <div id="employeeEditView"></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="duplicate_employee_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="duplicate_employee_modal_label"><?= get_label('dublicate_employee', 'Duplicate employee') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="duplicate_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST">
                @csrf
                <div id="employeeDuplicateView"></div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/employee/managers/timesheet*')||Request::is('tracki/payroll/timesheet*'))
<div class="offcanvas offcanvas-start" id="view_readonly_employee_timesheet_entry_modal" tabindex="-1" aria-labelledby="offcanvasWithBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="add_edit_project_modal_label"></h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="manager_timesheet_entries_readonly"></div>

    </div>
</div>
@endif

@if (Request::is('tracki/employee/timesheet/entries*'))
<div class="modal fade" id="edit_employee_timesheet_entry_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="mb-0"><?= get_label('edit_employee_bank', 'Edit Emergency Contact') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_timesheet_entry_form" novalidate="" action="{{ route ('tracki.employee.timesheet.entries.update') }}" method="POST">
                @csrf
                <input type="hidden" id="edit_employee_timesheet_entry_table_h" name="table" value="employee_timesheet_entry_table">
                <input type="hidden" id="edit_timesheet_entries_id" name="id" value="">


                <div class="modal-body">
                    <!-- <div class="row"> -->
                    <!-- begining of left div -->
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="inputEmail4">Day</label>
                            <input name="calendar_day" id="edit_calendar_day" class="form-control" type="text" placeholder="" disabled>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="inputEmail4"> Day Action <span class="text-danger">*</span></label>
                            <select class="form-select" name="day_action" id="edit_day_action" required>
                                <option value="" selected>Select...</option>
                                <option value="W"> Worked</option>
                                <option value="L"> Paid Leave</option>
                                <option value="U"> Unpaid Leave</option>
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <!-- </div> -->
                    </div>
                    <!-- end of left div -->
                    <!-- </div> -->
                    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/employee/timesheet') || Request::is('tracki/employee/profile*'))
<div class="modal fade" id="add_employee_timesheet_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('add_employee_timesheet', 'Add employee timesheet') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_timesheet_form" novalidate="" action="{{ route ('tracki.employee.timesheet.store') }}" method="POST">
                @csrf
                <input type="hidden" id="add_employee_timesheet_table_h" name="table" value="employee_timesheet_table">

                <div class="modal-body">
                    <div class="row">
                        <!-- begining of left div -->
                        <div class="col-md-12">
                            <!-- <div class="mb-3 row"> -->
                            @if(Request::is('tracki/employee/profile*')||auth()->user()->hasRole('User'))

                            @php
                            $employee_id = null;
                            @endphp

                            @foreach ($employees as $key => $item)
                            @php
                            $employee_id = $item->id;
                            @endphp
                            @endforeach
                            <input type="hidden" id="add_timesheet_employee_profile_id" name="employee_id" value="{{$emp->id??$employee_id}}">
                            @else
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="inputEmail4">Select Employee</label>
                                <select class="form-select" name="employee_id" required>
                                    <option value="" selected>Select employee...</option>
                                    @foreach ($employees as $key => $item )
                                    <option value="{{ $item->id  }}">
                                        {{ $item->full_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>
                            @endif

                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="inputEmail4">Select Month</label>
                                <select class="form-select" name="month_selected_id" required>
                                    <option value="" selected>Select month...</option>
                                    @foreach ($months_name as $key => $item )
                                    <option value="{{ $item->id}}">
                                        {{ $item->month_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="inputEmail4">Select Year</label>
                                <select class="form-select" name="year_selected" required>
                                    <option value="" selected>Select year...</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                </select>
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>
                            <!-- </div> -->
                        </div>
                        <!-- end of left div -->
                    </div>
                    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add_employee_profile_timesheet_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('add_employee_timesheet', 'Add employee timesheet') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_timesheet_profile_form" novalidate="" action="{{ route ('tracki.employee.timesheet.store') }}" method="POST">
                @csrf
                <input type="hidden" id="add_employee_timesheet_table_h" name="table" value="employee_timesheet_table">
                <input type="hidden" id="add_timesheet_employee_profile_id" name="employee_id" value="">

                <div class="modal-body">
                    <!-- <div class="row"> -->
                    <!-- begining of left div -->
                    <div class="col-md-12">
                        <!-- <div class="mb-3 row"> -->

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Select Month</label>
                            <select class="form-select" name="month_selected_id" required>
                                <option value="" selected>Select month...</option>
                                @foreach ($months_name as $key => $item )
                                <option value="{{ $item->id}}">
                                    {{ $item->month_name }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Select Year</label>
                            <select class="form-select" name="year_selected" required>
                                <option value="" selected>Select year...</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <!-- </div> -->
                    </div>
                    <!-- end of left div -->
                    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_employee_timesheet_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('edit_employee_timesheet', 'Edit employee timesheet') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_timesheet_form" novalidate="" action="{{ route ('tracki.employee.timesheet.update') }}" method="POST">
                @csrf
                <div id="employeeTimeSheetEditView"></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="timesheetStatusModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Change Timesheet Status</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" novalidate="" action="{{route('tracki.employee.timesheet.status.update')}}" method="POST" id="change_timesheet_status">
                <!-- <form class="needs-validation" novalidate="" action="{{url('/tracki/leave/status/update')}}" method="POST" id="leave_status"> -->
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <!-- <div class="row g-4"> -->
                        <div class="col-lg-12">
                            <input type="hidden" id="editTimesheetId" name="id">
                            <input type="hidden" id="timesheetStatusParentTable" name="table">
                            <div class="mb-4">
                                <label class="text-1000 fw-bold mb-2">Status</label>
                                <select name="status_id" class="form-select" id="editTimesheetStatusSelection" required>
                                    <option selected="selected" value="">Select</option>
                                    @foreach ($employee_leave_statuses as $key => $item )
                                    <option value="{{ $item->id  }}">
                                        {{ $item->title }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <input class="form-control" type="number" max="100" min="0" name="prorgress_number" id="editPoregessNumber" required /> -->
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="inputEmail4">Additional Information</label>
                            <input name="additional_information" id="edit_timesheet_status_additional_information" class="form-control" type="text" placeholder="">
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


@if (Request::is('tracki/employee/salary') || Request::is('tracki/employee/profile*'))
<div class="modal fade" id="add_employee_salary_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('add_employee_salary', 'Add employee salary') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.salary.store') }}" method="POST">
                @csrf
                <input type="hidden" id="add_employee_salary_table_h" name="table" value="employee_salary_table">

                <div class="modal-body">
                    <div class="row">
                        <!-- begining of left div -->
                        <div class="col-md-12">
                            <!-- <div class="mb-3 row"> -->

                            @if(Request::is('tracki/employee/profile*'))
                            <input type="hidden" name="employee_id" value="{{$emp->id}}">
                            @else
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="inputEmail4">Select Employee <span class="text-danger">*</span></label>
                                <select class="form-select" name="employee_id" required>
                                    <option value="" selected>Select...</option>
                                    @foreach ($employees as $key => $item )
                                    <option value="{{ $item->id  }}">
                                        {{ $item->full_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>
                            @endif

                            <div class="col-md-12">
                                <label class="form-label" for="inputEmail4">Net salary</label>
                                <input name="net_salary" id="add_net_salary" class="form-control" type="text" placeholder="">
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>
                            <!-- </div> -->
                        </div>
                        <!-- end of left div -->
                    </div>
                    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_employee_salary_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('edit_employee_salary', 'Edit employee salary') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_salary_form" novalidate="" action="{{ route ('tracki.employee.salary.update') }}" method="POST">
                @csrf
                <div id="employeeSalaryEditView"></div>
            </form>
        </div>
    </div>
</div>
@endif


@if (Request::is('tracki/employee/managers/leave'))
<div class="modal fade" id="leaveStatusModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Change Leave Status</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" novalidate="" action="{{route('tracki.employee.leave.status.update')}}" method="POST" id="change_leave_status">
                <!-- <form class="needs-validation" novalidate="" action="{{url('/tracki/leave/status/update')}}" method="POST" id="leave_status"> -->
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="col-lg-12">
                            <input type="hidden" id="editLeaveId" name="id">
                            <input type="hidden" id="leaveStatusParentTable" name="table">
                            <div class="mb-4">
                                <label class="text-1000 fw-bold mb-2">Status</label>
                                <select name="status_id" class="form-select" id="editLeaveStatusSelection" required>
                                    <option selected="selected" value="">Select</option>
                                    @foreach ($employee_leave_statuses as $key => $item )
                                    <option value="{{ $item->id  }}">
                                        {{ $item->title }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <input class="form-control" type="number" max="100" min="0" name="prorgress_number" id="editPoregessNumber" required /> -->
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="inputEmail4">Additional Information</label>
                                <input name="additional_information" id="edit_leave_status_additional_information" class="form-control" type="text" placeholder="">
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/employee/managers/timesheet'))
<div class="modal fade" id="timesheetStatusModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Change Timesheet Status</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" novalidate="" action="{{route('tracki.employee.timesheet.status.update')}}" method="POST" id="change_timesheet_status">
                <!-- <form class="needs-validation" novalidate="" action="{{url('/tracki/leave/status/update')}}" method="POST" id="leave_status"> -->
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <!-- <div class="row g-4"> -->
                        <div class="col-lg-12">
                            <input type="hidden" id="editTimesheetId" name="id">
                            <input type="hidden" id="timesheetStatusParentTable" name="table">
                            <div class="mb-4">
                                <label class="text-1000 fw-bold mb-2">Status</label>
                                <select name="status_id" class="form-select" id="editTimesheetStatusSelection" required>
                                    <option selected="selected" value="">Select</option>
                                    @foreach ($employee_leave_statuses as $key => $item )
                                    <option value="{{ $item->id  }}">
                                        {{ $item->title }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <input class="form-control" type="number" max="100" min="0" name="prorgress_number" id="editPoregessNumber" required /> -->
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="inputEmail4">Additional Information</label>
                            <input name="additional_information" id="edit_timesheet_status_additional_information" class="form-control" type="text" placeholder="">
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@if (Request::is('tracki/employee/leave') || Request::is('tracki/employee/profile*'))
<div class="modal fade" id="add_employee_leave_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('add_employee_leave', 'Add employee leave') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.leave.store') }}" method="POST" enctype='multipart/form-data'>
                @csrf
                <input type="hidden" id="add_employee_leave_table_h" name="table" value="employee_leave_table">

                <div class="modal-body">
                    <!-- <div class="row"> -->
                    <!-- begining of left div -->
                    <div class="col-md-12">
                        <!-- <div class="mb-3 row"> -->

                        @if(Request::is('tracki/employee/profile*')||auth()->user()->hasRole('User'))

                        @php
                        $employee_id = null;
                        @endphp

                        @foreach ($employees as $key => $item)
                        @php
                        $employee_id = $item->id;
                        @endphp
                        @endforeach


                        <input type="hidden" id="add_employee_leave_table_h" name="employee_id" value="{{$emp->id?? $employee_id}}">
                        @else
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Select Employee <span class="text-danger">*</span></label>
                            <select class="form-select" name="employee_id" required>
                                <option value="" selected>Select...</option>
                                @foreach ($employees as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->full_name }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        @endif

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Select Leave Type <span class="text-danger">*</span></label>
                            <select class="form-select" name="leave_type_id" id="leave_type_selection" required>
                                <option value="" selected>Select...</option>
                                @foreach ($employee_leave_types as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">From <span class="text-danger">*</span></label>
                            <input class="form-control datetimepicker" name="date_from" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">To <span class="text-danger">*</span></label>
                            <input class="form-control datetimepicker" name="date_to" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="text-1000 fw-bold mb-2">Name</label>
                            <input class="form-control" type="file" name="leave_file_name" id="leave_file_name" required disabled />
                        </div>

                        <div class="col-md-12">
                            <label class="form-label" for="gridCheck">Leave Reason <span class="text-danger">*</span></label>
                            <textarea style="height: 100px;" required name="reason" class="form-control tinymce1" data-tinymce="{}" placeholder=""></textarea>
                        </div>

                        <!-- </div> -->
                    </div>
                    <!-- end of left div -->
                    <!-- </div> -->
                    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_employee_leave_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('edit_employee_leave', 'Edit employee leave') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_leave_form" novalidate="" action="{{ route ('tracki.employee.leave.update') }}" method="POST">
                @csrf
                <div id="employeeLeaveEditView"></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="leaveStatusModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Change Leave Status</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" novalidate="" action="{{route('tracki.employee.leave.status.update')}}" method="POST" id="change_leave_status">
                <!-- <form class="needs-validation" novalidate="" action="{{url('/tracki/leave/status/update')}}" method="POST" id="leave_status"> -->
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="col-lg-12">
                            <input type="hidden" id="editLeaveId" name="id">
                            <input type="hidden" id="leaveStatusParentTable" name="table">
                            <div class="mb-4">
                                <label class="text-1000 fw-bold mb-2">Status</label>
                                <select name="status_id" class="form-select" id="editLeaveStatusSelection" required>
                                    <option selected="selected" value="">Select</option>
                                    @foreach ($employee_leave_statuses as $key => $item )
                                    <option value="{{ $item->id  }}">
                                        {{ $item->title }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <input class="form-control" type="number" max="100" min="0" name="prorgress_number" id="editPoregessNumber" required /> -->
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="inputEmail4">Additional Information</label>
                                <input name="additional_information" id="edit_leave_status_additional_information" class="form-control" type="text" placeholder="">
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="show_leave_balance_modal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('leave_balance', 'Leave Balance for ') ?>{{now()->format('M, Y')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <div id="leave_balance_view"></div>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/employee/bank') || Request::is('tracki/employee/profile*'))
<div class="modal fade" id="add_employee_bank_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('add_employee_bank', 'Add employee bank') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.bank.store') }}" method="POST">
                @csrf
                <input type="hidden" id="add_employee_bank_table_h" name="table" value="employee_bank_table">

                <div class="modal-body">
                    <!-- <div class="row"> -->
                    <!-- begining of left div -->
                    <div class="col-md-12">
                        <!-- <div class="mb-3 row"> -->

                        @if(Request::is('tracki/employee/profile*'))
                        <input type="hidden" name="employee_id" value="{{$emp->id}}">
                        @else
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Select Employee <span class="text-danger">*</span></label>
                            <select class="form-select" name="employee_id" required>
                                <option value="" selected>Select...</option>
                                @foreach ($employees as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->full_name }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        @endif

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Bank Branch Name</label>
                            <input name="bank_branch_name" id="add_net_salary" class="form-control" type="text" placeholder="" required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Bank Account Name</label>
                            <input name="bank_account_name" id="add_net_salary" class="form-control" type="text" placeholder="" required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">IBAN</label>
                            <input name="iban" id="add_net_salary" class="form-control" type="text" placeholder="" maxlength="29" required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Swift Code</label>
                            <input name="swift_code" id="add_net_salary" class="form-control" type="text" placeholder="" maxlength="8" required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <!-- </div> -->
                    </div>
                    <!-- end of left div -->
                    <!-- </div> -->
                    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_employee_bank_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('edit_employee_bank', 'Edit employee bank') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_bank_form" novalidate="" action="{{ route ('tracki.employee.bank.update') }}" method="POST">
                @csrf
                <div id="employeeBankEditView"></div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/employee/emergency') || Request::is('tracki/employee/profile*'))
<div class="modal fade" id="add_employee_emergency_contact_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('add_employee_bank', 'Add Emergency Contact') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_emergency_form" novalidate="" action="{{ route ('tracki.employee.emergency.store') }}" method="POST">
                @csrf
                <input type="hidden" id="add_employee_emergency_table_h" name="table" value="employee_emergency_table">

                <div class="modal-body">
                    <!-- <div class="row"> -->
                    <!-- begining of left div -->
                    <div class="col-md-12">
                        <!-- <div class="mb-3 row"> -->

                        @if(Request::is('tracki/employee/profile*')||auth()->user()->hasRole('User'))
                        @php
                            $employee_id = null;
                        @endphp
                        @foreach ($employees as $key => $item)
                        @php
                        $employee_id = $item->id;
                        @endphp
                        @endforeach
                        <input type="hidden" name="employee_id" value="{{$emp->id??$employee_id}}">
                        @else
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Select Employee <span class="text-danger">*</span></label>
                            <select class="form-select" name="employee_id" required>
                                <option value="" selected>Select...</option>
                                @foreach ($employees as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->full_name }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        @endif

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">First Name</label>
                            <input name="first_name" id="first_name" class="form-control" type="text" placeholder="" required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Last Name</label>
                            <input name="last_name" id="last_name" class="form-control" type="text" placeholder="" required>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4"> Relationship <span class="text-danger">*</span></label>
                            <select class="form-select" name="relationship_id" required>
                                <option value="" selected>Select...</option>
                                @foreach ($relationships as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Contact Number</label>
                            <input name="contact_number" class="form-control" type="text" placeholder="">
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <!-- </div> -->
                    </div>
                    <!-- end of left div -->
                    <!-- </div> -->
                    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_employee_emergency_contact_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="mb-0"><?= get_label('edit_employee_bank', 'Edit Emergency Contact') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_emergency_form" novalidate="" action="{{ route ('tracki.employee.emergency.update') }}" method="POST">
                @csrf
                <input type="hidden" id="edit_employee_emergency_table_h" name="table" value="employee_emergency_table">
                <input type="hidden" id="edit_employee_emergency_id" name="id" value="">

                <div class="modal-body">
                    <!-- <div class="row"> -->
                    <!-- begining of left div -->
                    <div class="col-md-12">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">First Name</label>
                            <input name="first_name" id="edit_first_name" class="form-control" type="text" placeholder="">
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Last Name</label>
                            <input name="last_name" id="edit_last_name" class="form-control" type="text" placeholder="">
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4"> Relationship <span class="text-danger">*</span></label>
                            <select class="form-select" name="relationship_id" id="edit_relationship_id" required>
                                <option value="" selected>Select...</option>
                                @foreach ($relationships as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="inputEmail4">Contact Number</label>
                            <input name="contact_number" id="edit_contact_number" class="form-control" type="text" placeholder="">
                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                        </div>
                        <!-- </div> -->
                    </div>
                    <!-- end of left div -->
                    <!-- </div> -->
                    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/employee/address') || Request::is('tracki/employee/profile*'))
<div class="modal fade" id="add_employee_address_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content ">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_employee_address_modal_label"><?= get_label('add_employee_address', 'Add employee address') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_address_form" novalidate="" action="{{ route ('tracki.employee.address.store') }}" method="POST">
                @csrf

                <input type="hidden" id="add_employee_id_h" name="id" value="{{$emp->id}}">
                <input type="hidden" id="add_employee_address_table_h" name="table" value="employee_address_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="inputEmail4">Address Type</label>
                                <select class="form-select" name="employee_address_type" id="employee_address_type_id" required>
                                    <option value="" selected>Select...</option>
                                    @foreach ($address_types as $key => $item )
                                    <option value="{{ $item->id  }}">
                                        {{ $item->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="inputEmail4">Address1</label>
                                <input name="employee_address1" id="add_employee_address1" class="form-control" type="text" placeholder="" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="inputEmail4">Address2</label>
                                <input name="employee_address2" id="add_employee_address2" class="form-control" type="text" placeholder="Address2">
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="form-label" for="inputEmail4">City</label>
                                    <input name="employee_city" id="add_employee_city" class="form-control" type="text" placeholder="City" required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label" for="inputEmail4">State</label>
                                    <input name="employee_state" id="add_employee_state" class="form-control" type="text" placeholder="State">
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label" for="inputEmail4">Zipcode</label>
                                    <input name="employee_zipcode" id="add_employee_zipcode" class="form-control" type="text" placeholder="00000" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="inputEmail4">Country</label>
                                <select class="form-select" name="employee_address_country" id="add_employee_address_country_id" required>
                                    <option value="">Select...</option>
                                    @foreach ($countries as $key => $item )
                                    @if (Request::old('id') == $item->id )
                                    <option value="{{ $item->id  }}" selected>
                                        {{ $item->country_name }}
                                    </option>
                                    @else
                                    <option value="{{ $item->id  }}">
                                        {{ $item->country_name }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="flexCheckDefault" name="primary_address" type="checkbox" value="Y" />
                                <label class="form-check-label" for="flexCheckDefault">Primary address</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_employee_address_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_employee_address_modal_label"><?= get_label('edit_employee_address', 'Edit employee_address') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_address_form" novalidate="" action="{{ route ('tracki.employee.address.update') }}" method="POST">
                @csrf
                <div id="employee_addressEditView"></div>
            </form>
        </div>
    </div>
</div>
@endif



@if ((Request::is('xxxtracki/project/*') || Request::is('xxxtracki/users/create-new') || Request::is('xxxtracki/task/*/list')) && !Request::is('xxxtracki/project/archive'))
<div class="offcanvas offcanvas-start w-50" id="offcanvasAddEditProject" tabindex="-1" aria-labelledby="offcanvasWithBackdropLabel">

    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="add_edit_project_modal_label">Create new project</h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <?php
        $workspace_id = session()->get('workspace_id');
        $is_workspace_id_set = ($workspace_id) ? true : false;
        ?>
        <!-- <h4 class="mb-3">Information </h4> -->
        <form class="row g-3 needs-validation form-submit-event" id="add_edit_project_form" novalidate="" action="{{ route ('tracki.project.create') }}" method="POST">
            @csrf

            <input type="hidden" name="id" id="add_edit_project_id_h" value="">
            <input type="hidden" name="table" id="add_edit_project_table_h" value="task_table">
            <input type="hidden" name="redirect" id="add_edit_project_redirect_h" value="">

            @if (!$is_workspace_id_set)
            <div class="col-12">
                <!-- <label class="form-label" for="inputAddress">Workspace</label> -->
                <label class="col-sm-2 col-form-label col-form-label-sm" for="colFormLabelSm">Workspace</label>
                <select name="workspace_id" class="form-select" id="add_edit_project_workspace_id" required style="background-color: #ADC5FF;">
                    <option selected="selected" value="">Select...</option>
                    @foreach ($workspaces as $key => $item )
                    <option value="{{ $item->id  }}">
                        {{ $item->title }}
                    </option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="col-12 gy-6">
                <div class="form-floating form-floating-advance-select">
                    <label>Add tags</label>
                    <select class="form-select" id="organizerMultiple" data-choices="data-choices" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                        <option selected="selected">Stupidity</option>
                        <option>Jerry</option>
                        <option>Not_the_mouse</option>
                        <option>Brainlessness</option>
                    </select>
                </div>
            </div>
            <div class="col-12 gy-6">
                <label for="organizerMultiple">Multiple</label>
                <select class="form-select" id="organizerMultiple" data-choices="data-choices" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                    <option value="">Select organizer...</option>
                    <option>Massachusetts Institute of Technology</option>
                    <option>University of Chicago</option>
                    <option>GSAS Open Labs At Harvard</option>
                    <option>California Institute of Technology</option>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="inputEmail4">Title</label>
                <input name="name" id="add_edit_project_name" class="form-control" type="text" placeholder="" required>
            </div>
            <div class="col-12">
                <label class="form-label" for="inputAddress2">Tags (multiple)</label>

                <select required class="form-select js-example-basic-multiple" id="add_edit_project_tag" name="tag_id[]" multiple="multiple" data-with="100%" data-placeholder="<?= get_label('Tags', 'Tags') ?>">
                    <!-- <select name="assignment_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required> -->
                    <option value="">Select tag</option>
                    @foreach ($tags as $key => $item )
                    <option value="{{ $item->id  }}">
                        {{ $item->title }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Project type</label>
                <select name="project_type_id" class="form-select" id="add_edit_project_project_type" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($project_type as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Category</label>
                <select name="category_id" class="form-select" id="add_edit_project_category" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($event_category as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Audience</label>
                <select name="audience_id" class="form-select" id="add_edit_project_audience" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($event_audience as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Client</label>
                <select name="client_id" class="form-select" id="add_edit_project_client" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($clients as $key => $item )
                    <option value="{{ $item->id  }}">
                        {{ $item->first_name.' '.$item->last_name}}
                    </option>
                    @endforeach
                </select>
            </div>


            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Venue</label>
                <select name="venue_id" class="form-select" id="add_edit_project_venue" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($event_venue as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Location</label>
                <select name="location_id" class="form-select" id="add_edit_project_location" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($event_location as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Fund</label>
                <select name="fund_category_id" class="form-select" id="add_edit_project_fund" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($fund_category as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Budget</label>
                <select name="budget_name_id" class="form-select" id="add_edit_project_budget" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($budget_name as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <!-- <h4 class="mt-6">Schedule</h4> -->
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">Start Date</label>
                <input class="form-control datetimepicker" id="add_edit_project_start_date" data-target="#floatingInputStartDate" name="start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">End Date</label>
                <input class="form-control datetimepicker" id="add_edit_project_end_date" data-target="#floatingInputStartDate" name="end_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>
            <!-- <h4 class="mt-6">Other Information</h4> -->
            <div class="col-md-6">
                <label class="form-label" for="inputCity">Budget allocated</label>
                <input name="budget_allocation" class="form-control" id="add_edit_project_budget_allocation" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputState">Attendance forcast</label>
                <input name="attendance_forcast" class="form-control" id="add_edit_project_attendance" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="gridCheck">Description</label>
                <textarea required name="description" class="form-control tinymce" id="add_edit_project_description" data-tinymce="{}" placeholder=""></textarea>
            </div>
            <div class="col-12 d-flex justify-content-end mt-6">
                <button class="btn btn-phoenix-secondary action button-submit" type="submit" value="save" id="submit_btn">Save</button>
                <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                <!-- <a class="btn btn-phoenix-danger me-2 px-6" href="#">Cancel</a> -->
                <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
            </div>
        </form>

    </div>
</div>
@endif

@if (Request::is('tracki/setting/address_type*'))
<div class="modal fade" id="create_address_type_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_address_type', 'Create Address Type') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_address_type_form" novalidate="" action="{{ route('tracki.setting.address_type.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="address_type_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="address_type_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_address_type_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_address_type_form" novalidate="" action="{{ route('tracki.setting.address_type.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_address_type_id" name="id" value="">
                <input type="hidden" id="edit_address_type_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_address_type_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_address_type_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('active_flag', 'Activ flag') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="edit_address_type_active_flag" name="active_flag">
                                <option>Select ...</option>
                                <option value="0">In Active</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/gender*'))
<div class="modal fade" id="create_gender_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_gender', 'Create Gender') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_gender_form" novalidate="" action="{{ route('tracki.setting.gender.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="gender_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="gender_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_gender_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_gender_form" novalidate="" action="{{ route('tracki.setting.gender.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_gender_id" name="id" value="">
                <input type="hidden" id="edit_gender_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_gender_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_gender_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/invoice/notes*'))
<div class="modal fade" id="create_invoice_notes_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_invoice_notes', 'Create Gender') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_invoice_notes_form" novalidate="" action="{{ route('tracki.setting.invoice.notes.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="invoice_notes_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="invoice_notes_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_invoice_notes_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit Invoice Notes</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_invoice_notes_form" novalidate="" action="{{ route('tracki.setting.invoice.notes.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_invoice_notes_id" name="id" value="">
                <input type="hidden" id="edit_invoice_notes_table" name="table" value="">

                <div class="modal-body">

                    <div class="col-md-12 mb-3">
                        <label for="edit_invoice_notes_note_1" class="form-label"><?= get_label('note', 'Note 1') ?> <span class="asterisk">*</span></label>
                        <input type="text" id="edit_invoice_notes_note_1" class="form-control" name="note_1" required placeholder="<?= get_label('please_enter_note', 'Please enter note') ?>" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="edit_invoice_notes_note_2" class="form-label"><?= get_label('note', 'Note 2') ?> <span class="asterisk">*</span></label>
                        <input type="text" id="edit_invoice_notes_note_2" class="form-control" name="note_2" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/marital*'))
<div class="modal fade" id="create_marital_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_marital', 'Create Marital Status') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_marital_form" novalidate="" action="{{ route('tracki.setting.marital.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="marital_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="marital_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_marital_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_marital_form" novalidate="" action="{{ route('tracki.setting.marital.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_marital_id" name="id" value="">
                <input type="hidden" id="edit_marital_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_marital_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_marital_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/entities*'))
<div class="modal fade" id="create_entity_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_entity', 'Create Entity') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_entity_form" novalidate="" action="{{ route('tracki.setting.entities.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="entity_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="entity_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_entity_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_entity_form" novalidate="" action="{{ route('tracki.setting.entities.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_entity_id" name="id" value="">
                <input type="hidden" id="edit_entity_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_entity_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_entity_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/element/classifications*'))
<div class="modal fade" id="create_element_classificaiton_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_element_classification', 'Create Element Classification') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_element_classification_form" novalidate="" action="{{ route('tracki.setting.element.classifications.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="element_classificaiton_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="entity_name" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_element_classificaiton_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_element_classificaiton_form" novalidate="" action="{{ route('tracki.setting.element.classifications.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_element_classificaiton_id" name="id" value="">
                <input type="hidden" id="edit_element_classificaiton_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="edit_element_classificaiton_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_element_classificaiton_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/element*'))
<div class="modal fade" id="create_element_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_element', 'Create Element') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_element_form" novalidate="" action="{{ route('tracki.setting.element.store') }}" method="POST">
                @csrf
                <input type="hidden" name="table" value="element_table">

                <div class="modal-body">

                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="inputAddress">Classification</label>
                        <select name="element_classification_id" class="form-select" id="add_element_classification_id" required>
                            <option selected="selected" value="">Select...</option>
                            @foreach ($element_classifications as $key => $item )
                            <option value="{{ $item->id  }}" selected>
                                {{ $item->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="entity_name" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="inputAddress">Type</label>
                            <select name="input_type_id" class="form-select" id="add_element_classification_id" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($input_types as $key => $item )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="entity_name" class="form-label"><?= get_label('value', 'Value') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="input_value" required placeholder="<?= get_label('please_enter_value', 'Please enter value') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_element_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit Element</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_element_form" novalidate="" action="{{ route('tracki.setting.element.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_element_id" name="id" value="">
                <input type="hidden" id="edit_element_table" name="table" value="">

                <div class="modal-body">

                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="inputAddress">Classification</label>
                        <select name="element_classification_id" class="form-select" id="edit_element_classification_id" required>
                            <option selected="selected" value="">Select...</option>
                            @foreach ($element_classifications as $key => $item )
                            <option value="{{ $item->id  }}" selected>
                                {{ $item->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="entity_name" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" class="form-control" name="title" id="edit_element_title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="inputAddress">Type</label>
                            <select name="input_type_id" class="form-select" id="edit_element_input_type_id" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($input_types as $key => $item )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="entity_name" class="form-label"><?= get_label('value', 'Value') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="input_value" id="edit_element_input_value" required placeholder="<?= get_label('please_enter_value', 'Please enter value') ?>" />
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/directorates*'))
<div class="modal fade" id="create_directorate_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_directorate', 'Create Directorate') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_directorate_form" novalidate="" action="{{ route('tracki.setting.directorates.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="directorate_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="directorate_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_directorate_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_directorate_form" novalidate="" action="{{ route('tracki.setting.directorates.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_directorate_id" name="id" value="">
                <input type="hidden" id="edit_directorate_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_directorate_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_directorate_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/relationships*'))
<div class="modal fade" id="create_relationship_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_relationship', 'Create Directorate') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_relationship_form" novalidate="" action="{{ route('tracki.setting.relationships.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="relationship_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="relationship_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_relationship_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_relationship_form" novalidate="" action="{{ route('tracki.setting.relationships.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_relationship_id" name="id" value="">
                <input type="hidden" id="edit_relationship_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_relationship_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_relationship_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/leave_types*'))
<div class="modal fade" id="create_leave_type_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_leave_type', 'Create Directorate') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_leave_type_form" novalidate="" action="{{ route('tracki.setting.leave_types.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="leave_type_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="leave_type_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_leave_type_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_leave_type_form" novalidate="" action="{{ route('tracki.setting.leave_types.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_leave_type_id" name="id" value="">
                <input type="hidden" id="edit_leave_type_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_leave_type_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_leave_type_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('active_flag', 'Activ flag') ?> <span class="asterisk">*</span></label>
                        <select class="form-select" id="edit_leave_type_active_flag" name="active_flag">
                            <option>Select ...</option>
                            <option value="0">In Active</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/countries*'))
<div class="modal fade" id="create_country_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_country', 'Create Countries') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_country_form" novalidate="" action="{{ route('tracki.setting.countries.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="country_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="country_name" class="form-label"><?= get_label('name', 'Country Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="country_name" required placeholder="<?= get_label('please_enter_name', 'Please enter country name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_country_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_country_form" novalidate="" action="{{ route('tracki.setting.countries.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_country_id" name="id" value="">
                <input type="hidden" id="edit_country_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_country_country_name" class="form-label"><?= get_label('country_name', 'Country Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_country_country_name" class="form-control" name="country_name" required placeholder="<?= get_label('please_enter_country_name', 'Please enter country name') ?>" />
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/nationalities*'))
<div class="modal fade" id="create_nationality_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_nationality', 'Create Nationality') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_nationality_form" novalidate="" action="{{ route('tracki.setting.nationalities.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="nationality_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nationality_name" class="form-label"><?= get_label('name', 'Nationality') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="nationality" required placeholder="<?= get_label('please_enter_name', 'Please enter nationality') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_nationality_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_nationality_form" novalidate="" action="{{ route('tracki.setting.nationalities.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_nationality_id" name="id" value="">
                <input type="hidden" id="edit_nationality_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_nationality_nationality_name" class="form-label"><?= get_label('nationality_name', 'Nationality') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_nationality_nationality_name" class="form-control" name="nationality" required placeholder="<?= get_label('please_enter_country_name', 'Please enter country name') ?>" />
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


@if (Request::is('tracki/setting/job_level*'))
<div class="modal fade" id="create_job_level_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_job_level', 'Create Job Level') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_job_level_form" novalidate="" action="{{ route('tracki.setting.job_level.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="job_level_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="job_level_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_job_level_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_job_level_form" novalidate="" action="{{ route('tracki.setting.job_level.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_job_level_id" name="id" value="">
                <input type="hidden" id="edit_job_level_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_job_level_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_job_level_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('active_flag', 'Activ flag') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="edit_job_level_active_flag" name="active_flag">
                                <option>Select ...</option>
                                <option value="0">In Active</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/sponsorship*'))
<div class="modal fade" id="create_sponsorship_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_sponsorship', 'Create Sponsorship') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_sponsorship_form" novalidate="" action="{{ route('tracki.setting.sponsorship.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="sponsorship_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="sponsorship_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_sponsorship_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_sponsorship_form" novalidate="" action="{{ route('tracki.setting.sponsorship.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_sponsorship_id" name="id" value="">
                <input type="hidden" id="edit_sponsorship_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_sponsorship_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_sponsorship_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('active_flag', 'Activ flag') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="edit_sponsorship_active_flag" name="active_flag">
                                <option>Select ...</option>
                                <option value="0">In Active</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/contract_type*'))
<div class="modal fade" id="create_contract_type_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_contract_type', 'Create contract_type') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_contract_type_form" novalidate="" action="{{ route('tracki.setting.contract_type.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="contract_type_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="contract_type_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_contract_type_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_contract_type_form" novalidate="" action="{{ route('tracki.setting.contract_type.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_contract_type_id" name="id" value="">
                <input type="hidden" id="edit_contract_type_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="edit_contract_type_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_contract_type_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('active_flag', 'Activ flag') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="edit_contract_type_active_flag" name="active_flag">
                                <option>Select ...</option>
                                <option value="0">In Active</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/status/*'))
<div class="modal fade" id="create_status_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_status', 'Create status') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_status_form" novalidate="" action="{{ route('tracki.setup.status.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="status_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="status_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="addTitle" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="color" name="color">
                                <option class="badge badge-phoenix badge-phoenix-primary" value="primary"><?= get_label('primary', 'Primary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-secondary" value="secondary"><?= get_label('secondary', 'Secondary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-success" value="success"><?= get_label('success', 'Success') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-danger" value="danger"><?= get_label('danger', 'Danger') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-warning" value="warning"><?= get_label('warning', 'Warning') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-info" value="info"><?= get_label('info', 'Info') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-dark" value="dark"><?= get_label('dark', 'Dark') ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_status_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_status_form" novalidate="" action="{{ route('tracki.setup.status.update') }}" method="POST">
                @csrf

                <input type="hidden" id="status_id" name="id" value="">
                <input type="hidden" id="edit_status_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="status_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="status_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="status_color" name="color">
                                <option class="badge badge-phoenix badge-phoenix-primary" value="primary"><?= get_label('primary', 'Primary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-secondary" value="secondary"><?= get_label('secondary', 'Secondary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-success" value="success"><?= get_label('success', 'Success') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-danger" value="danger"><?= get_label('danger', 'Danger') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-warning" value="warning"><?= get_label('warning', 'Warning') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-info" value="info"><?= get_label('info', 'Info') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-dark" value="dark"><?= get_label('dark', 'Dark') ?></option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/priority/*'))
<div class="modal fade" id="create_priority_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_priority', 'Create priority') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="create_priority_form" novalidate="" action="{{ route('tracki.setup.priority.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="priority_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="priority_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="addTitle" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="color" name="color">
                                <option class="badge badge-phoenix badge-phoenix-primary" value="primary"><?= get_label('primary', 'Primary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-secondary" value="secondary"><?= get_label('secondary', 'Secondary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-success" value="success"><?= get_label('success', 'Success') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-danger" value="danger"><?= get_label('danger', 'Danger') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-warning" value="warning"><?= get_label('warning', 'Warning') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-info" value="info"><?= get_label('info', 'Info') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-dark" value="dark"><?= get_label('dark', 'Dark') ?></option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_priority_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_priority_form" novalidate="" action="{{ route('tracki.setup.priority.update') }}" method="POST">
                @csrf

                <input type="hidden" id="priority_id" name="id" value="">
                <input type="hidden" id="edit_priority_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="priority_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="priority_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="priority_color" name="color">
                                <option class="badge badge-phoenix badge-phoenix-primary" value="primary"><?= get_label('primary', 'Primary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-secondary" value="secondary"><?= get_label('secondary', 'Secondary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-success" value="success"><?= get_label('success', 'Success') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-danger" value="danger"><?= get_label('danger', 'Danger') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-warning" value="warning"><?= get_label('warning', 'Warning') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-info" value="info"><?= get_label('info', 'Info') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-dark" value="dark"><?= get_label('dark', 'Dark') ?></option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('home') || Request::is('todos'))
<div class="modal fade" id="create_todo_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content form-submit-event" action="{{url('/todos/store')}}" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_todo', 'Create todo') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('priority', 'Priority') ?> <span class="asterisk">*</span></label>
                        <select class="form-select" name="priority">
                            <option value="low" {{ old('priority') == "low" ? "selected" : "" }}><?= get_label('low', 'Low') ?></option>
                            <option value="medium" {{ old('priority') == "medium" ? "selected" : "" }}><?= get_label('medium', 'Medium') ?></option>
                            <option value="high" {{ old('priority') == "high" ? "selected" : "" }}><?= get_label('high', 'High') ?></option>
                        </select>
                    </div>
                </div>
                <label for="description" class="form-label"><?= get_label('description', 'Description') ?></label>
                <textarea class="form-control" name="description" placeholder="<?= get_label('please_enter_description', 'Please enter description') ?>"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?>
                </button>
                <button type="submit" id="submit_btn" class="btn btn-primary"><?= get_label('create', 'Create') ?></button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_todo_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{url('/todos/update')}}" class="modal-content form-submit-event" method="POST">
            <input type="hidden" name="id" id="todo_id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('update_todo', 'Update todo') ?></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" id="todo_title" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('priority', 'Priority') ?> <span class="asterisk">*</span></label>
                        <select class="form-select" id="todo_priority" name="priority">
                            <option value="low"><?= get_label('low', 'Low') ?></option>
                            <option value="medium"><?= get_label('medium', 'Medium') ?></option>
                            <option value="high"><?= get_label('high', 'High') ?></option>
                        </select>
                    </div>
                </div>
                <label for="description" class="form-label"><?= get_label('description', 'Description') ?></label>
                <textarea class="form-control" id="todo_description" name="description" placeholder="<?= get_label('please_enter_description', 'Please enter description') ?>"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?>
                </button>
                <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('update', 'Update') ?></span></button>
            </div>
        </form>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/tags'))
<!-- tags modal -->
<div class="modal fade" id="create_tags_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.tags.store')}}" method="POST">
            <input type="hidden" name="table" value="tags_table">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_tags', 'Create tags') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="nameBasic" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                        <input required type="color" value="#d6fafc" id="tags_color" name="color" class="form-control" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?></label>
                </button>
                <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_tags_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setup.tags.update')}}" method="POST">
            <input type="hidden" id="edit_tags_id" name="id" value="">
            <input type="hidden" id="edit_tags_table" name="table">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('edit_tags', 'Edit tags') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" id="edit_tags_title" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                        <input required type="color" id="edit_tags_color" name="color" class="form-control" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?></label>
                </button>
                <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
            </div>
        </form>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/designations'))
<!-- designations modal -->
<div class="modal fade" id="create_designations_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <!-- <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_designations', 'Create designations') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setting.designations.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="designations_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('Department', 'department') ?></label>
                        <select class="form-select" name="department_id" id="add_department_id">
                            <option value="">Select department...</option>
                            @foreach ($departments as $key => $item )
                            @if (Request::old('id') == $item->id )
                            <option value="{{ $item->id  }}" selected>
                                {{ $item->name }}
                            </option>
                            @else
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_designations_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('edit_designations', 'Edit designations') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setting.designations.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_designations_id" name="id" value="">
                <input type="hidden" id="edit_designations_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_designations_name" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('Department', 'department') ?></label>
                        <select class="form-select" name="department_id" id="edit_department_id">
                            <option value="">Select department...</option>
                            @foreach ($departments as $key => $item )
                            <option value="{{ $item->id  }}" selected>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/departments'))
<!-- departments modal -->
<div class="modal fade" id="create_departments_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_departments', 'Create departments') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setting.departments.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="departments_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('parent_department', 'Parent department') ?></label>
                        <select class="form-select" name="parent_id">
                            <option value="" selected>Select department...</option>
                            @foreach ($departments as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_departments_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setting.departments.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_departments_id" name="id" value="">
                <input type="hidden" id="edit_departments_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_departments_title" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('parent_department', 'Parent department') ?></label>
                        <select class="form-select" name="parent_id" id="edit_parent_id">
                            <option value="">Select department...</option>
                            @foreach ($departments as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/locations'))
<!-- locations modal -->
<div class="modal fade" id="create_locations_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_locations', 'Create locations') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.locations.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="locations_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_locations_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setup.locations.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_locations_id" name="id" value="">
                <input type="hidden" id="edit_locations_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_locations_title" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/venue'))
<!-- venues modal -->
<div class="modal fade" id="create_venues_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_venues', 'Create venues') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.venue.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="venues_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('location', 'Location') ?></label>
                        <select class="form-select" name="location_id" id="add_location_id">
                            <option value="" selected>Select venue...</option>
                            @foreach ($locations as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_venues_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setup.venue.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_venues_id" name="id" value="">
                <input type="hidden" id="edit_venues_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_venues_name" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('location', 'Location') ?></label>
                        <select class="form-select" name="location_id" id="edit_location_id">
                            <option value="" selected>Select venue...</option>
                            @foreach ($locations as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setting/funcareas'))
<!-- venues modal -->
<div class="modal fade" id="create_funcareas_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_funcareas', 'Create Functional Area') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setting.funcareas.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="funcareas_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('venue', 'Venue') ?></label>
                        <select class="form-select" name="venue_id" id="add_venue_id">
                            <option value="" selected>Select funcarea...</option>
                            @foreach ($venues as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_funcareas_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit Functional Area</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setting.funcareas.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_funcareas_id" name="id" value="">
                <input type="hidden" id="edit_funcareas_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_funcareas_name" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('venue', 'Venue') ?></label>
                        <select class="form-select" name="venue_id" id="edit_venue_id">
                            <option value="" selected>Select funcarea...</option>
                            @foreach ($venues as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/venue'))
<!-- venues modal -->
<div class="modal fade" id="create_venues_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_venues', 'Create venues') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.venue.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="venues_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('location', 'Location') ?></label>
                        <select class="form-select" name="location_id" id="add_location_id">
                            <option value="" selected>Select venue...</option>
                            @foreach ($locations as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_venues_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setup.venue.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_venues_id" name="id" value="">
                <input type="hidden" id="edit_venues_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_venues_name" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('location', 'Location') ?></label>
                        <select class="form-select" name="location_id" id="edit_location_id">
                            <option value="" selected>Select venue...</option>
                            @foreach ($locations as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


@if (Request::is('tracki/setup/workspace'))
<!-- workspace modal -->
<div class="modal fade" id="create_workspace_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.workspace.store')}}" method="POST">
            <input type="hidden" name="table" value="workspace_table">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_workspace', 'Create workspace') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" id="nameBasic" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>

                <div class="row">

                    <div class="col-12">
                        <label class="form-label" for="inputAddress2">Assigned to</label>
                        <select class="form-select js-example-basic-multiple" name="assigned_to_id[]" multiple="multiple" data-with="100%" data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                            <!-- <select name="assigned_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required> -->
                            <option value="">Select Assinged to</option>
                            @foreach ($employees as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->full_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 gy-6">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?></label>
                </button>
                <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_workspace_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.workspace.update')}}" method="POST">
            <input type="hidden" name="table" value="workspace_table">
            <input type="hidden" id="id" name="id" value="">
            <input type="hidden" id="table" name="table">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('edit_workspace', 'Edit workspace') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" id="edit_ws_title" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="user_id"><?= get_label('select_users', 'Select users') ?> <span id="task_update_users_associated_with_project"></span></label>
                        <select id="edit_ws_asg_id" class="form-select js-asg-basic-multiple" name="assigned_to_id[]" multiple="multiple" data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                            <option value="">Select Assinged to</option>
                            @foreach ($employees as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->full_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="user_id"><?= get_label('select_clients', 'Select clients') ?> <span id="task_update_users_associated_with_project"></span></label>
                        <select id="edit_ws_client_id" class="form-select js-client-basic-multiple" name="client_id[]" multiple="multiple" data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                            <option value="">Select Assinged to</option>
                            @foreach ($clients as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->first_name.' '.$item->last_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?></label>
                </button>
                <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
            </div>
        </form>
    </div>
</div>
@endif

@if (Request::is('tracki/todo/manage'))
<div class="modal fade" id="createTodoModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Create Todo</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation" novalidate="" form-submit-eventx" id="add_new_todo" action="{{ route('tracki.todo.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <!-- <input type="hidden" name="parent_task_id" id="subtask_parent_task_id" value=""> -->
                                <!-- <input type="hidden" name="table" value="task_table"> -->

                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="inputEmail4">Title</label>
                                    <input name="title" class="form-control" type="text" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="inputAddress2">Assigned to</label>
                                    <select name="assigned_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required>
                                        <option value="">Select Assinged to</option>
                                        @foreach ($users as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->full_name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->full_name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="inputAddress">Priority</label>
                                    <select name="priority_id" class="form-select" id="floatingSelectRating" required>
                                        <option selected="selected" value="">Select...</option>
                                        @foreach ($priorities as $key => $item )
                                        @if (Request::old('id') == $item->id )
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

                                <div class="col-12">
                                    <label class="form-label" for="gridCheck">Description</label>
                                    <textarea required name="description" class="form-control" id="floatingProjectOverview" data-tinymce="{}" placeholder=""></textarea>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-6">
                                    <button class="btn btn-phoenix-secondary action button-submit" type="submit" value="save" id="submit_btn">Save</button>
                                    <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                                    <a class="btn btn-phoenix-danger me-2 px-6" href="#" data-bs-dismiss="modal">Cancel</a>
                                    <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/task/*/list') || Request::is('tracki/task/manage') || Request::is('tracki/task/*/edit')||Request::is('tracki/todo/manage'))
<!-- this is the Add Attachement Modal for tasks -->
<div class="modal fade" id="addAttachementTaskModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Upload Task File</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" id="add_new_task_file" novalidate="" action="{{ route('tracki.task.file.store') }}" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="taskAttachId" name="task_id">
                                <input type="hidden" id="taskAttachParentTable" name="table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Name</label>
                                    <input class="form-control" type="file" name="file_name" id="fileupld" required />
                                </div>
                                <div class="form-group">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/task/*/list') || Request::is('tracki/task/manage') || Request::is('tracki/task/*/edit') ||Request::is('tracki/users/*'))

<!-- this is the Add task Notes Modal -->
<div class="modal fade" id="addTaskNoteModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Add task note</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" id="add_new_task_note" novalidate="" action="{{ route('tracki.task.note.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="taskNoteId" name="task_id" value="">
                                <input type="hidden" id="taskNoteParentTable" name="table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Note</label>
                                    <textarea class="form-control mb-3" id="task_note" name="note_text" rows="4" required> </textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals for change status in project and task -->
<div class="modal fade" id="taskStatusModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Change Status</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" novalidate="" action="{{route('tracki.task.status.update')}}" method="POST" id="task_status">
                <!-- <form class="needs-validation" novalidate="" action="{{url('/tracki/task/status/update')}}" method="POST" id="task_status"> -->
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="editTaskId" name="id">
                                <input type="hidden" id="editTaskEventId" name="event_id">
                                <input type="hidden" id="taskStatusParentTable" name="table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Status</label>
                                    <select name="status_id" class="form-select" id="editTaskStatusSelection" required>
                                        <option selected="selected" value="">Select</option>
                                        @foreach ($statuses as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <input class="form-control" type="number" max="100" min="0" name="prorgress_number" id="editPoregessNumber" required /> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- //****************************************** add_task_modal ******************************************/ */ -->
<div class="modal fade" id="add_task_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_task_modal_label"><?= get_label('add_task', 'Edit task') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_task_form" novalidate="" action="{{ route ('tracki.task.store') }}" method="POST">
                @csrf

                <input type="hidden" id="add_task_id_h" name="id" value="">
                <input type="hidden" id="add_task_table_h" name="table" value="">
                <!-- <input type="hidden" id="add_task_event_id" name="event_id" value=""> -->


                <div class="modal-body">


                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="inputEmail4">Title</label>
                        <input name="name" id="add_task_name" class="form-control" type="text" placeholder="" required>
                    </div>
                    @if (Request::is('tracki/task/manage'))
                    <div class="col-12">
                        <label class="form-label" for="inputAddress">Project</label>
                        <select name="event_id" id="add_task_event_id" onChange="getProjectUsers(this.value);" class="form-select" id="floatingSelectRating" required>
                            <option selected="selected" value="">Select...</option>
                            @foreach ($projects as $key => $item )
                            @if (Request::old('id') == $item->id )
                            <option value="{{ $item->id  }}" selected>
                                {{ $item->name }}
                            </option>
                            @else
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @elseif (Request::is('tracki/task/*/list'))
                    <input type="hidden" id="add_task_event_id" name="event_id" value="">
                    @endif
                    <div class="mb-3 row">

                        <div class="col-md-6">
                            <label class="form-label" for="inputEmail4">Start Date</label>
                            <input class="form-control datetimepicker" id="add_task_start_date" data-target="#floatingInputStartDate" name="start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="inputEmail4">Due Date</label>
                            <input class="form-control datetimepicker" id="add_task_due_date" data-target="#floatingInputStartDate" name="due_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label" for="inputAddress">Status</label>
                            <select name="status_id" class="form-select" id="add_task_status" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($statuses as $key => $item )
                                @if (Request::old('id') == $item->id )
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
                        <div class="col-md-6">
                            <label class="form-label" for="inputAddress">Department</label>
                            <select name="department_assignment_id" id="add_task_department_id" class="form-select" id="floatingSelectRating" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($departments as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->name }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <label class="form-label" for="inputAddress2">Assigned to (multiple)</label>

                        <select required class="form-select js-example-basic-multiple" id="add_task_assigned_to" name="assignment_to_id[]" multiple="multiple" data-with="100%" data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                            <!-- <select name="assignment_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required> -->
                            <option value="">Select Assinged to</option>
                            @foreach ($employees as $key => $item )
                            @if (Request::old('id') == $item->id )
                            <option value="{{ $item->id  }}" selected>
                                {{ $item->full_name }}
                            </option>
                            @else
                            <option value="{{ $item->id  }}">
                                {{ $item->full_name }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 row">

                        <div class="col-md-6">
                            <label class="form-label" for="inputCity">Budget allocated</label>
                            <input name="budget_allocation" class="form-control" id="add_task_budget" type="number" step="0.01" placeholder="" value="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="inputState">Actual budget utilized</label>
                            <input name="actual_budget_allocated" class="form-control" id="add_task_budget_utilization" type="number" step="0.01" placeholder="" value="0" required>
                        </div>
                    </div>
                    <!-- <h4 class="mt-6">Other Information</h4> -->

                    <div class="col-12">
                        <label class="form-label" for="gridCheck">Description</label>
                        <textarea style="height: 200px;" required name="description" class="form-control tinymce" id="add_task_description" data-tinymce="{}" placeholder=""></textarea>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- //****************************************** edit_task_modal ******************************************/ */ -->
<div class="modal fade" id="edit_task_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <!-- <div class="d-flex justify-content-center">
        <div id="cover-spin" style="display:none;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="edit_task_modal_label"><?= get_label('edit_task', 'Edit task') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_task_form" novalidate="" action="{{ route ('tracki.task.update') }}" method="POST">
                @csrf
                <div id="edit_task_modal_form"></div>
            </form>
        </div>
    </div>
</div>

<!-- //****************************************** offcanvasAddEditTask (not used but can be an option.  will add it to config) ******************************************/ */ -->
<div class="offcanvas offcanvas-start" id="offcanvasAddEditTask" tabindex="-1" aria-labelledby="offcanvasWithBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="add_edit_task_modal_label">Edit task for ( )</h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <form class="row g-3 needs-validation form-submit-event" id="add_edit_task_form" novalidate="" action="" method="POST">
            @csrf
            <input type="hidden" id="add_edit_task_id_h" name="id" value="">
            <input type="hidden" id="add_edit_task_table_h" name="table" value="">

            <div class="col-md-12">
                <label class="form-label" for="inputEmail4">Title</label>
                <input name="name" id="add_edit_task_name" class="form-control" type="text" placeholder="" required>
            </div>
            @if (Request::is('tracki/task/manage'))
            <div class="col-12">
                <label class="form-label" for="inputAddress">Project</label>
                <select name="event_id" id="add_edit_task_event_id" onChange="getProjectUsers(this.value);" class="form-select" id="floatingSelectRating" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($projects as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            @elseif (Request::is('tracki/task/*/list'))
            <input type="hidden" id="add_edit_task_event_id" name="event_id" value="">
            @endif
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">Start Date</label>
                <input class="form-control datetimepicker" id="add_edit_task_start_date" data-target="#floatingInputStartDate" name="start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">Due Date</label>
                <input class="form-control datetimepicker" id="add_edit_task_due_date" data-target="#floatingInputStartDate" name="due_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>

            <div class="col-6">
                <label class="form-label" for="inputAddress">Status</label>
                <select name="status_id" class="form-select" id="add_edit_task_status" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($statuses as $key => $item )
                    @if (Request::old('id') == $item->id )
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

            <div class="col-6">
                <label class="form-label" for="inputAddress">Department</label>
                <select name="department_assignment_id" id="add_edit_task_department_id" class="form-select" id="floatingSelectRating" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($departments as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label class="form-label" for="inputAddress2">Assigned to (multiple)</label>

                <select required class="form-select js-example-basic-multiple" id="add_edit_task_assigned_to" name="assignment_to_id[]" multiple="multiple" data-with="100%" data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                    <!-- <select name="assignment_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required> -->
                    <option value="">Select Assinged to</option>
                    @foreach ($users as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label" for="inputCity">Budget allocated</label>
                <input name="budget_allocation" class="form-control" id="add_edit_task_budget" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputState">Actual budget utilized</label>
                <input name="actual_budget_allocated" class="form-control" id="add_edit_task_budget_utilization" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-12">
                <label class="form-label" for="gridCheck">Description</label>
                <textarea required name="description" class="form-control tinymce" id="add_edit_task_description" data-tinymce="{}" placeholder=""></textarea>
            </div>
            <div class="col-12 d-flex justify-content-end mt-6">
                <button class="btn btn-phoenix-secondary action button-submit" type="submit" value="save" id="submit_btn">Save</button>
                <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                <!-- <a class="btn btn-phoenix-danger me-2 px-6" href="#">Cancel</a> -->
                <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
            </div>
        </form>

    </div>
</div>
<!-- </div> -->

<!-- add new task used in list and manage -->
<div class="offcanvas offcanvas-start" id="offcanvasCreateSubTask" tabindex="-1" aria-labelledby="offcanvasWithBackdropLabel">
    @if (Request::is('tracki/task/*/list'))
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Create subtask for {{Session::get('record_type')}} ( {{$eventData->name}} )</h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    @elseif (Request::is('tracki/task/manage'))
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Create new task</h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    @endif
    <div class="offcanvas-body">

        <form class="row g-3 needs-validation form-submit-event" id="add_new_task" novalidate="" action="{{ route('tracki.task.subtask.store') }}" method="POST">
            @csrf
            @if (Request::is('tracki/task/*/list'))
            <input type="hidden" name="event_id" value="{{ $eventData->id }}">
            @endif
            <input type="hidden" name="table" value="task_table">

            <div class="col-md-12">
                <label class="form-label" for="inputEmail4">Title</label>
                <input name="name" class="form-control" type="text" placeholder="" required>
            </div>
            @if (Request::is('tracki/task/manage'))
            <div class="col-12">
                <label class="form-label" for="inputAddress">Project</label>
                <select name="event_id" class="form-select" id="floatingSelectRating" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($projects as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            @endif
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">Start Date</label>
                <input class="form-control datetimepicker" id="floatingInputStartDate" data-target="#floatingInputStartDate" name="start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">Due Date</label>
                <input class="form-control datetimepicker" id="floatingInputStartDate" data-target="#floatingInputStartDate" name="due_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>

            <div class="col-6">
                <label class="form-label" for="inputAddress">Status</label>
                <select name="status_id" class="form-select" id="floatingSelectRating" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($statuses as $key => $item )
                    @if (Request::old('id') == $item->id )
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

            <div class="col-6">
                <label class="form-label" for="inputAddress">Department</label>
                <select name="department_assignment_id" class="form-select" id="floatingSelectRating" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($departments as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label class="form-label" for="inputAddress2">Assigned to</label>
                <select name="assignment_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required>
                    <option value="">Select Assinged to</option>
                    @foreach ($users as $key => $item )
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>

                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label" for="inputCity">Budget allocated</label>
                <input name="budget_allocation" class="form-control" id="floatingInputLinkedin" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputState">Actual budget utilized</label>
                <input name="actual_budget_allocated" class="form-control" id="floatingInputLinkedin" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-12">
                <label class="form-label" for="gridCheck">Description</label>
                <textarea required name="description" class="form-control tinymce" id="floatingProjectOverview" data-tinymce="{}" placeholder=""></textarea>
            </div>
            <div class="col-12 d-flex justify-content-end mt-6">
                <button class="btn btn-phoenix-secondary action button-submit" type="submit" value="save" id="submit_btn">Save</button>
                <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                <a class="btn btn-phoenix-danger me-2 px-6" href="#">Cancel</a>
                <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
            </div>
        </form>

    </div>
</div>

<!-- Subtask modal -->
<div class="modal fade" id="createSubTaskModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Create subtask</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" id="add_new_subtasktask" novalidate="" action="{{ route('tracki.task.subtask.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" name="parent_task_id" id="subtask_parent_task_id" value="">
                                <input type="hidden" name="table" value="task_table">

                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="inputEmail4">Title</label>
                                    <input name="title" class="form-control" type="text" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="inputAddress">Status</label>
                                    <select name="priority_id" class="form-select" id="floatingSelectRating" required>
                                        <option selected="selected" value="">Select...</option>
                                        @foreach ($priorities as $key => $item )
                                        @if (Request::old('id') == $item->id )
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

                                <div class="col-12">
                                    <label class="form-label" for="gridCheck">Description</label>
                                    <textarea required name="description" class="form-control" id="floatingProjectOverview" data-tinymce="{}" placeholder=""></textarea>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-6">
                                    <button class="btn btn-phoenix-secondary action button-submit" type="submit" value="save" id="submit_btn">Save</button>
                                    <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                                    <a class="btn btn-phoenix-danger me-2 px-6" href="#" data-bs-dismiss="modal">Cancel</a>
                                    <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- The main Task overview ***************************************************************************************************-->
<div class="modal fade" id="taskCardViewModal" tabindex="-1" aria-labelledby="taskCardViewModal" aria-hidden="true">

    <!-- <div class="d-flex justify-content-center">
        <div class="spinner-border" style="display:block;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <div class="mb-0">
                    <h3 class="fw-bolder lh-sm" id="overviewtaskTitle">Task quick view</h3>
                    <p class="text-body-highlight fw-semibold mb-0">Project <a class="ms-1 fw-bold" href="#!" id="overviewProjectName">Review </a></p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2 px-md-3 bg-body">
                <div class="row g-2">
                    <div class="col-12 col-md-12">
                        <div class="d-md-flex mt-5 mb-0">
                            <p class="text-body-highlight fw-semibold mb-0" id="overviewtaskStatus"></p>
                            <p class="text-body-highlight fw-semibold mb-0" id="overviewtaskWorkspace"></p>
                            <div class="d-flex gap-2 ms-md-auto mt-3 mt-md-0">
                                <div class="d-flex">
                                    <p id="overviewtaskAssignees" class="d-flex"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="card py-3 px-3 mb-3">
                            <table class="lh-sm mb-3">
                                <tbody>
                                    <tr>
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Started : </td>
                                        <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3" id="overviewtaskStartDate"></td>
                                    </tr>
                                    <tr>
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Deadline :</td>
                                        <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3" id="overviewtaskDueDate"></td>
                                    </tr>
                                    <tr class="mb-5">
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Budget Allocated :</td>
                                        <td class="text-body-tertiary fw-semibold ps-3" id="overviewtaskAllocatedBudget"></td>
                                    </tr>
                                    <tr class="mb-5">
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Expenses :</td>
                                        <td class="text-body-tertiary fw-semibold ps-3" id="overviewtaskActualBudget"></td>
                                    </tr>
                                    <tr class="mb-5">
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Department :</td>
                                        <td class="text-body-tertiary fw-semibold ps-3" id="overviewtaskDepartment"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="lh-sm mb-4">
                                <tbody>
                                    <tr>
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Labels :</td>
                                        <td class="text-warning fw-semibold ps-9">
                                            <div class="d-flex align-items-center">
                                                <span class="badge badge-phoenix badge-phoenix-info fs-10 me-2">INFO</span>
                                                <span class="badge badge-phoenix badge-phoenix-warning fs-10 me-2">URGENT</span>
                                                <span class="badge badge-phoenix badge-phoenix-success fs-10 me-2">DONE</span>
                                                <a class="text-body fw-bolder fs-9 lh-1 text-decoration-none" href="#!">
                                                    <!-- <span class="fa-solid fa-plus me-1"></span>Add another</a> -->
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <h5 class="me-3">Description</h5>
                                    <a href="#"><button class="btn btn-link p-0"><span class="fa-solid fa-pen"></span></button></a>
                                </div>
                                <p class="text-body-highlight" id="overviewtaskDescription"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="card py-3 px-3 mb-3">
                            <ul class="nav nav-underline fs-9 border-bottom" id="myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="task-note-tab" data-taskid="" data-bs-toggle="tab" href="#tab-task-note" role="tab" aria-controls="tab-task-note" aria-selected="false">Notes</a></li>
                                <li class="nav-item"><a class="nav-link" id="task-file-tab" data-bs-toggle="tab" href="#tab-task-file" role="tab" aria-controls="tab-home" aria-selected="true">Files</a></li>
                                <li class="nav-item"><a class="nav-link" id="task-subtask-tab" data-bs-toggle="tab" href="#tab-task-subtask" role="tab" aria-controls="tab-task-subtask" aria-selected="false">Subtask</a></li>
                            </ul>
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade active show" id="tab-task-note" role="tabpanel" aria-labelledby="task-note-tab">

                                    <a id="collapse_task_note" class="btn btn-link p-0 collapsed mb-4" data-bs-toggle="collapse" href="#collapseTaskNote" aria-expanded="false" aria-controls="collapseExample">
                                        + Add note
                                    </a>
                                    <div class="collapse" id="collapseTaskNote">
                                        <form class="needs-validation form-submit-task-new-note" novalidate="" action="{{ route('tracki.task.note.store') }}" method="POST" id="form_submit_task_new_note">
                                            @csrf
                                            <input type="hidden" id="note_parent_task_id_overview" name="task_id">
                                            <input type="hidden" id="taskNoteParentTable" name="table" value="task_table">
                                            <textarea class="form-control form-control mb-3" data-tinymce="{}" rows="3" id="task_note_text" name="note_text" placeholder="Add comment" required></textarea>
                                            <div class="d-flex flex-between-center pb-3 mb-3">
                                                <div class="d-flex">
                                                </div>
                                                <button class="btn btn-sm btn-outline-primary px-6" type="submit" id="add_comment_btn">Save comment</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="taskTabNotes"></div>
                                </div>
                                <div class="tab-pane fade" id="tab-task-file" role="tabpanel" aria-labelledby="task-file-tab">
                                    <a id="collapse_task_file" class="btn btn-link p-0 collapsed mb-2" data-bs-toggle="collapse" href="#collapseTaskFile" aria-expanded="false" aria-controls="collapseExample">
                                        + Upload file
                                    </a>
                                    <div class="collapse" id="collapseTaskFile">
                                        <!-- <div class="card card-body"> -->

                                        <form id="form_submit_task_new_file" class="needs-validation form-submit-task-new-file" novalidate="" action="{{ route('tracki.task.file.store') }}" method="POST" enctype='multipart/form-data'>
                                            @csrf
                                            <div class="modal-body">
                                                <div class="modal-body px-0">
                                                    <div class="row g-4">
                                                        <div class="col-lg-12">
                                                            <input type="hidden" id="file_parent_task_id_overview" name="task_id">
                                                            <input type="hidden" id="task_parent_table" name="table" value="task_table">
                                                            <div class="mb-4">
                                                                <label class="text-1000 fw-bold mb-2">upload file</label>
                                                                <input class="form-control" type="file" name="file_name" id="fileupld" required />
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="modal-footer"> -->
                                            <button class="btn btn-sm btn-outline-primary px-6" type="submit" id="add_file_btn">Upload file</button>
                                            <!-- </div> -->
                                        </form>
                                        <!-- </div> -->
                                    </div>
                                    <div id="taskTabFiles"></div>
                                </div>

                                <div class="tab-pane fade" id="tab-task-subtask" role="tabpanel" aria-labelledby="task-subtask-tab">
                                    <a id="collapse_task_subtask" class="btn btn-link p-0 collapsed mb-2" data-bs-toggle="collapse" href="#collapseTaskSubtask" aria-expanded="false" aria-controls="collapseExample">
                                        + Add new subtask
                                    </a>
                                    <div class="collapse" id="collapseTaskSubtask">
                                        <!-- <div class="card card-body"> -->

                                        <form class="needs-validation form-submit-task-new-subtask" id="form_submit_task_new_subtask" novalidate="" action="{{ route('tracki.task.subtask.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="modal-body px-0">
                                                    <div class="row g-4">
                                                        <div class="col-lg-12">
                                                            <input type="hidden" name="parent_task_id" id="subtask_parent_task_id_overview" value="">
                                                            <input type="hidden" name="table" value="task_table">

                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label" for="inputEmail4">Title</label>
                                                                <input name="title" class="form-control" type="text" placeholder="" required>
                                                            </div>
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label" for="inputAddress">Priority</label>
                                                                <select name="priority_id" class="form-select" id="floatingSelectRating" required>
                                                                    <option selected="selected" value="">Select...</option>
                                                                    @foreach ($priorities as $key => $item )
                                                                    @if (Request::old('id') == $item->id )
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

                                                            <div class="col-12">
                                                                <label class="form-label" for="gridCheck">Description</label>
                                                                <textarea required name="description" class="form-control" id="floatingProjectOverview" data-tinymce="{}" placeholder=""></textarea>
                                                            </div>
                                                            <div class="col-12 d-flex justify-content-end mt-6">
                                                                <button class="btn btn-sm btn-outline-primary px-6 action button-submit" type="submit" value="save" id="add_subtask_btn">Save</button>
                                                                <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                                                                <!-- <a class="btn btn-phoenix-danger me-2 px-6" href="#" data-bs-dismiss="modal">Cancel</a> -->
                                                                <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                        <!-- </div> -->
                                    </div>
                                    <div id="taskTabSub"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endif