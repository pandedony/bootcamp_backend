$(document).ready(function () {
    $(".category-datatable").DataTable({
        processing: true,
        rowId: "id",
        serverSide: true,
        ajax: "/category/getjson",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "name", name: "name", className: "text-gray-900" },
            { data: "action", name: "action" },
        ],
        columnDefs: [
            {
                targets: "_all",
                createdCell: function (td, cellData, rowData, row, col) {
                    // Add data-label attribute to each table cell
                    $(td).attr(
                        "data-label",
                        $(this.api().columns(col).header()).text()
                    );
                },
            },
        ],
        dom:
            "<'flex flex-col md:flex-row items-start md:items-center mb-2 justify-between w-full'" +
            "<'w-full text-center md:text-start md:w-1/2 order-1 md:order-1'l>" +
            "<'w-full text-center md:text-end md:w-1/2 order-2 md:order-2 md:w-auto'f>>" +
            "<'w-full'tr>" +
            "<'flex flex-col md:flex-row items-start md:items-center mt-2 justify-between w-full'" +
            "<'w-full text-center md:text-start md:w-1/2 order-1 md:order-1'i>" +
            "<'w-full text-center md:text-end md:w-auto md:w-1/2 order-2 md:order-2'p>>",
    });

    $(".category-datatable").on("click", "#deleteCategoryButton", function () {
        console.log("Button clicked");
        var confirmation = confirm(
            "Are you sure you want to delete this category?"
        );
        if (confirmation) {
            // Find the form related to the clicked button and submit it
            $(this).closest("form").submit();
        }
    });
});
