

$(document).ready(function () {
    // console.log("all tasksJS file");

    $(".js-example-basic-multiple").select2();

    $("body").on("click", "#add_employee_address", function () {
        console.log("inside #add_employee_address");
        $("#cover-spin").show();
        // reset all values
        // $("#add_employee_form")[0].reset();
        // $("#add_employee_form")[0].classList.remove("was-validated");
        // var table = $(this).data("table");
        // var action = $(this).data("action");

        // var form_action = "/tracki/task/" + action;
        // set the form action with the source var
        // $("#add_task_form").attr("action", form_action);
        // $("#add_employee_table_h").val(table);
        // $("#add_employee_modal_label").html("Add new employee");
        $("#add_employee_address_modal").modal("show");
        $("#cover-spin").hide();
    });

    $("body").on("click", "#edit_employee_address", function () {
        $("#cover-spin").show();
        console.log("inside #edit_employee");
        // console.log("source: " + x_source);
        // console.log($("#edit_employee").data("id"));
        // reset all values

        // $("#taskTabNotes").empty("").append(refreshEmpEdit(taskID));
        id = $(this).data("id");
        console.log("employee_id: " + id);

        $.ajax({
            url: "/hr/admin/address/mv/edit/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                g_response = response.view;
                $("#employee_addressEditView").empty("").append(g_response);
                $("#edit_employee_address_modal").modal("show");
                $("#cover-spin").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#cover-spin").hide();
            },
        });
    });



    // delete task item
    $("body").on("click", "#deleteEmployeeAddress", function (e) {
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
                    url: "/hr/admin/address/delete/" + id,
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
                    },
                });
            }
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


function buttons() {
    return {
        btnUsersAdd: {
            text: "Highlight Users",
            icon: "fa-users",
            event: function () {
                alert(
                    "Do some stuff to e.g. search all users which has logged in the last week"
                );
            },
            attributes: {
                title: "Search all users which has logged in the last week",
            },
        },
        btnAdd: {
            text: "Add new row",
            icon: "fa-plus",
            event: function () {
                alert("Do some stuff to e.g. add a new row");
            },
            attributes: {
                title: "Add a new row to the table",
            },
        },
    };
}

$(
    "#task_status_filter,#tasks_person_filter,#tasks_project_filter,#tasks_department_filter"
).on("change", function (e) {
    e.preventDefault();
    console.log("tasks.js on change");
    $("#employee_address_table").bootstrapTable("refresh");
});
