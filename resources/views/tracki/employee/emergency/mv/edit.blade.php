<!-- <script src="{{asset('assets/js/custom.js')}}"></script> -->
<script src="{{ asset ('assets/tracki/js/phoenix.js') }}"></script>
<!-- <script src="{{asset('assets/js/pages/employees.js')}}"></script> -->

@csrf
<input type="hidden" id="add_employee_leave_id_h" name="id" value="{{$employee_bank->id}}">
<input type="hidden" id="add_employee_leave_table_h" name="table" value="employee_bank_table">

<div class="modal-body">
    <!-- <div class="row"> -->
    <!-- begining of left div -->
    <div class="col-md-12">
        <!-- <div class="mb-3 row"> -->

        <div class="col-md-12 mb-3">
            <label class="form-label" for="inputEmail4">Employee</label>
            <input class="form-control" type="text" placeholder="" value="{{ $employee_bank->employees->full_name }}" disabled>
            <!-- <div class="invalid-feedback">This field is required.</div> -->
            <!-- <div class="invalid-feedback">This field is required.</div> -->
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="inputEmail4">Bank Branch Name</label>
            <input name="bank_branch_name" class="form-control" type="text" placeholder="" value="{{$employee_bank->bank_branch_name}}">
            <!-- <div class="invalid-feedback">This field is required.</div> -->
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="inputEmail4">Bank Account Name</label>
            <input name="bank_account_name" class="form-control" type="text" placeholder="" value="{{$employee_bank->bank_account_name}}">
            <!-- <div class="invalid-feedback">This field is required.</div> -->
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="inputEmail4">IBAN</label>
            <input name="iban" class="form-control" type="text" placeholder="" value="{{$employee_bank->iban}}">
            <!-- <div class="invalid-feedback">This field is required.</div> -->
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="inputEmail4">Swift Code</label>
            <input name="swift_code" class="form-control" type="text" placeholder="" value="{{$employee_bank->swift_code}}">
            <!-- <div class="invalid-feedback">This field is required.</div> -->
        </div>
        <!-- </div> -->
    </div>
    <!-- end of left div -->
    <!-- </div> -->
    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
</div>
<!-- </form> -->
