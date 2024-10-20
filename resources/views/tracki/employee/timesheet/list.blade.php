@extends('tracki.layout.dashboard')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<div class="content">
    <div class="container-fluid">
        <!-- <div class="d-flex justify-content-between mb-2 mt-4"> -->
        <div class="mb-2">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="{{route('tracki.employee.dashboard')}}"><?= get_label('home', 'Home') ?></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('tracki.employee')}}">
                                <?= get_label('employees', 'Employees') ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= get_label('employee_timesheet', 'Employee Time Sheet') ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">Time Sheets</h2>
            </div>
        </div>
        <div class="mb-4 mt-4">
            <div class="d-flex flex-wrap gap-3">
                <!-- <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search products" aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>

                    </form>
                </div> -->
                <div class="col-md-2">
                    <select class="form-select select-appearance" id="timesheet_period_filter" aria-label="Default select example">
                        <option value="" selected><?= get_label('select_timesheet_period', 'Select month') ?></option>
                        @foreach ($timesheet_periods as $employee_timesheet)
                        <option value="{{$employee_timesheet->timesheet_period}}">{{$employee_timesheet->timesheet_period}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select select-appearance" id="timesheet_status_filter" aria-label="Default select example">
                        <option value=""><?= get_label('select_status', 'Select status') ?></option>
                        @foreach ($employee_leave_statuses as $status)
                        @php
                        $selected = (request()->has('status') && request()->status == $status->id) ? 'selected' : '';
                        @endphp
                        <option value="{{ $status->id }}" {{ $selected }}>{{ $status->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="ms-xxl-auto">
                    <!-- <button class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span>Export</button> -->
                    <!-- <button class="btn btn-primary" id="addBtn"><span class="fas fa-plus me-2"></span>Add product</button> -->
                    <a href="#!" id="add_employee_timesheet" data-action="store" data-source="manage" data-type="add" data-table="employee_timesheet_table" data-id="0">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee_timesheet', 'Create employee_timesheet') ?>">
                            <i class="bx bx-plus"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <!-- <div>
            <a href="#!" id="add_employee_timesheet" data-action="store" data-source="manage" data-type="add" data-table="employee_timesheet_table" data-id="0">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee_timesheet', 'Create employee_timesheet') ?>">
                    <i class="bx bx-plus"></i>
                </button>
            </a>
        </div> -->
        <!-- </div> -->
        <x-employee-timesheet-card :employeetimesheets="$employee_timesheets" :employeeleavestatuses="$employee_leave_statuses" employeeid="" />
    </div>

    <script src="{{asset('assets/js/pages/employees_timesheet.js')}}"></script>

    @endsection

    @push('script')


    @endpush
