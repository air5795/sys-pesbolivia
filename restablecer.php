<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Incluir Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Restablecer Contraseña</div>

                <div class="card-body">
                    <form id="form-restablecer-contrasena">
                        <div class="form-group">
                            <label for="password">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            <input type="hidden" id="email" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
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
    $('#form-restablecer-contrasena').submit(function(e){
        e.preventDefault(); // Evitar el envío convencional del formulario
        
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        
        if (password !== confirm_password) {
            // Mostrar notificación Toastr de error si las contraseñas no coinciden
            toastr.error('Las contraseñas no coinciden', 'Error');
            return;
        }
        
        // Realizar solicitud AJAX para restablecer la contraseña
        $.ajax({
            url: 'procesar_restablecimiento.php',
            type: 'POST',
            data: {
                email: $('#email').val(), // Obtener el valor del campo oculto
                password: password,
                confirm_password: confirm_password
            },
            success: function(response){
                // Mostrar notificación Toastr de éxito
                toastr.success(response, 'Éxito');
                
                // Limpiar los campos de contraseña después de restablecer
                $('#password').val('');
                $('#confirm_password').val('');
                
                // Redirigir al usuario a la página index.php después de 2 segundos
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 2000);
            },
            error: function(xhr, status, error){
                // Mostrar notificación Toastr de error si ocurre algún problema
                toastr.error('Hubo un error al restablecer la contraseña. Por favor, inténtalo de nuevo.', 'Error');
            }
        });
    });
});
</script>


</body>
</html>
