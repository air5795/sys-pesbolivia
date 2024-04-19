<?php
// Incluir PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Configurar PHPMailer
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.titan.email'; // Cambiar según tu servidor SMTP
$mail->SMTPAuth = true;
$mail->Username = 'airpatch@pesbolivia.airsoftbol.com'; // Cambiar por tu dirección de correo electrónico
$mail->Password = '123456789Ale*'; // Cambiar por tu contraseña de correo electrónico
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('airpatch@pesbolivia.airsoftbol.com', 'pesbolivia'); // Cambiar por tu dirección de correo electrónico y tu nombre

// Procesar el formulario de recuperación de contraseña
if(isset($_POST['email'])){
    $email = $_POST['email'];
    
    // Aquí puedes incluir la lógica para validar el correo electrónico y verificar si existe en tu base de datos
    
    // Generar un token único para restablecer la contraseña
    $token = bin2hex(random_bytes(32)); // Genera un token de 64 caracteres hexadecimal
    
    // Aquí deberías guardar el token en tu base de datos junto con la dirección de correo electrónico
    
    // Enviar correo de recuperación de contraseña
    try {
        // Configurar destinatario y contenido del correo
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Recuperacion de Clave de Acceso';

        // Obtener la URL base del sitio web (localhost)
        $base_url = 'https://pesbolivia.airsoftbol.com';

        // Componer la URL completa para la página de restablecimiento
        $reset_url = $base_url . '/restablecer.php?email=' . urlencode($email) . '&token=' . $token;

        // Configurar el contenido del correo electrónico con el enlace de restablecimiento de contraseña
        $mail->Body = 'Haz clic en el siguiente enlace para restablecer tu contraseña: <a href="' . $reset_url . '">Restablecer Contraseña</a>';

        
        // Enviar correo
        $mail->send();
        echo 'Correo de recuperación enviado correctamente';
    } catch (Exception $e) {
        echo 'Error al enviar el correo de recuperación: ', $mail->ErrorInfo;
    }
} else {
    echo 'El campo de correo electrónico está vacío';
}
?>
