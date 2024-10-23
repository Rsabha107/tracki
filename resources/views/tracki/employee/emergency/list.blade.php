@extends('tracki.layout.dashboard')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-2 mt-2">
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
                            <li class="breadcrumb-item active">
                                <?= get_label('employee_emergencies', 'Employee Emergency Contact') ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div>
                <a href="#!" id="add_employee_emergency_contact" data-action="store" data-source="manage" data-type="add" data-table="employee_emergency_table" data-id="0">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee_emergency', 'Create employee_emergency') ?>">
                        <i class="bx bx-plus"></i>
                    </button>
                </a>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">Emergency Contacts</h2>
            </div>
        </div>
        <x-employee-emergency-card employeeid="" />

    </div>

    <script src="{{asset('assets/js/pages/employees_emergency_contacts.js')}}"></script>

    @endsection

    @push('script')


    @endpush