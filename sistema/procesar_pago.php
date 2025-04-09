<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

include "../conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $editor = $_POST['editor'];
    $monto = floatval($_POST['monto']);
    $metodo = $_POST['metodo'] ?? '';
    $nota = $_POST['nota'] ?? '';

    // Insertar el pago en la tabla
    $query = "INSERT INTO pagos (nombre, monto_pagado, metodo_pago, nota) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sdss", $editor, $monto, $metodo, $nota);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?success=Pago registrado correctamente");
    } else {
        header("Location: index.php?error=Error al registrar el pago");
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    exit;
}
?>