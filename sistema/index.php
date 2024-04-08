<?php
    session_start();
    include "includes/scripts.php";
    include "includes/header.php";
    include "../conexion.php"; 

/* numero de compras de computadora */
$sql = mysqli_query($conexion, "SELECT COUNT(id_compra) FROM compras WHERE tipo='COMPUTADORA' and estado = 'aprobado';");
$result_f = mysqli_fetch_array($sql);
$PC = $result_f['COUNT(id_compra)']; 
/* numero de compras de ps4/ps5 */
$sql2 = mysqli_query($conexion, "SELECT COUNT(id_compra) FROM compras WHERE tipo='PS4/PS5' and estado = 'aprobado';");
$result_f2 = mysqli_fetch_array($sql2);
$PLAY = $result_f2['COUNT(id_compra)']; 
/* compras pendientes */
$sql3 = mysqli_query($conexion, "SELECT COUNT(id_compra) FROM compras WHERE estado = 'en espera';");
$result_f3 = mysqli_fetch_array($sql3);
$PENDIENTES = $result_f3['COUNT(id_compra)']; 

/* compras pendientes */
$sql4 = mysqli_query($conexion, "SELECT COUNT(id_compra) FROM compras WHERE estado = 'aprobado';");
$result_f4 = mysqli_fetch_array($sql4);
$total_compras = $result_f4['COUNT(id_compra)']; 

/* saldos */
$saldos_pc = $PC * 50 * 0.3;
$saldos_play = $PLAY * 40 * 0.3;
$saldo_pesboliviaPC = $PC * 50 * 0.1;
$saldo_pesboliviaPLAY = $PLAY * 40 * 0.1;

$saldo_total = $saldos_pc + $saldos_play;
$saldo_totalPESBOLIVIA = $saldo_pesboliviaPC + $saldo_pesboliviaPLAY;



?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="img/ICONO.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        
        <title>PES-BOLIVIA</title>
        
    </head>
    <body class="sb-nav-fixed" >
    

        <!-- contenido del sistema-->

        <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 p-2">
                        <div class="alert alert-warning alert-dismissible fade show " role="alert" style="background-color: #b2ffdb;border:none;color:#575757"> 
                             <?php echo $_SESSION['nombre']  ?>  <strong> Bienvenido a PES BOLIVIA  !  
                            <button type="button" class=" btn-close btn-sm " data-bs-dismiss="alert" aria-label="Close"></button> 
                        </div>

                        

                        

                      

                       

                        <?php
                        if ($_SESSION['rol'] == 1 ) {
                        ?> 

                        <div class="row">
                            <div class="col-sm-6">

                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">COMPRAS PENDIENTES!</h4>
                                <hr> 
                                <p class="mb-0">Compras pendientes de Verificacion <strong>
                                    <?php echo '<button style="border-radius: 50px;" class="btn btn-info btn-sm"> <strong>' . $PENDIENTES . ' </strong> En espera </button>';?></strong></p>
                            </div>

                            </div>
                            <div class="col-sm-3">

                            <div class="alert alert-dark" role="alert">
                                <h4 class="alert-heading">SALDO ACUMULADO</h4>
                                <hr>
                                <p class="mb-0"><strong>
                                    <?php echo '<button style="border-radius: 50px;" class="btn btn-dark btn-sm w-50">' . number_format($saldo_total,2,'.',',') . ' Bs </button>';?></strong></p>
                            </div>

                            </div>

                            <?php
                                if ($_SESSION['user']!='admin') {
                                    
                                
                            ?>


                            <div class="col-sm-3">

                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">SALDO PAGADO</h4>
                                <hr>
                                <p class="mb-0"> <strong>
                                    <?php echo '<button style="border-radius: 50px;" class="btn btn-success btn-sm w-50">' . $PENDIENTES . '</button>';?></strong></p>
                            </div>

                            </div>

                            <?php
                                
                                    
                                } else {
                                    
                                
                            ?>

                            <div class="col-sm-3">

                            <div class="alert alert-dark" role="alert">
                                <h4 class="alert-heading">SALDO PES-BOLIVIA</h4>
                                <hr>
                                <p class="mb-0"> <strong>
                                    <?php echo '<button style="border-radius: 50px;" class="btn btn-dark btn-sm w-50">' . number_format($saldo_totalPESBOLIVIA,2,'.',',') .  ' Bs </button>';?></strong></p>
                            </div>

                            </div>



                        <?php
                                
                                    
                            } 
                        ?>

                            
                            

                        </div>



<hr>




                        

                        


                        <div class="home-content">
                            <div class="overview-boxes">

                                <div class="box">
                                    <div class="left-side">
                                        <div class="box_topic">N° de Compras PC</div>
                                        <div class="number"> 
                                            <?php echo $PC;?> 
                                        </div>
                                        
                                    </div>
                                    <img src="img/Steam_icon_logo.svg.png" width="20%" height="" >
                                    
                                </div>

                                <div class="box">
                                    <div class="left-side">
                                        <div class="box_topic">Total Ingresos PC</div>
                                        <div class="number">
                                        <?php 
                                        $COSTO_PC = 50;

                                        $COSTO_TOTAL_PC = $PC * $COSTO_PC; 
                                        echo ''.number_format($COSTO_TOTAL_PC,2,'.',','). ' Bs';
                                        
                                        ?> 
                                        </div>
                                    
                                        
                                    </div>

                                    <img src="img/Steam_icon_logo.svg.png" width="20%" height="" >
                                </div>


                                <div class="box">
                                    <div class="left-side">
                                        <div class="box_topic">N° de compras PS4/PS5</div>
                                        <div class="number">
                                        <?php echo $PLAY;?> 
                                        </div>
                                        
                                    </div>
                                    <img src="img/2560px-PlayStation_logo.svg.png" width="20%" height="" >
                                    

                                    
                                </div>


                                <div class="box">
                                    <div class="left-side">
                                        <div class="box_topic">Total Ingresos PS4/PS5</div>
                                        <div class="number">
                                        <?php 
                                        $COSTO_PLAY = 40;

                                        $COSTO_TOTAL_PLAY = $PLAY * $COSTO_PLAY; 
                                        echo ''.number_format($COSTO_TOTAL_PLAY,2,'.',','). ' Bs';
                                        
                                        ?> 
                                        </div>
                                        
                                    </div>
                                    <img src="img/2560px-PlayStation_logo.svg.png" width="20%" height="" >

                                   
                                </div>

                                
                            </div>
                        </div>

                        <hr>

                        <?php
                        }

                        if ($_SESSION['rol'] != 1 ) {
                        ?> 

                        <div class="row">

                            <div class="col-sm-12">

                            <div class="card mb-3" style="max-width: 100%;" >
                                <div class="row g-0">
                                    <div class="col-md-4">
                                    <img src="../assets/images/AIR/portada.png" class="img-fluid rounded-start" alt="..." >
                                    </div>
                                    <div class="col-md-8">
                                    <div class="card-body" style="text-align: center;">

                                    <div class="row">
                                        <div class="col-sm-6">
                                         
                                        </div>
                                        <div class="col-sm-6">
                                        
                                        </div>

                                    </div>
                                        

                                        <hr>
                                        
                                        <div class="row  text-center">
                                        <div class="col-sm-6">
                                            <div class="card mb-4 rounded-3 shadow-sm" style="background-color: #e7e7e7;">
                                            <div class="card-header py-3">
                                                <h4 class="my-0 fw-normal">AIRPATCH 2024 PC</h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title pricing-card-title">50 Bs<small class="text-body-secondary fw-light">/anual</small></h1><hr>
                                                <ul class="list-unstyled mt-3 mb-4">
                                                <li>Temporada 2024 liga boliviana (copa Paceña, Liga Tigo)</li>
                                                <li>Copa Simón Bolívar</li>
                                                <li>Ambientación total 2024</li>
                                                <li>Actualizaciones de errores y mejoras</li>
                                                <li>Acceso a descarga en la nube del parche</li>
                                                <li>Soporte en instalación</li>
                                                <li>Libertadores 2024</li>
                                                <li>Champions league 2024</li>
                                                <li>Futura actualización Copa América</li>

                                                
                                                </ul>
                                                <button type="button" class="w-100 btn btn-lg btn-outline-primary"><i class="bi bi-bag"></i> Comprar Ahora</button> <hr>
                                                <button style="font-size: x-large;" type="button" class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#pc">
                                                <i class="bi bi-eye"></i> Ver Novedades</button>

                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card mb-4 rounded-3 shadow-sm" ">
                                            <div class="card-header py-3">
                                                <h4 class="my-0 fw-normal">OPTION FILE AIRPATCH 2024 PS4/PS5 </h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title pricing-card-title">40 Bs<small class="text-body-secondary fw-light">/anual</small></h1> <hr>
                                                <ul class="list-unstyled mt-3 mb-4">
                                                <li>Temporada 2024 liga boliviana</li>
                                                <li>Plantillas 2024</li>
                                                <li>Equipaciones 2024</li>
                                                <li>Actualizaciones de errores y mejoras</li>
                                                <li>Acceso a descarga en la nube del parche</li>
                                                <li>Soporte en instalación</li>
                                                <li>Libertadores 2024</li>
                                                <li>Champions league 2024</li>
                                                <li>Futura actualización Copa América</li>

                                                
                                                </ul>
                                                <button type="button" class="w-100 btn btn-lg btn-outline-primary"><i class="bi bi-bag"></i> Comprar Ahora</button> <hr>
                                               

                                                <button style="font-size: x-large;" type="button" class="btn btn-outline-secondary  w-100" data-bs-toggle="modal" data-bs-target="#ps4">
                                        <i class="bi bi-eye"></i> Ver Novedades</button>
                                            </div>
                                            </div>
                                        </div>
                                    
                                        </div>

                                        <HR>

                                        

                                            

                                        <hr>
                                        
                                        <!-- <a href="#" class="card-link btn btn-success" style="font-size: x-large;"><i class="bi bi-eye"></i> Ver Informacion Detallada </a> -->
                                        
                                        <hr>

                                        
                                    </div>
                                    </div>
                                </div>
                                </div>

                            </div>
                            


                        </div>


                        


                        <?php
                        }

                        
                        ?> 


                    <!-- Modal pc-->
                    <div class="modal fade" id="pc" tabindex="-1" aria-labelledby="pc" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen modal-dialog-dark">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="pc">Airpatch 2024 PC</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        
                        <div class="card-group">
                            <div class="card">
                                <img src="../assets/images/AIR/12.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                                <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                                </div>
                                <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                </div>
                                <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            </div>
                            
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>

                    

                    <!-- Modal ps4/ps5 -->
                    <div class="modal fade" id="ps4" tabindex="-1" aria-labelledby="ps4" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ps4">Option File Airptach 2024 ps4/ps5</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>




                        


                        


                            
                                
                               
                                
                                
                            
                        
                        
                                            


                        
                                               

                        


                            
                            

                            

                                                
                                        
                                    



                        


                        
                        
                        

                        
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; @irsoft - 2023</div>
                            <div>
                                
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

   

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
