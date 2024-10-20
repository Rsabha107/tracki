function refreshEmpEdit(val) {
    var g_response;
    // alert('refreshTaskNotes')
    $.ajax({
        url: "/tracki/employee/mv/edit" + val,
        method: "GET",
        async: false,
        success: function (response) {
            g_response = response.view;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        },
    });

    // console.log('return: '+g_response);
    return g_response;
}

function checkModelOpen(e) {
    if (Element.data("bs.modal").isShown) {
        return true;
    }

    return false;
}

$(document).ready(function () {
    // console.log("all tasksJS file");

    $(".js-example-basic-multiple").select2();

    // $(function () {
    //     console.log('tooltip')
    //     $('[data-bs-toggle="tooltip"]').tooltip()
    //   })

    $("body").on("click", "#add_employee_leave", function () {
        // console.log("inside #add_employee");
        $("#cover-spin").show();
        // reset all values
        // $("#add_employee_form")[0].reset();
        // $("#add_employee_form")[0].classList.remove("was-validated");
        // var action = $(this).data("action");

        // var form_action = "/tracki/task/" + action;
        // set the form action with the source var
        // $("#add_task_form").attr("action", form_action);
        // $("#add_employee_table_h").val(table);
        // $("#add_employee_modal_label").html("Add new employee");

        $("#add_employee_leave_modal").modal("show");
        $("#cover-spin").hide();
    });

    $("body").on("click", "#show_leave_balance", function () {
        $("#cover-spin").show();
        // console.log("inside #show_leave_balance");

        id = $(this).data("employeeid");
        table = $(this).data("table");
        // console.log("employee_id: " + id);
        // console.log("table: " + table);

        $.ajax({
            url: "/tracki/employee/leave/mv/balance/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                g_response = response.view;
                $("#leave_balance_view").empty("").append(g_response);
                $("#show_leave_balance_modal").modal("show");
                $("#cover-spin").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                toastr.error(thrownError);
                $("#cover-spin").hide();
            },
        });
    });

    $("body").on("click", "#edit_employee_leave", function () {
        $("#cover-spin").show();
        // console.log("inside #edit_employee");
        // console.log("source: " + x_source);
        // console.log($("#edit_employee").data("id"));
        // reset all values

        // $("#taskTabNotes").empty("").append(refreshEmpEdit(taskID));
        id = $(this).data("id");
        // console.log("employee_id: " + id);

        $.ajax({
            url: "/tracki/employee/leave/mv/edit/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                g_response = response.view;
                $("#employeeLeaveEditView").empty("").append(g_response);
                $("#edit_employee_leave_modal").modal("show");
                $("#cover-spin").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            },
        });
    });

    $("body").on("change", "#leave_type_selection", function (event) {
        var selected_text = $.trim(
            $("#leave_type_selection").find(":selected").text()
        );
        var selected_value = $("#leave_type_selection").find(":selected").val();

        if (selected_text == "Sick Leave") {
            // $("#leave_file_name").attr('required',true);
            $("#leave_file_name").removeAttr("disabled");
        } else {
            // $("#leave_file_name").attr('required',true);
            $("#leave_file_name").attr("disabled", "disabled");
        }
    });

    // ************************************************** Leave status
    $("body").on("click", "#editLeaveStatus", function (event) {
        // console.log("inside sec click edit");
        // event.preventDefault();
        var id = $(this).data("id");
        var table = $(this).data("table");
        // var route = $(this).data("route");
        // console.log("id: " + id);
        // console.log("table: " + table);

        $.get("/tracki/employee/leave/status/edit/" + id, function (data) {
            //  console.log(data);
            // $.each(data, function (index, value) {
                $("#editLeaveId").val(data.id);
                $("#editLeaveStatusSelection").val(data.status_id);
                $("#edit_leave_status_additional_information").val(data.additional_information);
                $("#leaveStatusParentTable").val(table);
                $("#leaveStatusModal").modal("show");
            // });

            // $('#staticBackdropLabel').html("Edit category");
            // $('#submit').val("Edit category");
        });
    });

    // delete task item
    $("body").on("click", "#deleteEmployeeLeave", function (e) {
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
                    url: "/tracki/employee/leave/delete/" + id,
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
        status: $("#leave_status_filter").val(),
        leave_type: $("#leave_type_filter").val(),
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

function actionsFormatter(value, row, index) {
    return [
        '<a href="javascript:void(0);" class="edit-tag" data-bs-toggle="modal" data-bs-target="#edit_tag_modal" data-id=' +
            row.id +
            " title=" +
            label_update +
            ' class="card-link"><i class="bx bx-edit mx-1"></i></a>' +
            "<button title=" +
            label_delete +
            ' type="button" class="btn delete" data-id=' +
            row.id +
            ' data-type="tags">' +
            '<i class="bx bx-trash text-danger mx-1"></i>' +
            "</button>",
    ];
}

function TaskUserFormatter(value, row, index) {
    // console.log('inside TaskUserFormatter: '+ row.assigned_to)
    var assigned_to =
        Array.isArray(row.assigned_to) && row.assigned_to.length
            ? row.assigned_to
            : '<span class="badge bg-primary">' +
              label_not_assigned +
              "</span>";
    if (Array.isArray(assigned_to)) {
        assigned_to = assigned_to.map((user) => "<li>" + user + "</li>");
        return (
            '<ul class="list-unstyled assigned_to-list m-0 avatar-group d-flex align-items-center">' +
            assigned_to.join("") +
            "</ul>"
        );
    } else {
        return assigned_to;
    }
}

function attributeFormatter(value, row, index) {
    return [
        '<a href="javascript:void(0);" class="edit-tag" data-bs-toggle="modal" data-bs-target="#edit_tag_modal" data-id=' +
            row.id +
            " title=" +
            label_update +
            ' class="card-link"><i class="bx bx-edit mx-1"></i></a>' +
            "<button title=" +
            label_delete +
            ' type="button" class="btn delete" data-id=' +
            row.id +
            ' data-type="tags">' +
            '<i class="bx bx-trash text-danger mx-1"></i>' +
            "</button>",
    ];
}

function actions2Formatter(value, row, index) {
    // console.log("employees.js inside actions2Formatter");
    html = "";
    html =
        html +
        '<div class="font-sans-serif btn-reveal-trigger position-static">';

    if (can_edit) {
        // html =
        //     '<div class="font-sans-serif btn-reveal-trigger position-static">' +
        //     '<a href="/tracki/employee/' +
        //     row.id +
        //     '/edit" class="btn btn-sm" id="editX" data-route="category" data-id="">' +
        //     '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
        html =
            html +
            // '<div class="font-sans-serif btn-reveal-trigger position-static">' +
            '<a href="javascript:void(0)" class="btn btn-sm" id="edit_employee_leave" data-action="update" " data-type="edit" data-id="' +
            row.id +
            '" data-table="employee_leave_table" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
            label_update +
            '">' +
            '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
        // html ='<a href="javascript:voice(0)" id="edit_employee" data-id ="'+ row.id +'"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="'+ label_update +'"><i class="bx bx-plus"></i></button></a>'
    }
    if (can_delete) {
        html =
            html +
            '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_leave_table" data-id="' +
            row.id +
            '" id="deleteEmployeeLeave" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
            label_delete +
            '">' +
            '<i class="bx bx-trash text-danger"></i></a>';
    }

    html = html + "</div></div>";

    return [html];
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
    "#leave_status_filter,#leave_type_filter"
).on("change", function (e) {
    e.preventDefault();
    // console.log("tasks.js on change");
    $("#employee_leave_table").bootstrapTable("refresh");
});
