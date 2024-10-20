$(document).ready(function () {

    // **************************************************

    $("body").on("click", "#edit_element", function () {
        console.log('inside element classification')
        var id = $(this).data("id");
        var table = $(this).data("table");
        $.ajax({
            url: "/tracki/setting/element/get/" + id,
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
            },
            dataType: "json",
            success: function (response) {
                console.log(response)
                $("#edit_element_id").val(response.op.id);
                $("#edit_element_title").val(response.op.title);
                $("#edit_element_classification_id").val(response.op.element_classification_id);
                $("#edit_element_input_type_id").val(response.op.input_type_id);
                $("#edit_element_input_value").val(response.op.input_value);
                $("#edit_element_table").val(table);
                // $("#edit_element_modal").modal("show");
            },
        }).done(function () {
            $("#edit_element_modal").modal("show");
        });
    });
});

$("body").on("click", "#delete_element", function (e) {
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
                url: "/tracki/setting/element/delete/" + id ,
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
        '<a href="javascript:void(0);" id="edit_element" data-id=' +
            row.id +
            " title=" +
            label_update +
            ' data-table="element_table" class="card-link"><i class="bx bx-edit mx-1"></i></a>' +
            "<button title=" +
            label_delete +
            ' type="button" data-table="element_table" class="btn delete" id="delete_element" data-id=' +
            row.id +
            ' data-type="status">' +
            '<i class="bx bx-trash text-danger mx-1"></i>' +
            "</button>",
    ];
}
