<?php

session_start();


date_default_timezone_set('America/La_Paz');
include("conexion.php");
include("funciones.php");

    
    $usuario_session = $_SESSION['user'];
  

    setlocale(LC_TIME, "spanish");
    $fecha = date("Y-m-d");


if ($_SESSION['rol'] == 1) {
    
    // Consulta SQL para obtener los datos del usuario
    $query = "SELECT * FROM compras ";

    if (isset($_POST["search"]["value"])) {
        $query .= 'WHERE usuario LIKE "%' . $_POST["search"]["value"] . '%" ';
     }
 
     if (isset($_POST["order"])) {
         $query .= 'ORDER BY ' . $_POST['order']['0']['column'] .' '.$_POST["order"][0]['dir'] . '';        
     }else{
         $query .= 'ORDER BY id_compra DESC ';
     }
 
     if($_POST["length"] != -1){
         $query .= 'LIMIT ' . $_POST["start"] . ','. $_POST["length"];
     }

    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll();


    $datos = array();
    $filtered_rows = $stmt->rowCount();
    foreach($resultado as $fila){
       

        $imagen = '';
        if($fila["foto"] != '' ){
            /* $imagen = '<img class="gallery-item " src="comprobantes/'.$fila['foto'].'" height="50px" width="30px"   id="comprobantes/'.$fila['foto'].'">'; */
            $imagen = '<a style="font-size:12px;background-color:#4b4b4b;text-align: left; color:white; text-align:center" class="btn  w-100 gallery-item" id="comprobantes/'.$fila['foto'].'"> <i class="fa-solid fa-eye"></i> Ver Comprobante  </a>';
            //$image = '<a class="btn btn-outline-primary btn-sm gallery-item boton-w"  id="actas/'.$fila['image'].'"><i class="fa-solid fa-image"></i> </a>';
        }else{
            $imagen = '<a class="btn btn-outline-secondary btn-sm gallery-item boton-w disabled" id=""><i class="fa-solid fa-ban"></i> </a>';
        }

        if ($fila['estado'] == 'en espera') {
            $estado = '<span style="font-size:12px;background-color:#fff37a;text-align: left; color:black; text-align:center" class="btn  w-100"><i class="bi bi-exclamation-circle"></i> EN ESPERA </span>'.'<br/>';
        } if ($fila['estado'] == 'aprobado') {
            $estado = '<span style="font-size:12px;background-color:#cbff9a;text-align: left; color:#5a5a5a;text-align:center" class="btn  w-100"><i class="bi bi-check"></i> COMPRA APROBADA </span>'.'<br/>';
        } if ($fila['estado'] == 'rechazado') {
            $estado = '<span style="font-size:12px;background-color:#c11414;text-align: left; color:#f9f9f9;text-align:center" class="btn  w-100"><i class="bi bi-ban"></i> SOLICITUD RECHAZADA </span>'.'<br/>';
        } if ($fila['estado'] == 'regalo') {
            $estado = '<span style="font-size:12px;background-color:#673ca3;text-align: left; color:#f9f9f9;text-align:center" class="btn  w-100"><i class="bi bi-gift"></i> REGALO </span>'.'<br/>';
        }

        if ($fila['tipo'] == 'COMPUTADORA') {
            $tipo = '<span style="font-size:12px;background-color:#212529;text-align: left; color:white;text-align:center" class="btn  w-100"> COMPUTADORA</span>'.'<br/>';
        } else {
            $tipo= '<span style="font-size:12px;background-color:#143885;text-align: left; color:white;text-align:center" class="btn  w-100"> PS4/PS5 </span>'.'<br/>';
        }


        $compra =  '<span style="font-size:12px;background-color:#1e953c;text-align: left; color:white;text-align:center" class="btn  w-100">COMPRA COD-00'.$fila["id_compra"].' </span>'.'<br/>';
        $person =  '<span style="font-size:12px;background-color:white;text-align: left; color:black;text-align:center;user-select: text;border-bottom: 1px solid #28c750" class="btn  w-100"> '.$fila["usuario"].' </span>'.'<br/>';
        $corre = '<span style="font-size:12px;background-color:white;text-align: left; color:black;text-align:center; user-select: text;border-bottom: 1px solid #28c750" class="btn  w-100"> '.$fila["correo"].' </span>'.'<br/>';
        $fech = '<span style="font-size:12px;background-color:white;text-align: left; color:black;text-align:center; user-select: text;border-bottom: 1px solid #28c750" class="btn  w-100"> '.$fila["fecha"].' </span>'.'<br/>';

       



        $sub_array = array();
        $sub_array[] = $compra;
        $sub_array[] = $tipo;
        $sub_array[] = $person;
        $sub_array[] = $corre;
        
        
        $sub_array[] = $fech;
        $sub_array[] = $imagen;
        $sub_array[] = $estado;
       /*  $sub_array[] = $ficha;
        $sub_array[] = $certificado; */
        $sub_array[] = '<button type="button" name="editar" id="'.$fila["id_compra"].'" class="btn btn-warning btn-sm boton-w  editar" style="background-color: #fbe806;color: #505050; color:#767676;"><i class="fa-solid fa-pencil"></i> Editar </button>';
        
        $datos[] = $sub_array;
    }

    $salida = array(
        "draw"               => intval($_POST["draw"]),
        "recordsTotal"       => $filtered_rows,
        "recordsFiltered"    => obtener_todos_registros(),
        "data"               => $datos
    );

    echo json_encode($salida);
    
} else {
    // Consulta SQL para obtener los datos del usuario
    $query = "SELECT * FROM compras WHERE usuario = :usuario";

    if (isset($_POST["order"])) {
        $query .= ' ORDER BY ' . $_POST['order']['0']['column'] .' '.$_POST["order"][0]['dir'];
    } else {
        $query .= ' ORDER BY id_compra DESC ';
    }

    if($_POST["length"] != -1){
        $query .= ' LIMIT ' . $_POST["start"] . ','. $_POST["length"];
    }

    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':usuario', $usuario_session);

    $stmt->execute();
    $resultado = $stmt->fetchAll();


    $datos = array();
    $filtered_rows = $stmt->rowCount();
    foreach($resultado as $fila){
       

        $imagen = '';
        if($fila["foto"] != '' ){
            $imagen = '<img class="gallery-item boton-w" src="comprobantes/'.$fila['foto'].'" height="70px"   id="comprobantes/'.$fila['foto'].'">';
            //$image = '<a class="btn btn-outline-primary btn-sm gallery-item boton-w"  id="actas/'.$fila['image'].'"><i class="fa-solid fa-image"></i> </a>';
        }else{
            $imagen = '<a class="btn btn-outline-secondary btn-sm gallery-item boton-w disabled" id=""><i class="fa-solid fa-ban"></i> </a>';
        }

        if ($fila['estado'] == 'en espera') {
            $estado = '<div class="card p-0 m-0" style="text-align:center">
            <div class="card-header bg-warning text-black p-0">
                <h5 class="card-title m-0"> Estado de la compra : En espera</h5>
            </div>
            <div class="card-body p-0">
                <div class="alert alert-warning m-0" role="alert" >
                      (Se le avisara a su correo  : '.$fila["correo"].' cuando este Aprobado) 
                    
                </div>
            </div>
            
        </div>';
        } else {
            $estado = '<div class="card p-0 m-0" style="text-align:center">
              <div class="card-header bg-success text-white p-0">
                  <h5 class="card-title m-0">Estado de la compra :  Aprobado</h5>
              </div>
              <div class="card-body p-0">
                  <div class="alert alert-success m-0" role="alert" >
                      <i class="bi bi-check"></i>  (REVISE SU CORREO: '.$fila["correo"].') 
                  </div>
              </div>
              
          </div>';


        }

        if ($fila['tipo'] == 'COMPUTADORA') {
            $tipo= '<div class="card p-0 m-0" style="text-align:center">
            <div class="card-header bg-secondary text-white p-0">
                <h5 class="card-title m-0">Plataforma : COMPUTADORA </h5>
            </div>
            <div class="card-body p-0">
                <div class="alert alert-secondary m-0" role="alert" >
                    PARCHE AIRPATCH 2024
                </div>
            </div>
            
        </div>';
        } else {
            $tipo= '<div class="card p-0 m-0" style="text-align:center">
            <div class="card-header bg-secondary text-white p-0">
                <h5 class="card-title m-0">Plataforma : PLAYSTATION </h5>
            </div>
            <div class="card-body p-0">
                <div class="alert alert-secondary m-0" role="alert" >
                    OPTION FILE AIRPATCH 2024
                </div>
            </div>
            
        </div>';
        }

        $fec = '<span style="font-size:12px;background-color:white;text-align: left; color:black;text-align:center; user-select: text;border-bottom: 1px solid #28c750" class="btn  w-100"> Solicitud: '.$fila["fecha"].' </span>'.'<br/>';
       



        $sub_array = array();
        
        
        $sub_array[] = $fec;
        $sub_array[] = $tipo;
        
        
        
        $sub_array[] = $estado;
       /*  $sub_array[] = $ficha;
        $sub_array[] = $certificado; */


       

        $sub_array[] = '<button type="button" name="borrar" id="'.$fila["id_compra"].'" class="btn btn-warning btn-sm boton-w  borrar" style="background-color: #ff6060;color: white; border:none;"><i class="bi bi-trash"></i>  </button>';
       
        $datos[] = $sub_array;
    }

    $salida = array(
        "draw"               => intval($_POST["draw"]),
        "recordsTotal"       => $filtered_rows,
        "recordsFiltered"    => obtener_todos_registros(),
        "data"               => $datos
    );

    echo json_encode($salida);
    
}



    