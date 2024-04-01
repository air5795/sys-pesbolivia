<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
if (empty($_SESSION['active'])) {
  header('location: ../');
}
}

?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <center><img src="../sistema/img/logito.png" width="200px" ></center> 
            
            
            
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                     
                     
                    <p class="form-text "  style="color: white;padding: 5px;"><i class="bi bi-person"></i> Usuario : </p> 
                    <p class="form-text "  style="color: #ffffff;padding: 5px;background-color: #4f4f4f;border-radius: 8px;">
                        <?php 
                            if ($_SESSION['rol'] == 1) {
                                $tipo = 'Administrador';
                                echo $_SESSION['nombre'] .' - ('.$tipo.')'; 
                            }else{
                                $tipo = 'Trabajador';
                                echo $_SESSION['nombre'] .' - ('.$tipo.')';
                            }   

                        ?>
                                                
                    </p>    
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?php
                                                    if ($_SESSION['iduser'] == 1 ) {
                                                    echo '<img style="width:35px; height:35px;" src="../img/ale.png" >';
                                                        //echo $_SESSION['iduser'];
                                                    }
                                                    elseif ($_SESSION['iduser'] == 12 ) {
                                                        echo '<img style="width:35px; height:35px;" src="../sistema/img/nicol.png" >';
                                                            //echo $_SESSION['iduser'];
                                                        }
                                                        elseif ($_SESSION['iduser'] == 28 ) {
                                                            echo '<img style="width:35px; height:35px;" src="../sistema/img/mavel.png" >';
                                                                //echo $_SESSION['iduser'];
                                                            }
                                                            elseif ($_SESSION['iduser'] == 29 ) {
                                                                echo '<img style="width:35px; height:35px;" src="../sistema/img/jazmin.png" >';
                                                                    //echo $_SESSION['iduser'];
                                                                } elseif ($_SESSION['iduser'] == 32 ) {
                                                                    echo '<img style="width:35px; height:35px;" src="../sistema/img/edwin.png" >';
                                                                        //echo $_SESSION['iduser'];
                                                                    } elseif ($_SESSION['iduser'] == 34 ) {
                                                                        echo '<img style="width:35px; height:35px;" src="../sistema/img/usuario.png" >';
                                                                            //echo $_SESSION['iduser'];
                                                                        }elseif ($_SESSION['iduser'] == 30 ) {
                                                                            echo '<img style="width:35px; height:35px;" src="../sistema/img/alberto.png" >';
                                                                                //echo $_SESSION['iduser'];
                                                                            }elseif ($_SESSION['iduser'] == 35 ) {
                                                                                echo '<img style="width:35px; height:35px;" src="../sistema/img/lucia.png" >';
                                                                                    //echo $_SESSION['iduser'];
                                                                                }elseif ($_SESSION['iduser'] == 36 ) {
                                                                                    echo '<img style="width:35px; height:35px;" src="../sistema/img/cristian.png" >';
                                                                                        //echo $_SESSION['iduser'];
                                                                                    }elseif ($_SESSION['iduser'] == 37 ) {
                                                                                        echo '<img style="width:35px; height:35px;" src="../sistema/img/denis.png" >';
                                                                                            //echo $_SESSION['iduser'];
                                                                                        }

                                                
                                                ?> </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="salir.php"><i class="fa-solid fa-circle-xmark"></i> Salir del Sistema</a></li>
                    </ul>
                </li>
            </ul>
            
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu" style="background-color: #424242;">
                        <div class="nav">
                            
                            
                            <a class="nav-link" href="index.php" style="background-color: #2f2f2f;color: white;font-weight: 300;">
                                <div class="sb-nav-link-icon"><i style="color:#FFffff" class="fa-solid fa-house"></i></div>
                                Inicio
                            </a>

                            <?php
                                if ($_SESSION['rol'] == 1 or $_SESSION['iduser'] == 12 or $_SESSION['iduser'] == 28 or $_SESSION['iduser'] == 29 or $_SESSION['iduser'] == 30 or $_SESSION['iduser'] == 34 or $_SESSION['iduser'] == 35 or $_SESSION['iduser'] == 36 ) {
                            ?> 

                            

                            

                            <div class="sb-sidenav-menu-heading " style="color: #0fa37e; font-size: medium; text-transform: none; background-color: #38383869;">
                            <i class="fa-solid fa-object-ungroup"></i> General</div>

                            

                            <!-- lista de menu 1 -->
                 
                            

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapsei" aria-expanded="false" aria-controls="pagesCollapseError">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                                Inventarios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapsei" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <!--<a class="nav-link" href="categorias_i.php">Categorias mercaderia</a> 
                                    <a class="nav-link" href="inventario_i.php">Gestor Inventario</a>-->
                                    <a class="nav-link" href="#">Inventario de Mercaderia</a>
                                    <a class="nav-link" href="sub-inventarios-activos/">Inventario Activos Fijos</a>
                                </nav>
                            </div>


                        <?php
                        }
                        if ($_SESSION['rol'] == 1) {
                            # code..
                        
                        ?>      
                        
                        

                            


                            <div class="sb-sidenav-menu-heading" style="color:white; font-size: medium; text-transform: none; background-color: #38383869; " ><i class="fa-solid fa-lock"></i> Administrador</div>
                            
                                              
                            <a  class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapse3" aria-expanded="false" aria-controls="pagesCollapseError">
                            <div class="sb-nav-link-icon" ><i class="fas fa-user-plus"></i></div>
                                Usuarios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="pagesCollapse3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="registro_usuario.php">Nuevo Usuario</a>
                                    <a class="nav-link" href="lista_usuarios.php">Lista de Usuarios</a>
                                </nav>
                            </div>
                            <?php
                               
                               } 
                            ?>
                        </div>
                    </div>
                
                    
                    <div class="sb-sidenav-footer">
                        
                        <div> <i class="fa-solid fa-clipboard-user"></i> Usuario:</div> <span style="font-size: 12px;"><?php echo $_SESSION['nombre'] ?></span>
                        
                        
                    </div>
                </nav>
            </div>



            
            