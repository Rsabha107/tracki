@extends('tracki.event.layout.event-add-layout')
@section('main')

<div class="content">
    <div class="row g-4 g-xl-0 mt-3">
        <div class="d-flex justify-content-between m-2">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="{{url('/home')}}"><?= get_label('home', 'Home') ?></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('tracki.employee')}}"><?= get_label('employee', 'Employee') ?></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('tracki.employee.timesheet')}}"><?= get_label('timesheet', 'timesheet') ?></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$employee_timesheet->employees->full_name}}
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$employee_timesheet->timesheet_period}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">


                <div class="row g-0">
                    <div class="col-12 col-xxl-12 px-0 bg-white border-xxl border-top-sm">
                        <div class="px-4 px-lg-6 pt-6 pb-9">

                            <div class="border-bottom mb-7 mx-n3 px-2 px-lg-6">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="d-sm-flex justify-content-between">
                                            <h3 class="mb-4">Create Time Sheet ({{$employee_timesheet->employees->full_name}} for period: {{$employee_timesheet->timesheet_period}} )</h3>
                                            <div class="d-flex mb-3">
                                                <a class="btn btn-subtle-danger me-1 mb-1" href="{{ route('tracki.employee.timesheet') }}">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form class="row g-3  px-3 needs-validation form-submit-event1" novalidate="" action="{{ route ('tracki.employee.timesheet.entries.store') }}" method="POST">
                                @csrf

                                @php
                                $start_timesheet_entry = 1; // we will always start with 1 unless the contract start date of the month selected is other than 1
                                $end_timesheet_entry = $employee_timesheet->days_in_month;

                                // get the number of days in the selected month
                                $employee_timesheet->days_in_month = getDaysInMonthOfYear($employee_timesheet->timesheet_period);

                                // pase the contract start date and get the month-year values to compare with the selected timesheet period
                                $contract_start_date_MY = \Carbon\Carbon::parse($employee_timesheet->employees->contract_start_date)->format('F-Y');

                                // pase the contract end date and get the month-year values to compare with the selected timesheet period
                                $contract_end_date_MY = \Carbon\Carbon::parse($employee_timesheet->employees->contract_end_date)->format('F-Y');


                                // if the timesheet period is the same as contract_start_date_MY then we get the day token of the contract start date
                                if ($contract_start_date_MY == $employee_timesheet->timesheet_period){
                                    $contract_start_date_D = \Carbon\Carbon::parse($employee_timesheet->employees->contract_start_date)->format('j');
                                    $start_timesheet_entry = $contract_start_date_D;
                                }

                                // if the timesheet period is the same as contract_end_date_MY then we get the day token of the contract end date
                                if ($contract_end_date_MY == $employee_timesheet->timesheet_period){
                                    $contract_end_date_D = \Carbon\Carbon::parse($employee_timesheet->employees->contract_end_date)->format('j');
                                    $end_timesheet_entry = $contract_end_date_D;
                                } else {
                                    $end_timesheet_entry = $employee_timesheet->days_in_month;
                                }

                                @endphp
                                <table class="lh-sm table  bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Day</th>
                                            <th scope="col">Date</th>
                                            <th scope="col col-md-6">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" name="employee_timesheet_id" value="{{$employee_timesheet->id}}">
                                        <input type="hidden" name="employee_id" value="{{$employee_timesheet->employee_id}}">
                                        <input type="hidden" name="employee_timesheet->days_in_month" value="{{$employee_timesheet->days_in_month}}">
                                        @for ($i = $start_timesheet_entry; $i < $end_timesheet_entry + 1; ++$i)

                                            @php
                                            $constructed_timesheet_date = \Carbon\Carbon::parse($i.'-'.$employee_timesheet->timesheet_period);
                                            $short_day_name = $constructed_timesheet_date->format('D');
                                            $is_weekend = $constructed_timesheet_date->isWeekend();

                                            // we have to set when the weekend starts in \app\Providers\AppServiceProvider.php
                                            if ($is_weekend){
                                            $day_color = 'warning';
                                            } else {
                                            $day_color = 'body';
                                            }

                                            $is_leave = false;
                                            $is_leave = hasApprovedLeave($employee_timesheet->year_selected,$months->month_number,$i,$employee_timesheet->employee_id);
                                            if ($is_leave){
                                            $is_selected_pl = 'selected';
                                            $is_selected_w = null;
                                            $is_pl_disabled = null;
                                            } else {
                                            $is_selected_w = 'selected';
                                            $is_selected_pl = null;
                                            $is_pl_disabled = 'disabled';
                                            }
                                            @endphp

                                            <tr>
                                                <td class="align-top py-1 text-{{$day_color}} text-nowrap fw-bold ps-3">{{$short_day_name}} </td>
                                                <td class="align-top py-1 text-{{$day_color}} text-nowrap fw-bold ps-3">{{$i}} </td>
                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">

                                                    <input type="hidden" name="calendar_day[]" value="{{$i}}">


                                                    <select class="form-select col-md-6 text-{{$day_color}}" aria-label="Default select example" name="day_action[]">
                                                        <option selected="">Open this select menu</option>
                                                        <option value="W" {{$is_selected_w}}>Worked</option>
                                                        <option value="L" {{$is_selected_pl}}>Paid Leave</option>
                                                        <option value="U">Unpaid Leave</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            @endfor
                                    </tbody>
                                </table>
                                <div class="col-12 d-flex justify-content-end mt-6">
                                    <button class="btn btn-subtle-primary me-1 mb-1 action button-submit" type="submit" value="save">Save</button>
                                    <a class="btn btn-subtle-danger me-1 mb-1" href="{{ route('tracki.employee.timesheet') }}">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>

        <!-- ===============================================-->
        <!--    End of Main Content-->
        <!-- ===============================================-->

        @endsection

        @push('script')


        @endpush
