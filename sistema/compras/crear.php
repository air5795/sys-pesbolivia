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



if ($_POST["operacion"] == "Crear") {
    $imagen = '';
    /* $ficha = '';
    $certificado = ''; */
    if ($_FILES["foto"]["name"] != '') {
        $imagen = subir_imagen();
    }
   /*  if ($_FILES["ficha"]["name"] != '') {
        $ficha = subir_ficha();
    }
    if ($_FILES["certificado"]["name"] != '') {
        $certificado = subir_certificado();
    } */
    $stmt = $conexion->prepare("INSERT INTO compras(usuario, correo, tipo,foto)
                                VALUES(:usuario, :correo, :tipo, :foto )");

    $resultado = $stmt->execute(
        array(
            ':usuario'           => $_POST["usuario"],
            ':correo'            => $_POST["correo"],
            ':tipo'           => $_POST["tipo"],
            ':foto'             => $imagen
        )
    );

    if (!empty($resultado)) {
        echo 'Se registro Correctamente.';
    } else {
        echo 'Error al insertar el registro en la base de datos.';
    }
}



	$correo = $_POST["email"];




if ($_POST["operacion"] == "Editar") {
    $stmt = $conexion->prepare("UPDATE compras SET estado=:estado, tipo=:tipo WHERE id_compra = :id_compra");

    $resultado = $stmt->execute(
        array(
            ':id_compra' => $_POST["id_compra"],
            ':estado'    => $_POST["estado"],
            ':tipo'      => $_POST["tipo"]
        )
    );

    if (!empty($resultado)) {
        echo 'exito editado.';

        
        // Verifica si el estado ha cambiado a "Enviado" y envía un correo electrónico
        if ($_POST["estado"] == "aprobado") {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.titan.email';
            $mail->Port = 587; // Puedes cambiarlo según la configuración de tu servidor
            $mail->SMTPAuth = true;
            $mail->Username = 'airpatch@pesbolivia.airsoftbol.com';
            $mail->Password = '123456789Ale*';
            $mail->SMTPSecure = 'tls';
            $mail->setFrom('airpatch@pesbolivia.airsoftbol.com', 'pesbolivia');
            
            $mail->addAddress($correo); // Agrega el destinatario del correo electrónico
            $mail->Subject = 'Compra Exitosa ! - PESBOLIVIA ';
            $mail->Body = 'Este es el link de ACCESO Descarga y disfruta ';
            
            if (!$mail->send()) {
                echo 'Error al enviar el correo electrónico: ' . $mail->ErrorInfo;
            } else {
                echo 'Correo electrónico enviado correctamente.';
            }
        }
    } else {
        echo 'Error al actualizar el registro en la base de datos.';
    }
}