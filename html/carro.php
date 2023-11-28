<?php
session_start();
if (isset($_SESSION["id_usuario"])) {
    //  header('location: vistas2.php');
    // You may want to remove this echo statement unless it's for debugging purposes
    // echo "sesion" . $_SESSION['id_usuario'];
} else {
    //echo "Sesión no iniciada";
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

    <script src="https://www.paypal.com/sdk/js?client-id=AfF_gJcCHUpF3hitqwZE3ni31c1mZgzKfJnqa-LsJSyhO01dbcI0KhotmE4K6TMQzQ9W4A6BGdW_wGvm&currency=MXN"></script>
  </head>

  <body>
    <!-- <div id="sas"></div> -->

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
        <!-- Agregamos clases d-flex, justify-content-center y align-items-center para centrar vertical y horizontalmente -->
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
              //console.log(response);
              $("#carrito").html(response);
            },
            error: function () {
              // Maneja errores si la solicitud AJAX falla
              $("#carrito").html("Error al cargar la barra de navegación");
            },
          });
          recargarPaginaT();

        }
      </script>
    </div>
    <div id="sas"></div>
  </body>
</html>
<script>
  $(document).ready(function () {
    carro();
    
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
        $("#tbMensajes").html(data); // Actualiza la tabla del carrito
        mostrarNotificacion("elemento eliminado", "success");
      },
    });
    carro();
  }

  // function comprarCarrito(id) {
  //           // Agrega al carrito
  //           carro();

  //           $.ajax({
  //               type: "POST",
  //               url: "../controller/Usuario/ctrusuario.php?opc=5",
  //               data:
  //                {
  //                 id:id
  //                },

  //               success: function(data) {
  //                   $('#sas').html(data); // Actualiza la tabla del carrito
  //               },
  //           });
  //           carro();
  //       }

  function comprarCarrito(id) {
  // Agrega al carrito
  carro();

  // Muestra la alerta de espera
  Swal.fire({
    title: "Cargando...",
    allowOutsideClick: false,
    onBeforeOpen: () => {
      Swal.showLoading();
    },
  });

  $.ajax({
    type: "POST",
    url: "../controller/Usuario/ctrusuario.php?opc=5",
    data: {
      id: id,
    },
    success: function (data) {
      // Actualiza la tabla del carrito
      $("#sas").html(data);

      // Cierra la alerta después de completar la solicitud
      Swal.close();

      // Muestra una alerta de éxito
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: "¡La operación se ha completado con éxito!",
        showConfirmButton: false,
        timer: 1500,
      });
    },
    error: function () {
      // Maneja el error aquí si es necesario
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Ha ocurrido un error durante la solicitud.",
      });
    },
  });

  // Esto parece ser una referencia a una función no definida, asegúrate de que está definida antes de usarla
  carro();
}

</script>

<script>
  var id;

  var total; // Variable global para almacenar el valor total
  var titulo;
  var currencyCode;

  var id;

  function recargarPaginaT() {
    $.ajax({
      type: "GET",
      url: "../controller/Usuario/ctrusuario.php?opc=12",
      data: {},
      success: function (data) {
        try {
          // Intenta analizar la respuesta como JSON
          var respuestaJSON = JSON.parse(data);

          // Verifica si la respuesta contiene la clave 'total'
          if ("total" in respuestaJSON) {
            total = respuestaJSON.total;

            // Hacer algo con el valor total
            console.log("Total:", total);

            // Llama a la función de PayPal después de obtener el valor
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
                  value: total.toString(), // Make sure to use a string for the value
                },
              },
            ],
          });
        },
        onApprove: function (data, actions) {
          actions.order.capture().then(function (details) {
            // Extract values from the details object
            var purchaseUnit = details.purchase_units[0];
            var amount = purchaseUnit.amount.value;
            var currencyCode = purchaseUnit.amount.currency_code;
            var estado = details.status;
            id = details.id;
            // Log or use the extracted values
            console.log(details);
            console.log("Amount:", amount);
            console.log("Currency Code:", currencyCode);
            console.log("estado:", estado);
            console.log("id=", id);
            comprarCarrito(id);
          });
        },
        // Payment canceled
        onCancel: function (data) {
          alert("Payment canceled");
          console.log(data);
        },
      })
      .render("#paypal-button-container");
  }
</script>
