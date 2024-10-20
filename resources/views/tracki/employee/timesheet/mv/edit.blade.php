<!-- <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST"> -->
<!-- @csrf -->

<!-- <script src="{{asset('assets/js/custom.js')}}"></script> -->
<script src="{{ asset ('assets/tracki/js/phoenix.js') }}"></script>
<!-- <script src="{{asset('assets/js/pages/employees.js')}}"></script> -->


<!-- <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST"> -->
<!-- @csrf -->

<!-- <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST"> -->
@csrf

<input type="hidden" id="add_employee_timesheet_id_h" name="id" value="{{$employee_timesheet->id}}">
<input type="hidden" id="add_employee_table_h" name="table" value="employee_timesheet_table">

<div class="modal-body">

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
