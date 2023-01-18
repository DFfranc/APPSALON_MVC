<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php 
    include_once __DIR__ . '/../templates/alertas.php';

?>

<form class="formulario" method="POST"  action="/" >

    <div class="campo">
        <label for="email">E-mail</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu E-mail"
            name="email"
            value="<?php echo s($auth->email); ?>"
        >
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            placeholder="Tu Password"
            name="password"
        >
    </div>

    <div class="boton-derecha">
        <input type="submit" class="boton" value="Iniciar Sesión">
    </div>
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
    <a href="/restablecer">¿Olvidaste tu password? Restablecer</a>
</div>