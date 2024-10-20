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
                    <li class="breadcrumb-item"><a href="{{route('tracki.employee')}}">
                            <?= get_label('employees', 'Employees') ?></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('tracki.employee.timesheet')}}">
                        <?= get_label('employee_timesheet', 'Employee Time Sheet') ?></a>
                    </li>
                    <li class="breadcrumb-item active">
                        <?= get_label('employee_timesheet', 'Time Sheet Entry') ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-between align-items-end mb-4 g-3">
        <div class="col-12 col-sm-auto">
            <h2 class="mb-0">{{$employee_timesheets->employees->full_name}}<span class="fw-normal text-700 ms-3">({{$employee_timesheets->timesheet_period}})</span></h2>
        </div>
        <div class="col-12 col-sm-auto">
            <div class="d-flex align-items-center">
                <div class="search-box me-3">
                </div>
                <!-- <a href="#!" id="add_employee_timesheet" data-action="store" data-source="manage" data-type="add" data-table="employee_timesheet_table" data-id="0">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee_timesheet', 'Create employee_timesheet') ?>">
                        <i class="bx bx-plus"></i>
                    </button>
                </a> -->
            </div>
        </div>
    <!-- </div> -->


    <!-- <div class="d-flex justify-content-center">
        <div id="cover-spin" style="display:none;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div>
        <a href="#!" id="add_employee_timesheet" data-action="store" data-source="manage" data-type="add" data-table="employee_timesheet_table" data-id="0">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee_timesheet', 'Create employee_timesheet') ?>">
                <i class="bx bx-plus"></i>
            </button>
        </a>
    </div> -->
    <!-- </div> -->
    <x-employee-timesheet-entry-card :employeetimesheetentries='$employee_timesheet_entries' timesheetId="{{$employee_timesheets->id}}" />
</div>

<script src="{{asset('assets/js/pages/employees_timesheet_entry.js')}}"></script>

@endsection

@push('script')


@endpush
