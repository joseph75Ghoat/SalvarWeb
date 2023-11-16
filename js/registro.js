// jQuery(document).on("submit", "#forming", function (event) {
//   event.preventDefault();

//   // Verificar el captcha antes de continuar
//   var response = grecaptcha.getResponse();

//   if (!response) {
//     response = "completa el captcha";
//     // El captcha no se completó
//     console.log("Por favor, complete el captcha.");
//     alert("Por favor, complete el captcha.");
//     return;
//   }

//   // Continúa con el envío del formulario si el captcha se completó
//   jQuery
//     .ajax({
//       url: "../controller/ctrlRegistrar.php",
//       type: "POST",
//       dataType: "json",
//       data: jQuery(this).serialize(),
//       beforeSend: function () {
//         // jQuery('.botonlg').val('Validando...');
//       },
//     })
//     .done(function (respuesta) {
//       if (respuesta.success) {
//   alert("registro exitoso");
//   window.location.href='login.html';
//       } else {
//         jQuery("#error").html(respuesta.message);
//         alert(respuesta.message);
//         jQuery("#error").slideDown("slow");
//         setTimeout(function () {
//           jQuery("#error").slideUp("slow");
//         }, 3000);
//         console.log("Error: " + respuesta.message);
//         grecaptcha.reset();
//         // Puedes mostrar un mensaje de error
//       }
//     })

//     .fail(function (resp) {
//       console.log(resp.responseText);
//     })
//     .always(function () {
//       console.log("Complete");
//     });
// });
jQuery(document).on("submit", "#forming", function (event) {
  event.preventDefault();

  // Verificar el captcha antes de continuar
  var response = grecaptcha.getResponse();

  if (!response) {
    response = "completa el captcha";
    // El captcha no se completó
    console.log("Por favor, complete el captcha.");
    showAlert('Error', 'Por favor, complete el captcha.');
    return;
  }

  // Continúa con el envío del formulario si el captcha se completó
  jQuery.ajax({
    url: "../controller/ctrlRegistrar.php",
    type: "POST",
    dataType: "json",
    data: jQuery(this).serialize(),
    beforeSend: function () {
      // jQuery('.botonlg').val('Validando...');
    },
  })
  .done(function (respuesta) {
    if (respuesta.success) {
      showAlert('Éxito', 'Registro exitoso', true, 'login.html');
    } else {
      jQuery("#error").html(respuesta.message);
      showAlert('Error', respuesta.message);
      jQuery("#error").slideDown("slow");
      setTimeout(function () {
        jQuery("#error").slideUp("slow");
      }, 3000);
      console.log("Error: " + respuesta.message);
      grecaptcha.reset();
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
