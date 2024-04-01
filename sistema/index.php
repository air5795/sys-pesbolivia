<?php
    session_start();
    include "includes/scripts.php";
    include "includes/header.php";
    include "../conexion.php"; 

/*     $sql_suma_bs = mysqli_query($conexion, "SELECT SUM(monto_bs) FROM exp_general;");
                            $result_sum = mysqli_fetch_array($sql_suma_bs);
                            $total = $result_sum['SUM(monto_bs)']; 

                            $sql_tfila = mysqli_query($conexion, "SELECT COUNT(id_exp) FROM exp_general;");
                            $result_f = mysqli_fetch_array($sql_tfila);
                            $total2 = $result_f['COUNT(id_exp)']; 

                            $sql_suma_bs = mysqli_query($conexion, "SELECT SUM(monto_bs) FROM exp_general_c;");
                            $result_sum = mysqli_fetch_array($sql_suma_bs);
                            $total3 = $result_sum['SUM(monto_bs)']; 

                            $sql_tfila = mysqli_query($conexion, "SELECT COUNT(id_exp) FROM exp_general_c;");
                            $result_f = mysqli_fetch_array($sql_tfila);
                            $total4 = $result_f['COUNT(id_exp)']; */

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
                            <button type="button" class=" btn-close " data-bs-dismiss="alert" aria-label="Close"></button> 
                        </div>

                        

                      

                       

                        <?php
                        if ($_SESSION['rol'] == 1 ) {
                        ?> 

                        

                        


                        <div class="home-content">
                            <div class="overview-boxes">

                                <div class="box">
                                    <div class="left-side">
                                        <div class="box_topic">N° de Compras PC</div>
                                        <div class="number">2</div>
                                        
                                    </div>
                                    <img src="img/Steam_icon_logo.svg.png" width="20%" height="" >
                                    
                                </div>

                                <div class="box">
                                    <div class="left-side">
                                        <div class="box_topic">Total Ingresos PC</div>
                                        <div class="number">100 Bs</div>
                                    
                                        
                                    </div>

                                    <img src="img/Steam_icon_logo.svg.png" width="20%" height="" >
                                </div>


                                <div class="box">
                                    <div class="left-side">
                                        <div class="box_topic">N° de compras PS4/PS5</div>
                                        <div class="number">4</div>
                                        
                                    </div>
                                    <img src="img/2560px-PlayStation_logo.svg.png" width="20%" height="" >
                                    

                                    
                                </div>


                                <div class="box">
                                    <div class="left-side">
                                        <div class="box_topic">Total Ingresos PS4/PS5</div>
                                        <div class="number">200 Bs</div>
                                        
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
                                        <h5 class="card-title">AIRPATCH 2024 PC</h5>
                                        <HR></HR>
                                        <p class="card-text" style="margin: 0; "> - Copa Simon Bolivar , Copa Paceña y Liga tigo </p>
                                        <p class="card-text" style="margin: 0; "> - Kits Actualizados temporada 2024</p>
                                        <p class="card-text" style="margin: 0; "> - Balon temporada 2024</p>
                                        <p class="card-text" style="margin: 0; "> - Entrance temporada 2024</p>
                                        <p class="card-text" style="margin: 0; "> - Faces Jugadores</p>
                                        <p class="card-text" style="margin: 0; "> - Vallas Publicitarias</p>
                                        <p class="card-text" style="margin: 0; "> - Nuevos Estadios</p>
                                        <hr>
                                        <a href="#" class="card-link btn btn-danger" style="font-size: x-large;"><i class="bi bi-bag"></i> Comprar Ahora </a>
                                        <!-- <a href="#" class="card-link btn btn-success" style="font-size: x-large;"><i class="bi bi-eye"></i> Ver Informacion Detallada </a> -->
                                        <button style="font-size: x-large;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pc">
                                        <i class="bi bi-eye"></i> Ver detalles PC</button>

                                        <hr>

                                        <h5 class="card-title">AIRPATCH 2024 ps4/ps5</h5>
                                        <HR></HR>

                                        <p class="card-text" style="margin: 0; "> - Copa Simon Bolivar , Copa Paceña y Liga tigo </p>
                                        <p class="card-text" style="margin: 0; "> - Kits Actualizados temporada 2024</p>
                                        <p class="card-text" style="margin: 0; "> - Balon temporada 2024</p>
                                        <p class="card-text" style="margin: 0; "> - Entrance temporada 2024</p>
                                        <p class="card-text" style="margin: 0; "> - Faces Jugadores</p>
                                        <p class="card-text" style="margin: 0; "> - Vallas Publicitarias</p>
                                        <p class="card-text" style="margin: 0; "> - Nuevos Estadios</p>
                                        <hr>
                                        <a href="#" class="card-link btn btn-danger" style="font-size: x-large;"><i class="bi bi-bag"></i> Comprar Ahora </a>
                                        <!-- <a href="#" class="card-link btn btn-success" style="font-size: x-large;"><i class="bi bi-eye"></i> Ver Informacion Detallada </a> -->
                                        <button style="font-size: x-large;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ps4">
                                        <i class="bi bi-eye"></i> Ver detalles PS4/PS5</button>

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
