<!-- meetings -->

<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            {{$slot}}
            @if (is_countable($statuses) && count($statuses) > 0)
            <input type="hidden" id="data_type" value="status">
            <div class="mx-2 mb-2">
                <table id="employee_file_table"
                    data-toggle="table"
                    data-classes="table table-hover  fs-9 mb-0 border-top border-translucent"
                    data-loading-template="loadingTemplate"
                    data-url="{{ route('tracki.employee.files.list', $emp->id)}}"
                    data-icons-prefix="bx"
                    data-icons="icons"
                    data-show-export="true"
                    data-show-refresh="true"
                    data-total-field="total"
                    data-trim-on-search="false"
                    data-data-field="rows"
                    data-page-size="10"
                    data-page-list="[5, 10, 20, 50, 100, 200]"
                    data-search="true"
                    data-side-pagination="server"
                    data-show-columns="true"
                    data-pagination="true"
                    data-sort-name="id"
                    data-sort-order="desc"
                    data-mobile-responsive="true"
                    data-buttons-class="secondary"
                    data-query-params="queryParams">
                    <thead>
                        <tr>
                            <!-- <th data-checkbox="true"></th> -->
                            <!-- <th class="text-wrap" data-sortable="true" data-field="id"><?= get_label('id', 'Id') ?></th> -->
                            <th data-sortable="true" data-field="image" data-align="center"></th>
                            <th data-sortable="true" data-field="original_file_name"><?= get_label('file', 'File') ?></th>
                            <th data-sortable="true" data-field="file_size"><?= get_label('size', 'Size') ?></th>
                            <th data-sortable="true" data-field="created_at" data-visible="false"><?= get_label('created_at', 'Created at') ?></th>
                            <th data-sortable="true" data-field="updated_at" data-visible="false"><?= get_label('updated_at', 'Updated at') ?></th>
                            <th data-field="actions"><?= get_label('actions', 'Actions') ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            @else
            <?php
            $type = 'Attachments'; ?>
            <x-empty-state-card :type="$type" />

            @endif
        </div>
    </div>
</div>
