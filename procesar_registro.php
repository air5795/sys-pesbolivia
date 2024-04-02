<?php
include 'conexion.php'; // Incluye tu archivo de conexión a la base de datos

if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['rol'])){
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $clave = md5($_POST['clave']);
    $rol = $_POST['rol'];
    
    // Verificar si el usuario ya existe en la base de datos
    $query_verificar = "SELECT * FROM usuario WHERE usuario = '$usuario'";
    $result_verificar = mysqli_query($conexion, $query_verificar);
    if(mysqli_num_rows($result_verificar) > 0){
        echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
        exit; // Detiene la ejecución del script si el usuario ya existe
    }
    
    // Insertar el nuevo usuario en la base de datos
    $query_insertar = "INSERT INTO usuario (nombre, correo, usuario, clave, rol) VALUES ('$nombre', '$correo', '$usuario', '$clave', '$rol')";
    
    if(mysqli_query($conexion, $query_insertar)){
        echo "Registro exitoso"; // Esto será devuelto como respuesta AJAX
        exit; // Detiene la ejecución del script después de imprimir "Registro exitoso"
    } else{
        echo "Error al registrar el usuario: " . mysqli_error($conexion); // Esto será devuelto como respuesta AJAX en caso de error
        exit; // Detiene la ejecución del script después de imprimir el mensaje de error
    }
} else{
    echo "Todos los campos son obligatorios"; // Esto será devuelto como respuesta AJAX si no se reciben todos los datos necesarios
    exit; // Detiene la ejecución del script después de imprimir el mensaje de error
}
?>





