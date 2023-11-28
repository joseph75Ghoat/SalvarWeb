<?php

require('src/PHPMailer/src/Exception.php');
require 'src/PHPMailer/src/PHPMailer.php';
require 'src/PHPMailer/src/SMTP.php';
require("src/vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class MailerService
{
    public function sendMail($para, $asunto, $mensaje, $nombre)
    {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP de Gmail
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Desactiva la salida de depuración (puedes cambiarlo según tus necesidades)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Servidor SMTP de Gmail
            $mail->SMTPAuth   = true;
            $mail->Port       = 587; // Puerto SMTP de Gmail
            $mail->Username   = 'nikeschex@gmail.com'; // Tu dirección de correo de Gmail
            $mail->Password   = 'srlqxrgnqnblmida'; // Tu contraseña de Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilita el cifrado TLS

            // Configuración de los destinatarios y contenido del correo
            $mail->setFrom('nikeschex@gmail.com', 'NIKE CHEX'); // Tu dirección de correo y tu nombre
            $mail->addAddress($para, $nombre); // Dirección de correo del destinatario y su nombre
            $mail->isHTML(true);
            $mail->Subject = $asunto;
             $mail->Body = '
            <h1>Felicitaciones, ' . $para . '</h1>
            <p>Queremos expresar nuestro agradecimiento y felicitaciones por ser uno de los mejores compradores en la plataforma DECO. Tu continua preferencia y apoyo nos motivan a seguir brindándote el mejor servicio.</p>
            <p>Gracias por ser parte de nuestra comunidad y confiar en nosotros para tus compras. ¡Esperamos que disfrutes de tus productos y esperamos verte pronto en DECO!</p>
            <p>¡Sigue siendo un comprador increíble!</p>
            <p>Saludos,</p>
            <p>El equipo DECO</p>
            <img src="https://th.bing.com/th/id/OIG.kGQEozpKvQBxTxyUPBXZ?pid=ImgGn" alt="Imagen de felicitación">
        ';
            $mail->AltBody = 'FELICITACIONES';
           

            // Envía el correo
            $mail->send();
            echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            echo "No se pudo enviar el mensaje. Error del remitente: {$mail->ErrorInfo}";
        }
    }
    public function sendMailTicket($para, $mensaje)
    {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP de Gmail
           // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Desactiva la salida de depuración (puedes cambiarlo según tus necesidades)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Servidor SMTP de Gmail
            $mail->SMTPAuth   = true;
            $mail->Port       = 587; // Puerto SMTP de Gmail
            $mail->Username   = 'nikeschex@gmail.com'; // Tu dirección de correo de Gmail
            $mail->Password   = 'srlqxrgnqnblmida';  // Tu contraseña de Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilita el cifrado TLS

            // Configuración de los destinatarios y contenido del correo
            $mail->setFrom('nikeschex@gmail.com', 'NIKE CHEX'); // Tu dirección de correo y tu nombre
            $mail->addAddress($para); // Dirección de correo del destinatario y su nombre
            $mail->isHTML(true);
            $mail->Subject = 'TICKET';
            $mail->Body = $mensaje;
            $mail->AltBody = 'Comprobante de pago';
            // Envía el correo
            $mail->send();
            echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            echo "No se pudo enviar el mensaje. Error del remitente: {$mail->ErrorInfo}";
        }
    }
}

// Uso del método
//$mailer = new MailerService();
//$mailer->sendMail('deco14m@gmail.com', 'asdasdasdasdasd', 'dsasdasdas');