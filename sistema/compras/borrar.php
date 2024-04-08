<?php
include('conexion.php');
include("funciones.php");

if (isset($_POST["id_compra"])) {
    $imagen = '';
    $imagen = obtener_nombre_imagen($_POST["id_compra"]);
    if ($imagen != '') {
        unlink("comprobantes/" . $imagen);
    }

    // Verificar el estado antes de eliminar
    $stmt_check = $conexion->prepare(
        "SELECT estado FROM compras WHERE id_compra = :id_compra"
    );
    $stmt_check->execute(
        array(
            ':id_compra' => $_POST["id_compra"]
        )
    );
    $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
    $estado = $row['estado'];

    if ($estado == 'en espera') {
        $stmt_delete = $conexion->prepare(
            "DELETE FROM compras WHERE id_compra = :id_compra and estado = 'en espera'"
        );
        $resultado = $stmt_delete->execute(
            array(
                ':id_compra' => $_POST["id_compra"]
            )
        );

        if ($resultado) {
            // La eliminación fue exitosa
            http_response_code(200); // Código 200 OK
            echo json_encode(array('message' => 'Registro borrado exitosamente.'));
        } else {
            // La eliminación falló por alguna razón
            http_response_code(500); // Código 500 Internal Server Error
            echo json_encode(array('message' => 'Error al intentar borrar el registro.'));
        }
    } else {
        // La eliminación no es posible (estado no es 'en espera')
        http_response_code(403); // Código 403 Forbidden
        echo json_encode(array('message' => 'No se puede cancelar la solicitud porque no está en estado "en espera".'));
    }
}
?>
