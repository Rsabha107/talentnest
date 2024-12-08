
var employeeLetterVariable = [];
var descriptionPreview = $('#preview_letter');
var contentText = $('#content_text');


tinymce.init(
    {
        selector: "#content",
        // height: "20vh",
        // skin: "oxide",
        height: 300,
        // menubar: true,
        resize: true,
        license_key: "gpl",
        content_style: `
                .mce-content-body {
                color: ${("emphasis-color")};
                background-color: ${("tinymce-bg")};
                }
                .mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
                color: ${("quaternary-color")};
                font-weight: 400;
                font-size: 12.8px;
                }
                `,
        // mobile: {
        //   theme: 'mobile',
        //   toolbar: ['undo', 'bold']
        // },
        statusbar: false,
        // plugins: "link,image,lists,table,media,preview,emoticons",
        plugins: [
            "advlist",
            "autolink",
            "link",
            "image",
            "lists",
            "charmap",
            "preview",
            "anchor",
            "pagebreak",
            "autoresize",
            "searchreplace",
            "wordcount",
            "visualblocks",
            "code",
            "fullscreen",
            "insertdatetime",
            "media",
            "table",
            "emoticons",
            "help",
            // "template",
        ],
        theme_advanced_toolbar_align: "center",
        directionality: "ltr",
        toolbar: [
            { name: "history", items: ["undo", "redo"] },
            {
                name: "formatting",
                items: [
                    "bold",
                    "italic",
                    "underline",
                    "strikethrough",
                ],
            },
            {
                name: "styling",
                items: ["styles"],
            },
            {
                name: "alignment",
                items: [
                    "alignleft",
                    "aligncenter",
                    "alignright",
                    "alignjustify",
                ],
            },
            {
                name: "list",
                items: [
                    "numlist",
                    "bullist",
                    "outdent",
                    "indent",
                ],
            },
            {
                name: "link",
                items: [
                    "link",
                    "image",
                    "preview",
                    "media",
                    "mergetags",
                ],
            },
            {
                name: "color",
                items: ["forecolor", "backcolor", "emoticons"],
            },
        ],
        menu: {
            favs: {
                title: "My Favorites",
                items: "code visualaid | searchreplace | emoticons",
            },
        },
        menubar:
            "favs file edit view insert format tools table help",
        content_style:
            "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
        setup: (editor) => {
            editor.on("focus", () => {
                const wraper =
                    document.querySelector(".tox-sidebar-wrap");
                wraper.classList.add("editor-focused");
            });
            editor.on("blur", () => {
                const wraper =
                    document.querySelector(".tox-sidebar-wrap");
                wraper.classList.remove("editor-focused");
            });
            editor.on("change", (e) => {
                // alert(
                //     "The TinyMCE rich text editor content has changed."
                // );
                generatePreview()
            });
        },
    },
);
function generatePreview(content = '') {
    // var result = content || quill.root.innerHTML;
    var result = content || tinymce.activeEditor.getContent("content");
    // console.log(result);
    // employeeLetterVariable = { '##EMPLOYEE_NAME##': 'Raafat Sabha'}

    
    // replace all letter variables
    for (var [key, value] of Object.entries(employeeLetterVariable)) {
        console.log(`${key}:${value}`);
        if (value == null) {
            value = '--';
        }
        result = result.replaceAll(key, value);
    }

    console.log(result);
    descriptionPreview.html(result);
    contentText.html(result);

    // setPreviewPadding();
}

$(document).ready(function () {
    // console.log("all tasksJS file");
    // setup: (editor) => {
    //     editor.on("change", (e) => {
    //       alert("The TinyMCE rich text editor content has changed.");
    //     });
    //   };
      
    // alert ('employees_letter_generate.js')


        var clipboard = new ClipboardJS('.btn-copy');
        clipboard.on('success', function(e) {
            Swal.fire({
                icon: 'success',
                text: "Copied",
                toast: true,
                position: 'top-end',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                customClass: {
                    confirmButton: 'btn btn-primary',
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
            })
        });


    $(".js-example-basic-multiple").select2();

    // $(function () {
    //     console.log('tooltip')
    //     $('[data-bs-toggle="tooltip"]').tooltip()
    //   })

    // $("body").on("change", "#letter_type", function (){
    //     alert ('hello');
    // });

    $("#letter_type").on("change", function() {
        $("#cover-spin").hide();

        // alert (this.value);
        id = this.value;
        $.ajax({
            url: "/hr/admin/letter/generate/gettemplate/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                console.log(response)
                g_response = response.letter;
                content = g_response.content;
                console.log(g_response)
                tinymce.get('content').setContent(content)
                $("#preview_letter").empty("").append(content);
                generatePreview()
                // $('<textarea>').val( g_response).appendTo('#content');
                // $("#view_template_modal").offcanvas("show");
                $("#cover-spin").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#cover-spin").hide();
                toastr.error(thrownError);
            },
        });
    });

    $("#template_employee_id").on("change", function() {
        $("#cover-spin").hide();
        
        // alert (this.value);
        id = this.value;
        $.ajax({
            url: "/hr/admin/letter/generate/empvar/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                console.log(response)
                if (response){
                g_response = response.employee[0];
                console.log(g_response)
                employeeLetterVariable = g_response
                } else {
                    employeeLetterVariable = null
                }
                // content = g_response.content;
                // console.log(g_response)
                // tinymce.get('content').setContent(content)
                // $("#preview_letter").empty("").append(content);
                // $("#cover-spin").hide();

        generatePreview();

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#cover-spin").hide();
                toastr.error(thrownError);
            },
        });
    });


    $("body").on("click", "#show_template", function () {
        console.log("inside #show_template");
        $("#cover-spin").show();
        id = $(this).data("id");
        console.log("employee_id: " + id);

        $.ajax({
            url: "/hr/admin/letter/mv/show/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                g_response = response.view;
                $("#show_template_content").empty("").append(g_response);
                $("#view_template_modal").offcanvas("show");
                $("#cover-spin").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#cover-spin").hide();
                toastr.error(thrownError);
            },
        });
    });


    // delete task item
    $("body").on("click", "#delete_template", function (e) {
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
                    url: "/hr/admin/letter/delete/" + id,
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
                    },
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

    // restore task item
    $("body").on("click", "#restoreEmployee", function (e) {
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
                    url: "/hr/admin/restore/" + id,
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

    $("body").on("click", ".removeNoteDiv", function (e) {
        e.preventDefault();
        var taskNoteId = $(this).data("id");
        var tableID = $(this).data("table");
        var divToRemove = $(this)
            .parent("div")
            .parent("div")
            .parent("div")
            .parent("div");
        e.preventDefault();
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
                    url: "/tracki/task/note/" + taskNoteId + "/delete",
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (result) {
                        if (!result["error"]) {
                            toastr.success(result["message"]);
                            divToRemove.remove();
                            // $("#fileCount").html(
                            //     "File (" + result["count"] + ")"
                            // );
                            $("#" + tableID).bootstrapTable("refresh");
                            // for delete confirmation uncomment below
                            // Swal.fire(
                            //     "Deleted!",
                            //     "Your file has been deleted.",
                            //     "success"
                            // );
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
    // delete single file
    $("body").on("click", ".removeFileDiv", function (e) {
        e.preventDefault();
        var taskFileId = $(this).data("id");
        var tableID = $(this).data("table");
        var divToRemove = $(this)
            .parent("div")
            .parent("div")
            .parent("div")
            .parent("div");
        e.preventDefault();
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
                    url: "/tracki/task/file/" + taskFileId + "/delete",
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (result) {
                        if (!result["error"]) {
                            toastr.success(result["message"]);
                            divToRemove.remove();
                            // $("#fileCount").html(
                            //     "File (" + result["count"] + ")"
                            // );
                            // $("#" + tableID).bootstrapTable("refresh");
                            // Swal.fire(
                            //     "Deleted!",
                            //     "Your file has been deleted.",
                            //     "success"
                            // );
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
        department: $("#department_filter").val(),
        functional_area: $("#functional_area_filter").val(),
        entity: $("#entity_filter").val(),
        directorate: $("#directorate_filter").val(),
        active_archived: $("#active_archived_filter").val(),
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
    "#functional_area_filter, #department_filter, #entity_filter, #directorate_filter, #active_archived_filter"
).on("change", function (e) {
    e.preventDefault();
    // console.log("tasks.js on change");
    $("#employee_table").bootstrapTable("refresh");
});
