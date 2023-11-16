// jQuery(document).on('submit', '#forming', function (event) {
//     event.preventDefault(); 
//     jQuery.ajax({
//         url: '../controller/ctrlogin.php',
//         type: 'POST',
//         dataType: 'json',
//         data: jQuery(this).serialize(),
//         beforeSend: function () {
//             // Puedes realizar acciones antes de enviar la solicitud aquí
//             jQuery('.botonlg').val('validando...'); // Debes usar jQuery en lugar de $
//         }
//     })
//         .done(function (respuesta) {
//             console.log(respuesta);
//             // Evaluar la respuesta
//             if (!respuesta.error){
                
//                 location.href= '../html/catalogo.php';
//             } else {
//                alert ('Campos incorrectos')
//     }
//         })
//         .fail(function (resp) {
//             console.log(resp.responseText);
//         })
//         .always(function () {
//             console.log("complete");
//         });
// });

jQuery(document).on('submit', '#forming', function (event) {
    event.preventDefault();

    jQuery.ajax({
        url: '../controller/ctrlogin.php',
        type: 'POST',
        dataType: 'json',
        data: jQuery(this).serialize(),
        beforeSend: function () {
            // Puedes realizar acciones antes de enviar la solicitud aquí
            jQuery('.botonlg').val('Validando...');
        }
    })
    .done(function (respuesta) {
        if (!respuesta.error) {
            showAlert('Éxito', 'Inicio de sesión exitoso', true, '../html/catalogo.php');
        } else {
            showAlert('Error', 'Campos incorrectos');
        }
    })
    .fail(function (resp) {
        console.log(resp.responseText);
    })
    .always(function () {
        console.log("Complete");
    });
});

function showAlert(title, message, redirect = false, location = '') {
    var alertContainer = jQuery('<div class="custom-alert">')
        .appendTo('body');

    var alertBox = jQuery('<div class="custom-alert-box">')
        .appendTo(alertContainer);

    var alertTitle = jQuery('<h3>').text(title).appendTo(alertBox);
    var alertMessage = jQuery('<p>').text(message).appendTo(alertBox);

    var closeButton = jQuery('<button class="custom-alert-close">Cerrar</button>')
        .click(function () {
            alertContainer.remove();
            if (redirect && location !== '') {
                window.location.href = location;
            }
        })
        .appendTo(alertBox);
}

