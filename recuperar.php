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
<body>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Recuperar Contraseña</div>

                <div class="card-body">
                    <form id="form-recuperar-contrasena">
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Correo de Recuperación</button>
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
