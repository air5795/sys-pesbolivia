<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}

$tiempo_vida = 1800; // 30 minutos en segundos
session_set_cookie_params($tiempo_vida);
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




    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PESBOLIVIA</title>

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

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        /* Cambia la orientación de la tabla para que los datos se muestren en vertical */
        @media screen and (max-width: 600px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            th {
                display: none;
                /* Oculta los encabezados */
            }

            /* Estilos adicionales para mejorar la visualización en vertical */
            td {
                border: none;
                position: relative;
                padding-left: 80px;
                /* Espacio para el título en la vista móvil */
            }

            /* Establecer estilos para el título en la vista móvil */
            th {
                position: absolute;
                left: 8px;
                width: 70px;
                /* Ancho del título en la vista móvil */
                border-bottom: 5px solid #ddd;
                /* Agregar borde inferior al título */
                margin-top: 10px;
                /* Espaciado superior entre grupos */
            }

            /* Agregar bordes entre grupos de datos */
            tr {
                border-bottom: 5px solid black;
                margin-bottom: 20px;
                /* Espaciado inferior entre grupos */
                background-color: white !important;
            }

            tr:last-child {
                border-bottom: none;
                /* Eliminar borde inferior para la última fila */
            }
        }
    </style>





</head>

<body class="sb-nav-fixed">
    <?php include "../menu.php" ?>


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

<div class="row" style="font-family: 'Arial', sans-serif; margin: 0; background: #e0e7ff;">
    <div class="col-sm-12">
        <div class="card" style="border: none; border-radius: 12px; margin: 20px 0; background: rgba(255, 255, 255, 0.3); backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(0,0,0,0.1); display: flex; flex-wrap: wrap;">
            <div class="card-header" style="background: transparent; border-bottom: none; padding: 15px; text-align: center; width: 100%;">
                <h5 style="color: #1a3c34; font-size: 1.6rem; font-weight: 600; margin: 0; letter-spacing: 0.5px; position: relative;">
                    Guía de Compra
                    <span style="position: absolute; bottom: -5px; left: 50%; transform: translateX(-50%); width: 40px; height: 3px; background: #2ca089; border-radius: 1px;"></span>
                </h5>
            </div>
            <div class="card-body" style="padding: 20px; display: flex; flex-wrap: wrap; gap: 20px; width: 100%;">
                <div style="flex: 1; min-width: 300px; max-width: 60%;">
                    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                        <div style="flex: 1; min-width: 150px;">
                            <ol style="list-style: none; counter-reset: step-counter; padding: 0; margin: 0;">
                                <li style="counter-increment: step-counter; display: flex; align-items: flex-start; margin-bottom: 12px;">
                                    <span style="width: 24px; height: 24px; line-height: 24px; text-align: center; background: #2ca089; color: #fff; border-radius: 50%; font-weight: bold; margin-right: 10px; flex-shrink: 0;">1</span>
                                    <span style="font-size: 0.95rem; color: #1a3c34; line-height: 1.4;">Clic en <strong style="color: #2ca089;">"Efectuar Pago"</strong>.</span>
                                </li>
                                <li style="counter-increment: step-counter; display: flex; align-items: flex-start; margin-bottom: 12px;">
                                    <span style="width: 24px; height: 24px; line-height: 24px; text-align: center; background: #2ca089; color: #fff; border-radius: 50%; font-weight: bold; margin-right: 10px; flex-shrink: 0;">2</span>
                                    <span style="font-size: 0.95rem; color: #1a3c34; line-height: 1.4;">Elige: <strong style="color: #2ca089;">Transferencia</strong>, <strong style="color: #2ca089;">Tigo Money</strong> o <strong style="color: #2ca089;">QR</strong>.</span>
                                </li>
                                <li style="counter-increment: step-counter; display: flex; align-items: flex-start; margin-bottom: 12px;">
                                    <span style="width: 24px; height: 24px; line-height: 24px; text-align: center; background: #2ca089; color: #fff; border-radius: 50%; font-weight: bold; margin-right: 10px; flex-shrink: 0;">3</span>
                                    <span style="font-size: 0.95rem; color: #1a3c34; line-height: 1.4;">Paga y guarda el <strong style="color: #2ca089;">comprobante</strong>.</span>
                                </li>
                                <li style="counter-increment: step-counter; display: flex; align-items: flex-start; margin-bottom: 12px;">
                                    <span style="width: 24px; height: 24px; line-height: 24px; text-align: center; background: #2ca089; color: #fff; border-radius: 50%; font-weight: bold; margin-right: 10px; flex-shrink: 0;">4</span>
                                    <span style="font-size: 0.95rem; color: #1a3c34; line-height: 1.4;">Clic en <strong style="color: #2ca089;">"Solicitar Compra"</strong>.</span>
                                </li>
                                <li style="counter-increment: step-counter; display: flex; align-items: flex-start; margin-bottom: 12px;">
                                    <span style="width: 24px; height: 24px; line-height: 24px; text-align: center; background: #2ca089; color: #fff; border-radius: 50%; font-weight: bold; margin-right: 10px; flex-shrink: 0;">5</span>
                                    <span style="font-size: 0.95rem; color: #1a3c34; line-height: 1.4;">Selecciona <strong style="color: #2ca089;">PC</strong> o <strong style="color: #2ca089;">PS4/PS5</strong> y sube comprobante.</span>
                                </li>
                            </ol>
                        </div>
                        <div style="flex: 1; min-width: 150px;">
                            <ol style="list-style: none; counter-reset: step-counter 5; padding: 0; margin: 0;">
                                <li style="counter-increment: step-counter; display: flex; align-items: flex-start; margin-bottom: 12px;">
                                    <span style="width: 24px; height: 24px; line-height: 24px; text-align: center; background: #2ca089; color: #fff; border-radius: 50%; font-weight: bold; margin-right: 10px; flex-shrink: 0;">6</span>
                                    <span style="font-size: 0.95rem; color: #1a3c34; line-height: 1.4;">Envía solicitud (30-45 min o inmediato).</span>
                                </li>
                                <li style="counter-increment: step-counter; display: flex; align-items: flex-start; margin-bottom: 12px;">
                                    <span style="width: 24px; height: 24px; line-height: 24px; text-align: center; background: #2ca089; color: #fff; border-radius: 50%; font-weight: bold; margin-right: 10px; flex-shrink: 0;">7</span>
                                    <span style="font-size: 0.95rem; color: #1a3c34; line-height: 1.4;">Recibe correo de <strong style="color: #2ca089;">Compra Exitosa</strong>.</span>
                                </li>
                                <li style="counter-increment: step-counter; display: flex; align-items: flex-start; margin-bottom: 12px;">
                                    <span style="width: 24px; height: 24px; line-height: 24px; text-align: center; background: #2ca089; color: #fff; border-radius: 50%; font-weight: bold; margin-right: 10px; flex-shrink: 0;">8</span>
                                    <span style="font-size: 0.95rem; color: #1a3c34; line-height: 1.4;">Accede al <strong style="color: #2ca089;">parche</strong> vía correo.</span>
                                </li>
                                <li style="counter-increment: step-counter; display: flex; align-items: flex-start; margin-bottom: 12px;">
                                    <span style="width: 24px; height: 24px; line-height: 24px; text-align: center; background: #2ca089; color: #fff; border-radius: 50%; font-weight: bold; margin-right: 10px; flex-shrink: 0;">9</span>
                                    <span style="font-size: 0.95rem; color: #1a3c34; line-height: 1.4;">Contacta al <strong style="color: #2ca089;">79441119</strong> (WhatsApp) si hay demoras.</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div style="flex: 1; min-width: 300px; max-width: 40%; padding: 20px; display: flex; align-items: center; justify-content: center;">
                    <div style="text-align: center; padding: 15px; background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(10px); border-radius: 8px; width: 100%;">
                        <strong style="font-size: 1.2rem; color: #1a3c34;">¡Preventa Abierta!</strong>
                        <p style="font-size: 0.9rem; color: #1a3c34; margin: 5px 0;">Entrega por orden de compra.</p>
                        <p style="font-size: 1.1rem; color: #dc3545; font-weight: 600; margin-top: 10px;">
                            Lanzamiento: 19 Abr, 21:00 (PC, PS4, PS5)
                        </p>
                     
                    </div>
                </div>
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
                                    <button style="background-color: #28c750;border: none;" type="button" class="btn btn-success  w-100" data-bs-toggle="modal" data-bs-target="#modalpagar" id="boton">
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
                            <table id="datos_usuario" class="table table-hover" style="width:100%;text-align:center" cellpadding="0">
                                <thead>
                                    <tr>
                                        <?php
                                        if ($_SESSION['rol'] == '1') {

                                        ?>
                                            <th>COD-COMPRA</th>
                                            <th>TIPO</th>
                                            <th>USUARIO</th>
                                            <th>CORREO</th>

                                            <th>FECHA DE SOLICITUD</th>
                                            <th>COMPROBANTE</th>
                                            <th>ESTADO</th>
                                            <th></th>



                                        <?php

                                        } else {


                                        ?>

                                            <th>FECHA DE SOLICITUD</th>
                                            <th>TIPO DE PEDIDO</th>

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
                                                    <label for="tipo" style="font-family: sans-serif;">Elija la Plataforma <span style="color:red"> *</span></label>
                                                    <select name="tipo" id="tipo" class="form-control form-control-sm">
                                                        <option value="">Selecciona una Opcion</option>
                                                        <option value="COMPUTADORA">Computadora Airpatch 2025</option>
                                                        <option value="PS4/PS5">PS4/PS5 Option File 2025</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-12">
                                                    <label for="estado" style="font-family: sans-serif;">Estado <span style="color:red"> *</span></label>
                                                    <select name="estado" id="estado" class="form-control form-control-sm">
                                                        <option value="">Selecciona un Estado</option>
                                                        <option value="en espera">en espera</option>
                                                        <option value="aprobado">Aprobar</option>
                                                        <option value="rechazado">Rechazar</option>
                                                        <option value="regalo">Regalar</option>

                                                    </select>
                                                </div>


                                                <div class="col-sm-12">
                                                    <label for="foto" style="font-family: sans-serif;">Ingrese Foto o captura de comprobante de pago </label>
                                                    <input type="file" class="form-control form-control-sm" name="foto" id="foto" required>
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
                            <div class="modal-content" style="border-radius: 30px;">
                                <div class="modal-header" style="text-align:center">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel"> </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;border-radius:30px;background-color: crimson;"></button>
                                </div>





                                <div class="modal-body" style="margin: 10px; text-align:center;">

                                    <h5>FORMAS DE PAGO</h5>
                                    <hr>
                                    <p> Elegir el metodo de pago (Transferencia, QR , Paypal , Tigo Money) </p>
                                    <p style="background-color: #198754;color: white;"> Cada Metodo de pago tiene un precio diferente por las comisiones de la plataforma, revisar </p>




                                    <div class="row">




                                        <div class="col-sm-4" style="color: #6e6e6e;">






                                            <div class="row" style="background-color: #000469;color: white;padding: 10px;border-radius: 15px;font-size:small;margin-right:1px; ">
                                                <div class="col-sm-6">
                                                    <h6 style="background-color: orangered;color:white;padding:10px;border-radius: 15px;text-align: center;">TRANFERENCIA BANCARIA </h6>
                                                    <p style="margin-top:0; margin-bottom:0;">Banco : <strong> Banco de Credito (BCP) </strong></p>
                                                    <p style="margin-top:0; margin-bottom:0;">Numero de Cuenta : <strong> 20151776129301 </strong></p>
                                                    <p style="margin-top:0; margin-bottom:0;">Nombre : Alejandro Iglesias Raldes</p>
                                                    <p style="margin-top:0; margin-bottom:0;">Cuenta : Cuenta Ahorro</p>
                                                    <p style="margin-top:0; margin-bottom:0;">CI : 10478330</p>

                                                    <hr>
                                                    <a href="" class="btn btn-secondary disabled w-100"> 50/Bs (PC) </a>
                                                    <hr>
                                                    <a href="" class="btn btn-secondary disabled w-100">40/Bs (Ps4/Ps5)</a>
                                                    <hr>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 style="background-color: orangered;color:white;padding:10px;border-radius: 15px;text-align: center;">PAGO QR </h6>
                                                    <img src="../img/qr.jpeg" alt="" style="width: 100%;">
                                                    <a href="../img/qr.jpeg" class="btn btn-primary w-100" download="QR.jpeg" style="padding:5px;font-size:14px;background-color: orangered;color: white;border: none;border-radius: 5px 5px 25px 25px;"">Descargar QR  </a>
                                </div>
                            

                            
                            </div>

                        </div>
                        

                        <div class=" col-sm-4" style="color: #6e6e6e;">

                                                        <div class="row" style="background-color: #fcc10f;color: #00377c;padding: 10px;border-radius: 15px;font-size:small;margin-right:1px;">
                                                            <div class="col-sm-6">
                                                                <h6 style="background-color: #00377c;color:white;padding:10px;border-radius: 15px;text-align: center;">TIGO MONEY </h6>
                                                                <p style="margin-top:0; margin-bottom:0;">CELULAR : <strong> 69644019 </strong></p>
                                                                <p style="margin-top:0; margin-bottom:0;">se cobra en tigo money un adicional de 2bs por la comision de tigo </p>


                                                                <hr>
                                                                <a href="" class="btn btn-dark disabled w-100"> 52/Bs (PC) </a>
                                                                <hr>
                                                                <a href="" class="btn btn-dark disabled w-100">42/Bs (Ps4/Ps5)</a>
                                                                <hr>

                                                            </div>
                                                            <div class="col-sm-6">
                                                                <h6 style="background-color: #00377c;color:white;padding:10px;border-radius: 15px;text-align: center;">PAGO QR </h6>
                                                                <img src="../img/qr2.png" alt="" style="width: 100%;">
                                                                <a href="../img/qr2.png" class="btn btn-primary w-100" download="QR.jpeg" style="padding:5px;font-size:14px;background-color: #00377c;color: white;border: none;border-radius: 5px 5px 25px 25px;"">Descargar QR  </a>
                                </div>
                            

                            
                            </div>

                        
                            
                        </div>
                        

                        <div class=" col-sm-4" style="color: #6e6e6e;">

                                                                    <div class="row" style="background-color: #ababab;color: #00377c;padding: 10px;border-radius: 15px;font-size:small;margin-right:1px; ">
                                                                        <div class="col-sm-6">
                                                                            <h6 style="background-color: #00377c;color:white;padding:10px;border-radius: 15px;text-align: center;">PAYPAL </h6>
                                                                            <p style="margin-top:0; margin-bottom:0;">se cobra en Paypal el precio de 9$ por la comision de la plataforma </p>
                                                                            <script src="https://www.paypal.com/sdk/js?client-id=BAAbR13ioh5lH0_IoB5k5Zm8u19Pu6bmZK6DXTfH_VCiKFjGDV7D3jvYJftd6kxz2DSi3V-akfQ1GG-AVg&components=hosted-buttons&disable-funding=venmo&currency=USD"></script>
                                                                            <div id="paypal-container-CJ5BYW4EHBDTC"></div>
                                                                            <script>
                                                                                paypal.HostedButtons({
                                                                                    hostedButtonId: "CJ5BYW4EHBDTC",
                                                                                }).render("#paypal-container-CJ5BYW4EHBDTC")
                                                                            </script>

                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <h6 style="background-color: #00377c;color:white;padding:10px;border-radius: 15px;text-align: center;">PAGO QR </h6>
                                                                            <img src="../img/qr3.png" alt="" style="width: 100%;">
                                                                            <a href="../img/qr3.png" class="btn btn-primary w-100" download="QR.jpeg" style="padding:5px;font-size:14px;background-color: #00377c;color: white;border: none;border-radius: 5px 5px 25px 25px;"">Descargar QR  </a>
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

                <div class=" modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
        $(document).ready(function() {
            // Variable global para controlar el estado de la solicitud
            var isProcessing = false;

            $("#botonCrear").click(function() {
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
            });

            var habilitarFunciones = <?php echo ($_SESSION['rol'] != 1) ? 'true' : 'false'; ?>;

            if (habilitarFunciones) {
                dataTableactivo = $('#datos_usuario').DataTable({
                    "paging": false,
                    "info": false,
                    "searching": false,
                    "pageLength": 10,
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        url: "obtener_registros.php",
                        type: "POST"
                    },
                    "columnsDefs": [{
                        "targets": [0, 3, 4],
                        "orderable": false,
                    }, ],
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
            } else {
                dataTableactivo = $('#datos_usuario').DataTable({
                    "paging": true,
                    "info": true,
                    "searching": true,
                    "pageLength": 15,
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        url: "obtener_registros.php",
                        type: "POST"
                    },
                    "columnsDefs": [{
                        "targets": [0, 3, 4],
                        "orderable": false,
                    }, ],
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
            $(document).on('submit', '#formulario', function(event) {
                event.preventDefault();
                // Verificar si ya hay una solicitud en curso
                if (isProcessing) {
                    return; // Ignorar la solicitud si ya se está procesando una
                }
                // Establecer la bandera en true para indicar que se está procesando una solicitud
                isProcessing = true;

                var usuario = $('#usuario').val();
                var correo = $('#correo').val();
                var tipo = $('#tipo').val();
                /* var estado = $('#estado').val(); */

                var extension = $('#foto').val().split('.').pop().toLowerCase();
                /* var extension2 = $('#ficha').val().split('.').pop().toLowerCase();
                var extension3 = $('#certificado').val().split('.').pop().toLowerCase(); */
                if (extension != '') {
                    if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        alert("Fomato de imagen inválido");
                        $('#foto').val('');
                        isProcessing = false; // Restablecer la bandera en caso de error
                        return false;
                    }
                }

                // Deshabilitar el botón al enviar la solicitud
                $("#action").prop("disabled", true);

                if (usuario != '' && correo != '' && tipo != '') {
                    $.ajax({
                        url: "crear.php",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            // Restablecer la bandera a false una vez completada la solicitud
                            isProcessing = false;
                            // Habilitar el botón después de que se complete la solicitud
                            $("#action").prop("disabled", false);

                            // Llamar al archivo PHP separado para enviar el correo electrónico
                            $.ajax({
                                url: 'enviar_correo.php',
                                method: 'POST',
                                success: function(response) {
                                    console.log(response); // Muestra la respuesta en la consola del navegador
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error al llamar al archivo enviar_correo.php:', error);
                                }
                            });

                            Swal.fire(
                                'Exitoso!',
                                'Se registro correctamente',
                                'success'
                            );
                            $('#formulario')[0].reset();
                            $('#modalproductos').modal('hide');
                            dataTableactivo.ajax.reload();
                        },
                        error: function() {
                            // Restablecer la bandera a false en caso de error
                            isProcessing = false;
                            // Habilitar el botón en caso de error
                            $("#action").prop("disabled", false);

                            Swal.fire(
                                'Error!',
                                'Ha ocurrido un error al procesar la solicitud',
                                'error'
                            );
                        }
                    });
                } else {
                    // Restablecer la bandera a false en caso de error
                    isProcessing = false;
                    // Habilitar el botón en caso de error
                    $("#action").prop("disabled", false);

                    Swal.fire(
                        'Algunos Campos son Obligatorios ?',
                        'Revisa el formulario',
                        'warning'
                    );
                }
            });


            //Funcionalidad de editar
            $(document).on('click', '.editar', function() {
                var id_compra = $(this).attr("id");
                // Mostrar el elemento de carga
                $('#cargando').show();
                $.ajax({
                    url: "obtener_registro.php",
                    method: "POST",
                    data: {
                        id_compra: id_compra
                    },
                    dataType: "json",
                    success: function(data) {
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
            $(document).on('click', '.borrar', function() {
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
                            data: {
                                id_compra: id_compra
                            },
                            success: function(data, textStatus, xhr) {
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
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("gallery-item")) {
                const src = e.target.getAttribute("id");
                document.querySelector(".modal-img").src = src;

                const myModal = new bootstrap.Modal(document.getElementById('gallery-modal'));
                myModal.show();
            }
        });
    </script>

    <script type="text/javascript">
        function calcular_a_bs() {
            try {
                var b = parseFloat(document.getElementById("pc").value) || 0;
                decimal = b.toFixed(2);
                proceso = (decimal * (30 / 100)) + b;
                result = proceso.toFixed(2);
                document.getElementById("pv").value = result;
            } catch (e) {}
        }
    </script>

    <script>
        const bdark = document.querySelector('#bdark');
        const main = document.querySelector('main');
        const body = document.querySelector('body');

        bdark.addEventListener('click', e => {
            main.classList.toggle('darkmode');
        });

        bdark.addEventListener('click', e => {
            body.classList.toggle('darkmode');
        });



        const table = document.querySelector('table');
        bdark.addEventListener('click', e => {
            table.classList.toggle('table-dark');
        });
    </script>





</body>

</html>