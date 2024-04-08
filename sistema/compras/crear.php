<?php

include("conexion.php");
include("funciones.php");



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



	




if ($_POST["operacion"] == "Editar") {
    
    $stmt = $conexion->prepare("UPDATE compras SET estado=:estado, tipo=:tipo WHERE id_compra = :id_compra");

    $resultado = $stmt->execute(
        array(
            ':id_compra'      => $_POST["id_compra"],
            ':estado'           => $_POST["estado"],
            ':tipo'           => $_POST["tipo"]
            

        )

        

        
    );

    if (!empty($resultado)) {

        echo 'exito editado.';
        
    } else {
        echo 'Error al actualizar el registro en la base de datos.';
    }
}