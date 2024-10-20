$("body").on("click", "#address-tab", function (event) {
    // alert('in activity-tab')
    // $(".employee-address").html("<x-employee-addresses-card :emp='$emp' />");

    $("#employee_address_table").bootstrapTable("refresh");
    // $('#firstModal').modal('toggle');
});

$("body").on("click", "#salary-tab", function (event) {
    // alert('in activity-tab')
    $("#employee_salary_table").bootstrapTable("refresh");
    // $('#firstModal').modal('toggle');
});

$("body").on("click", "#bank-tab", function (event) {
    // alert('in activity-tab')
    $("#employee_bank_table").bootstrapTable("refresh");
    // $('#firstModal').modal('toggle');
});

$("body").on("click", "#timesheet-tab", function (event) {
    // alert('in activity-tab')
    $("#employee_timesheet_table").bootstrapTable("refresh");
    // $('#firstModal').modal('toggle');
});

$("body").on("click", "#leave-tab", function (event) {
    // alert('in activity-tab')
    $("#employee_leave_table").bootstrapTable("refresh");
    // $('#firstModal').modal('toggle');
});

$("body").on("click", "#attachments-tab", function (event) {
    // alert('in activity-tab')
    $("#employee_file_table").bootstrapTable("refresh");
    // $('#firstModal').modal('toggle');
});

$("body").on("click", "#emergency-tab", function (event) {
    // alert('in activity-tab')
    $("#employee_emergency_table").bootstrapTable("refresh");
    // $('#firstModal').modal('toggle');
});

// $("body").on("click", "#projects-tab", function (event) {
//     var employeeId = $(this).data("employee-id");
//     console.log(employeeId)

//     $(".spinner-border").show();
//     $.ajax({
//         url: "/tracki/project/vw/cards/"+employeeId,
//         method: "GET",
//         async: true,
//         success: function (response) {
//             g_response = response.view;
//             $("#projectCards").empty("").append(g_response);
//             $(".spinner-border").hide();
//         },
//     });
// });
