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
                                <?= get_label('employee_banks', 'Employee Banks') ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div id="cover-spin" style="display:none;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div>
                @hasanyrole('SuperAdmin|HRMSADMIN')
                <a href="#!" id="add_employee_bank" data-action="store" data-source="manage" data-type="add" data-table="employee_bank_table" data-id="0">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee_bank', 'Create employee_bank') ?>">
                        <i class="bx bx-plus"></i>
                    </button>
                </a>
                @endhasanyrole
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">Banks</h2>
            </div>
        </div>
        <x-employee-bank-card employeeid="" />
    </div>

    <script src="{{asset('assets/js/pages/employees_banks.js')}}"></script>

    @endsection

    @push('script')


    @endpush