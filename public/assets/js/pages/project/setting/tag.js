$("body").on("click", "#add_project_tag", function () {
    console.log("inside #add_project_tag");
    // $(".js-example-basic-multiple2").select2();

    $("#cover-spin").show();
    $("#add_project_tag_modal").modal("show");
    $("#cover-spin").hide();
});

$("body").on("click", "#edit_project_tag", function () {
    console.log("inside #edit_project_tag");
    // $(".js-example-basic-multiple2").select2();

    $("#cover-spin").show();
    $("#edit_project_tag_modal").modal("show");
    $("#cover-spin").hide();
});

$("body").on("click", "#edit_project_tag", function () {
    var id = $(this).data("id");
    var table = $(this).data("table");
    // console.log('edit tag in designations.js');
    // console.log('id: '+id);
    // console.log('table: '+table);
    // var target = document.getElementById("edit_designations_modal");
    // var spinner = new Spinner().spin(target);
    // $("#edit_designations_modal").modal("show");
    $.ajax({
        url: "/projects/admin/setting/tag/edit/"+id,
        type: "get",
        headers: {
            "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#cover-spin").show();

            $("#edit_project_tag_id").val(response.tag.id);
            $("#edit_project_tag_title").val(response.tag.title);
            $("#edit_project_tag_color").val(response.tag.color);
            $("#edit_project_tag_active_flag").val(response.tag.active_flag);
            $("#edit_project_tag_table").val(table);
            // $("#edit_designations_modal").modal("show");
        },
    }).done(function () {
        $("#edit_project_tag_modal").modal("show");
        $("#cover-spin").hide();
    });
});

$("body").on("click", "#delete_project_tag", function (e) {
    var id = $(this).data("id");
    var tableID = $(this).data("table");
    e.preventDefault();
    // alert('in deleteStatus '+tableID);
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
                url: "/projects/admin/setting/tag/delete/" + id ,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
                },
                dataType: "json",
                success: function (result) {
                    if (!result["error"]) {
                        toastr.success(result["message"]);
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

("use strict");

function queryParams(p) {
    return {
        status: $("#project_tag_filter").val(),
        project_id: $("#project_filter").val(),
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
