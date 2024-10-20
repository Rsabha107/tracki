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
                            <a href="{{route('tracki.project.show.card')}}"><?= get_label('task', 'Tasks') ?></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('tracki.project.show.card')}}"><?= get_label('information', 'Information') ?></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$employee_timesheet->month_selection}}
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
                                            <h3 class="mb-4">Edit task ( {{$employee_timesheet->month_selection}} )</h3>
                                            <div class="d-flex mb-3">
                                                <a class="btn btn-subtle-danger me-1 mb-1" href="{{ route('tracki.employee.timesheet') }}">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form class="row g-3  px-3 needs-validation form-submit-event1" id="edit_employee_timesheet_form" novalidate="" action="{{ route ('tracki.employee.timesheet.update') }}" method="POST">
                                @csrf
                                <table class="lh-sm table  bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Day</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 1; $i < getDaysInMonthOfYear($employee_timesheet->month_selection) + 1; ++$i)
                                            <tr>
                                                <td class="align-top py-1 text-body text-nowrap fw-bold ps-3">{{$i}} : </td>
                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">

                                                    <input type="hidden" name="calendar_day[{{$i}}]" value="{{$i}}">

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="day_action[{{$i}}]" value="W" />
                                                        <label class="form-check-label text-primary" for="inlineRadio1">Worked</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="day_[{{$i}}]" value="L" />
                                                        <label class="form-check-label" for="inlineRadio2">Paid Leave</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="day_[{{$i}}]" value="U" />
                                                        <label class="form-check-label" for="inlineRadio3">Unpaid Leave</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endfor
                                    </tbody>
                                </table>
                                <div class="col-12 d-flex justify-content-end mt-6">
                                    <button class="btn btn-subtle-primary me-1 mb-1 action button-submit" type="submit" value="save">Save</button>
                                    <a class="btn btn-subtle-danger me-1 mb-1" href="{{ route('tracki.employee.timesheet) }}">Cancel</a>
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
