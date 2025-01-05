<!-- <div class="card mb-4"> -->
    <!-- <div class="card-body"> -->

        <div class="table-responsive text-nowrap">

            <input type="hidden" id="data_type" value="tags">
            <table
                id="project_table"
                data-toggle="table"
                data-classes="table table-hover  fs-9 mb-0 border-top border-translucent"
                data-search="true"
                data-url="{{ route('projects.admin.employee.project.list', $empId) }}"
                data-pagination="true"
                data-show-custom-view="true"
                data-custom-view="customViewFormatter"

                data-loading-template="loadingTemplate"
                data-icons-prefix="bx"
                data-icons="icons"
                data-show-export="true"
                data-export-types="['csv', 'txt', 'doc', 'excel', 'xlsx', 'pdf']"
                data-show-refresh="true"
                data-total-field="total"
                data-trim-on-search="false"
                data-data-field="rows"
                data-page-list="[5, 10, 20, 50, 100, 200]"
                data-page-size="5"
                data-side-pagination="server"
                data-query-params="queryParams"
                data-show-columns="true"
                data-pagination="true"
                data-sort-name="id"
                data-sort-order="desc"
                data-mobile-responsive="true"
                data-show-columns-toggle-all="true"
                data-show-custom-view-button="true">

                <thead>
                    <tr>

                        <th data-sortable="true" data-field="name"><?= get_label('project_name', 'Title') ?></th>
                        <th data-sortable="true" data-field="project_status"><?= get_label('status', 'Status') ?></th>
                        <th data-sortable="true" data-field="client"><?= get_label('client', 'Client') ?></th>
                        <th data-sortable="true" data-field="budget"><?= get_label('budget', 'Budget') ?></th>
                        <th data-sortable="true" data-field="balance"><?= get_label('balance', 'Balance') ?></th>
                        <th data-sortable="true" data-field="progress"><?= get_label('progress', 'Progress') ?></th>
                        <th data-sortable="true" data-field="start_date"><?= get_label('start_date', 'Start Date') ?></th>
                        <th data-sortable="true" data-field="end_date"><?= get_label('end_date', 'End Date') ?></th>
                        <th data-sortable="true" data-field="assigned_to"><?= get_label('assigned_to', 'Assigned To') ?></th>
                        <th data-sortable="true" data-field="task_count"><?= get_label('task_count', 'Task Count') ?></th>
                        <th data-sortable="true" data-field="created_at" data-visible="false">
                            <?= get_label('created_at', 'Created at') ?></th>
                        <th data-sortable="true" data-field="updated_at" data-visible="false">
                            <?= get_label('updated_at', 'Updated at') ?></th>
                        <th data-sortable="true" data-field="actions"><?= get_label('actions', 'Actions') ?></th>
                    </tr>
                </thead>
            </table>

            <template id="profileTemplate">

                <div class="col">
                    <div class="card h-100 hover-actions-trigger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h4 class="mb-2 line-clamp-1 lh-sm flex-1 me-5">%PROJECTNAME%</h4>

                                <div class="hover-actions top-0 end-0 mt-4 me-4">
                                    <!-- <button class="btn btn-primary btn-icon flex-shrink-0" id="projectsCardViewModal" data-bs-toggle="modal" data-bs-target="#projectsCardViewModal"><span class="fa-solid fa-chevron-right"></span></button> -->

                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal"
                                        type="button" data-bs-toggle="dropdown" data-boundary="window"
                                        aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span
                                            class="fa-solid fa-gear"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        @if (Auth::user()->can('project.edit'))
                                        <a class="dropdown-item" href="javascript:void(0);" id="edit_project"
                                            data-action="update" data-source="list" data-type="edit"
                                            data-table="none" data-id="%PROJECTID%" data-redirect="card"
                                            data-workspace_id="{{ session()->get('workspace_id') }}">Edit</a>
                                        @endif
                                        @if (Auth::user()->can('project.delete'))
                                        <a class="dropdown-item text-danger" href="#!" id="delete"
                                            data-id="" title="Delete" class="card-link">Delete</a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            %PROJECTSTATUS%
                            %PROJECTFUND%
                            <div class="d-flex align-items-center mb-2"><span
                                    class="fa-solid fa-user me-2 text-body-tertiary fs-9 fw-extra-bold"></span>
                                <p class="fw-bold mb-0 text-truncate lh-1">Client :
                                    <span class="fw-semibold text-primary ms-1"> %CLIENT%
                                    </span>
                                </p>
                            </div>
                            <div class="d-flex align-items-center mb-2"><span
                                    class="fa-solid fa-credit-card me-2 text-body-tertiary fs-9 fw-extra-bold"></span>
                                <p class="fw-bold mb-0 lh-1">Budget : <span
                                        class="ms-1 text-body-emphasis">%BUDGET%</span></p>
                            </div>
                            <div class="d-flex align-items-center mb-4"><span
                                    class="fa-solid fa-cash-register me-2 text-body-tertiary fs-9 fw-extra-bold"></span>
                                <p class="fw-bold mb-0 lh-1">Balance : <span
                                        class="ms-1 text-body-emphasis">%BALANCE%</span>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between text-body-tertiary fw-semibold">
                                <p class="mb-2"> Progress</p>
                                <p class="mb-2 text-body-emphasis">%PROGRESS% %</p>
                            </div>
                            %PROGRESSBAR%
                            <div class="d-flex align-items-center mt-4">
                                <p class="mb-0 fw-bold fs-9">Started :<span
                                        class="fw-semibold text-body-tertiary text-opactity-85 ms-1">
                                        %STARTDATE%</span></p>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <p class="mb-0 fw-bold fs-9">Deadline : <span
                                        class="fw-semibold text-body-tertiary text-opactity-85 ms-1">
                                        %ENDDATE%</span></p>
                            </div>
                            <div class="d-flex d-lg-block d-xl-flex justify-content-between align-items-center mt-3">
                                %ASSIGNEDTO%
                                <div class="mt-lg-3 mt-xl-0"><a
                                        href="%TASKURL%"> <i
                                            class="fa-solid fa-list-check me-1"></i>
                                        <p class="d-inline-block fw-bold mb-0">%TASKCOUNT%<span class="fw-normal">
                                                Task</span></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </template>
        </div>
    <!-- </div> -->
<!-- </div> -->