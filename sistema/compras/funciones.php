<?php

    function subir_imagen(){
        if (isset($_FILES["foto"])) {
            
            $extension = explode('.', $_FILES["foto"]['name']);
            $nuevo_nombre = 'Comprobante-'.date('d-m-y').'-'.rand() . '.' . $extension[1];
            $ubicacion = './comprobantes/' . $nuevo_nombre;
            move_uploaded_file($_FILES["foto"]['tmp_name'], $ubicacion);
            return $nuevo_nombre;
        }
    }


    function obtener_nombre_imagen($id_compra){
        include('conexion.php');
        $stmt = $conexion->prepare("SELECT foto FROM compras WHERE id_compra = '$id_compra'");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        foreach($resultado as $fila){
            return $fila["foto"];
        }
    }



    function obtener_todos_registros(){
        include('conexion.php');
        $stmt = $conexion->prepare("SELECT * FROM compras");
        $stmt->execute();
        $resultado = $stmt->fetchAll(); 
        return $stmt->rowCount();       
    }

 


    
    