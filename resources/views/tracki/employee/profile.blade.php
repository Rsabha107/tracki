@extends('tracki.layout.dashboard')
@section('main')

<div class="content">
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{route('tracki.employee.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('tracki.employee')}}">employee</a></li>
            <li class="breadcrumb-item"><a href="{{route('tracki.employee.profile', encrypt($emp->id))}}">profile</a></li>
            <li class="breadcrumb-item active">{{$emp->full_name}}</li>
        </ol>
    </nav>
    <div class="pb-9">
        <div class="row">
            <div class="col-12">
                <div class="row align-items-center justify-content-between g-3 mb-3">
                    <div class="col-12 col-md-auto">
                        <h2 class="mb-0">Employee Details</h2>
                    </div>
                    @hasrole('xxx')
                    <div class="col-12 col-md-auto">
                        <div class="d-flex">
                            <button class="btn btn-primary me-2"><span class="fa-solid fa-envelope me-2"></span><span>Send an email</span></button>
                            <button class="btn btn-phoenix-secondary px-3 px-sm-5 me-2"><span class="fa-solid fa-thumbtack me-sm-2"></span><span class="d-none d-sm-inline">Shortlist</span></button>
                            <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-ellipsis"></span></button>
                            <ul class="dropdown-menu dropdown-menu-end p-0" style="z-index: 9999;">
                                <li><a class="dropdown-item" href="#!">View profile</a></li>
                                <li><a class="dropdown-item" href="#!">Report</a></li>
                                <li><a class="dropdown-item" href="#!">Manage notifications</a></li>
                                <li><a class="dropdown-item text-danger" href="#!">Delete Employee</a></li>
                            </ul>
                        </div>
                    </div>
                    @endhasrole
                </div>
            </div>
        </div>
        <!-- <div class="row g-0 g-md-4 g-xl-6"> -->
        <div class="col-md-12 col-lg-5 col-xl-12">
            <div class="sticky-leads-sidebar">
                <!-- <div class="lead-details-offcanvas bg-body scrollbar phoenix-offcanvas phoenix-offcanvas-fixed" id="productFilterColumn"> -->
                <!-- <div class="d-flex justify-content-between align-items-center mb-2 d-md-none">
                    <h3 class="mb-0">Employee Details</h3>
                    <button class="btn p-0" data-phoenix-dismiss="offcanvas"><span class="uil uil-times fs-7"></span></button>
                </div> -->



                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row align-items-center justify-content-between g-3 mb-3">
                                    <div class="col-12 col-md-auto">
                                        {!!$image!!}
                                        <!-- <div class="avatar avatar-4xl"> -->
                                            <!-- <img class="rounded-circle" src="{{(!empty($emp->emp_files->file_name)) ? url($emp->emp_files->file_path.$emp->emp_files->file_name) : url('upload/no_image.jpg')}}" alt=""></div> -->

                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <div class="d-flex">
                                            <!-- <div class="flex-1 d-md-none">
                                                <button class="btn px-3 btn-phoenix-secondary text-body-tertiary me-2" data-phoenix-toggle="offcanvas" data-phoenix-target="#productFilterColumn"><span class="fa-solid fa-bars"></span></button>
                                            </div> -->
                                            <div class="col-12 col-sm-auto flex-1">
                                                <h3 class="fw-bolder mb-2">{{$emp->full_name}}</h3>
                                                <p class="mb-0">{{$emp->departments->name}}</p>
                                                <p class="mb-0">{{$emp->designation->name}}</p>
                                                <a class="fw-bold">{{$emp->employee_number}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-underline fs-9" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active " id="profile-tab" data-bs-toggle="tab" href="#tab-profile" role="tab" aria-controls="tab-profile" aria-selected="true">Profile</a></li>
                            <li class="nav-item"><a class="nav-link " id="address-tab" data-bs-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Address</a></li>
                            <li class="nav-item"><a class="nav-link " id="bank-tab" data-bs-toggle="tab" href="#tab-bank" role="tab" aria-controls="tab-bank" aria-selected="false">Bank Details</a></li>
                            <li class="nav-item"><a class="nav-link " id="salary-tab" data-bs-toggle="tab" href="#tab-salary" role="tab" aria-controls="tab-salary" aria-selected="false">Salary</a></li>
                            <li class="nav-item"><a class="nav-link " id="entitlement-tab" data-bs-toggle="tab" href="#tab-entitlement" role="tab" aria-controls="tab-entitlement" aria-selected="false">Entitlement</a></li>
                            <li class="nav-item"><a class="nav-link " id="emergency-tab" data-bs-toggle="tab" href="#tab-emergency" role="tab" aria-controls="tab-emergency" aria-selected="false">Emergency Contact</a></li>
                            <li class="nav-item"><a class="nav-link " id="leave-tab" data-bs-toggle="tab" href="#tab-leave" role="tab" aria-controls="tab-leave" aria-selected="false">Leave</a></li>
                            <li class="nav-item"><a class="nav-link " id="timesheet-tab" data-bs-toggle="tab" href="#tab-timesheet" role="tab" aria-controls="tab-timesheet" aria-selected="false">Time Sheet</a></li>
                            <!-- <li class="nav-item"><a class="nav-link " id="projects-tab" data-employee-id="{{$emp->id}}" data-bs-toggle="tab" href="#tab-projects" role="tab" aria-controls="tab-projects" aria-selected="false">Projects</a></li>
                            <li class="nav-item"><a class="nav-link " id="tasks-tab" data-bs-toggle="tab" href="#tab-tasks" role="tab" aria-controls="tab-tasks" aria-selected="false">Tasks</a></li> -->
                            <li class="nav-item"><a class="nav-link " id="attachments-tab" data-bs-toggle="tab" href="#tab-attachments" role="tab" aria-controls="tab-attachments" aria-selected="false"><span class="fa-solid fa-paperclip me-2 tab-icon-color"></span>Attachments</a></li>
                        </ul>
                    </div>
                </div>

                <div class="phoenix-offcanvas-backdrop d-lg-none top-0" data-phoenix-backdrop="data-phoenix-backdrop"></div>
            </div>
        </div>

        <div class="col-md-7 col-lg-7 col-xl-12">
            <div class="lead-details-container">

                <div class="tab-content mt-3" id="myTabContent">


                    <div class="tab-pane fade show active mb-3" id="tab-profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 row-cols-xxl-3 g-3 mb-9">
                            <div class="col">
                                <div class="card h-100 hover-actions-trigger">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <h4 class="mb-2 line-clamp-1 lh-sm flex-1 me-5"></h4><span class="badge badge-phoenix fs--2 mb-4 badge-phoenix-warning">Personal</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-soid far fa-envelope me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Email : <span class="fw-semi-bold text-primary ms-1"> {{$emp?->work_email_address}} </span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid fas fa-phone-square-alt me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Phone : <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{$emp?->phone_number}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid fas fa-male me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Gender : <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{$emp?->genders->title}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid fas fa-birthday-cake me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Date of Birth : <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{format_date($emp?->date_of_birth)}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid far fa-user me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">reporting to : <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{$emp->managers?->full_name}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid fas fa-calendar-day me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Contact Start : <span class="ms-1 text-1100">{{format_date($emp?->contract_start_date)}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid fas fa-calendar-day me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Contact End : <span class="ms-1 text-1100">{{format_date($emp?->contract_end_date)}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-4"><span class="fa-solid fas fa-file-invoice-dollar me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Net salary : <span class="fw-semi-bold text-success ms-1">{{$emp->salaries?->net_salary}}</span></p>
                                        </div>
                                        <!-- <div class="d-flex justify-content-between text-body-tertiary fw-semibold">
                                            <p class="mb-2"> Progress</p>
                                            <p class="mb-2 text-1100">{{1*100}}%</p>
                                        </div> -->
                                        <!-- <div class="progress bg-success-100">
                                            <div class="progress-bar rounded bg-primary" role="progressbar" aria-label="Success example" style="width: {{1*100}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card h-100 hover-actions-trigger">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <h4 class="mb-2 line-clamp-1 lh-sm flex-1 me-5"></h4><span class="badge badge-phoenix fs--2 mb-4 badge-phoenix-warning">Address</span>
                                            <!-- <div class="hover-actions top-0 end-0 mt-8 me-4">
                                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-gear"></span></button>
                                                <div class="dropdown-menu dropdown-menu-end py-2">
                                                    @if (Auth::user()->can('project.edit'))
                                                    <a class="dropdown-item" href="javascript:void(0);" id="add_edit_project" data-action="update" data-source="list" data-type="edit" data-table="none" data-id="" data-redirect="card" data-workspace_id="{{session()->get('workspace_id')}}">Edit</a>
                                                    @endif
                                                    @if (Auth::user()->can('project.delete'))
                                                    <a class="dropdown-item text-danger" href="#!" id="delete" data-id="" title="Delete" class="card-link">Delete</a>
                                                    @endif
                                                </div>

                                            </div> -->
                                        </div>
                                        <div class="d-flex align-items-center">
                                        </div>
                                        @foreach ($emp->addresses as $key => $item )
                                        @if ($item->primary_address == 'Y' )
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid far fa-address-book me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Type : <span class="fw-semi-bold text-primary ms-1"> {{$item->address_types?->title}} </span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid far fa-address-card me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Address 1 : <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{$item->address1}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid far fa-address-card me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Address 2 : <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{$item->address2}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid fas fa-birthday-cake me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">City : <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{$item->city}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid far fa-user me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">State : <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{$item->state}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid fas fa-calendar-day me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Zipcode: <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{$item->zipcode}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-4"><span class="fa-solid fas fa-calendar-day me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-8">Country: <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{$item->country?->country_name}}</span></p>
                                        </div>
                                        @endif
                                        @endforeach
                                        <!-- <div class="d-flex justify-content-between text-body-tertiary fw-semibold">
                                            <p class="mb-2"> Progress</p>
                                            <p class="mb-2 text-1100">{{1*100}}%</p>
                                        </div> -->
                                        <!-- <div class="progress bg-success-100">
                                            <div class="progress-bar rounded bg-primary" role="progressbar" aria-label="Success example" style="width: {{1*100}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card h-100 hover-actions-trigger">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <h4 class="mb-2 line-clamp-1 lh-sm flex-1 me-5"></h4><span class="badge badge-phoenix fs--2 mb-4 badge-phoenix-warning">Bank</span>
                                            <!-- <div class="hover-actions top-0 end-0 mt-8 me-4">
                                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-gear"></span></button>
                                                <div class="dropdown-menu dropdown-menu-end py-2">
                                                    @if (Auth::user()->can('project.edit'))
                                                    <a class="dropdown-item" href="javascript:void(0);" id="add_edit_project" data-action="update" data-source="list" data-type="edit" data-table="none" data-id="" data-redirect="card" data-workspace_id="{{session()->get('workspace_id')}}">Edit</a>
                                                    @endif
                                                    @if (Auth::user()->can('project.delete'))
                                                    <a class="dropdown-item text-danger" href="#!" id="delete" data-id="" title="Delete" class="card-link">Delete</a>
                                                    @endif
                                                </div>

                                            </div> -->
                                        </div>
                                        <div class="d-flex align-items-center">
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid far fa-address-book me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Branch : <span class="fw-semi-bold text-primary ms-1"> {{$emp->banks?->bank_branch_name}} </span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid far fa-address-card me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">Account name : <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1"> {{$emp->banks?->bank_account_name}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid far fa-address-card me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">IBAN : <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{$emp->banks?->bank_account_name}}</span></p>
                                        </div>
                                        <div class="d-flex align-items-center mb-2"><span class="fa-solid fas fa-birthday-cake me-2 text-700 fs--1 fw-extra-bold"></span>
                                            <p class="mb-0 fw-bold fs-9">SWIFT code : <span class="fw-semibold text-body-tertiary text-opactity-85 ms-1">{{$emp->banks?->bank_account_name}}</span></p>
                                        </div>

                                        <!-- <div class="d-flex justify-content-between text-body-tertiary fw-semibold">
                                            <p class="mb-2"> Progress</p>
                                            <p class="mb-2 text-1100">{{1*100}}%</p>
                                        </div> -->
                                        <!-- <div class="progress bg-success-100">
                                            <div class="progress-bar rounded bg-primary" role="progressbar" aria-label="Success example" style="width: {{1*100}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade mb-3" id="tab-address" role="tabpanel" aria-labelledby="address-tab">

                        <div class=" col-12 col-sm-12 col-xl-12 col-xxl-12 g-3 mb-9">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between mb-2 mt-4">
                                    <div class="d-flex justify-content-center">
                                        <p>Address</p>
                                        <div id="cover-spin" style="display:none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="#!" id="add_employee_address" data-action="store" data-source="manage" data-type="add" data-table="employee_address_table" data-id="0">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee_address', 'Create employee address') ?>">
                                                <i class="bx bx-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="employee-address">
                                    <x-employee-addresses-card :emp="$emp"></x-employee-addresses-card>
                                </div>
                            </div>

                            <script src="{{asset('assets/js/pages/employee_addresses.js')}}"></script>
                        </div>
                    </div>
                    <div class="tab-pane fade mb-3" id="tab-bank" role="tabpanel" aria-labelledby="bank-tab">
                        <div class=" col-12 col-sm-12 col-xl-12 col-xxl-12 g-3 mb-9">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between mb-2 mt-4">
                                    <div class="d-flex justify-content-center">
                                        <div id="cover-spin" style="display:none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div>
                                        <!-- <a href="#!" id="add_employee_bank" data-action="store" data-source="manage" data-type="add" data-table="employee_bank_table" data-id="0">
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee_bank', 'Create employee bank') ?>">
                                                    <i class="bx bx-plus"></i>
                                                </button>
                                            </a> -->
                                    </div>
                                    @hasanyrole('SuperAdmin|HRMSADMIN')
                                    <div>
                                        <a href="#!" id="add_employee_bank" action="store" data-source="profile" data-type="add" data-table="employee_bank_table" data-employeeId="{{$emp->id}}">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee_bank', 'Create employee bank') ?>">
                                                <i class="bx bx-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @endhasanyrole
                                </div>
                                <x-employee-profile-bank-card employeeid="{{$emp->id}}" />
                            </div>

                            <script src="{{asset('assets/js/pages/employees_banks.js')}}"></script>
                        </div>
                    </div>
                    <div class="tab-pane fade mb-3" id="tab-salary" role="tabpanel" aria-labelledby="salary-tab">
                        <div class=" col-12 col-sm-12 col-xl-12 col-xxl-12 g-3 mb-9">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between mb-2 mt-4">
                                    <div class="d-flex justify-content-center">
                                        <div id="cover-spin" style="display:none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    @hasanyrole('SuperAdmin|HRMSADMIN')
                                    <div>
                                        <a href="#!" id="add_employee_salary" data-action="store" data-source="manage" data-type="add" data-table="employee_salary_table" data-id="0">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee_salary', 'Create employee salary') ?>">
                                                <i class="bx bx-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @endhasanyrole
                                </div>
                                <x-employee-profile-salary-card employeeid="{{$emp->id}}" />
                            </div>

                            <script src="{{asset('assets/js/pages/employees_salary.js')}}"></script>
                        </div>
                    </div>
                    <div class="tab-pane fade mb-3" id="tab-emergency" role="tabpanel" aria-labelledby="emergency-tab">

                        <div class=" col-12 col-sm-12 col-xl-12 col-xxl-12 g-3 mb-9">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between mb-2 mt-4">
                                    <div class="d-flex justify-content-center">
                                        <div id="cover-spin" style="display:none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="#!" id="add_employee_emergency_contact" action="store" data-source="profile" data-type="add" data-table="employee_emergency_table" data-employeeId="{{$emp->id}}">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_emergency', 'Create emergency contract') ?>">
                                                <i class="bx bx-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <x-employee-profile-emergency-card employeeid="{{$emp->id}}" />
                            </div>

                            <script src="{{asset('assets/js/pages/employees_emergency_contacts.js')}}"></script>
                        </div>
                    </div>
                    <div class="tab-pane fade mb-3" id="tab-leave" role="tabpanel" aria-labelledby="leave-tab">

                        <div class=" col-12 col-sm-12 col-xl-12 col-xxl-12 g-3 mb-9">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between mb-2 mt-4">
                                    <div class="d-flex justify-content-center">
                                        <!-- <div id="cover-spin" style="display:block;" role="status"> -->
                                        <!-- <span class="visually-hidden">Loading...</span> -->
                                        <a href="#!" id="show_leave_balance" action="store" data-source="profile" data-type="add" data-table="employee_leave_table" data-employeeid="{{$emp->id}}">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('check_leave_balance', 'Check leave balance') ?>">
                                                <i class="fa-solid fa-scale-balanced"></i>
                                            </button>
                                        </a>
                                        <!-- </div> -->
                                    </div>
                                    <div>
                                        <a href="#!" id="add_employee_leave" action="store" data-source="profile" data-type="add" data-table="employee_leave_table" data-employeeId="{{$emp->id}}">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_leave', 'Apply for a Leave') ?>">
                                                <i class="bx bx-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <x-employee-profile-leave-card employeeid="{{$emp->id}}" totalleavestaken="{{$total_leave_taken}}" />
                            </div>

                            <script src="{{asset('assets/js/pages/employees_leaves.js')}}"></script>
                        </div>
                    </div>
                    <div class="tab-pane fade mb-3" id="tab-timesheet" role="tabpanel" aria-labelledby="timesheet-tab">

                        <div class=" col-12 col-sm-12 col-xl-12 col-xxl-12 g-3 mb-9">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between mb-2 mt-4">
                                    <div class="d-flex justify-content-center">
                                        <div id="cover-spin" style="display:none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="#!" id="add_employee_timesheet" action="store" data-source="profile" data-type="add" data-table="employee_timesheet_table" data-employeeId="{{$emp->id}}">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_time_sheet', 'Create Time Sheet') ?>">
                                                <i class="bx bx-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <x-employee-profile-timesheet-card employeeid="{{$emp->id}}" />
                            </div>

                            <script src="{{asset('assets/js/pages/employees_timesheet.js')}}"></script>
                        </div>
                    </div>
                    <div class="tab-pane fade mb-3" id="tab-attachments" role="tabpanel" aria-labelledby="attachments-tab">

                        <div class=" col-12 col-sm-12 col-xl-12 col-xxl-12 g-3 mb-9">
                            <div class="container-fluid">
                                <div class="d-flex justify-content-between mb-2 mt-4">
                                    <div class="d-flex justify-content-center">
                                        <div id="cover-spin" style="display:none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    @if (Auth::user()->can('salary.create'))
                                    <div>
                                        <a href="#!" id="add_employee_file" action="store" data-source="profile" data-type="add" data-table="employee_file_table" data-employeeId="{{$emp->id}}">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('upload_file', 'Upload new file') ?>">
                                                <i class="bx bx-plus"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                <x-employee-file-card :emp="$emp" />
                            </div>

                            <script src="{{asset('assets/js/pages/employees_file.js')}}"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
    <script src="{{asset('assets/js/pages/profile.js')}}"></script>


    <!-- </div> -->

    <!-- </div> -->

    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    @endsection

    @push('script')


    @endpush
