<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Incluir Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background-color:#2b2b2b">

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card" style="background-color: #1b1a18;color: white;">
                <div class="card-header">Recuperar Contraseña</div>
               
                    <div style="text-align: center;">
                    <img src="sistema/img/AIRPATCH.png" alt="" width="50%">
                    </div>
                <div class="card-body">
                    <form id="form-recuperar-contrasena">
                        <div class="form-group">
                            <label for="email">Correo Electrónico <span> </span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #01593b;border: none;width: 100%;">Enviar Correo de Recuperación</button> <br> <br>
                        <a style="color: aquamarine;float: right;" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
</svg> Volver Atras </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Incluir Toastr JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Incluir Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Tu script personalizado -->
<script>
$(document).ready(function(){
    $('#form-recuperar-contrasena').submit(function(e){
        e.preventDefault(); // Evita que el formulario se envíe de forma convencional
        
        var email = $('#email').val();
        
        // Realizar solicitud AJAX para enviar el correo de recuperación
        $.ajax({
            url: 'procesar_recuperacion.php', // Ruta al archivo PHP que procesa la recuperación de contraseña
            type: 'POST',
            data: {
                email: email
            },
            success: function(response){
                // Mostrar notificación Toastr de éxito
                toastr.success(response, 'Éxito');
                
                // Limpiar el campo de correo electrónico después de enviar el formulario
                $('#email').val('');
            },
            error: function(xhr, status, error){
                // Mostrar notificación Toastr de error
                toastr.error('Hubo un error al enviar el correo de recuperación. Por favor, inténtalo de nuevo.', 'Error');
            }
        });
    });
});
</script>

</body>
</html>
