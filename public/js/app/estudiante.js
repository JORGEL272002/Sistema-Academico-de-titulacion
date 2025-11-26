$(document).ready(function () {
    var estudianteTable = $("#estudiante_table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "estudiantes",
            type: "GET",
        },
        columns: [
            { data: "carnet" },
            { data: "full_name" },
            { data: "created_at" }
        ],
    });
});
