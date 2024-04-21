<?php



include("conexion.php");
include("funciones.php");

/* require_once 'C:/xampp/htdocs/sys-pesbolivia/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once 'C:/xampp/htdocs/sys-pesbolivia/vendor/phpmailer/phpmailer/src/SMTP.php';
require_once 'C:/xampp/htdocs/sys-pesbolivia/vendor/phpmailer/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer; */

// Incluir PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

// Crear una nueva instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configurar el servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.titan.email';  // Cambia 'smtp.tudominio.com' por tu servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'airpatch@pesbolivia.airsoftbol.com';  // Cambia 'tu_correo@tudominio.com' por tu correo electrónico
    $mail->Password = '123456789Ale*';  // Cambia 'tu_contraseña' por tu contraseña de correo electrónico
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;  // Puerto SMTP

    // Destinatario del correo electrónico
    $mail->setFrom('airpatch@pesbolivia.airsoftbol.com', 'pesbolivia');  // Cambia 'tu_correo@tudominio.com' y 'Tu Nombre' por tu correo electrónico y tu nombre
    $mail->addAddress('ale.empresa2@gmail.com');  // Correo electrónico de destino

    // Contenido del correo electrónico
    $mail->isHTML(true);
    $mail->Subject = 'Nueva solicitud de compra';
    $mail->Body    = 'Se ha registrado una nueva solicitud de compra verifica en el sistema.';

    // Enviar el correo electrónico
    $mail->send();
    echo 'Correo enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
}
?>
