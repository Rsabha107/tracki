<!-- <script src="{{asset('assets/js/custom.js')}}"></script> -->
<script src="{{ asset ('assets/tracki/js/phoenix.js') }}"></script>
<!-- <script src="{{asset('assets/js/pages/employees.js')}}"></script> -->

<input type="hidden" id="add_employee_id_h" name="id" value="{{$employee_address->id}}">
<input type="hidden" id="add_employee_address_table_h" name="table" value="employee_address_table">

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12 mb-3">
                <label class="form-label" for="inputEmail4">Address Type</label>
                <select class="form-select" name="employee_address_type" id="employee_address_type_id" required>
                    <option value="" selected>Select...</option>
                    @foreach ($address_types as $key => $item )
                    @if ($employee_address->address_type == $item->id )
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

            <div class="col-md-12">
                <label class="form-label" for="inputEmail4">Address1</label>
                <input name="employee_address1" id="add_employee_address1" class="form-control" value="{{$employee_address->address1}}" type="text" placeholder="" required>
            </div>

            <div class="col-md-12">
                <label class="form-label" for="inputEmail4">Address2</label>
                <input name="employee_address2" id="add_employee_address2" class="form-control" type="text" value="{{$employee_address->address2}}" placeholder="Address2">
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label class="form-label" for="inputEmail4">City</label>
                    <input name="employee_city" id="add_employee_city" class="form-control" type="text" value="{{$employee_address->city}}" placeholder="City" required>
                </div>

                <div class="col-md-2">
                    <label class="form-label" for="inputEmail4">State</label>
                    <input name="employee_state" id="add_employee_state" class="form-control" type="text" value="{{$employee_address->state}}" placeholder="State">
                </div>

                <div class="col-md-5">
                    <label class="form-label" for="inputEmail4">Zipcode</label>
                    <input name="employee_zipcode" id="add_employee_zipcode" class="form-control" type="text" value="{{$employee_address->zipcode}}" placeholder="00000" required>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label" for="inputEmail4">Country</label>
                <select class="form-select" name="employee_address_country" id="add_employee_address_country_id" required>
                    <option value="">Select...</option>
                    @foreach ($countries as $key => $item )
                    @if ($employee_address->country_id == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->country_name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->country_name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-check">
                <input class="form-check-input" id="primaryAddress" name="primary_address" value="Y" type="checkbox" {{$employee_address->primary_address?'checked':''}} />
                <label class="form-check-label" for="primaryAddress">Primary address</label>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
</div>
