"use strict";

(function ($, window, i) {
    console.log("Designed by EASuarez :D");
    /* Var Global */
    var product_id = document.getElementById("product_id").value,
        permission = document.getElementById("ctrl-permission").value;
    /*  Yajra DataTables */
    var table = $("#variants").DataTable({
        serverSide: true,
        ajax: "/api/variants/" + product_id,
        aLengthMenu: [
            [7, 20, 50, 100, -1],
            [7, 20, 50, 100, "All"],
        ],
        iDisplayLength: 7,
        columns: [
            { data: "id" },
            { data: "product_id" },
            { data: "product_variant_name" },
            { data: "info" },
            { data: "btn" },
        ],
        columnDefs: [
            { targets: [2, 4], className: "text-center" },
            { targets: [0, 1], visible: false, searchable: false },
        ],
    });

    $(document).on("click", ".destroybtn", function (e) {
        e.preventDefault();
        if (permission === "1") {
            var id = $(this).val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                type: "DELETE",
                url: "/variants/" + id,
                dataType: "json",
            })
                .done(function (res) {
                    if (res.response.status == 400) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: res.response.msg,
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        });
                        $("#btn-register").text("Guardar");
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: "¡Eliminado!",
                            text: res.response.msg,
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        });
                        table.ajax.reload();
                    }
                })
                .fail(function (res) {
                    console.log(res);
                });
        } else {
            /* Volver a revisar la opción hidden */
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "No cuentas con los permisos suficientes para esta acción.",
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        }
    });
})(jQuery, this, 0);
