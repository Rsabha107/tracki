@extends('tracki.layout.dashboard')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<div class="content">
    <div class="container-fluid">
        <div class="mb-2">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="{{route('tracki.dashboard')}}"><?= get_label('home', 'Home') ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= get_label('employees', 'Employees') ?>
                        </li>

                    </ol>
                </nav>
            </div>
            <div class="d-flex justify-content-center">
                <div id="cover-spin" style="display:none;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">Employees (Manager View)</h2>
            </div>
        </div>
        <?php
        /*
        <!-- <div class="mb-4 mt-4">
            <div class="d-flex flex-wrap gap-3">
                <div >
                    <select class="form-select select-appearance" id="directorate_filter" aria-label="Default select example">
                        <option value="" selected><?= get_label('select_directorate', 'Select directorate') ?></option>
                        @foreach ($directorate as $key)
                        <option value="{{$key->id}}">{{$key->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div >
                    <select class="form-select select-appearance" id="entity_filter" aria-label="Default select example">
                        <option value="" selected><?= get_label('select_entity', 'Select entity') ?></option>
                        @foreach ($entities as $key)
                        <option value="{{$key->id}}">{{$key->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div >
                    <select class="form-select select-appearance" id="department_filter" aria-label="Default select example">
                        <option value="" selected><?= get_label('select_department', 'Select department') ?></option>
                        @foreach ($departments as $key)
                        <option value="{{$key->id}}">{{$key->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div >
                    <select class="form-select select-appearance" id="functional_area_filter" aria-label="Default select example">
                        <option value=""><?= get_label('select_functional_area', 'Select fucntional area') ?></option>
                        @foreach ($functional as $key)
                        @php
                        $selected = (request()->has('status') && request()->status == $status->id) ? 'selected' : '';
                        @endphp
                        <option value="{{ $key->id }}" {{ $selected }}>{{ $key->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="ms-xxl-auto">
                    @if (Auth::user()->can('employee.create'))
                    <a href="#!" id="add_employee" data-action="store" data-source="manage" data-type="add" data-table="employee_table" data-id="0">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee', 'Create employee') ?>">
                            <i class="bx bx-plus"></i>
                        </button>
                    </a>
                    @endif
                </div>
            </div>
        </div> -->
        */
        ?>
        <x-managers-card :emps='$emps' />
    </div>

    <script src="{{asset('assets/js/pages/employees.js')}}"></script>

    @endsection

    @push('script')


    @endpush
