@extends('tracki.layout.dashboard')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<div class="content">

    <div class="d-flex justify-content-between m-2">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{route('tracki.employee.dashboard')}}"><?= get_label('home', 'Home') ?></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('tracki.project.show.card')}}">
                            <?= get_label('projects', 'Projects') ?></a>
                    </li>
                    <li class="breadcrumb-item active">
                        <?= get_label('card', 'Card') ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-between align-items-end mb-4 g-3">
        <div class="col-12 col-sm-auto">
            <h2 class="mb-0">{{__('traki.employee.create_employee')}}<span class="fw-normal text-700 ms-3"></span></h2>
        </div>
        <div class="col-12 col-sm-auto">
            <div class="d-flex align-items-center">
                <div class="search-box me-3">
                </div>
                <!-- <a class="btn btn-primary px-5" href="#!" id="add_new_project" data-workspace-id=""><i class="bx bx-plus"></i></a> -->
                <!-- <a href="#" id="add_new_project" data-workspace-id=""><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_project', 'Create project') ?>"><i class="bx bx-plus"></i></button></a> -->
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card theme-wizard mb-5" data-theme-wizard="data-theme-wizard">
            <div class="card-header bg-body-highlight pt-3 pb-2 border-bottom-0">
                <ul class="nav justify-content-between nav-wizard nav-wizard-success">
                    <li class="nav-item"><a class="nav-link active fw-semibold" href="#bootstrap-wizard-tab1" data-bs-toggle="tab" data-wizard-step="1">
                            <div class="text-center d-inline-block"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-lock"></span></span></span><span class="d-none d-md-block mt-1 fs-9">Basic</span></div>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#bootstrap-wizard-tab2" data-bs-toggle="tab" data-wizard-step="2">
                            <div class="text-center d-inline-block"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-lock"></span></span></span><span class="d-none d-md-block mt-1 fs-9">Personal</span></div>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#bootstrap-wizard-tab3" data-bs-toggle="tab" data-wizard-step="3">
                            <div class="text-center d-inline-block"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-address-card"></span></span></span><span class="d-none d-md-block mt-1 fs-9">Address</span></div>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#bootstrap-wizard-tab4" data-bs-toggle="tab" data-wizard-step="4">
                            <div class="text-center d-inline-block"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-file-alt"></span></span></span><span class="d-none d-md-block mt-1 fs-9">Bank</span></div>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#bootstrap-wizard-tab5" data-bs-toggle="tab" data-wizard-step="5">
                            <div class="text-center d-inline-block"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-file-alt"></span></span></span><span class="d-none d-md-block mt-1 fs-9">Emergency Contact</span></div>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#bootstrap-wizard-tab6" data-bs-toggle="tab" data-wizard-step="6">
                            <div class="text-center d-inline-block"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-check"></span></span></span><span class="d-none d-md-block mt-1 fs-9">Done</span></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-4 pb-0">
                <form id="basicForm" novalidate="novalidate" data-wizard-form="1">
                    <div class="tab-content">

                        <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-wizard-tab1" id="bootstrap-wizard-tab1">
                            <!-- <form class="needs-validation" id="basicForm" novalidate="novalidate" data-wizard-form="1"> -->
                            <div class="row mb-2">
                                <!-- begining of left div -->
                                <div class="col-md-12">
                                    <!-- <div class="mb-2 row"> -->
                                    <div class="mb-2 row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="bootstrap-wizard-validation-gender">Employee Type</label>
                                            <select class="form-select" name="employee_type" id="add_employee_employee_type" required="required">
                                                <option value="">Select ...</option>
                                                @foreach ($employee_types as $key => $item )
                                                <option value="{{ $item->id  }}">
                                                    {{ $item->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
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
                                    </div>

                                    <div class="mb-2 row">
                                        <div class="col-md-4">
                                            <label class="form-label" for="inputEmail4">First Name</label>
                                            <input name="first_name" id="add_employee_first_name" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="inputEmail4">Middle Name</label>
                                            <input name="middle_name" id="add_employee_middle_name" class="form-control" type="text" placeholder="">
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="inputEmail4">Last Name</label>
                                            <input name="last_name" id="add_employee_last_name" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="inputEmail4">Email</label>
                                            <input name="email_address" id="add_employee_email_address" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="inputEmail4">National Identificaton Number</label>
                                            <input name="national_identifier_number" id="add_employee_national_identifier_number" maxlength="11" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="inputEmail4">Department</label>
                                            <select class="form-select" name="department_id" id="add_department_id" required>
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
                                        <div class="col-md-6">
                                            <label class="form-label" for="inputEmail4">Designation</label>
                                            <select class="form-select" name="department_id" id="add_department_id" required>
                                                <option value="">Select department...</option>
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
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="inputEmail4">Email</label>
                                            <input name="email_address" id="add_employee_email_address" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="inputEmail4">National Identificaton Number</label>
                                            <input name="national_identifier_number" id="add_employee_national_identifier_number" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="inputEmail4">Phone</label>
                                            <input name="phone_number" id="add_employee_phone_number" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label" for="inputEmail4">Alternate Phone</label>
                                            <input name="alt_phone_number" id="add_employee_alt_phone_number" class="form-control" type="text" placeholder="">
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-6">
                                            <div class="mb-2 mb-sm-0">
                                                <label class="form-label text-body" for="bootstrap-wizard-wizard-password">Password*</label>
                                                <input class="form-control" type="password" name="password" placeholder="Password" id="bootstrap-wizard-wizard-password" data-wizard-password="true" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-2">
                                                <label class="form-label text-body" for="bootstrap-wizard-wizard-confirm-password">Confirm Password*</label>
                                                <input class="form-control" type="password" name="confirmPassword" placeholder="Confirm Password" id="bootstrap-wizard-wizard-confirm-password" data-wizard-confirm-password="true" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of left div -->
                            </div>
                            <!-- </form> -->
                        </div>
                        <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-wizard-tab2" id="bootstrap-wizard-tab2">
                            <!-- <form class="needs-validation" id="personalForm" novalidate="novalidate" data-wizard-form="2"> -->
                            <!-- begining of right div -->
                            <div class="row g-4 mb-4" data-dropzone="data-dropzone" data-options='{"maxFiles":1,"data":[{"name":"avatar.webp","size":"54kb","url":"../../assets/img/team"}]}'>
                                <div class="fallback">
                                    <input type="file" name="file" />
                                </div>
                                <div class="col-md-auto">
                                    <div class="dz-preview dz-preview-single">
                                        <div class="dz-preview-cover d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                            <div class="avatar avatar-4xl"><img id="showImage" class="rounded-circle avatar-placeholder" src="{{(!empty($emp->emp_files->file_name)) ? url($emp->emp_files->file_path.$emp->emp_files->file_name) : url('upload/no_image.jpg')}}" alt="..." data-dz-thumbnail="data-dz-thumbnail" /></div>
                                            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <input class="form-control form-control-sm" type="file" name="profile_image_name" id="profile_image_name" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="mb-2 row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="inputEmail4">Birth Date *</label>
                                        <input class="form-control datetimepicker" id="add_employee_date_of_birth" data-target="#floatingInputStartDate" name="date_of_birth" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}'>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="inputEmail4">Town of birth</label>
                                        <input name="town_of_birth" id="add_employee_town_of_birth" class="form-control" type="text" placeholder="">
                                        <!-- <div class="invalid-feedback">This field is .</div> -->
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="bootstrap-wizard-validation-gender">Country of birth</label>
                                        <select class="form-select" name="country_of_birth" id="add_employee_country_of_birth">
                                            <option value="">Select ...</option>
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
                                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="inputEmail4">Hire Date</label>
                                        <input class="form-control datetimepicker" id="edit_employee_date_of_hire" data-target="#floatingInputStartDate" name="date_of_hire" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}'>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="inputEmail4">Joining Date</label>
                                        <input class="form-control datetimepicker" id="edit_employee_join_date" data-target="#floatingInputStartDate" name="join_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}'>
                                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="bootstrap-wizard-validation-gender">Gender *</label>
                                        <select class="form-select" name="gender" id="add_employee_gender">
                                            <option value="">Select ...</option>
                                            @foreach ($genders as $key => $item )
                                            <option value="{{ $item->id  }}">
                                                {{ $item->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="bootstrap-wizard-validation-gender">Marital Status</label>
                                        <select class="form-select" name="marital_status" id="add_employee_marital_status">
                                            <option value="">Select ...</option>
                                            @foreach ($marital_statuses as $key => $item )
                                            <option value="{{ $item->id  }}" selected>
                                                {{ $item->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="bootstrap-wizard-validation-gender">Language</label>
                                        <select class="form-select" name="language" id="add_employee_language">
                                            <option value="">Select ...</option>
                                            <option value="1">English</option>
                                            <option value="2">French</option>
                                            <option value="3">Spanish</option>
                                            <option value="4">Others</option>
                                        </select>
                                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="bootstrap-wizard-validation-gender">Nationality</label>
                                        <select class="form-select" name="nationality" id="add_employee_nationality">
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
                                </div>
                            </div>

                            <!-- end of right div -->
                            <!-- </form> -->
                        </div>
                        <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-wizard-tab3" id="bootstrap-wizard-tab3">
                            <!-- <form id="addressForm" novalidate="novalidate" data-wizard-form="3"> -->
                            <!-- <div class="row g-4 mb-4" data-dropzone="data-dropzone" data-options='{"maxFiles":1,"data":[{"name":"avatar.webp","size":"54kb","url":"../../assets/img/team"}]}'>
                                <div class="fallback">
                                    <input type="file" name="file" />
                                </div>
                                <div class="col-md-auto">
                                    <div class="dz-preview dz-preview-single">
                                        <div class="dz-preview-cover d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                            <div class="avatar avatar-4xl"><img class="rounded-circle avatar-placeholder" src="../../assets/img/team/avatar.webp" alt="..." data-dz-thumbnail="data-dz-thumbnail" /></div>
                                            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="dz-message dropzone-area px-2 py-3" data-dz-message="data-dz-message">
                                        <div class="text-center text-body-emphasis">
                                            <h5 class="mb-2"><span class="fa-solid fa-upload me-2"></span>Upload Profile Picture</h5>
                                            <p class="mb-0 fs-9 text-body-tertiary text-opacity-85 lh-sm">Upload a 300x300 jpg image with <br />a maximum size of 400KB</p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-12 mb-2">
                                <div class="mb-2 row">
                                    <div class="col-md-12">
                                        <label class="form-label" for="bootstrap-wizard-validation-gender">Country</label>
                                        <select class="form-select" name="country" id="add_employee_address_country">
                                            <option value="">Select ...</option>
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
                                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                                    </div>
                                </div>
                                <!-- <div class="mb-2 row"> -->
                                <div class="col-md-12">
                                    <label class="form-label" for="inputEmail4">Address1</label>
                                    <input class="form-control" id="edit_employee_address1" data-target="#floatingInputStartDate" name="employee_address1" type="text">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="inputEmail4">Address2</label>
                                    <input class="form-control" id="edit_employee_address2" data-target="#floatingInputStartDate" name="employee_address2" type="text">
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <!-- </div> -->
                                <div class="mb-2 row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="bootstrap-wizard-validation-gender">City</label>
                                        <input class="form-control" id="edit_employee_address2" data-target="#floatingInputStartDate" name="employee_city" type="text" >
                                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="bootstrap-wizard-validation-gender">State</label>
                                        <input class="form-control" id="edit_employee_state" data-target="#floatingInputStartDate" name="employee_state" type="text" >
                                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="bootstrap-wizard-validation-gender">Zip Code</label>
                                        <input class="form-control" id="edit_employee_state" data-target="#floatingInputStartDate" name="employee_zip" type="text" >
                                    </div>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                        <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-wizard-tab4" id="bootstrap-wizard-tab4">
                            <form class="mb-2" id="wizardForm4" novalidate="novalidate" data-wizard-form="4">
                                <div class="row gx-3 gy-2">
                                    <div class="col-6">
                                        <label class="form-label" for="bootstrap-wizard-card-number">Bank Name</label>
                                        <input class="form-control" placeholder="XXXX XXXX XXXX XXXX" type="text" id="bootstrap-wizard-card-number" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="bootstrap-wizard-card-name">Branch</label>
                                        <input class="form-control" placeholder="John Doe" name="cardName" type="text" id="bootstrap-wizard-card-name" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="bootstrap-wizard-card-name">Account Number</label>
                                        <input class="form-control" placeholder="John Doe" name="cardName" type="text" id="bootstrap-wizard-card-name" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="bootstrap-wizard-card-name">Routing Number</label>
                                        <input class="form-control" placeholder="John Doe" name="cardName" type="text" id="bootstrap-wizard-card-name" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="bootstrap-wizard-card-name">IBAN</label>
                                        <input class="form-control" placeholder="John Doe" name="cardName" type="text" id="bootstrap-wizard-card-name" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-wizard-tab3" id="bootstrap-wizard-tab5">
                            <!-- <form id="wizardForm5" novalidate="novalidate" data-wizard-form="5"> -->

                            <div class="col-md-12 mb-2">
                                <div class="mb-2 row">
                                    <div class="col-md-12">
                                        <label class="form-label" for="bootstrap-wizard-validation-gender">Relationship</label>
                                        <select class="form-select" name="relationship_id" id="add_emergency_relationship_id">
                                            <option value="">Select ...</orelationshipsption>
                                                @foreach ($relationships as $key => $item )
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
                                <!-- <div class="mb-2 row"> -->
                                <div class="col-md-12">
                                    <label class="form-label" for="inputEmail4">Name</label>
                                    <input class="form-control" id="edit_emergency_name" data-target="#floatingInputStartDate" name="emergency_name" type="text">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="inputEmail4">Phone</label>
                                    <input class="form-control" id="add_emergency_phone" data-target="#floatingInputStartDate" name="emergency_phone" type="text">
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                        <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-wizard-tab6" id="bootstrap-wizard-tab6">
                            <!-- <form class="mb-2" id="confirmationForm" novalidate="novalidate" data-wizard-form="4"> -->
                            <div class="row flex-center pb-8 pt-4 gx-3 gy-4">
                                <div class="col-12 col-sm-auto">
                                    <div class="text-center text-sm-start"><img class="d-dark-none" src="../../assets/img/spot-illustrations/38.webp" alt="" width="220" /><img class="d-light-none" src="../../assets/img/spot-illustrations/dark_38.webp" alt="" width="220" /></div>
                                </div>
                                <div class="col-12 col-sm-auto">
                                    <div class="text-center text-sm-start">
                                        <h5 class="mb-2">You are all set!</h5>
                                        <p class="text-body-emphasis fs-9">Now you can access your account<br />anytime anywhere</p><a class="btn btn-primary px-6" href="../../modules/forms/wizard.html">Start Over</a>
                                    </div>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </form>

            </div>
            <div class="card-footer border-top-0" data-wizard-footer="data-wizard-footer">
                <div class="d-flex pager wizard list-inline mb-0">
                    <button class="d-none btn btn-link ps-0" type="button" data-wizard-prev-btn="data-wizard-prev-btn"><span class="fas fa-chevron-left me-1" data-fa-transform="shrink-3"></span>Previous</button>
                    <div class="flex-1 text-end">
                        <button class="btn btn-primary px-6 px-sm-6" type="submit" data-wizard-next-btn="data-wizard-next-btn">Next<span class="fas fa-chevron-right ms-1" data-fa-transform="shrink-3"> </span></button>
                        <button id="store_employee" class="btn btn-primary px-6 px-sm-6 d-none" type="submit" data-wizard-submit-btn="data-wizard-submit-btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Order Placed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Congratulations! Your order is placed.</div>
                <div id="jsonOutput"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeModal()">
                        Ok, close and reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @push('script')

    <script src="{{asset('assets/js/pages/employees.js')}}"></script>

    <!-- Include SmartWizard JavaScript source -->
    <!-- <script type="text/javascript" src="{{ asset('assets/smartwizard/js/demo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/smartwizard/dist/js/jquery.smartWizard.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/smartwizard/js/smartwizard.js') }}"></script> -->

    @endpush
