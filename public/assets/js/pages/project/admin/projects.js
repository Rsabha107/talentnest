// import Choices from 'phoenix.js'

$(document).ready(function () {
    // console.log("all tasksJS file");

    // showing the offcanvas for the task creation

    // $("body").on("click", "#add_edit_project", function (event) {
    //     // console.log("inside add_project_task");
    //     // event.preventDefault();
    //     var id = $(this).data("id");
    //     var table = $(this).data("table");

    //     $("#offcanvasAddEditProject").offcanvas("show");

    //     // var modalID = $(".offcanvas.offcanvas-start.show").attr("id");
    //     // alert(modalID);
    // });

    $("#add_project_assigned_to").select2();
    $(".js-example-basic-multiple2").select2();
    $(".js-example-basic-multiple").select2();

    // $("#projectCards").html("project cards projectCards");

    $("body").on("click", "#add_project", function () {
        console.log("inside #add_project");
        $(".js-example-basic-multiple2").select2();

        $("#cover-spin").show();
        $("#add_project_modal").modal("show");
        $("#cover-spin").hide();
    });

    $("body").on("click", "#test_change_choices_list", function () {
        console.log("inside #test_change_choices_list");
        console.log($(".test").val());
        selectEl = document.getElementsByClassName("test");
        console.log(selectEl);
        const selector = jQuery(selectEl).data("choiceobject");
        console.log(selector);
        // window.choiceObject.setValue(['xx', '3']);
        selector.removeActiveItems();
        // selector.change();
        selector.setChoiceByValue("2");
        selector.setChoiceByValue("3");
        selector.setChoiceByValue("1");
        // selector.setValue([{value: 5, label:'hello'}]);
    });

    //add_edit_project
    //update_project_team_members

    $("body").on("click", "#edit_project", function () {
        console.log("inside #edit_project");

        // reset all values
        // $("#add_edit_project_assigned_to").empty();
        $("#add_edit_project_form")[0].reset();
        $("#add_edit_project_tag").val([]).change();
        $("#add_edit_project_assigned_to").val([]).change();
        $("#add_edit_project_form")[0].classList.remove("was-validated");

        var id = $(this).data("id");
        var table = $(this).data("table");
        // var action = $(this).data("action");
        // var source = $(this).data("source");
        // var type = $(this).data("type");
        // var redirect = $(this).data("redirect");
        var workspace_id = $(this).data("workspace_id");
        // var form_action = "/project/" + action;

        // if (!workspace_id) {
        //     alert("choose a workspace first");
        //     return;
        // }

        console.log("workspace_id: " + workspace_id);
        is_workspace_set = workspace_id ? true : false;
        console.log("workspace_id: " + is_workspace_set);

        // if (!workspace_id && type == 'add'){
        //     alert('please choose a workspace first');
        //     return
        // }

        console.log("id: " + id);
        console.log("table: " + table);
        // console.log("action: " + action);
        // console.log("type: " + type);
        // console.log("form_action: " + form_action);

        $("#add_edit_project_table_h").val(table);

        console.log(id + " " + table);
        // $("#edit_workspace_modal").modal("show");
        // $("#add_edit_project_modal_label").html("Edit project...");

        $.ajax({
            url: "/projects/admin/project/get/" + id,
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
            },
            dataType: "json",
            success: function (response) {
                console.log("response");
                console.log(response);

                var project_tags = response.tag.map((tags) => tags.id);
                var project_users = response.assigned_to.map(
                    (users) => users.id
                );
                console.log("project_tags");
                console.log(project_tags);
                console.log("project_users");
                console.log(project_users);

                var formattedStartDate = moment(
                    response.project.start_date
                ).format("DD/MM/YYYY");
                var formattedEndDate = moment(response.project.end_date).format(
                    "DD/MM/YYYY"
                );

                $("#add_edit_project_modal_label").html(
                    "Edit project (" + response.project.name + ")"
                );
                $("#add_edit_project_id_h").val(response.project.id);

                $("#add_edit_project_name").val(response.project.name);
                $("#add_edit_project_workspace_id").val(
                    response.project.workspace_id
                );
                $("#add_edit_project_project_type").val(
                    response.project.project_type_id
                );
                $("#add_edit_project_client").val(response.project.client_id);
                $("#add_edit_project_category").val(
                    response.project.category_id
                );
                $("#add_edit_project_audience").val(
                    response.project.audience_id
                );
                $("#add_edit_project_venue").val(response.project.venue_id);
                $("#add_edit_project_location").val(
                    response.project.location_id
                );
                $("#add_edit_project_fund").val(
                    response.project.fund_category_id
                );
                $("#add_edit_project_budget").val(
                    response.project.budget_name_id
                );

                $("#add_edit_project_start_date").val(formattedStartDate);
                $("#add_edit_project_end_date").val(formattedEndDate);

                $("#add_edit_project_budget_allocation").val(
                    response.project.budget_allocation
                );
                $("#add_edit_project_attendance").val(
                    response.project.attendance_forcast
                );

                $("#add_edit_project_tag").val(project_tags);
                $("#add_edit_project_tag").trigger("change");

                $("#add_edit_project_assigned_to").val(project_users);
                $("#add_edit_project_assigned_to").trigger("change");
                // $("#add_edit_project_description").val(response.project.description);
                tinymce
                    .get("add_edit_project_description")
                    .setContent(response.project.description);
            },
        }).done(function () {
            // $("#offcanvasAddEditProject").offcanvas("show");
            $("#edit_project_modal").modal("show");
        });
    });

    // window.addEventListener("load", function () {
    //     alert("It's loaded!");
    // });

    // window.addEventListener("load", function () {
    //     $("#cover-spin").show();
    //     console.log("inside #edit_employee");
    //     // console.log("source: " + x_source);
    //     // console.log($("#edit_employee").data("id"));
    //     // reset all values

    //     // $("#taskTabNotes").empty("").append(refreshEmpEdit(taskID));
    //     id = $(this).data("id");
    //     console.log("employee_id: " + id);

    //     $.ajax({
    //         url: "/projects/admin/project/mv",
    //         method: "GET",
    //         async: true,
    //         success: function (response) {
    //             g_response = response.view;
    //             $("#project_card_view").empty("").append(g_response);
    //             $("#cover-spin").hide();
    //         },
    //         error: function (xhr, ajaxOptions, thrownError) {
    //             console.log(xhr.status);
    //             console.log(thrownError);
    //             $("#cover-spin").hide();
    //         },
    //     });
    // });

    $("#switchClientOwner").submit(function (event) {
        event.preventDefault();
        selected_value = $("#project_client_owner_id").val();
        alert(
            "in swtichClientOwner.  selected value " +
                selected_value +
                " " +
                $(this).find("option:selected").text()
        );
    });

    $("body").on("click", "#taskCardView", function (event) {
        // event.preventDefault();
        var taskId = $(this).data("id");
        console.log("click of taskCardView");
        $(".spinner-border").show();
        // console.log("task id: " + taskId);

        $("#task-note-tab").data("taskid", taskId);
        $("#edit_task").data("id", taskId);
        $tab_value = $("#task-note-tab").data("taskid");
        $edit_task_id = $("#edit_task").data("id");

        // alert($edit_task_id)

        $.ajax({
            url: "/projects/admin/task/overview/" + taskId,
            method: "GET",
            success: function (response) {
                console.log(response);
                html = "";
                html1 = "";

                console.log(response);
                // get the task information
                $.each(response.data.data, function (index, value) {
                    console.log("index: " + index);
                    // if (index == "data") {
                    // console.log("inside the data array");
                    // console.log(value);
                    // for (const project_task of value.data) {
                    // console.log(`${value.name} : ${value.id}°C`);
                    workspace_html =
                        '<span class="badge badge-phoenix badge-phoenix-warning me-2" id="overviewtaskWorkspace">' +
                        value.workspace +
                        "</span>";
                    $("#overviewtaskTitle").html(value.name);

                    $("#overviewProjectName").html(value.project_title);
                    $("#overviewtaskStatus").html(
                        '<span class="badge badge-phoenix badge-phoenix-' +
                            value.status_color +
                            ' me-2" id="overviewtaskStatus">' +
                            value.status_name +
                            "</span>"
                    );
                    $("#overviewtaskWorkspace").html(
                        '<span class="badge badge-phoenix badge-phoenix-warning me-2" id="overviewtaskWorkspace">' +
                            value.workspace +
                            "</span>"
                    );
                    $("#overviewtaskProgress").html(value.progress * 100 + "%");
                    $("#overviewtaskProgressStyle").css({
                        width: value.progress * 100 + "%",
                    });
                    console.log(value.start_date);
                    $("#overviewtaskStartDate").html(value.start_date);
                    $("#overviewtaskDueDate").html(value.due_date);
                    // $("#overviewtaskDueDate").prop("value", value.due_date);
                    $("#overviewtaskDescription").html(value.description);
                    $("#overviewtaskAllocatedBudget").html(
                        value.budget_allocation
                    );
                    $("#overviewtaskActualBudget").html(
                        value.actual_budget_allocated
                    );
                    $("#overviewtaskDepartment").html(value.department_name);
                    // $("#overviewtaskAllocatedBudget").html(
                    //     '<span class="me-2 fa-solid fa-dollar text-success"></span>' +
                    //         value.budget_allocation
                    // );
                    // $("#overviewtaskActualBudget").html(
                    //     '<span class="me-2 fa-solid fa-donate text-primary"></span>' +
                    //         value.actual_budget_allocated
                    // );
                    // $("#overviewtaskDepartment").html(
                    //     '<span class="me-2 fa-solid fa-building text-primary"></span>' +
                    //         value.department_name
                    // );
                });

                // lets get the assinged_to names
                $.each(response.data.data, function (index, value) {
                    console.log("index: " + index);
                    // if (index == "data") {
                    // console.log("inside the assigned_to array");
                    // console.log(value);
                    // for (const project_task of value.data) {
                    // console.log(`${value.name} : ${value.id}°C`);

                    for (const asg of value.assigned_to) {
                        initname = getNameItials(asg.full_name);
                        console.log("init initname: " + initname);
                        console.log("name: " + asg.full_name);
                        console.log("id: " + asg.id);

                        html +=
                            '<a href="/tracki/users/' +
                            asg.id +
                            '/details" title="' +
                            asg.full_name +
                            '" role="button"> <div class="avatar avatar-m pull-up me-1">';
                        html +=
                            '<div class="avatar-name rounded-circle me-2" title="' +
                            asg.full_name +
                            '"><span>' +
                            initname +
                            "</span></div>";
                        html += "</div></a>";
                    }

                    html +=
                        '<a href="javascript:void(0);" id="edit_task" data-action="update" data-dismiss="modal" data-source="list" ' +
                        'data-type="edit" data-table="task_table" data-redirect="list" data-id=' +
                        value.id +
                        ' role="button" title="add">' +
                        '<button class="btn btn-sm btn-phoenix-secondary btn-circle pull-up">' +
                        '<span class="fa-solid fa-plus text-warning"></span>' +
                        "</button>" +
                        "</a>";
                    $("#overviewtaskAssignees").empty("").append(html);

                    //   }

                    // }
                });

                $.ajax({
                    url: "/projects/admin/task/notes/" + taskId,
                    method: "GET",
                    async: true,
                    success: function (response) {
                        g_response = response.view;
                        $("#taskTabNotes").empty("").append(g_response);
                        $(".spinner-border").hide();
                    },
                });

                $.ajax({
                    url: "/projects/admin/task/subtask/" + taskId,
                    method: "GET",
                    async: true,
                    success: function (response) {
                        g_response = response.view;
                        $("#taskTabSub").empty("").append(g_response);
                        $(".spinner-border").hide();
                    },
                });

                $.ajax({
                    url: "/projects/admin/task/files/" + taskId,
                    method: "GET",
                    async: true,
                    success: function (response) {
                        g_response = response.view;
                        $("#taskTabFiles").empty("").append(g_response);
                        $(".spinner-border").hide();
                    },
                });

                // $("#taskTabNotes").empty("").append(refreshTaskNotes(taskId));
                // $("#taskTabSub").empty("").append(refreshTaskSubtask(taskId));
                $("#collapse_task_subtask").addClass("collapsed");

                // lets get the subtasks
                $.each(response.data.data, function (index, value) {
                    // console.log("subtasks index: " + index);
                    // // if (index == "data") {
                    // console.log("inside the subtasks array");
                    // console.log(value.subtasks);
                    // console.log(value.subtasks.length);
                    html = "";
                    html1 = "";

                    $("#subTaskCount").html(
                        "Subtasks (" + value.subtasks.length + ")"
                    );
                });

                // lets get the files
                $.each(response.data.data, function (index, value) {
                    console.log("in files ....");
                    console.log("files index: " + index);
                    // // if (index == "data") {
                    console.log("inside the files array");
                    console.log(value.files);
                    console.log(value.files.length);
                    html = "";
                    html1 = "";

                    $("#fileCount").html("File (" + value.files.length + ")");

                    for (const files of value.files) {
                        // console.log(`${notes.note_text} : ${notes.id}°C`);
                        html += '<div class="border-top py-3">';
                        html += '  <div class="me-n3">';
                        html += '    <div class="d-flex flex-between-center">';
                        html +=
                            '       <div class="d-flex mb-1"><span class="fa-solid fa-image me-2 text-body-tertiary fs-9"></span>';
                        html +=
                            '         <p class="text-body-highlight mb-0 lh-1"><a href="../../../storage/upload/event_files/' +
                            files.file_name +
                            '" target="_blank">' +
                            files.original_file_name +
                            "</a></p>";
                        html += "</div>";
                        html +=
                            ' <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>';
                        html +=
                            ' <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item text-danger removeFileDiv" href="#!" data-table="task_table" data-id=' +
                            files.id +
                            ' id="deletexxs">Delete</a></div>';
                        html += " </div>";
                        html +=
                            ' <p class="fs-9 text-body-tertiary mb-1"><span>' +
                            files.file_size / 100 +
                            'kb </span><span class="text-body-quaternary mx-1">| </span><a href="#!">' +
                            files.user_name +
                            ' </a><span class="text-body-quaternary mx-1">| </span><span class="text-nowrap">' +
                            moment(files.created_at).format("DD-MM-YYYY") +
                            "</span></p>";

                        if (
                            files.file_extension.toLowerCase() == "jpg" ||
                            files.file_extension.toLowerCase() == "jpeg" ||
                            files.file_extension.toLowerCase() == "png"
                        ) {
                            // console.log('file path: '+ files.file_path)
                            // console.log('file path: '+ files.file_name)
                            html +=
                                '<a href="' +
                                files.file_path +
                                files.file_name +
                                '" target="_blank"><img class="rounded-2 img-thumbnail" src="' +
                                files.file_path +
                                files.file_name +
                                '" alt="" width="200" height="200" /></a>';
                        }
                        html += "                </div>";
                        html += "            </div>";
                    }

                    $.ajax({
                        url: "/tracki/task/files/" + taskId,
                        method: "GET",
                        async: true,
                        success: function (response) {
                            g_response = response.view;
                            $("#taskTabFiles").empty("").append(g_response);
                            $(".spinner-border").hide();
                        },
                    });

                    $("#taskTabFiles").empty("").append(html);
                });

                console.log("taskCardView taskId: " + taskId);
                $("#note_parent_task_id_overview").val(taskId);
                $("#subtask_parent_task_id_overview").val(taskId);
                $("#file_parent_task_id_overview").val(taskId);
                $(".spinner-border").hide();
                $("#taskCardViewModal").modal("show");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }, //tr += '<option value="'+value[0]+'">'+value[1]+'</option>';
        });
    });
});

("use strict");

function queryParams(p) {
    return {
        status: $("#task_status_filter").val(),
        person_id: $("#tasks_person_filter").val(),
        // client_id: $("#tasks_client_filter").val(),
        project_id: $("#tasks_project_filter").val(),
        department_id: $("#tasks_department_filter").val(),
        show_page: $("#tasks_show_page_hidden").val(),
        show_page_id: $("#tasks_show_page_id_hidden").val(),
        task_start_date_from: $("#task_start_date_from").val(),
        task_start_date_to: $("#task_start_date_to").val(),
        task_end_date_from: $("#task_end_date_from").val(),
        task_end_date_to: $("#task_end_date_to").val(),
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

function customViewFormatter(data) {
    var template = $("#profileTemplate").html();
    var view = "";
    $.each(data, function (i, row) {
        view += template
            .replace("%PROJECTID%", row.id)
            .replace("%PROJECTNAME%", row.project_name_card)
            .replace("%PROJECTSTATUS%", row.project_status)
            .replace("%PROJECTFUND%", row.project_fund_category)
            .replace("%BUDGET%", row.budget)
            .replace("%CLIENT%", row.client)
            .replace("%BALANCE%", row.balance)
            .replace("%PROGRESS%", row.progress)
            .replace("%PROGRESSBAR%", row.progress_bar)
            .replace("%ASSIGNEDTO%", row.assigned_to)
            .replace("%STARTDATE%", row.start_date)
            .replace("%ENDDATE%", row.end_date)
            .replace("%TASKURL%", row.task_url)
            .replace("%TASKCOUNT%", row.task_count);
    });

    return `<div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 row-cols-xxl-4 g-3 mb-9">${view}</div>`;
    // return `<div class="row mx-0">${view}</div>`
}

$(
    "#task_status_filter,#tasks_person_filter,#tasks_project_filter,#tasks_department_filter"
).on("change", function (e) {
    e.preventDefault();
    console.log("tasks.js on change");
    $("#project_table").bootstrapTable("refresh");
});
