// import Choices from 'phoenix.js'

function checkModelOpen(e) {
    if (Element.data("bs.modal").isShown) {
        return true;
    }

    return false;
}

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

    $(document).on("show.bs.modal", ".modal", function (event) {
        // alert('on show.bs.modal')
        var zIndex = 1040 + 10 * $(".modal:visible").length;
        $(this).css("z-index", zIndex);
        setTimeout(function () {
            $(".modal-backdrop")
                .not(".modal-stack")
                .css("z-index", zIndex - 1)
                .addClass("modal-stack");
        }, 0);
    });

    // $("#add_project_assigned_to").select2();
    // $(".js-select-tags-multiple").select2();

    $(".js-select-fa-multiple").select2();
    $(".js-select-tags-multiple").select2();
    $(".js-select-assign-multiple").select2();
    $(".js-select-venues-multiple").select2();

    // $("#projectCards").html("project cards projectCards");

    $("body").on("click", "#add_project", function () {
        console.log("inside #add_project");
        // $(".js-example-basic-multiple2").select2();

        $("#cover-spin").show();
        $("#add_project_modal").modal("show");
        $("#cover-spin").hide();
    });

        // ************************************************** task status
        $("body").on("click", "#editTaskStatus", function (event) {
            // console.log("inside sec click edit");
            // event.preventDefault();
            var id = $(this).data("id");
            var table = $(this).data("table");
            // var route = $(this).data("route");
            // console.log("id: " + id);
            // console.log("table: " + table);
    
            $.get("/projects/admin/task/status/edit/" + id, function (data) {
                //  console.log('event name: ' + data);
                $.each(data, function (index, value) {
                    // console.log(value[0]);
                    $("#editTaskId").val(value[0].id);
                    $("#editTaskEventId").val(value[0].event_id);
                    $("#editTaskStatusSelection").val(value[0].status_id);
                    $("#taskStatusParentTable").val(table);
                    $("#taskStatusModal").modal("show");
                });
    
                // $('#staticBackdropLabel').html("Edit category");
                // $('#submit').val("Edit category");
            });
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

        $("#add_edit_project_form")[0].reset();
        $("#add_edit_project_tag").val([]).change();
        $("#add_edit_project_assigned_to").val([]).change();
        $("#add_edit_project_form")[0].classList.remove("was-validated");

        var id = $(this).data("id");
        var table = $(this).data("table");
        var workspace_id = $(this).data("workspace_id");

        console.log("workspace_id: " + workspace_id);
        is_workspace_set = workspace_id ? true : false;
        console.log("workspace_id: " + is_workspace_set);

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
                var project_users = response.assigned_to.map((users) => users.id);
                var project_venues = response.venues.map((venues) => venues.id);
                var project_fas = response.functional_areas.map((fas) => fas.id);

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
                // $("#add_edit_project_venue").val(response.project.venue_id);
                $("#add_edit_project_location").val(response.project.location_id);
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

                $("#add_edit_project_assigned_to").val(project_users);
                $("#add_edit_project_assigned_to").trigger("change");

                $("#add_edit_project_venue").val(project_venues);
                $("#add_edit_project_venue").trigger("change");

                $("#add_edit_project_fa").val(project_fas);
                $("#add_edit_project_fa").trigger("change");

                $("#add_edit_project_description").val(response.project.description);
                // tinymce
                //     .get("add_edit_project_description")
                //     .setContent(response.project.description);
            },
        }).done(function () {
            // $("#offcanvasAddEditProject").offcanvas("show");
            $("#edit_project_modal").modal("show");
        });
    });

    // delete project
    $("body").on("click", "#delete_project", function (e) {
        var id = $(this).data("id");
        var tableID = $(this).data("table");
        e.preventDefault();
        // alert("tableID: "+tableID);
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/projects/admin/project/delete/" + id,
                    method: "GET",
                    success: function (result) {
                        if (!result["error"]) {
                            toastr.success(result["message"]);
                            // divToRemove.remove();
                            // $("#fileCount").html("File ("+result["count"]+")");
                            // console.log('before table refrest for #'+tableID);
                            $("#" + tableID).bootstrapTable("refresh");
                            // Swal.fire(
                            //     'Deleted!',
                            //     'Your file has been deleted.',
                            //     'success'
                            //   )
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                        // $("#cover-spin").hide();
                        toastr.error(thrownError);
                    },
                });
            }
        });
    });

    // resotre project
    $("body").on("click", "#restore_project", function (e) {
        var id = $(this).data("id");
        var tableID = $(this).data("table");
        e.preventDefault();
        // alert("tableID: "+tableID);
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/projects/admin/project/restore/" + id,
                    method: "GET",
                    success: function (result) {
                        if (!result["error"]) {
                            toastr.success(result["message"]);
                            // divToRemove.remove();
                            // $("#fileCount").html("File ("+result["count"]+")");
                            // console.log('before table refrest for #'+tableID);
                            $("#" + tableID).bootstrapTable("refresh");
                            // Swal.fire(
                            //     'Deleted!',
                            //     'Your file has been deleted.',
                            //     'success'
                            //   )
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                        // $("#cover-spin").hide();
                        toastr.error(thrownError);
                    },
                });
            }
        });
    });

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
        console.log("click of taskCardView projects.js");
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
                            '         <p class="text-body-highlight mb-0 lh-1"><a href="../../../upload/event_files/' +
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
                        url: "/projects/admin/task/files/" + taskId,
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

    $("body").on("click", "#edit_task", function () {
        console.log("inside #edit_task projects.js");
        // console.log("source: " + x_source);
        // $(".spinner-border").show();
        console.log($("#edit_task").data("id"));
        // var id = ($(this).data("id") == 'undefined')?$('#edit_task').data("id"):$(this).data("id");
        var id = $(this).data("id");
        // if (typeof id == "undefined") {
        //     id = $("#edit_task").data("id");
        // }

        $.ajax({
            url: "/projects/admin/task/mv/edit/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                g_response = response.view;
                $("#edit_task_modal_form").empty("").append(g_response);

                $.ajax({
                    url: "/projects/admin/task/get/" + id,
                    type: "get",
                    headers: {
                        "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        console.log(response.asg);
                        console.log(response.project.employees);
                        $("#edit_task_assigned_to").empty();

                        var formattedStartDate = moment(
                            response.task.start_date
                        ).format("DD/MM/YYYY");
                        var formattedDueDate = moment(
                            response.task.due_date
                        ).format("DD/MM/YYYY");

                        $("#edit_task_start_date").val(formattedStartDate);
                        $("#edit_task_due_date").val(formattedDueDate);

                        // var wsUsers = response.asg.map((users) => users.id);
                        $.each(
                            response.project.employees,
                            function (index, user) {
                                var option = $("<option>", {
                                    value: user.id,
                                    text: user.full_name,
                                });

                                $("#edit_task_assigned_to").append(option);
                            }
                        );

                        var wsUsers = response.task.employees.map(
                            (users) => users.id
                        );
                        console.log(wsUsers);

                        console.log("Name: " + response.task.description);
                        // $("#edit_task_modal_label").html(
                        //     "Edit task (" +
                        //         response.task.name +
                        //         ") Project: " +
                        //         response.project.name
                        // );

                        console.log("populating edit_task_assigned_to");
                        console.log(wsUsers);
                        $("#edit_task_assigned_to").val([]).change();
                        $("#edit_task_assigned_to").val(wsUsers);
                        $("#edit_task_assigned_to").trigger("change");

                        $("#edit_task_description").val(
                            response.task.description
                        );
                        // tinymce
                        //     .get("edit_task_description")
                        //     .setContent(response.task.description);
                    },
                });

                $("#edit_task_modal").modal("show");
                $("#cover-spin").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            },
        });
    });
});

("use strict");

function queryParams(p) {
    return {
        status: $("#project_status_filter").val(),
        project_id: $("#project_filter").val(),
        venue_id: $("#project_venue_filter").val(),
        // client_id: $("#tasks_client_filter").val(),
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
            .replace("%DELETEPROJECTID%", row.id)
            .replace("%PROJECTNAME%", row.project_name_card)
            .replace("%PROJECTSTATUS%", row.project_status)
            .replace("%PROJECTFUND%", row.project_fund_category)
            .replace("%BUDGET%", row.budget)
            .replace("%CLIENT%", row.client)
            .replace("%BALANCE%", row.balance)
            .replace("%PROGRESS%", row.progress)
            .replace("%PROGRESSBAR%", row.progress_bar_card)
            .replace("%ASSIGNEDTO%", row.assigned_to)
            .replace("%STARTDATE%", row.start_date)
            .replace("%CARDDELRESTDIV%", row.card_delete_restore_div)
            .replace("%ENDDATE%", row.end_date)
            .replace("%TASKURL%", row.task_url)
            .replace("%TASKCOUNT%", row.task_count);
    });

    return `<div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 row-cols-xxl-4 g-3 mb-9">${view}</div>`;
    // return `<div class="row mx-0">${view}</div>`
}

$(
    "#project_status_filter,#project_filter,#project_venue_filter,#tasks_department_filter"
).on("change", function (e) {
    e.preventDefault();
    console.log("tasks.js on change");
    $("#project_table").bootstrapTable("refresh");
});

$("#add_project_tag").on("select2:close", function (e) {
    e.preventDefault();
    console.log("projects.js on change of add_project_tag");
    console.log($("#add_project_tag").val());
});
