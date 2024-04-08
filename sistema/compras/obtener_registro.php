<?php

include("conexion.php");
include("funciones.php");

if (isset($_POST["id_compra"])) {
    $salida = array();
    $stmt = $conexion->prepare("SELECT * FROM compras WHERE id_compra = '".$_POST["id_compra"]."' LIMIT 1");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach($resultado as $fila){
        $salida["usuario"] = $fila["usuario"];
        $salida["correo"] = $fila["correo"];
        $salida["tipo"] = $fila["tipo"];
        $salida["estado"] = $fila["estado"];
        $salida["fecha"] = $fila["fecha"];
        

        /* FOTO */ 
        if ($fila["foto"] != "") {
            $salida["foto"] = '<img src="comprobantes/' . $fila["foto"] . '"  class="img-thumbnail" width="150" height="150" />
            <input type="hidden" name="img_o" value="'.$fila["foto"].'" />';
        }else{
            $salida["foto"] = '<div class="alert alert-danger" role="alert"> <input type="hidden" name="img_o" value="" /> <i class="bi bi-exclamation-octagon-fill"></i> Sin Foto</div>' ;
            //$salida["foto"] = '<input type="hidden" name="img_o" value="" />';
        }

       
        
        
    }

    echo json_encode($salida);
}