<!-- <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST"> -->
<!-- @csrf -->

<!-- <script src="{{asset('assets/js/custom.js')}}"></script> -->
<script src="{{ asset ('assets/tracki/js/phoenix.js') }}"></script>
<!-- <script src="{{asset('assets/js/pages/employees.js')}}"></script> -->


<!-- <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST"> -->
<!-- @csrf -->

<!-- <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST"> -->
@csrf

<input type="hidden" id="add_employee_salary_id_h" name="id" value="{{$employee_salary->id}}">
<input type="hidden" id="add_employee_table_h" name="table" value="employee_salary_table">

<div class="modal-body">

    <div class="row mb-5">
        <!-- begining of left div -->
        <div class="col-md-12">
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label class="form-label" for="inputEmail4">Employee</label>
                    <input class="form-control" type="text" placeholder="" value="{{ $employee_salary->employees->full_name }}" disabled>
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="inputEmail4">Net Salary</label>
                    <input name="net_salary" id="edit_net_salary" class="form-control" type="text" placeholder="" value="{{$employee_salary->net_salary}}">
                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                </div>
            </div>
        </div>
        <!-- end of left div -->
    </div>

    <a href="javascript:void(0)" class="btn btn-sm" id="add_employee_salary_elements" data-action="update" "="" data-type="edit" data-id="2" data-table="employee_salary_table" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Update" data-bs-original-title="Update"><i class="fa-solid fa-pen-to-square text-primary"></i></a>

    <div class="accordion" id="accordionExample">
        <div class="accordion-item border-top">
            <h2 class="accordion-header" id="headingOne">

                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Earnings
                </button>
            </h2>
            <div class="accordion-collapse collapse" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body pt-0">
                    <div class="collapse" id="accordionExample">
                        <a id="collapse_task_subtask" class="btn btn-link p-0 collapsed mb-2" data-bs-toggle="collapse" href="#collapseTaskSubtask" aria-expanded="false" aria-controls="collapseExample">
                            + Add new subtask
                        </a>
                        <form class="needs-validation form-submit-task-new-subtask" id="form_submit_task_new_subtask" novalidate="" action="{{ route('tracki.task.subtask.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="modal-body px-0">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="parent_task_id" id="subtask_parent_task_id_overview" value="">
                                            <input type="hidden" name="table" value="task_table">

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label" for="inputEmail4">Title</label>
                                                <input name="title" class="form-control" type="text" placeholder="" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label" for="inputAddress">Priority</label>
                                                <select name="priority_id" class="form-select" id="floatingSelectRating" required>
                                                    <option selected="selected" value="">Select...</option>
                                                    @foreach ($priorities as $key => $item )
                                                    @if (Request::old('id') == $item->id )
                                                    <option value="{{ $item->id  }}" selected>
                                                        {{ $item->title }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $item->id  }}">
                                                        {{ $item->title }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label" for="gridCheck">Description</label>
                                                <textarea required name="description" class="form-control" id="floatingProjectOverview" data-tinymce="{}" placeholder=""></textarea>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end mt-6">
                                                <button class="btn btn-sm btn-outline-primary px-6 action button-submit" type="submit" value="save" id="add_subtask_btn">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">

                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Deductions

                </button>
            </h2>
            <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body pt-0">
                    Add deductions here
                </div>
            </div>
        </div>
    </div>

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
