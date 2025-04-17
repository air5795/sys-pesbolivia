<?php
session_start();
include("conexion.php");
include("funciones.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

if (!isset($_SESSION['user'])) {
    echo 'Error: Sesión no iniciada.';
    exit;
}

$esAdmin = isset($_SESSION['rol']) && $_SESSION['rol'] == 1;

if ($_POST["operacion"] == "Crear") {
    $imagen = '';

    // Si no es administrador, la imagen es obligatoria
    if (!$esAdmin && empty($_FILES["foto"]["name"])) {
        echo 'Error: Debes subir una captura de comprobante de pago.';
        exit;
    }

    if (!empty($_FILES["foto"]["name"])) {
        $imagen = subir_imagen();
    }

    $stmt = $conexion->prepare("INSERT INTO compras(usuario, correo, tipo, foto, estado) VALUES(:usuario, :correo, :tipo, :foto, :estado)");
    $resultado = $stmt->execute([
        ':usuario' => $_POST["usuario"],
        ':correo' => $_POST["correo"],
        ':tipo' => $_POST["tipo"],
        ':foto' => $imagen,
        ':estado' => $esAdmin && !empty($_POST["estado"]) ? $_POST["estado"] : 'en espera'
    ]);

    if ($resultado) {
        echo 'Se registró correctamente.';
    } else {
        echo 'Error al insertar el registro en la base de datos.';
    }
}

if ($_POST["operacion"] == "Editar") {
    if (!$esAdmin) {
        echo 'Error: No tienes permisos para editar.';
        exit;
    }

    $params = [
        ':id_compra' => $_POST["id_compra"],
        ':estado' => $_POST["estado"],
        ':tipo' => $_POST["tipo"]
    ];

    $sql = "UPDATE compras SET estado=:estado, tipo=:tipo";
    if (!empty($_FILES["foto"]["name"])) {
        $params[':foto'] = subir_imagen();
        $sql .= ", foto=:foto";
    }
    $sql .= " WHERE id_compra = :id_compra";

    $stmt = $conexion->prepare($sql);
    $resultado = $stmt->execute($params);

    if ($resultado) {
        echo 'Éxito al editar.';
        if ($_POST["estado"] == "aprobado") {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.titan.email';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'airpatch@pesbolivia.airsoftbol.com';
                $mail->Password = '123456789Ale*';
                $mail->SMTPSecure = 'tls';
                $mail->setFrom('airpatch@pesbolivia.airsoftbol.com', 'PES Bolivia');
                $mail->addAddress($_POST["correo"]);
                $mail->Subject = 'Compra Exitosa! - PESBOLIVIA';
                $mail->Body = 'Gracias por tu compra! Se te dará acceso a la carpeta de Google Drive en este correo. toda atualizacion se subira a esta misma carpeta ';
                
                if ($mail->send()) {
                    echo 'Correo electrónico enviado correctamente.';
                } else {
                    echo 'Error al enviar el correo electrónico: ' . $mail->ErrorInfo;
                }
            } catch (Exception $e) {
                echo 'Error al enviar el correo electrónico: ' . $e->getMessage();
            }
        }
    } else {
        echo 'Error al actualizar el registro en la base de datos.';
    }
}