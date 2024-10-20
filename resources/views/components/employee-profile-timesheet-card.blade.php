<div class="card">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            {{$slot}}
            <input type="hidden" id="data_type" value="tags">
            <table id="employee_timesheet_table"
                data-classes="table table-hover  fs-9 mb-0 border-top border-translucent"
                data-toggle="table"
                data-loading-template="loadingTemplate"
                data-url="{{route('tracki.employee.timesheet.list', $employeeid)}}"
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
                        <!-- <th data-sortable="true" data-field="id1"><?= get_label('id', 'ID') ?></th> -->
                        <!-- <th data-sortable="true" data-field="id"><?= get_label('id', 'ID') ?></th> -->
                        <th data-sortable="true" data-field="timesheet_period"><?= get_label('timesheet_period', 'Month') ?></th>
                        <th data-sortable="true" data-field="designation"><?= get_label('designation', 'Designation') ?></th>
                        <th data-sortable="true" data-field="count_worked"><?= get_label('days_worked', 'Worked') ?></th>
                        <th data-sortable="true" data-field="count_leaves"><?= get_label('leaves_taken', 'Laeves') ?></th>
                        <th data-sortable="true" data-field="count_unpaid"><?= get_label('unpaid_leaves', 'Unpaid') ?></th>
                        <th data-sortable="true" data-field="total_paid_days"><?= get_label('total_paid_days', 'Total Days (Max 30)') ?></th>
                        <th data-sortable="true" data-field="daily_rate"><?= get_label('daily_rate', 'Daily Rate') ?></th>
                        <th data-sortable="true" data-field="net_salary"><?= get_label('base_salary', 'Salary') ?></th>
                        <th data-sortable="true" data-field="actual_payment"><?= get_label('actual_payment', 'Payment') ?></th>
                        <th data-sortable="true" data-field="approved_by"><?= get_label('approved_by', 'Approver') ?></th>
                        <th data-sortable="true" data-field="status"><?= get_label('status', 'Status') ?></th>
                        <th data-sortable="true" data-field="created_at" data-visible="false"><?= get_label('created_at', 'Created at') ?></th>
                        <th data-sortable="true" data-field="updated_at" data-visible="false"><?= get_label('updated_at', 'Updated at') ?></th>
                        <th data-field="actions"><?= get_label('actions', 'Actions') ?></th>
                        <!-- <th data-formatter="actions2Formatter"><?= get_label('actions', 'Actions') ?></th> -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
