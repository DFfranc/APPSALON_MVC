<h1 class="nombre-pagina">Restablecer Password</h1>
<p class="descripcion-pagina">Restablece tu password escribiendo tu e-mail a continuación</p>

<?php 
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" method="POST" action="/restablecer">
    <div class="campo">
        <label for="email">E-mail</label>
        <input 
            type="email"
            id="email"
            name="email"
            placeholder="Tu Email">
    </div>

    <div class="boton-derecha">
        <input type="submit" class="boton" value="Enviar Instrucciones">
    </div>

    <div class="acciones">
        <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
        <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
    </div>
</form>