$(document).ready(function () {
    var usersTable = $("#users_table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "usuarios",
            type: "GET",
        },
        columns: [
            { data: "carnet" },
            { data: "full_name" },
            { data: "email" },
            // { data: "status" },
            { data: "action", orderable: false, searchable: false },
        ],
    });
    registerAjaxForm("form#add_user", "div.modal_user", usersTable);

    updateAjaxForm(
        "form#edit_user",
        "button.edit_user",
        "div.modal_user",
        usersTable
    );

    deleteAjaxConfirmation({
        selector: "button.delete_user",
        table: usersTable,
    });


});
