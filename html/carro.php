<?php
session_start();
if (isset($_SESSION["id_usuario"])) {
    //  header('location: vistas2.php');
    // Puedes eliminar este echo a menos que sea para fines de depuración
    // echo "sesion" . $_SESSION['id_usuario'];
} else {
    // echo "Sesión no iniciada";
    header('location: login.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="ruta/a/sweetalert2.min.css" />
    <script src="ruta/a/sweetalert2.min.js"></script>

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"
    ></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/caritto.css" />
    <!-- CDN de Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <script src="https://www.paypal.com/sdk/js?client-id=AfF_gJcCHUpF3hitqwZE3ni31c1mZgzKfJnqa-LsJSyhO01dbcI0KhotmE4K6TMQzQ9W4A6BGdW_wGvm&currency=MXN"></script>

    <style>
    #paypal-container {
        display: none;
        position: fixed;
        bottom: -14px; /* Ajusta la distancia desde la parte inferior según tus necesidades */
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000; /* Asegúrate de que el contenedor esté en la parte superior */
    }
</style>


</head>
<body>
<div id="paypal-container"></div>

<div id="tbMensajes"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a
                        class="nav-link active"
                        aria-current="page"
                        href="../html/catalogo.php"
                >Catalogo</a
                >
            </li>
        </ul>
    </div>

    <div
            class="container-fluid d-flex justify-content-center align-items-center"
    >
        <label class="text-white" for="">Carrito de compras</label>
    </div>
</nav>

<div id="carrito">
    <script>
        function carro() {
            $.ajax({
                url: "../controller/Usuario/ctrusuario.php?opc=3",
                type: "GET",
                success: function (response) {
                    $("#carrito").html(response);
                },
                error: function () {
                    $("#carrito").html("Error al cargar la barra de navegación");
                },
            });
            // No es necesario llamar a recargarPaginaT() aquí
        }
    </script>
</div>
<div id="sas"></div>

<script>
    $(document).ready(function () {
        carro();
        recargarPaginaT();
    });

    function borrarDeCarrito(id_producto) {
        carro();
        $.ajax({
            type: "POST",
            url: "../controller/Usuario/ctrusuario.php?opc=4",
            data: {
                id_producto: id_producto,
            },
            success: function (data) {
                $("#tbMensajes").html(data);
                mostrarNotificacion("elemento eliminado", "success");
            },
        });
        carro();
    }
    function comprarCarrito(id) {
    carro();

    Swal.fire({
        title: "<span style='color: #3498db;'>Cargando...</span>",
        html: '<div class="custom-loader-container"><i class="fas fa-shopping-cart custom-loader"></i></div>',
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading();
        },
        customClass: {
            title: 'custom-title-class',
            popup: 'custom-popup-class',
        },
    });

    // Swal.fire({
    //     title: "<span style='color: #3498db;'>Cargando...</span>",
    //     html: '<div class="custom-loader-container"><i class="fas fa-hourglass-half custom-loader"></i></div>',
    //     allowOutsideClick: false,
    //     showCancelButton: false,
    //     showConfirmButton: false,
    //     onBeforeOpen: () => {
    //         Swal.showLoading();
    //     },
    //     customClass: {
    //         title: 'custom-title-class',
    //         popup: 'custom-popup-class',
    //     },
    // });


    $.ajax({
        type: "POST",
        url: "../controller/Usuario/ctrusuario.php?opc=5",
        data: {
            id: id,
        },
        success: function (data) {
            $("#sas").html(data);
            Swal.close();

            Swal.fire({
    title: "¡Operación exitosa!",
    showConfirmButton: false,
    // timer: 1000,
    customClass: {
        title: 'animated rubberBand custom-title-class', // Animación de entrada
        popup: 'animated bounceOutUp custom-popup-class', // Animación de salida
    },
});



            // Oculta el contenedor de PayPal después de completar la compra
            $("#paypal-container").hide();

            // Agrega un retraso de 1 segundo antes de recargar la página
            setTimeout(function () {
                // Recarga la página después de completar la compra
                location.reload();
            }, 1000); // 1000 milisegundos = 1 segundo
        },
        error: function () {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ha ocurrido un error durante la solicitud.",
            });
        },
    });
}

</script>


<script>
    var id;
    var total;

    function recargarPaginaT() {
        $.ajax({
            type: "GET",
            url: "../controller/Usuario/ctrusuario.php?opc=12",
            data: {},
            success: function (data) {
                try {
                    var respuestaJSON = JSON.parse(data);
                    if ("total" in respuestaJSON) {
                        total = respuestaJSON.total;
                        console.log("Total:", total);
                        inicializarPayPal(total);
                    } else {
                        console.error('La respuesta no contiene la clave "total".');
                    }
                } catch (error) {
                    console.error("Error al analizar la respuesta como JSON:", error);
                }
            },
        });
    }

    function inicializarPayPal(total) {
        paypal
            .Buttons({
                style: {
                    color: "blue",
                    shape: "pill",
                    label: "pay",
                },
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [
                            {
                                amount: {
                                    value: total.toString(),
                                },
                            },
                        ],
                    });
                },
                onApprove: function (data, actions) {
                    actions.order.capture().then(function (details) {
                        var purchaseUnit = details.purchase_units[0];
                        var amount = purchaseUnit.amount.value;
                        var currencyCode = purchaseUnit.amount.currency_code;
                        var estado = details.status;
                        id = details.id;

                        console.log(details);
                        console.log("Amount:", amount);
                        console.log("Currency Code:", currencyCode);
                        console.log("estado:", estado);
                        console.log("id=", id);
                        comprarCarrito(id);
                    });
                },
                onCancel: function (data) {
                    alert("Payment canceled");
                    console.log(data);
                },
            })
            .render("#paypal-container");

        if (total > 0) {
            $("#paypal-container").show();
        }
    }
</script>
</body>
</html>