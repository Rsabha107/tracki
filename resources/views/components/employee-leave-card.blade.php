<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            {{$slot}}
            <input type="hidden" id="data_type" value="tags">
            <table id="employee_leave_table" 
                data-classes="table table-hover  fs-9 mb-0 border-top border-translucent"
                data-toggle="table" 
                data-loading-template="loadingTemplate"
                data-url="{{route('tracki.employee.leave.list', $employeeid)}}"
                data-icons-prefix="bx"
                data-icons="icons"
                data-show-export="true"
                data-export-types="['csv', 'txt', 'doc', 'excel', 'xlsx', 'pdf']"
                data-show-refresh="true" 
                data-total-field="total"
                data-trim-on-search="false" 
                data-data-field="rows"
                data-page-list="[5, 10, 20, 50, 100, 200]" 
                data-search="true"
                data-side-pagination="server" 
                data-show-columns="true"
                data-pagination="true" 
                data-sort-name="id" 
                data-sort-order="desc"
                data-mobile-responsive="true" 
                data-query-params="queryParams">
                <thead>
                    <tr>
                        <th data-checkbox="true" data-halign="left" data-align="center" data-visible="false"></th>
                        <th data-sortable="true" data-field="image" data-align="center"></th>
                        <!-- <th data-sortable="true" data-field="id1"><?= get_label('id', 'ID') ?></th> -->
                        <!-- <th data-sortable="true" data-field="id"><?= get_label('id', 'ID') ?></th> -->
                        <th data-sortable="true" data-field="employee_number"><?= get_label('employee_number', 'Emp Number') ?></th>
                        <th data-sortable="true" data-field="full_name"><?= get_label('full_name', 'Name') ?></th>
                        <th class="align-middle white-space-nowrap fs-9 text-body" data-sortable="true" data-field="leave_type"><?= get_label('leave_type', 'Leave Type') ?></th>
                        <th data-sortable="true" data-field="date_from"><?= get_label('date_from', 'From') ?></th>
                        <th data-sortable="true" data-field="date_to"><?= get_label('date_to', 'To') ?></th>
                        <th data-sortable="true" data-field="number_of_days"><?= get_label('number_of_days', 'No of Days') ?></th>
                        <th data-sortable="true" data-field="reason"><?= get_label('reason', 'Reason') ?></th>
                        <th data-sortable="true" data-field="approved_by"><?= get_label('approved_by', 'Approver') ?></th>
                        <th data-sortable="true" data-field="status"><?= get_label('status', 'Status') ?></th>
                        <th data-sortable="true" data-field="created_at" data-visible="false"><?= get_label('created_at', 'Created at') ?></th>
                        <th data-sortable="true" data-field="updated_at" data-visible="false"><?= get_label('updated_at', 'Updated at') ?></th>
                        <th data-sortable="true" data-field="attach"><span class="fas fa-paperclip me-1"></span></th>
                        <th data-field="actions"><?= get_label('actions', 'Actions') ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
