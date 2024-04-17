$(document).ready(function () {
    // Product datatable
    $(".product-datatable").DataTable({
        autoWidth: false,
        processing: true,
        rowId: "id",
        serverSide: true,
        ajax: "/product/getjson",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "avatar", name: "avatar" },
            { data: "title", name: "title", className: "text-gray-900" },
            { data: "customPrice", name: "price" },
            { data: "category.name", name: "category.name" },
            { data: "colors", name: "colors" },
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

    // Preview image on file input change
    $("#productImgUpload").change(function () {
        let reader = new FileReader();
        reader.onload = (e) => {
            $("#productImgUploadPreview").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });

    $(".product-datatable").on("click", "#deleteProductButton", function () {
        console.log("Button clicked");
        var confirmation = confirm(
            "Are you sure you want to delete this product?"
        );
        if (confirmation) {
            // Find the form related to the clicked button and submit it
            $(this).closest("form").submit();
        }
    });
});
