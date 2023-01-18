<div class="barra">
    <p>Hola: <span> <?php echo $nombre ?? ''; ?> </span> </p>

    <a class="boton" href="/logout">Cerrar Sesión</a>
</div>

<?php if( isset($_SESSION['admin']) ) : ?>
    <nav class="barra-servicios">
        <a class="boton-admin" href="/admin">Ver Citas</a>
        <a class="boton-admin" href="/servicios">Ver Servicios</a>
        <a class="boton-admin" href="/servicios/crear">Nuevo Servicio</a> 
    </nav>
<?php endif; ?>