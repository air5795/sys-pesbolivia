<?php
    
    session_start();
    include "../../conexion.php";

    // Verifica si el rol del usuario es 1
if ($_SESSION['rol'] == 1) {
    $habilitado = true;
} else {
    $habilitado = false;
}
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        
        <link rel="stylesheet" href="css/estilos3.css">
        <link rel="stylesheet" href="css/estilos2.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

        

        <link rel="shortcut icon" href="../img/ICONO.png">
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PONCELET</title>

        <style>
    /* Personaliza el tamaño del modal solo para el modal específico */
    .modal-custom .modal-dialog {
        max-width: 90%;
        margin: 1.75rem auto;
    }

    .table-responsive {
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

/* Cambia la orientación de la tabla para que los datos se muestren en vertical */
@media screen and (max-width: 600px) {
  table, thead, tbody, th, td, tr {
    display: block;
  }

  th {
    display: none; /* Oculta los encabezados */
  }

  /* Estilos adicionales para mejorar la visualización en vertical */
  td {
    border: none;
    position: relative;
  }

  td:before {
    position: absolute;
    top: 6px;
    left: 6px;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap;
  }

 
}
</style>

        


        
    </head>
    <body class="sb-nav-fixed">
    <?php include "../menu.php"?>
    

        <!-- contenido del sistema-->

        <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid ">
                    <div class="container-fluid  ">
                    
                     
                        <br>
                        
<!-- contenido del sistema 2--> 

<!-- Contenedor tabla--> 

<div class="container-fluid  fondo ">    






                        <?php
                        
                            if ($_SESSION['rol'] != '1') {
                                
                        ?>



                        

        <div class="row" style="font-size: small;">
            <div class="col-sm-12">
            
            <div class="card">
            <h5 class="card-header">Pasos para realizar la compra !</h5>
            <div class="card-body">
            

            <ol>
                <li>- Dar al boton Efectuar Pago</li>
                <li>- Te saldra las formas de pago (Transferencia Bancaria , Tigo Money o QR) </li>
                <li>- Realiza el pago y guarda tu comprobante (foto o captura de pantalla)</li>
                <li>- Dar al Boton Solicitar Compra</li>
                <li>- Coloca si quieres para (COMPUTADORA) O (PS4/PS5) y carga tu comprobante</li>
                <li>- Envia Tu Solicitud (Esto puede demorar  30 min hasta 45 min o ser inmediato , para ser aprobado) </li>
                <li>- Una ves aprobado te llegara un correo de Compra Exitosa ! que confirmara que se aprobo su solicitud. </li>
                <li>- Inmediatamente se te dara acceso al correo. para la posterior descarga del parche o Option file </li>
                <li>- Si durante el tiempo esperado no cambio el estado y sigue (en espera),  comunicate por mensaje al numero 79441119 (por whatssap - Alejandro ) </li>
            </ol>
            </div>
            </div>

            

            </div>
            

        </div>

                        <?php
                            }
                                
                        ?>


<hr>
        <div class="row">
            <div class="col-sm-8">
                <h2><i class="fa-solid fa-database"></i> COMPRAS - PES BOLIVIA </h2>
            </div>

            <div class="col-sm-2 ">
                
                <div class="text-center">
                    <!-- Button trigger modal -->
                        <button style="background-color: #28c750;border: none;"type="button" class="btn btn-success  w-100" data-bs-toggle="modal" data-bs-target="#modalpagar" id="boton">
                        <i class="bi bi-cash"></i> Efectuar Pago
                        </button>
                        
                </div>
            </div>


            <div class="col-sm-2 ">
                
                <div class="text-center">
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success  w-100" data-bs-toggle="modal" data-bs-target="#modalproductos" id="botonCrear">
                        <i class="bi bi-box-seam"></i> Solicitar Compra
                        </button>
                        
                </div>
            </div>
            
            
        </div>

        




        
        <hr style="background-color: green;">

        <div class="table-responsive" style="font-size: 11px; width:100%">
            <table id="datos_usuario" class="table table-hover" style="width:100%;text-align:center" cellpadding="0" >
                <thead>
                    <tr>
                        <?php
                            if ($_SESSION['rol'] == '1') {
                                
                        ?>
                        <th>COD-COMPRA</th>
                        <th>USUARIO</th>
                        <th>CORREO</th>
                        <th>TIPO</th>
                        <th>FECHA DE SOLICITUD</th>
                        <th width="5px">COMPROBANTE</th>
                        <th>ESTADO</th>
                        <th></th>
                        


                        <?php
                                
                            } else {


                        ?>

                        <th >FECHA DE SOLICITUD</th>
                        <th >TIPO DE PEDIDO</th>
                        
                        <th>ESTADO</th>
                        <th></th>

                        <?php
                                
                            } 


                        ?>
                        

                    </tr>
                </thead>
            </table>
        </div>
    </div>

<!-- FINAL tabla--> 

<!-- Modal NUEVO -->
<div class="modal fade" id="modalproductos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-box"></i> SOLICITUD DE COMPRA</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: azure;"></button>
            </div>
            
                <form action="" method="POST" id="formulario" enctype="multipart/form-data">
                    
                    <div class="modal-content">

                    <div class="modal-body">

                    

                 
                    <div class="row">


                       
                
                        <div class="col-sm-12">
                            <label for="tipo" style="font-family: sans-serif;">Elija la Plataforma  <span style="color:red"> *</span></label>
                            <select name="tipo" id="tipo" class="form-control form-control-sm">
                                <option value="">Selecciona una Opcion</option>
                                <option value="COMPUTADORA">Computadora Airpatch 2024</option>
                                <option value="PS4/PS5">PS4/PS5 Option File 2024</option>
                            </select>
                        </div>

                        <div class="col-sm-12">
                            <label for="estado" style="font-family: sans-serif;">Estado <span style="color:red"> *</span></label>
                            <select name="estado" id="estado" class="form-control form-control-sm">
                                <option value="">Selecciona un Estado</option>
                                <option value="en espera">en espera</option>
                                <option value="aprobado">Aprobado</option>
                            </select>
                        </div>
                                                

                        <div class="col-sm-12">
                            <label for="foto" style="font-family: sans-serif;">Ingrese Foto o captura de comprobante de pago </label>
                            <input type="file" class="form-control form-control-sm" name="foto" id="foto">
                        </div>
                        <div class="col-sm-12">
                            <span id="imagen-subida"></span>
                        </div>

                        
                            <input type="hidden" name="usuario" id="usuario" class="form-control form-control-sm" value="<?php echo $_SESSION['user'] ?>">
                            <input type="hidden" name="correo" id="correo" class="form-control form-control-sm" value="<?php echo $_SESSION['correo'] ?>">

                            <input type="hidden" name="email" id="email" class="form-control form-control-sm">
                            
                            
                        
 

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_compra" id="id_compra">
                        <input type="hidden" name="operacion" id="operacion">

                        
                        <input type="submit" name="action" id="action" class="btn btn-success" value="Registrar">
                        
                    </div>
                    </div>
                    </div>
                </form>
            </div>


            
        </div>



        </div>

        <!-- Modal NUEVO -->
<div class="modal fade modal-custom" id="modalpagar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content" style="border-radius: 30px;" >
            <div class="modal-header" style="text-align:center">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;border-radius:30px;background-color: crimson;"></button>
            </div>
            
                
                    
                    

                    <div class="modal-body" style="margin: 10px; text-align:center;">

                    <h5>FORMAS DE PAGO</h5> <hr>
                    <p> Elegir el metodo de pago (Transferencia, QR , Paypal , Tigo Money) </p>
                    <p style="background-color: #198754;color: white;"> Cada Metodo de pago tiene un precio diferente por las comisiones de la plataforma, revisar </p>

                    

                 
                    <div class="row">

                    
                       
                
                        <div class="col-sm-4" style="color: #6e6e6e;">

                        
                       

                        

                            <div class="row" style="background-color: #000469;color: white;padding: 10px;border-radius: 15px;font-size:small;margin-right:1px; ">
                                <div class="col-sm-6">
                                    <h6 style="background-color: orangered;color:white;padding:10px;border-radius: 15px;text-align: center;">TRANFERENCIA BANCARIA  </h6>
                                    <p style="margin-top:0; margin-bottom:0;" >Banco :  <strong> Banco de Credito (BCP) </strong></p>
                                    <p style="margin-top:0; margin-bottom:0;" >Numero de Cuenta :  <strong> 20151776129301 </strong></p>
                                    <p style="margin-top:0; margin-bottom:0;" >Nombre : Alejandro Iglesias Raldes</p>
                                    <p style="margin-top:0; margin-bottom:0;" >Cuenta : Cuenta Ahorro</p>
                                    <p style="margin-top:0; margin-bottom:0;" >CI : 10478330</p>

                                    <hr>
                                    <a href="" class="btn btn-secondary disabled w-100"> 50/Bs (PC) </a> 
                                    <hr>
                                    <a href="" class="btn btn-secondary disabled w-100">40/Bs (Ps4/Ps5)</a>
                                    <hr>
                                </div>
                                <div class="col-sm-6">
                                    <h6 style="background-color: orangered;color:white;padding:10px;border-radius: 15px;text-align: center;">PAGO QR  </h6>
                                    <img src="../img/qr.jpeg" alt="" style="width: 100%;">
                                    <a href="../img/qr.jpeg"  class="btn btn-primary w-100" download="QR.jpeg" style="padding:5px;font-size:14px;background-color: orangered;color: white;border: none;border-radius: 5px 5px 25px 25px;"">Descargar QR  </a>
                                </div>
                            

                            
                            </div>

                        </div>
                        

                        <div class="col-sm-4" style="color: #6e6e6e;">

                        <div class="row" style="background-color: #fcc10f;color: #00377c;padding: 10px;border-radius: 15px;font-size:small;margin-right:1px;">
                                <div class="col-sm-6">
                                    <h6 style="background-color: #00377c;color:white;padding:10px;border-radius: 15px;text-align: center;">TIGO MONEY  </h6>
                                    <p style="margin-top:0; margin-bottom:0;" >CELULAR :  <strong> 69644019 </strong></p>
                                    <p style="margin-top:0; margin-bottom:0;" >se cobra en tigo money un adicional de 2bs por la comision de tigo </p>
                                    

                                    <hr>
                                    <a href="" class="btn btn-dark disabled w-100"> 52/Bs (PC) </a> 
                                    <hr>
                                    <a href="" class="btn btn-dark disabled w-100">42/Bs (Ps4/Ps5)</a>
                                    <hr>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <h6 style="background-color: #00377c;color:white;padding:10px;border-radius: 15px;text-align: center;">PAGO QR  </h6>
                                    <img src="../img/qr2.png" alt="" style="width: 100%;">
                                    <a href="../img/qr2.png"  class="btn btn-primary w-100" download="QR.jpeg" style="padding:5px;font-size:14px;background-color: #00377c;color: white;border: none;border-radius: 5px 5px 25px 25px;"">Descargar QR  </a>
                                </div>
                            

                            
                            </div>

                        
                            
                        </div>
                        

                        <div class="col-sm-4" style="color: #6e6e6e;">

                        <div class="row" style="background-color: #ababab;color: #00377c;padding: 10px;border-radius: 15px;font-size:small;margin-right:1px; ">
                                <div class="col-sm-6">
                                    <h6 style="background-color: #00377c;color:white;padding:10px;border-radius: 15px;text-align: center;">PAYPAL  </h6>
                                    <p style="margin-top:0; margin-bottom:0;" >se cobra en Paypal el precio de 9$ por la comision de la plataforma </p>
                                    <script src="https://www.paypal.com/sdk/js?client-id=BAAbR13ioh5lH0_IoB5k5Zm8u19Pu6bmZK6DXTfH_VCiKFjGDV7D3jvYJftd6kxz2DSi3V-akfQ1GG-AVg&components=hosted-buttons&disable-funding=venmo&currency=USD"></script>
                                    <div id="paypal-container-CJ5BYW4EHBDTC"></div>
                                    <script>
                                    paypal.HostedButtons({
                                        hostedButtonId: "CJ5BYW4EHBDTC",
                                    }).render("#paypal-container-CJ5BYW4EHBDTC")
                                    </script>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <h6 style="background-color: #00377c;color:white;padding:10px;border-radius: 15px;text-align: center;">PAGO QR  </h6>
                                    <img src="../img/qr3.png" alt="" style="width: 100%;">
                                    <a href="../img/qr3.png"  class="btn btn-primary w-100" download="QR.jpeg" style="padding:5px;font-size:14px;background-color: #00377c;color: white;border: none;border-radius: 5px 5px 25px 25px;"">Descargar QR  </a>
                                </div>
                            

                            
                            </div>

                        
                            
                        </div>

                        
                                                
                        


                    </div>
                   
                    </div>
                 
                
            </div>


            
        </div>



        </div>





</div>

<!-- FINAL MODAL -->
<!-- Modal para  ver imagenes -->

                <div class="modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered ">
                        <div class="modal-content modal-fullscreen ">
                            <div class="modal-header">
                                <!--<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="img/actas/acta_103_1_2021-02-22.jpg" class="modal-img" alt="modal img" width="100%" height="100%">
                            </div>

                        </div>
                    </div>
                </div>
<!-- FINAL Modal para  ver imagenes -->
                

<!-- FINAL CONTENIDO--> 
                
            </div>
        </div>

    </main>

</div>

        

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" ></script>
        
        <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

    


        <script>

            window.addEventListener('DOMContentLoaded', event => {
            // Toggle the side navigation
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                // Uncomment Below to persist sidebar toggle between refreshes
                // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                //     document.body.classList.toggle('sb-sidenav-toggled');
                // }
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
                });
            }

            });
        </script>

<script type="text/javascript">
                $(document).ready(function(){
                $("#botonCrear").click(function(){
                $("#formulario")[0].reset();
                $(".modal-title").text("COMPRAS");
                $("#action").val("Solicitar Compra");
                $("#operacion").val("Crear");
                $('#estado').closest('.col-sm-12').hide(); // Ocultar el campo "estado"
                $('#foto').closest('.col-sm-12').show();
                $('#imagen-subida').html("");
                /* $('#pdf-subido').html("");
                $('#certificado-subido').html(""); */
                $("#foto").html("");
                /* $("#ficha").html("");
                $("#certificado").html(""); */
                // Llamada a la función al cargar la página para inicializar las opciones del select
                reloadCategoriaSelect();

                
            });

            var habilitarFunciones = <?php echo ($_SESSION['rol'] != 1) ? 'true' : 'false'; ?>;

            if (habilitarFunciones) {
        dataTableactivo = $('#datos_usuario').DataTable({
            
            
                
                "paging": false,
                "info": false,
                "searching": false,
                "pageLength": 10,
                "processing":true,
                "serverSide":true,
                "order":[],
                "ajax":{
                    url: "obtener_registros.php",
                    type: "POST"
                },
                "columnsDefs":[
                    {
                    "targets":[0, 3, 4],
                    "orderable":false,
                    },
                    
                ],
                "language": {
                    
                "decimal": "",
                "emptyTable": "No hay Compras",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
            });

            } else{
                dataTableactivo = $('#datos_usuario').DataTable({
            
            
                
            "paging": true,
            "info": true,
            "searching": true,
            "pageLength": 10,
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                url: "obtener_registros.php",
                type: "POST"
            },
            "columnsDefs":[
                {
                "targets":[0, 3, 4],
                "orderable":false,
                },
                
            ],
            "language": {
                
            "decimal": "",
            "emptyTable": "No hay Compras",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
        });

            }

            

            

                


            
            
            //Aquí código inserción
            $(document).on('submit', '#formulario', function(event){
            event.preventDefault();
            var usuario = $('#usuario').val();
            var correo = $('#tipo').val();
            var tipo = $('#tipo').val();
            /* var estado = $('#estado').val(); */
            
            var extension = $('#foto').val().split('.').pop().toLowerCase();
            /* var extension2 = $('#ficha').val().split('.').pop().toLowerCase();
            var extension3 = $('#certificado').val().split('.').pop().toLowerCase(); */
            if(extension != '')
            {
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
                {
                    alert("Fomato de imagen inválido");
                    $('#foto').val('');
                    return false;
                }
            }

           
            	
		    if(usuario != '' && correo != '' && tipo != '')
                {
                    $.ajax({
                        url:"crear.php",
                        method:'POST',
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data)
                        {
                            Swal.fire(
                            'Exitoso!',
                            'Se registro correctamente',
                            'success'
                            ),
                            $('#formulario')[0].reset();
                            $('#modalproductos').modal('hide');
                            dataTableactivo.ajax.reload();
                            reloadCategoriaSelect();
                        }
                    });
                }
                else
                {
                    Swal.fire(
                    'Algunos Campos son Obligatorios ?',
                    'Revisa el formulario',
                    'warning'
                    );
                }
	        });


            //Funcionalidad de editar
$(document).on('click', '.editar', function(){     
    var id_compra = $(this).attr("id");     
    // Mostrar el elemento de carga
    $('#cargando').show();
    $.ajax({
        url:"obtener_registro.php",
        method:"POST",
        data:{id_compra:id_compra},
        dataType:"json",
        success:function(data) {
            // Ocultar el elemento de carga
            $('#cargando').hide();
            $('#modalproductos').modal('show');
            $('#estado').closest('.col-sm-12').show(); // Ocultar el campo "estado"
            $('#foto').closest('.col-sm-12').hide();

            $('#estado').val(data.estado);
            $('#tipo').val(data.tipo);
            $('#email').val(data.correo);

            $('#id_compra').val(id_compra);

            $('.modal-title2').text("Editar compra");
            $('#action').val("Editar compra");
            $('#operacion').val("Editar");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            // Ocultar el elemento de carga en caso de error
            $('#cargando').hide();
        }
    });
});


            //Funcionalidad de borrar
            $(document).on('click', '.borrar', function(){
    var id_compra = $(this).attr("id");

    Swal.fire({
        title: '¿Está seguro de cancelar su Solicitud de Compra?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#72db88',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Bórralo!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "borrar.php",
                method: "POST",
                data: { id_compra: id_compra },
                success: function (data, textStatus, xhr) {
                    if (xhr.status === 200) {
                        // Eliminación exitosa
                        Swal.fire(
                            'Borrado con Éxito!',
                            'Se canceló su Solicitud',
                            'success'
                        );
                        dataTableactivo.ajax.reload();
                    } else if (xhr.status === 403) {
                        // No se puede cancelar
                        Swal.fire(
                            'Error!',
                            'No se puede cancelar la solicitud.',
                            'error'
                        );
                    } else {
                        // Error interno del servidor
                        Swal.fire(
                            'Error!',
                            'Error interno del servidor.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    // Error en la solicitud AJAX
                    Swal.fire(
                        'Error!',
                        'No se puede cancelar la solicitud porque ya esta aprobado su solicitud',
                        'error'
                    );
                }
            });
        } else {
            return false;
        }
    });
});


        });         
    </script>





























<script>
    document.addEventListener("click",function(e){
        if(e.target.classList.contains("gallery-item")){
            const src = e.target.getAttribute("id");
            document.querySelector(".modal-img").src = src;

            const myModal = new bootstrap.Modal(document.getElementById('gallery-modal'));
            myModal.show();
        }
    });
</script>

<script type="text/javascript">
        

        function calcular_a_bs(){
            try{
                var b = parseFloat(document.getElementById("pc").value) || 0;
                decimal = b.toFixed(2);
                proceso = (decimal *(30/100))+b;
                result = proceso.toFixed(2);
                document.getElementById("pv").value = result;
            } catch(e){}
        }


    </script>

    <script>
        const bdark = document.querySelector('#bdark');
        const main = document.querySelector('main');
        const body = document.querySelector('body');

        bdark.addEventListener('click',e =>{
            main.classList.toggle('darkmode');
        });

        bdark.addEventListener('click',e =>{
            body.classList.toggle('darkmode');
        });

        

        const table = document.querySelector('table');
            bdark.addEventListener('click',e =>{
            table.classList.toggle('table-dark');
        });





    </script>
        
        
       


        </body>
</html>