<?php
include 'conexion.php'; // Incluye tu archivo de conexión a la base de datos
$email = "";

// Verificar si se recibieron los datos del formulario
if(isset($_POST['password']) && isset($_POST['confirm_password'])) {
    // Obtener los valores del formulario
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Verificar que las contraseñas coincidan
    if($password !== $confirm_password) {
        echo 'Las contraseñas no coinciden';
        exit; // Detener la ejecución del script
    }
    
    // Obtener el correo electrónico del usuario desde la URL
    $email = $_GET['email'];

    // Encriptar la nueva contraseña con MD5
    $hashed_password = md5($password);

    // Actualizar la contraseña encriptada del usuario en la base de datos
    $query = "UPDATE usuario SET clave = '$hashed_password' WHERE correo = '$email'";
    
    if(mysqli_query($conexion, $query)) {
        echo 'Contraseña restablecida correctamente';
    } else {
        echo 'Error al restablecer la contraseña: ' . mysqli_error($conexion);
    }
} else {
    echo 'Todos los campos son obligatorios';
}
?>
