<?php
    
    include "../conexion.php"; 

// Consulta para obtener la cantidad de compras por mes y por tipo de compra
$sql = "SELECT MONTH(fecha) AS mes, YEAR(fecha) AS año, tipo, COUNT(*) AS cantidad
        FROM compras
        GROUP BY YEAR(fecha), MONTH(fecha), tipo
        ORDER BY YEAR(fecha), MONTH(fecha), tipo";

$result = $conexion->query($sql);

// Array para almacenar los datos
$data = array();

if ($result->num_rows > 0) {
    // Guardar los resultados en el array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Cerrar conexión
$conexion->close();

// Retornar los datos en formato JSON
echo json_encode($data);

?>