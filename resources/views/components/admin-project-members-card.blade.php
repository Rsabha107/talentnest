<?php
$workspace_id = session()->get('workspace_id') ? session()->get('workspace_id') : "0";
?>

<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table table-stripped 
                id="project_members_table"
                data-toggle="table"
                data-classes="table table-hover fs-9 mb-0 border-top border-translucent"
                data-loading-template="loadingTemplate"
                data-url="{{ route('projects.admin.project.member.list', $projectId)}}"
                data-icons-prefix="bx"
                data-icons="icons"
                data-show-export="true"
                data-show-refresh="true"
                data-show-columns-toggle-all="true"
                data-show-fullscreen="true"
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
                data-query-params="memberqueryParams">
                <thead>
                    <tr>
                        <!-- <th data-checkbox="true"></th> -->
                        <th data-sortable="true" data-field="id1" data-width="50"><?= get_label('id', 'ID') ?></th>
                        <th data-sortable="false" data-field="image" data-align="center" data-width="100"></th>
                        <!-- <th data-field="attributes"></th> -->
                        <th class="name align-middle white-space-nowrap ps-0" data-sortable="true" data-field="name"><?= get_label('name', 'Name') ?></th>
                        <th data-sortable="true" data-field="designation_id" data-visible="true"><?= get_label('job', 'Job') ?></th>
                        {{-- <th data-sortable="true" data-field="project_id"><?= get_label('project', 'Project') ?></th>
                        <th class="align-middle white-space-nowrap fs-9 text-body" data-sortable="true" data-field="workspace_id"><?= get_label('workspace', 'Workspace') ?></th>
                        <th class="align-middle white-space-nowrap fs-9 text-body" data-sortable="true" data-field="department_assignment_id"><?= get_label('department', 'Department') ?></th>
                        <th data-sortable="false" data-field="status"><?= get_label('status', 'Status') ?></th>
                        <th data-sortable="false" data-field="assigned_by" data-visible="false"><?= get_label('assigned_by', 'Assigned by') ?></th>
                        <th data-sortable="false" data-field="assigned_to"><?= get_label('assigned_to', 'Assigned to') ?></th>
                        <!-- <th data-sortable="false" data-field="assigned_to" data-formatter="TaskUserFormatter"><?= get_label('assigned_to', 'Assigned to') ?></th> -->
                        <th class="align-middle white-space-nowrap fs-9 text-body" data-sortable="true" data-field="start_date" data-visible="false"><?= get_label('start_date', 'Start date') ?></th>
                        <th class="align-middle white-space-nowrap fs-9 text-body" data-sortable="false" data-field="end_date"><?= get_label('due_date', 'Due date') ?></th>
                        <th data-sortable="false" data-field="budget" data-visible="false"><?= get_label('budget', 'Budget') ?></th>
                        <th data-sortable="false" data-field="budget_consumed" data-visible="false"><?= get_label('budget_consumed', 'Budget Consumed') ?></th>
                        <th data-sortable="false" data-field="description" data-visible="false"><?= get_label('description', 'Description') ?></th> --}}
                        <th data-sortable="true" data-field="created_at" data-visible="false"><?= get_label('created_at', 'Created at') ?></th>
                        <th data-sortable="true" data-field="updated_at" data-visible="false"><?= get_label('updated_at', 'Updated at') ?></th>
                        <!-- <th data-formatter="actionsFormatter"><?= get_label('actions', 'Actions') ?></th> -->
                        <th data-sortable="false" data-field="actions"><?= get_label('actions', 'Actions') ?></th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>

function memberqueryParams(p) {
    return {
       
        page: p.offset / p.limit + 1,
        limit: p.limit,
        sort: p.sort,
        order: p.order,
        offset: p.offset,
        search: p.search,
    };
}
window.icons = {
    refresh: "bx-refresh",
    toggleOn: "bx-toggle-right",
    toggleOff: "bx-toggle-left",
    fullscreen: "bx-fullscreen",
    columns: "bx-list-ul",
    export_data: "bx-list-ul",
    paginationSwitch: "bx-list-ul",
};

function loadingTemplate(message) {
    return '<i class="bx bx-loader-circle bx-spin bx-flip-vertical" ></i>';
}

    // $(
    //     "#tasks_status_filter,#tasks_employee_filter,#tasks_project_filter,#tasks_department_filter"
    // ).on("change", function(e) {
    //     e.preventDefault();
    //     // console.log("tasks.js on change");
    //     $("#task_table").bootstrapTable("refresh");
    // });
</script>