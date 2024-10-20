<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            {{$slot}}
            <input type="hidden" id="data_type" value="tags">
            <table  id="employee_timesheet_entry_table" data-classes="table table-hover  fs-9 mb-0 border-top border-translucent"
                    data-toggle="table" data-loading-template="loadingTemplate"
                    data-url="{{route('tracki.employee.timesheet.entries.list', $timesheetId)}}"
                    data-icons-prefix="bx"
                    data-icons="icons"
                    data-show-refresh="true" data-total-field="total"
                    data-trim-on-search="false" data-data-field="rows"
                    data-page-list="[5, 10, 20, 50, 100, 200]"
                    data-side-pagination="server" data-show-columns="true"
                    data-pagination="true" data-sort-name="calendar_day" data-sort-order="asc"
                    data-mobile-responsive="true" data-query-params="queryParams">
                <thead>
                    <tr>
                        <th data-checkbox="true" data-halign="left" data-align="center" data-visible="false"></th>
                        <!-- <th data-sortable="true" data-field="image" data-align="center"></th> -->
                        <!-- <th data-sortable="true" data-field="id1"><?= get_label('id', 'ID') ?></th> -->
                        <!-- <th data-sortable="true" data-field="id"><?= get_label('id', 'ID') ?></th> -->
                        <th data-sortable="true" data-field="calendar_day"><?= get_label('calendar_day', 'Day') ?></th>
                        <th class="align-middle white-space-nowrap fs-9 text-body" data-sortable="true" data-field="day_action"><?= get_label('day_action', 'Action') ?></th>
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
