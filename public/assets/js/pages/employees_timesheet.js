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

function convertToJson() {
    let personalForm = document.getElementById("personalForm");
    let basicForm = document.getElementById("basicForm");
    let addressForm = document.getElementById("addressForm");
    var myFile = document.getElementById("profile_image_name");
    var files = myFile.files;
    var file = files[0];

    console.log("personalForm: " + personalForm);
    console.log("myFile: " + myFile);
    console.log("files: " + files);
    console.log("file: " + file);

    let formData = {};
    let formData1 = new FormData();
    for (let i = 0; i < basicForm.elements.length; i++) {
        let element = basicForm.elements[i];
        // console.log('element name: '+element.name)
        if (element.type !== "submit") {
            if (element.type == "file" && element.value.length) {
                formData1.append(element.name, file, file.name);
            } else {
                formData1.append(element.name, element.value);
            }
            formData[element.name] = element.value;
        }
    }

    for (let i = 0; i < personalForm.elements.length; i++) {
        let element = personalForm.elements[i];
        // console.log('element name: '+element.name)
        if (element.type !== "submit") {
            if (element.type == "file" && element.value.length) {
                formData1.append(element.name, file, file.name);
            } else {
                formData1.append(element.name, element.value);
            }
            formData[element.name] = element.value;
        }
    }

    for (let i = 0; i < addressForm.elements.length; i++) {
        let element = addressForm.elements[i];
        // console.log('element name: '+element.name)
        if (element.type !== "submit") {
            if (element.type == "file" && element.value.length) {
                formData1.append(element.name, file, file.name);
            } else {
                formData1.append(element.name, element.value);
            }
            formData[element.name] = element.value;
        }
    }

    // Display the key/value pairs
    for (var pair of formData1.entries()) {
        console.log(pair[0] + ", " + pair[1]);
    }
    // let form2 = document.getElementById("form-2");
    // console.log('form: '+form2)
    // let formData2 = {};
    // // let formData = {};
    // for (let i = 0; i < form2.elements.length; i++) {
    //     let element = form2.elements[i];
    //     console.log('element name: '+element.name)
    //     if (element.type !== "submit") {
    //         formData2[element.name] = element.value;
    //     }
    // }

    // let form3 = document.getElementById("form-3");
    // console.log('form: '+form3)
    // let formData3 = {};
    // for (let i = 0; i < form3.elements.length; i++) {
    //     let element = form3.elements[i];
    //     console.log('element name: '+element.name)
    //     if (element.type !== "submit") {
    //         formData3[element.name] = element.value;
    //     }
    // }

    // let jsonData = formData;
    // let jsonData2 = formData2;
    // let jsonData3 = formData3;
    // let jsonOutput = document.getElementById("jsonOutput");

    console.log(formData);
    // console.log(jsonData2);
    // console.log(jsonData3);

    $.ajax({
        url: "/tracki/employee/store",
        type: "POST",
        dataType: "json",
        data: formData1,
        contentType: false,
        processData: false,
        // headers: {
        //     "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"),
        // },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        async: false,
        success: function (response) {
            console.log(response);
            toastr.success(response["message"]);
            // $('#smartwizard').smartWizard("reset");

            // Reset form
            // document.getElementById("form-1").reset();
            // document.getElementById("form-2").reset();
            // document.getElementById("form-3").reset();
            // document.getElementById("form-4").reset();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        },
    });

    // jsonOutput.innerHTML = "<pre>" + jsonData + "</pre>";
}

$(document).ready(function () {
    // console.log("all tasksJS file");

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

    $(".js-example-basic-multiple").select2();

    // $(function () {
    //     console.log('tooltip')
    //     $('[data-bs-toggle="tooltip"]').tooltip()
    //   })

    $("body").on("click", "#store_employee", function () {
        console.log("inside #store_employee");
        $("#cover-spin").show();
        convertToJson();
        $("#cover-spin").hide();
    });

    $("body").on(
        "click",
        "#view_readonly_employee_timesheet_entry",
        function () {
            console.log("inside #edit_employee_timesheet_entry");
            var id = $(this).data("id");

            $("#cover-spin").show();

            $.ajax({
                url: "/tracki/employee/managers/timesheet/entries/mv/get/" + id,
                method: "GET",
                async: true,
                success: function (response) {
                    g_response = response.view;
                    $("#manager_timesheet_entries_readonly")
                        .empty("")
                        .append(g_response);
                    $(
                        "#view_readonly_employee_timesheet_entry_modal"
                    ).offcanvas("show");
                    $("#cover-spin").hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    $("#cover-spin").hide();
                },
            });
        }
    );

    $("body").on("click", "#payroll_timesheet_check", function () {
        $("#cover-spin").show();
        var id = $(this).data("id");
        var tableID = $(this).data("table");
        console.log("inside #payroll_timesheet_check " + id);

        $.ajax({
            url: "/tracki/payroll/timesheet/review/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                toastr.success(response["message"]);
                $("#" + tableID).bootstrapTable("refresh");
                $("#cover-spin").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#cover-spin").hide();
            },
        });
        $("#cover-spin").hide();
    });

    $("body").on("click", "#add_employee_timesheet", function () {
        console.log("inside #add_employee_timesheet");
        $("#cover-spin").show();
        var source = $(this).data("source");

        $("#add_employee_timesheet_modal").modal("show");

        $("#cover-spin").hide();
    });

    $("body").on("click", "#edit_employee_timesheet", function () {
        $("#cover-spin").show();
        console.log("inside #edit_employee");
        // console.log("source: " + x_source);
        // console.log($("#edit_employee").data("id"));
        // reset all values

        // $("#taskTabNotes").empty("").append(refreshEmpEdit(taskID));
        id = $(this).data("id");
        console.log("employee_id: " + id);

        $.ajax({
            url: "/tracki/employee/timesheet/mv/edit/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                g_response = response.view;
                $("#employeeTimeSheetEditView").empty("").append(g_response);
                $("#edit_employee_timesheet_modal").modal("show");
                $("#cover-spin").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            },
        });
    });

    // ************************************************** task status
    $("body").on("click", "#editTimesheetStatus", function (event) {
        // console.log("inside sec click edit");
        // event.preventDefault();
        var id = $(this).data("id");
        var table = $(this).data("table");
        // var route = $(this).data("route");
        // console.log("id: " + id);
        // console.log("table: " + table);

        $.get("/tracki/employee/timesheet/status/edit/" + id, function (data) {
            //  console.log('event name: ' + data);
            // $.each(data, function (index, value) {
            // console.log(data);
            $("#editTimesheetId").val(data.id);
            $("#editTimesheetStatusSelection").val(data.status_id);
            $("#edit_timesheet_status_additional_information").val(
                data.additional_information
            );
            $("#timesheetStatusParentTable").val(table);
            $("#timesheetStatusModal").modal("show");
            // });

            // $('#staticBackdropLabel').html("Edit category");
            // $('#submit').val("Edit category");
        });
    });

    // delete task item
    $("body").on("click", "#deleteTimesheet", function (e) {
        var id = $(this).data("id");
        var tableID = $(this).data("table");
        e.preventDefault();
        // alert("tableID: "+tableID);
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Deleting This Timesheet will delete all related entries?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/tracki/employee/timesheet/delete/" + id,
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

// $(function () {
//     $("#task_table").bootstrapTable();
// });

("use strict");

function queryParams(p) {
    return {
        status: $("#timesheet_status_filter").val(),
        period: $("#timesheet_period_filter").val(),
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
    console.log("employees_timesheet.js inside actions2Formatter");
    html = "";
    html =
        html +
        '<div class="font-sans-serif btn-reveal-trigger position-static">' +
        '<a href="/tracki/employee/profile/' +
        row.id +
        '" class="btn btn-sm" id="employeeCardView" data-id="' +
        row.id +
        '" data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
        label_view +
        '">' +
        '<i class="fa-solid far fa-lightbulb text-warning"></i></a>';

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
            '<a href="javascript:void(0)" class="btn btn-sm" id="edit_employee_timesheet" data-action="update" " data-type="edit" data-id="' +
            row.id +
            '" data-table="employee_timesheet_table" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
            label_update +
            '">' +
            '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
        // html ='<a href="javascript:voice(0)" id="edit_employee" data-id ="'+ row.id +'"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="'+ label_update +'"><i class="bx bx-plus"></i></button></a>'
    }
    if (can_delete) {
        html =
            html +
            '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_timesheet_table" data-id="' +
            row.id +
            '" id="deleteEmployeetimesheet" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
            label_delete +
            '">' +
            '<i class="bx bx-trash text-danger"></i></a>';
    }
    html =
        html +
        '<button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>' +
        '<div class="dropdown-menu dropdown-menu-end py-2">';
    if (can_edit) {
        html =
            html +
            '<a class="dropdown-item" href="employee/address/' +
            row.id +
            '"  data-id="' +
            row.id +
            '" data-table="employee_table" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-plus text-primary me-1" ></i>Address</a>';
    }

    html =
        html +
        '<a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#employeeStatusModal" id="editemployeeStatus" data-id="' +
        row.id +
        '" data-table="employee_table" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-percent text-primary me-1" ></i>Change Status</a>' +
        '<a href="#!" id="addemployeeNote" data-table="employee_table" data-id="' +
        row.id +
        '" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addemployeeNoteModal" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-note-sticky text-primary me-1"></i>Add a note</a>' +
        '<a href="#!" id="addemployeeAttch" data-table="employee_table" data-id="' +
        row.id +
        '" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addAttachementemployeeModal" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-file-circle-plus text-primary me-1"></i></i>Upload a file</a>';
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

$("#timesheet_status_filter,#timesheet_period_filter").on(
    "change",
    function (e) {
        e.preventDefault();
        // console.log("tasks.js on change");
        $("#employee_timesheet_table").bootstrapTable("refresh");
        $("#payroll_timesheet_table").bootstrapTable("refresh");
    }
);
