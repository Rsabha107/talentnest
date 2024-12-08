



$(document).ready(function () {
    // console.log("all tasksJS file");

    $("body").on("click", ".add-allowance", function (e) {
        console.log('add-allowance')
    });

    $('#allowance_id').on('change', function () {
        console.log('allowance_id')
        var id = $(this).val();
        if (id != '') {
            $.ajax({
                url: '/allowances/get/' + id,
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value') // Replace with your method of getting the CSRF token
                },
                dataType: 'json',
                success: function (response) {
                    $('#allowance_0_title').val(response.allowance.title);
                    $('#allowance_0_amount').val(parseFloat(response.allowance.amount).toFixed(decimal_points));
                },

            });
        } else {
            $('#allowance_0_title').val('');
            $('#allowance_0_amount').val('');
        }

    });


    $(".js-example-basic-multiple").select2();

    $("body").on("click", "#add_employee_salary", function () {
        console.log("inside #add_employee");
        $("#cover-spin").show();

        $("#add_employee_salary_modal").modal("show");
        $("#cover-spin").hide();
    });

    $("body").on("click", "#edit_employee_salary", function () {
        $("#cover-spin").show();
        console.log("inside #edit_employee");
        id = $(this).data("id");
        console.log("employee_id: " + id);

        $.ajax({
            url: "/hr/admin/salary/mv/edit/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                g_response = response.view;
                $("#employeeSalaryEditView").empty("").append(g_response);
                $("#edit_employee_salary_modal").modal("show");
                $("#cover-spin").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#cover-spin").hide();

            },
        });
    });

    $("body").on("click", "#add_employee_salary_elements", function () {
        console.log("inside #add_employee_salary_elements_modal");
        $("#cover-spin").show();
        $("#add_employee_salary_elements_modal").modal("show");
        $("#cover-spin").hide();
    });


    // delete task item
    $("body").on("click", "#deleteEmployeeSalary", function (e) {
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
                    url: "/hr/admin/salary/delete/" + id,
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

$(function () {
    $("#task_table").bootstrapTable();
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
    $("#employee_salary_table").bootstrapTable("refresh");
});
