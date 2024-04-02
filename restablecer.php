<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
</head>
<body>

<h1>Restablecer Contraseña</h1>

<form id="form-restablecer-contrasena">
    <div>
        <label for="password">Nueva Contraseña</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="confirm_password">Confirmar Contraseña</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <button type="submit">Restablecer Contraseña</button>
</form>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Tu script personalizado -->
<script>
$(document).ready(function(){
    $('#form-restablecer-contrasena').submit(function(e){
        e.preventDefault(); // Evitar el envío convencional del formulario
        
        // Obtener los valores del formulario
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();
        
        // Verificar que las contraseñas coincidan
        if (password !== confirm_password) {
            alert('Las contraseñas no coinciden');
            return;
        }
        
        // Enviar la solicitud AJAX para restablecer la contraseña
        $.ajax({
            url: 'procesar_restablecimiento.php', // Ruta al archivo PHP que procesa el restablecimiento de contraseña
            type: 'POST',
            data: {
                password: password,
                confirm_password: confirm_password
            },
            success: function(response){
                alert(response); // Mostrar mensaje de éxito (puede ser un mensaje que envíes desde el servidor)
                // Redirigir al usuario a la página de inicio de sesión u otra página relevante
                window.location.href = 'index.php'; // Reemplaza 'pagina_de_inicio.php' con la URL de tu página de inicio
            },
            error: function(xhr, status, error){
                alert('Hubo un error al restablecer la contraseña. Por favor, inténtalo de nuevo.');
            }
        });
    });
});
</script>

</body>
</html>

