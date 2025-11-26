$(document).ready(function () {
    var plantelTable = $("#plantel_table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "plantel-administrativo",
            type: "GET",
        },
        columns: [
            { data: "carnet" },
            { data: "full_name" }
        ],
    });
});
