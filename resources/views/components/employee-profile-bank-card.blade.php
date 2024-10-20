<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            {{$slot}}
            <input type="hidden" id="data_type" value="tags">
            <table id="employee_bank_table" data-classes="table table-hover  fs-9 mb-0 border-top border-translucent"
                data-toggle="table" data-loading-template="loadingTemplate"
                data-url="{{route('tracki.employee.bank.list', $employeeid)}}"
                data-icons-prefix="bx"
                data-icons="icons"
                data-show-export="true"
                data-export-types="['csv', 'txt', 'doc', 'excel', 'xlsx', 'pdf']"
                data-show-refresh="true" data-total-field="total"
                data-trim-on-search="false" data-data-field="rows"
                data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true"
                data-side-pagination="server" data-show-columns="true"
                data-pagination="true" data-sort-name="id" data-sort-order="desc"
                data-mobile-responsive="true" data-query-params="queryParams">
                <thead>
                    <tr>
                        <th data-checkbox="true" data-halign="left" data-align="center" data-visible="false"></th>
                        <!-- <th data-sortable="true" data-field="id1"><?= get_label('id', 'ID') ?></th> -->
                        <!-- <th data-sortable="true" data-field="id"><?= get_label('id', 'ID') ?></th> -->
                        <th class="align-middle white-space-nowrap fs-9 text-body" data-sortable="true" data-field="bank_branch_name"><?= get_label('bank_branch_name', 'Bank Branch Name') ?></th>
                        <th data-sortable="true" data-field="bank_account_name"><?= get_label('bank_account_name', 'Bank Account Name') ?></th>
                        <th data-sortable="true" data-field="iban"><?= get_label('iban', 'IBAN') ?></th>
                        <th data-sortable="true" data-field="swift_code"><?= get_label('swift_code', 'Swift Code') ?></th>
                        <th data-sortable="true" data-field="created_at" data-visible="false"><?= get_label('created_at', 'Created at') ?></th>
                        <th data-sortable="true" data-field="updated_at" data-visible="false"><?= get_label('updated_at', 'Updated at') ?></th>
                        @if(Auth()->user()->hasRole('SuperAdmin'))
                        <th data-field="actions"><?= get_label('actions', 'Actions') ?></th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
