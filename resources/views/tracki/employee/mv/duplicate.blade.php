<!-- <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST"> -->
<!-- @csrf -->

<!-- <script src="{{asset('assets/js/custom.js')}}"></script> -->
<script src="{{ asset ('assets/tracki/js/phoenix.js') }}"></script>
<!-- <script src="{{asset('assets/js/pages/employees.js')}}"></script> -->


<!-- <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST"> -->
<!-- @csrf -->

<!-- <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST"> -->
@csrf

<input type="hidden" id="add_employee_id_h" name="id" value="{{$emp->id}}">
<input type="hidden" id="add_employee_table_h" name="table" value="employee_table">

<div class="modal-body">

    <!-- new -->
    <div class="row">
        <!-- begining of left div -->
        <div class="col-md-8">
            <div class="mb-3 row">

                <div class="col-md-6">
                    <label class="form-label" for="inputAddress">Prefix</label>
                    <select name="salutation" class="form-select" id="edit_employee_salutation">
                        <option selected="selected" value="">Select...</option>
                        @foreach ($salutations as $key => $item )
                        @if ($emp->salutation == $item->id )
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
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="inputEmail4">Entity</label>
                    <select class="form-select" name="entity_id" id="edit_employee_entity_id" required>
                        <option value="" selected>Select...</option>
                        @foreach ($entities as $key => $item )
                        @if ($emp->entity_id == $item->id )
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
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
            </div>
            <div class="mb-3 row">
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="inputEmail4">First Name</label>
                    <input name="first_name" id="edit_employee_first_name" class="form-control" type="text" value="{{$emp->first_name}}" placeholder="" required>
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label" for="inputEmail4">Middle Name</label>
                    <input name="middle_name" id="edit_employee_middle_name" class="form-control" type="text" value="{{$emp->middle_name}}" placeholder="">
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="inputEmail4">Last Name</label>
                    <input name="last_name" id="edit_employee_last_name" class="form-control" type="text" placeholder="" value="{{$emp->last_name}}" required>
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputEmail4">Personal Email</label>
                    <input name="personal_email_address" id="edit_personal_email_address" class="form-control" type="text" placeholder="" value="{{$emp->personal_email_address}}" required>
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputEmail4">Work Email</label>
                    <input name="work_email_address" id="edit_work_email_address" class="form-control" type="text" placeholder="" value="{{$emp->work_email_address}}" required>
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputEmail4">QID</label>
                    <input name="national_identifier_number" id="edit_employee_national_identifier_number"  maxlength="11" class="form-control" type="text" placeholder="" value="{{$emp->national_identifier_number}}">
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputEmail4">QID Expiry Date</label>
                    <input class="form-control datetimepickerstarttoday" data-target="#floatingInputStartDate" name="civil_id_expiry" id="edit_employee_civil_id_expiry" type="text" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' value="{{ \Carbon\Carbon::parse($emp->civil_id_expiry)->format('d/m/Y') }}" required>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputEmail4">Passport</label>
                    <input name="passport_number" class="form-control" type="text" placeholder="" value="{{$emp->passport_number}}" id="edit_employee_passport_number" required="required">
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputEmail4">Passport Expiry Date</label>
                    <input class="form-control datetimepickerstarttoday" data-target="#floatingInputStartDate" name="passport_expiry" id="edit_employee_passport_expiry" type="text" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' value="{{ \Carbon\Carbon::parse($emp->passport_expiry)->format('d/m/Y') }}" required>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="inputEmail4">Job</label>
                    <select class="form-select" name="designation_id" id="edit_employee_designation_id" required>
                        <option value="">Select...</option>
                        @foreach ($designations as $key => $item )
                        @if ($emp->designation_id == $item->id )
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
                    <select class="form-select" name="job_level_id" id="edit_employee_job_level_id" required>
                        <option value="" selected>Select...</option>
                        @foreach ($job_levels as $key => $item )
                        @if ($emp->job_level_id == $item->id )
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
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="phone_area_code">Code</label>
                    <select class="form-select" id="edit_phone_area_code" name="phone_area_code" required="required">
                        <option value="" selected>Select ...</option>
                        @foreach ($countries as $key => $item )
                        @if ($emp->phone_area_code == $item->phonecode )
                        <option value="{{ $item->phonecode  }}" selected>
                            {{ $item->phonecode }}
                        </option>
                        @else
                        <option value="{{ $item->phonecode  }}">
                            {{ $item->phonecode }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="col-md-4  mb-3">
                    <label class="form-label" for="inputEmail4">Phone</label>
                    <input name="phone_number" id="edit_employee_phone_number" class="form-control" type="text" placeholder="" value="{{$emp->phone_number}}" required>
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="alt_area_code">Code</label>
                    <select class="form-select" name="alt_area_code" id="edit_alt_area_code">
                        <option value="" selected>Select ...</option>
                        @foreach ($countries as $key => $item )
                        @if ($emp->alt_area_code == $item->phonecode )
                        <option value="{{ $item->phonecode  }}" selected>
                            {{ $item->phonecode }}
                        </option>
                        @else
                        <option value="{{ $item->phonecode  }}">
                            {{ $item->phonecode }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="col-md-4  mb-3">
                    <label class="form-label" for="inputEmail4">Alternate Phone</label>
                    <input name="alt_phone_number" id="edit_employee_alt_phone_number" class="form-control" type="text" value="{{$emp->alt_phone_number}}" placeholder="">
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="bootstrap-wizard-validation-gender">Sponsorship</label>
                    <select class="form-select" name="sponsorship_id" id="edit_employee_sponsorship_id" required="required">
                        <option value="" selected>Select ...</option>
                        @foreach ($sponsorships as $key => $item )
                        @if ($emp->sponsorship_id == $item->id )
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
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="col-md-6  mb-3">
                    <label class="form-label" for="inputEmail4">Sponsorship Name</label>
                    <input name="sponsorship_name" id="edit_employee_sponsorship_name" class="form-control" type="text" placeholder="" value="{{$emp->sponsorship_name}}">
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="bootstrap-wizard-validation-gender">Contract Type</label>
                    <select class="form-select" name="contract_type_id" id="edit_employee_contract_type_id" required="required">
                        <option value="" selected>Select ...</option>
                        @foreach ($contract_types as $key => $item )
                        @if ($emp->contract_type_id == $item->id )
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
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="inputEmail4">Contact Start Date</label>
                    <input class="form-control datetimepicker" id="edit_employee_contract_start_date" data-target="#floatingInputStartDate" name="contract_start_date" type="text" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' value="{{ \Carbon\Carbon::parse($emp->contract_start_date)->format('d/m/Y') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="inputEmail4">Contract End Date</label>
                    <input class="form-control datetimepicker" id="edit_employee_contract_end_date" data-target="#floatingInputStartDate" name="contract_end_date" type="text" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' value="{{ \Carbon\Carbon::parse($emp->contract_end_date)->format('d/m/Y') }}" required>
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
            </div>
        </div>
        <!-- end of left div -->

        <!-- begining of right div -->
        <div class="col-md-4">
        <div class="form-check form-switch mt-4 mb-4">
                <input class="form-check-input" id="flexSwitchCheckDefault" name="manager_flag" value="{{$emp->manager_flag}}" type="checkbox" {{$emp->manager_flag? 'checked':''}} />
                <label class="form-check-label" for="flexSwitchCheckDefault">Manager?</label>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label" for="bootstrap-wizard-validation-gender">Directorate</label>
                <select class="form-select" name="directorate_id" id="edit_employee_directorate_id" required="required">
                    <option value="" selected>Select ...</option>
                    @foreach ($directorate as $key => $item )
                    @if ($emp->directorate_id == $item->id )
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
                <!-- <div class="invalid-feedback">This field is required.</div> -->
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label" for="inputEmail4">Department</label>
                <select class="form-select" name="department_id" id="edit_employee_department_id" required>
                    <option value="" selected>Select...</option>
                    @foreach ($departments as $key => $item )
                    @if ($emp->department_id == $item->id )
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

            <div class="col-md-12 mb-3">
                <label class="form-label" for="bootstrap-wizard-validation-gender">Functioanl Area</label>
                <select class="form-select" name="functional_area_id" id="edit_employee_functional_area_id" required="required">
                    <option value="">Select ...</option>
                    @foreach ($functional as $key => $item )
                    @if ($emp->functional_area_id == $item->id )
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

            <div class="mb-3 row">

                <div class="mb-3 col-md-12">
                    <label class="form-label" for="bootstrap-wizard-validation-gender">Report to</label>
                    <select class="form-select" name="reporting_to_id" id="edit_employee_reporting_to_id" required="required">
                        <option value="">Select ...</option>
                        @foreach ($emps as $key => $item )
                        @if ($emp->reporting_to_id == $item->id )
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
                    <select class="form-select" name="gender_id" id="edit_employee_gender" required="required">
                        <option value="">Select ...</option>
                        @foreach ($genders as $key => $item )
                        @if ($emp->gender_id == $item->id )
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
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="bootstrap-wizard-validation-gender">Marital Status</label>
                    <select class="form-select" name="marital_status_id" id="edit_employee_marital_status" required="required">
                        <option value="" selected>Select ...</option>
                        @foreach ($marital_statuses as $key => $item )
                        @if ($emp->marital_status_id == $item->id )
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
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="inputEmail4">Birth Date</label>
                    <input class="form-control datetimepicker" id="edit_employee_date_of_birth" data-target="#floatingInputStartDate" name="date_of_birth" type="text" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' value="{{ \Carbon\Carbon::parse($emp->date_of_birth)->format('d/m/Y') }}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="bootstrap-wizard-validation-gender">Country of birth</label>
                    <select class="form-select" name="country_of_birth" id="edit_employee_country_of_birth" required="required">
                        <option value="" selected>Select ...</option>
                        @foreach ($countries as $key => $item )
                        @if ($emp->country_of_birth == $item->id )
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
                <div class="col-md-12">
                    <label class="form-label" for="bootstrap-wizard-validation-gender">Nationality</label>
                    <select class="form-select" name="nationality_id" id="edit_employee_nationality" required="required">
                        <option value="">Select ...</option>
                        @foreach ($nationalities as $key => $item )
                        @if ($emp->nationality == $item->id )
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

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
</div>
<!-- </form> -->

<script>
    $('#edit_profile_image_name').change(function(e) {
        console.log('inside edit profile_image_name')
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#edit_showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
</script>
