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

                        <hr>

                        


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
