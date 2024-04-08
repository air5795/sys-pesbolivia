<?php

$alert = '';
session_start();


if (!empty($_SESSION['active'])) {
  header('location: sistema/');
} else {




  if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['clave'])) {
      $alert = "Ingrese su Usuario y Clave ";
    } else {

      require_once "conexion.php";

      $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
      $pass = md5(mysqli_real_escape_string($conexion, $_POST['clave']));

      $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass' ");
      mysqli_close($conexion);
      $result = mysqli_num_rows($query);

      if ($result > 0) {
        $data = mysqli_fetch_array($query);



        $_SESSION['active'] = true;
        $_SESSION['iduser'] = $data['idusuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['correo'] = $data['correo'];
        $_SESSION['user'] = $data['usuario'];
        $_SESSION['rol'] = $data['rol'];

        header('location: sistema/');
      } else {
        $alert = "El Usuario o Clave son Incorrectos";
        session_destroy();
      }
    }
  }









}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Incluir jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluir CSS de Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
  

  <!-- 
    - primary meta tags
  -->
  <title>PES-BOLIVIA</title>
  <meta name="title" content="Adex">
  <meta name="description" content="PESBOLIVIA EDICION PARACHE LIGA BOLIVIANA">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.png" type="image/svg+xml">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;700&display=swap" rel="stylesheet">

  <!-- 
    - custom css link
  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/style2.css">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

  <!-- 
    - preload images
  -->

  <style>
    /* Estilos personalizados para las notificaciones Toastr */
        .toast {
            font-size: 16px; /* Tamaño de letra deseado */
        }

        .toast-success {
            background-color: #28a745 !important; /* Color verde */
            color: #fff !important; /* Texto en blanco */
        }
        .toast-error {
            background-color: #dc3545 !important; /* Color rojo */
            color: #fff !important; /* Texto en blanco */
        }
        
    </style>

</head>

<body>

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <a href="#" class="logo">
        <img src="./assets/images/logito.png" width="250" height="24" alt="Adex home" class="logo-light">

        <img src="./assets/images/logito2.png" width="250" height="24" alt="Adex home" class="logo-dark">
      </a>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">
          <a href="#" class="logo">
            <img src="./assets/images/logo-light.png" width="174" height="24" alt="Adex home">
          </a>

          <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
            <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
          </button>
        </div>

        <ul class="navbar-list">

          <li>
            <a href="index.php" class="navbar-link"><i class="bi bi-house-door-fill"></i> INICIO</a>
          </li>


          <li>
            <a href="extra.php" class="navbar-link"><i class="bi bi-dpad"></i> CONTENIDO EXTRA</a>
          </li>

          


          

          

          

        </ul>

        <div class="wrapper">
        <a style="text-align: center;" type="button" class="navbar-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
<i class="bi bi-person-circle"></i> Inicia sesión
</a> <hr>
          <a href="mailto:info@email.com" class="contact-link">pesbolivia2023@gmail.com</a>

          <a href="tel:001234567890" class="contact-link">79441119</a>
        </div>

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-dribbble"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

      </nav>

      <a href="https://api.whatsapp.com/send?phone=+59179441119&text=Hola%20Pes%20Bolivia%20,%20Quiero%20hacerte%20un%20pedido%20...." class="btn btn-outline"><i class="bi bi-telephone-forward-fill"></i> Solicitar Pedidos</a>
     
      <!-- <a href="#" class="btn btn-success"><i class="bi bi-people-fill"></i> Iniciar Sesion </a> -->



      <!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
<i class="bi bi-person-circle"></i> Inicia sesión
</button>



















      <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
        <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
      </button>

      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="section hero has-bg-image w-100" aria-label="home" style="background-image: url('./assets/images/hero-bg3.png')">
        <div class="container">

          <div class="hero-content">

            <h1 class="h1 hero-title">PES BOLIVIA</h1>

            <p class="">
              <!-- Parche liga Boliviana 2024 , comunidad de PES en Bolivia. -->
              <div class="btn btn-outline" id="contador" style="border-radius: 2px; "></div>
              
            </p>

            <div class="btn-wrapper">

              <a href="airpatch.php" class="btn btn-outline"> AIRPATCH 2024 PC </a>

              <a href="optionFile.php" class="btn btn-outline"> OPTION FILE 2024 PS4/PS5 </a>


            </div>

          </div>

          <div>

          </div>

          

        </div>
      </section>




<P></P>
















 





<!-- Modal iniciar sesion--------------------------------------------------------------------------------->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog " id="h">
    <div class="modal-content" style="
    background-color: #1b1a18;
    border-radius: 60px;
">
      
      <div class="modal-body" style="margin: 10px;">

      <div class="row">
        <div class="col-sm-12" id="form-iniciar-sesion" style="padding: 30px;color: #6e6e6e;">
        <center><img src="sistema/img/AIRPATCH.png" alt="Imagen" style="width: 40%;border-radius: 1000px;"></center><br>
        <h2 style="text-align:center">Iniciar Sesión</h2>

        
          
        

        

     


          <form action="" method="POST">
          <div class="mb-4">
              <label for="disabledTextInput" class="form-label font-weight-bold"><i class="bi bi-person"></i> Usuario</label>
              <input type="text" name="usuario" id="disabledTextInput" class="form-control border-0"  style="background-color: #e3e3e3;font-weight: 600;font-size:15px;">
            </div>
            <div class="mb-4">
              <label for="disabledTextInput" class="form-label font-weight-bold"><i class="bi bi-lock"></i> Contraseña</label>
              <input type="password" name="clave" id="disabledTextInput" class="form-control  border-0"  style="background-color: #e3e3e3;font-weight: 600;font-size:15px;">
            </div>
            <div style="color: #4f4f4f;padding: 0;font-weight: 600;" 
            class="alert form-text text-center"><?php echo isset($alert) ? $alert : ''; ?></div>

            <div style="text-align:center">
              <button type="submit" class="btn btn-primary w-100 " style="background-color: aquamarine;color:black;">Iniciar Sesión <i class="bi bi-chevron-right"></i></button>
              
              <a class="btn btn-primary" href="#" id="enlace-registrarse" style="background-color: #7fddff;color:black;">Registrarse <i class="bi bi-person-add"></i></a>
            </div>
<br>
            <div style="text-align:right">
            <a href="recuperar.php">Olvidaste tu contraseña <i class="bi bi-question-circle"></i></a>
          </div>

            

            
              
          </form>



          
        </div>
        <div class="col-sm-6" id="formulario-registro" style=" display:none; background-color: rgb(20 20 20);padding: 30px;border-radius: 30px;color: #78c99d;border: 1px solid #78c99d;">
        <h2>Registrarse</h2>
        <form action="" method="post" class="fields">

                            <label for="nombre">Nombre y Apellidos</label>
                            <input class="form-control " type="text" name="nombre" id="nombre" placeholder="Introdusca su nombre" style="font-size: 18px;background-color: aquamarine;color: #393939;" required>
                            <label for="correo">Correo Electronico</label>
                            <input class="form-control" type="email" name="correo" id="correo" placeholder="Introdusca su correo" style="font-size: 18px;background-color: aquamarine;color: #393939;" required>
                            <label for="usuario">Usuario</label>
                            <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Introdusca un nombre de usuario" style="font-size: 18px;background-color: aquamarine;color: #393939;" required>
                            <label for="clave">Constraseña</label>
                            <input class="form-control" type="password" name="clave" id="clave" placeholder="Introdusca una contraseña de acceso" style="font-size: 18px;background-color: aquamarine;color: #393939;" required>
                            <hr class="w-100">
                            <!-- selector--> 

                            <div class="input-group mb-3">
                              
                              <select class="form-select w-50" name="rol" id="rol" style="display: none;">
                                  <option value="2">Trabajador</option>
                              </select>
                              <input type="hidden" name="rol" value="2"> 
                          </div>

                            <hr class="w-100">

                            <div class="center">
                                <center>
                                <div class=" align-self-center " role="alert" style=""> <?php echo isset ($alert) ? $alert :''; ?></div>
                                <input type="submit" value="Crear Cuenta" class="btn btn-success  border-0 w-50   " data-dismiss="alert" >
                                </center>
                                
                            </div>

                          
                       </form>
        </div>
      </div>
            
      </div>
      
    </div>
  </div>
</div>











      <!-- 
        - #PROJECT
      -->

      <section class="section project" aria-labelledby="project-label">
        <div class="container">

          

          

          <ul class="grid-list">

            <li>
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 560; --height: 350;">
                  <img src="./assets/images/hero-slide-1.jpg" width="560" height="350" loading="lazy"
                    alt="Ligula tristique quis risus" class="img-cover">
                </figure>

                <div class="card-content">

                  <h3 class="h3">
                    <a href="#" class="card-title"> AirPatch 2024 (PC) <i class="bi bi-laptop"></i> </a>
                  </h3>

                  <p class="card-text">
                    Parche de la liga Boliviana Temporada 2024 PES 21 para Computadora. 
                  </p>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="calendar-outline" aria-hidden="true"></ion-icon>

                      <time class="meta-text" datetime="2022-04-14">26 de marzo</time>
                    </li>

                    <li class="card-meta-item">
                      <ion-icon name="document-text-outline" aria-hidden="true"></ion-icon>

                      <span class="meta-text">2024</span>
                    </li>

                  </ul>

                </div>

              </div>
            </li>

            <li>
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 560; --height: 350;">
                  <img src="./assets/images/321457533_473837884940027_9167222114206703697_n.jpg" width="560" height="350" loading="lazy"
                    alt="Nullam id dolor elit id nibh" class="img-cover">
                </figure>

                <div class="card-content">

                  <h3 class="h3">
                    <a href="#" class="card-title">Option File 2024 (PS4/PS5) <i class="bi bi-controller"></i> </a>
                  </h3>

                  <p class="card-text">
                   Option File para pes 21 de la Liga profesional Boliviana temporada 2024.
                  </p>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="calendar-outline" aria-hidden="true"></ion-icon>

                      <time class="meta-text" datetime="2022-03-29">26 de marzo</time>
                    </li>

                    <li class="card-meta-item">
                      <ion-icon name="document-text-outline" aria-hidden="true"></ion-icon>

                      <span class="meta-text">2024</span>
                    </li>

                  </ul>

                </div>

              </div>
            </li>

            <li>
              <div class="project-card">

                <figure class="card-banner img-holder" style="--width: 560; --height: 350;">
                  <img src="./assets/images/206410617_321540949568074_6493306400761527042_n.jpg" width="560" height="350" loading="lazy"
                    alt="Ultricies fusce porta elit" class="img-cover">
                </figure>

                <div class="card-content">

                  <h3 class="h3">
                    <a href="#" class="card-title">Trabajos de Edición <i class="bi bi-tools"></i></a>
                  </h3>

                  <p class="card-text">
                    Aceptamos pedidos de Edicion , Estadios, FacesS ,  Scoreboards, Adboards, Menus, Kits , kits Referee .   
                  </p>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="calendar-outline" aria-hidden="true"></ion-icon>

                      <time class="meta-text" datetime="2022-02-26">26 de marzo</time>
                    </li>

                    <li class="card-meta-item">
                      <ion-icon name="document-text-outline" aria-hidden="true"></ion-icon>

                      <span class="meta-text">2024</span>
                    </li>

                  </ul>

                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #CTA
      -->

      <section class="cta" aria-label="call to action">
        <div class="container">

          <h4 class="h4 section-title">
            Queda totalmente Prohibido el uso de nuestro material y comercializacion sin nuestra autorización.
            Apoyemos la edicion Boliviana para que cada año sigamos dandoles el mejor contenido. 
            
            Son meses de trabajo.
          </h4>

          <a href="https://www.paypal.com/donate/?hosted_button_id=K3RC9SZV79NMW" class="btn btn-primary"><i class="bi bi-cup-hot"> Donar</i></a>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">
    <p >
      &copy; 2024 PESBOLIVIA.  Todos los Derechos Reservados.
    </p>

    <p>@leigles , je$u$s , j0s3</p>
  </footer>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Incluir JavaScript de Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>









  <script>
$(document).ready(function(){
    // Agregar evento de clic al enlace "Registrarse"
    $("#enlace-registrarse").click(function(event){
        event.preventDefault(); // Prevenir comportamiento predeterminado del enlace
        $("#h").removeClass("").addClass("modal-lg");
        $("#form-iniciar-sesion").removeClass("col-sm-12").addClass("col-sm-6"); // Reducir el espacio del formulario de inicio de sesión
        $("#formulario-registro").show(); // Mostrar el formulario de registro
        
    });
});
</script>

<script>
$(document).ready(function(){
    $('.fields').submit(function(e){
        e.preventDefault(); // Evita que el formulario se envíe de forma convencional
        
        // Obtener los valores del formulario
        var nombre = $('#nombre').val();
        var correo = $('#correo').val();
        var usuario = $('#usuario').val();
        var clave = $('#clave').val();
        var rol = $('#rol').val();
        
        // Enviar los datos mediante AJAX
        $.ajax({
            url: 'procesar_registro.php', // Ruta del archivo PHP para procesar el registro
            type: 'POST',
            data: {
                nombre: nombre,
                correo: correo,
                usuario: usuario,
                clave: clave,
                rol: rol
            },
            success: function(response){
                // Manejar la respuesta del servidor
                console.log(response); // Puedes hacer algo más con la respuesta si es necesario
                if(response === "Registro exitoso") {
                    toastr.success('Usuario registrado correctamente', 'Éxito');
                    $("#h").removeClass("").removeClass("modal-lg");
                    $("#form-iniciar-sesion").removeClass("col-sm-6").addClass("col-sm-12");
                    $("#formulario-registro").hide();
                    // Aquí podrías redirigir al usuario a otra página o realizar alguna otra acción
                } else {
                    toastr.error(response, 'Error');
                }
            },
            error: function(xhr, status, error){
                // Manejar errores
                console.error(error);
                toastr.error('Hubo un error al registrar el usuario. Por favor, inténtalo de nuevo.', 'Error');
            }
        });
    });
});

</script>

<script>
    // Función para actualizar el contador cada segundo
    function actualizarContador() {
        var fechaSalida = new Date("April 17, 2024 20:00:00").getTime(); // Fecha de salida
        var ahora = new Date().getTime(); // Fecha actual
        var diferencia = fechaSalida - ahora; // Diferencia de tiempo en milisegundos

        // Cálculos para obtener días, horas, minutos y segundos restantes
        var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
        var horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
        var segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

        // Mostrar el contador en el elemento con id "contador"
        document.getElementById("contador").innerHTML = "FECHA DE SALIDA :  17 de Abril /  " + dias + "d " + horas + "h "
        + minutos + "m " + segundos + "s " ;

        // Actualizar el contador cada segundo
        setTimeout(actualizarContador, 1000);
    }

    // Llamar a la función actualizarContador cuando se cargue la página
    window.onload = function() {
        actualizarContador();
    };
</script>



</body>

</html>