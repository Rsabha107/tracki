<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            {{$slot}}
            <input type="hidden" id="data_type" value="tags">
            <table  id="employee_table" data-classes="table table-hover  fs-9 mb-0 border-top border-translucent"
                    data-toggle="table" data-loading-template="loadingTemplate"
                    data-url="{{route('tracki.payroll.timesheet.missing.list')}}"
                    data-icons-prefix="bx"
                    data-icons="icons"
                    data-show-export="true"
                    data-export-types =  "['csv', 'txt', 'doc', 'excel', 'xlsx', 'pdf']"
                    data-show-refresh="true" data-total-field="total"
                    data-trim-on-search="false" data-data-field="rows"
                    data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true"
                    data-side-pagination="server" data-show-columns="true"
                    data-pagination="true" data-sort-name="id" data-sort-order="desc"
                    data-mobile-responsive="true" data-query-params="queryParams">
                <thead>
                    <tr>
                        <th data-checkbox="true" data-halign="left" data-align="center"></th>
                        <th data-sortable="true" data-field="image" data-align="center"></th>
                        <!-- <th data-sortable="true" data-field="id1"><?= get_label('id', 'ID') ?></th> -->
                        <!-- <th data-sortable="true" data-field="id"><?= get_label('id', 'ID') ?></th> -->
                        <th class="align-middle white-space-nowrap fs-9 text-body" data-sortable="true" data-field="employee_number"><?= get_label('employee_number', 'Emp Number') ?></th>
                        <th data-sortable="true" data-field="full_name"><?= get_label('full_name', 'Name') ?></th>
                        <th data-sortable="true" data-field="entity"><?= get_label('entity', 'Entity') ?></th>
                        <th data-sortable="true" data-field="contract_start_date"><?= get_label('contract_start_date', 'Start Date') ?></th>
                        <th data-sortable="true" data-field="contract_end_date"><?= get_label('contract_end_date', 'End Date') ?></th>
                        <th data-sortable="true" data-field="email_address"><?= get_label('email', 'Email') ?></th>
                        <!-- <th data-sortable="true" data-field="employee_type"><?= get_label('employee_type', 'Emp Type') ?></th> -->
                        <th data-sortable="true" data-field="reporting_to"><?= get_label('reporting_to', 'Supervisor Name') ?></th>
                        <!-- <th data-sortable="true" data-field="gender"><?= get_label('gender', 'Gender') ?></th> -->
                        <th data-sortable="true" data-field="salary"><?= get_label('salary', 'Base Salary') ?></th>

                        <th data-sortable="true" data-field="first_name" data-visible="false"><?= get_label('first_name', 'First Name') ?></th>
                        <th data-sortable="true" data-field="middle_name" data-visible="false"><?= get_label('middle_name', 'Middle Name') ?></th>
                        <th data-sortable="true" data-field="last_name" data-visible="false"><?= get_label('last_name', 'Last Name') ?></th>

                        <th data-sortable="true" data-field="personal_email_address" data-visible="false"><?= get_label('personal_email_address', 'Personal Email') ?></th>
                        <th data-sortable="true" data-field="salutation" data-visible="false"><?= get_label('salutation', 'Prefix') ?></th>
                        <th data-sortable="true" data-field="national_identifier_number" data-visible="false"><?= get_label('national_identifier_number', 'QID') ?></th>
                        <th data-sortable="true" data-field="civil_id_expiry" data-visible="false"><?= get_label('civil_id_expiry', 'QID Expiry Date') ?></th>
                        <th data-sortable="true" data-field="passport_number" data-visible="false"><?= get_label('passport_number', 'Passport#') ?></th>
                        <th data-sortable="true" data-field="passport_expiry" data-visible="false"><?= get_label('passport_expiry', 'Passport Expiry Date') ?></th>
                        <th data-sortable="true" data-field="job" data-visible="false"><?= get_label('job', 'Job') ?></th>
                        <th data-sortable="true" data-field="job_level" data-visible="false"><?= get_label('job_level', 'Job Level') ?></th>

                        <th data-sortable="true" data-field="phone_area_code" data-visible="false"><?= get_label('phone_area_code', 'Area Code') ?></th>
                        <th data-sortable="true" data-field="phone_number" data-visible="false"><?= get_label('phone_number', 'Phone Number') ?></th>
                        <th data-sortable="true" data-field="alt_area_code" data-visible="false"><?= get_label('alt_area_code', 'Alt Area Code') ?></th>
                        <th data-sortable="true" data-field="alt_phone_number" data-visible="false"><?= get_label('alt_phone_number', 'Alt Phone Number') ?></th>
                        <th data-sortable="true" data-field="directorate" data-visible="false"><?= get_label('directorate', 'Directorate') ?></th>
                        <th data-sortable="true" data-field="department" data-visible="false"><?= get_label('department', 'Department') ?></th>
                        <th data-sortable="true" data-field="functional_area" data-visible="false"><?= get_label('functional_area', 'Functional Area') ?></th>
                        <th data-sortable="true" data-field="marital_status" data-visible="false"><?= get_label('marital_status', 'Marital Status') ?></th>
                        <th data-sortable="true" data-field="date_of_birth" data-visible="false"><?= get_label('date_of_birth', 'Date of Birth') ?></th>
                        <th data-sortable="true" data-field="country_of_birth" data-visible="false"><?= get_label('country_of_birth', 'Country of Birth') ?></th>
                        <th data-sortable="true" data-field="nationality" data-visible="false"><?= get_label('nationality', 'Nationality') ?></th>
                        <th data-sortable="true" data-field="countract_type" data-visible="false"><?= get_label('countract_type', 'Countract Type') ?></th>
                        <th data-sortable="true" data-field="manager_flag" data-visible="false"><?= get_label('manager_flag', 'Manager?') ?></th>
                        <th data-sortable="true" data-field="created_at" data-visible="false"><?= get_label('created_at', 'Created at') ?></th>
                        <th data-sortable="true" data-field="updated_at" data-visible="false"><?= get_label('updated_at', 'Updated at') ?></th>
                        <th data-sortable="true" data-field="actions"><?= get_label('actions', 'Actions') ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
