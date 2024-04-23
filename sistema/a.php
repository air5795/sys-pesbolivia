<?php
// Función para desencriptar MD5 utilizando un diccionario
function desencriptarMD5($hash, $diccionario) {
    foreach ($diccionario as $palabra) {
        if (md5($palabra) === $hash) {
            return $palabra;
        }
    }
    return false; // Si no se encuentra ninguna coincidencia
}

// Cadena MD5 a desencriptar
$md5_a_desencriptar = "f48b0076d0fc59aea3118fdecf2879db";

// Diccionario de contraseñas
$diccionario = array(
    "contraseña1",
    "123456",
    "password",
    "qwerty",
    // Agrega más palabras según sea necesario
);

// Intentar desencriptar
$resultado = desencriptarMD5($md5_a_desencriptar, $diccionario);

if ($resultado !== false) {
    echo "La cadena original es: " . $resultado;
} else {
    echo "No se pudo encontrar la cadena original en el diccionario.";
}
?>
