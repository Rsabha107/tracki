<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<div class="align-middle white-space-wrap fw-bold fs-8">{{$employee_timesheet->employees->full_name}} - {{$employee_timesheet->timesheet_period}}</div>
<p></p>
<table class="table table-sm">
            <thead>
                <tr>
                    <th scop="col">Day</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($employee_timesheet_entries as $employee_timesheet_entry)
                <tr>
                    <th scope="row">{{ \Carbon\Carbon::parse($employee_timesheet_entry->calendar_day.'-'.$employee_timesheet->timesheet_period)->format('D') }}</th>
                    <th scope="row">{{ $employee_timesheet_entry->calendar_day }}</th>
                    <td class="text-{{$employee_timesheet_entry->entry_actions->color}}">{{ $employee_timesheet_entry->entry_actions->title }}</td>

                </tr>
                @endforeach

            </tbody>
        </table>

