<!-- meetings -->

<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            {{$slot}}
            @if (is_countable($funcareas) && count($funcareas) > 0)
            <input type="hidden" id="data_type" value="funcareas">
            <div class="mx-2 mb-2">
                <table  id="funcareas_table"
                        data-toggle="table"
                        data-classes="table table-hover  fs-9 mb-0 border-top border-translucent"
                        data-loading-template="loadingTemplate"
                        data-url="{{route('tracki.setting.funcareas.list')}}"
                        data-icons-prefix="bx"
                        data-icons="icons"
                        data-show-export="true"
                        data-show-columns-toggle-all="true"
                        data-show-toggle="true"
                        data-show-fullscreen="true"
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
                        data-buttons-class="secondary"
                        data-query-params="queryParams">
                    <thead>
                        <tr>
                        <th data-checkbox="true"></th>
                        <th data-sortable="true" data-field="id" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('id', 'ID') ?></th>
                        <th data-sortable="true" data-field="name" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('name', 'Name') ?></th>
                        <th data-sortable="true" data-field="venue_id" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('venue', 'Venue') ?></th>
                        <th data-sortable="true" data-field="total"><?= get_label('total_employee', 'Total Employee') ?></th>
                        <th data-sortable="true" data-field="created_at" data-visible="false" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('created_at', 'Created at') ?></th>
                        <th data-sortable="true" data-field="updated_at" data-visible="false" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('updated_at', 'Updated at') ?></th>
                        <th data-formatter="actionsFormatter"><?= get_label('actions', 'Actions') ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            @else
            <?php
            $type = 'Location'; ?>
            <x-empty-state-card :type="$type" />

            @endif
        </div>
    </div>
</div>
