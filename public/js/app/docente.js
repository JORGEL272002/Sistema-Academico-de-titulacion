$(document).ready(function () {
    var teachersTable = $("#teachers_table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "docentes",
            type: "GET",
        },
        columns: [
            { data: "carnet" },
            { data: "full_name" },
            { data: "created_at" }
        ],
    });
});
