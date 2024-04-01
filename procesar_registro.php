<?php
include 'conexion.php'; // Incluye tu archivo de conexión a la base de datos

if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['rol'])){
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $clave = md5($_POST['clave']);
    $rol = $_POST['rol'];
    
    // Aquí deberías realizar la inserción en la base de datos
    // Por ejemplo:
    $query = "INSERT INTO usuario (nombre, correo, usuario, clave, rol) VALUES ('$nombre', '$correo', '$usuario', '$clave', '$rol')";
    
    if(mysqli_query($conexion, $query)){
        echo "Registro exitoso"; // Esto será devuelto como respuesta AJAX
    } else{
        echo "Error al registrar el usuario: " . mysqli_error($conexion); // Esto será devuelto como respuesta AJAX en caso de error
    }
} else{
    echo "Todos los campos son obligatorios"; // Esto será devuelto como respuesta AJAX si no se reciben todos los datos necesarios
}
?>
