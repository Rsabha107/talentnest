$(document).ready(function () {

    // **************************************************  pay_cycle

    $("body").on("click", "#edit_pay_cycle", function () {
        var id = $(this).data("id");
        var table = $(this).data("table");
        console.log('edit pay_cycle in pay_cycle.js');
        // console.log('id: '+id);
        // console.log('table: '+table);
        // var target = document.getElementById("edit_pay_cycle_modal");
        // var spinner = new Spinner().spin(target);
        // $("#edit_pay_cycle_modal").modal("show");
        $.ajax({
            url: "/tracki/setting/pay_cycle/get/" + id,
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
            },
            dataType: "json",
            success: function (response) {
                console.log(response)
                $("#edit_pay_cycle_id").val(response.op.id);
                $("#edit_pay_cycle_title").val(response.op.title);
                $("#edit_pay_cycle_table").val(table);
                $("#edit_pay_cycle_active_flag").val(response.op.active_flag);
                $("#edit_pay_cycle_modal").modal("show");
            },
        }).done(function(){
            // $("#edit_pay_cycle_modal").modal("show");
        });
    });


    $("body").on("click", "#delete_pay_cycle", function (e) {
        var id = $(this).data("id");
        var tableID = $(this).data("table");
        e.preventDefault();
        // alert('in deleteAddress_type '+tableID);
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
                    url: "/tracki/setting/pay_cycle/delete/" + id,
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
                    },
                    dataType: "json",
                    success: function (result) {
                        if (!result["error"]) {
                            toastr.success(result["message"]);
                            // divToRemove.remove();
                            // $("#fileCount").html("File ("+result["count"]+")");
                            $("#" + tableID).bootstrapTable("refresh");
                            // Swal.fire(
                            //     'Deleted!',
                            //     'Your file has been deleted.',
                            //     'success'
                            //   )
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.pay_cycle);
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
};

function loadingTemplate(message) {
    return '<i class="bx bx-loader-alt bx-spin bx-flip-vertical" ></i>';
}

function actionsFormatter(value, row, index) {
    return [
        '<a href="javascript:void(0);" class="edit-pay_cycle" id="edit_pay_cycle" data-id=' +
            row.id +
            " title=" +
            label_update +
            ' data-table="pay_cycle_table" class="card-link"><i class="bx bx-edit mx-1"></i></a>' +
            "<button title=" +
            label_delete +
            ' type="button" data-table="pay_cycle_table" class="btn delete" id="delete_pay_cycle" data-id=' +
            row.id +
            ' data-type="pay_cycle">' +
            '<i class="bx bx-trash text-danger mx-1"></i>' +
            "</button>",
    ];
}
