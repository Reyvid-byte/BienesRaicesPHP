<?php
require_once __DIR__ . '/../config/database.php';
$db = conectarDB();

$consulta = "SELECT * FROM propiedades ORDER BY id_propiedades DESC";

if (isset($limite)) {
    $consulta .= " LIMIT " . max(1, (int) $limite);
}

$resultado = mysqli_query($db, $consulta);
?>

<div class="contenedor-anuncios">
    <?php while ($propiedad = mysqli_fetch_assoc($resultado)): ?>
        <div class="anuncio">
            <img
                loading="lazy"
                src="/imagenes/<?php
                    echo htmlspecialchars(
                        $propiedad['imagen'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );
                ?>"
                alt="Fotografía de la propiedad"
            >

            <div class="contenido-anuncio">
                <h3>
                    <?php echo htmlspecialchars(
                        $propiedad['titulo'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>
                </h3>

                <p>
                    <?php echo htmlspecialchars(
                        $propiedad['descripcion'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>
                </p>

                <p class="precio">
                    $<?php echo number_format(
                        (float) $propiedad['precio'],
                        2
                    ); ?>
                </p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img
                            class="icono"
                            src="/build/img/icono_wc.svg"
                            alt="Baños"
                        >
                        <p><?php echo (int) $propiedad['wc']; ?></p>
                    </li>

                    <li>
                        <img
                            class="icono"
                            src="/build/img/icono_estacionamiento.svg"
                            alt="Estacionamientos"
                        >
                        <p>
                            <?php echo (int) $propiedad['estacionamientos']; ?>
                        </p>
                    </li>

                    <li>
                        <img
                            class="icono"
                            src="/build/img/icono_dormitorio.svg"
                            alt="Habitaciones"
                        >
                        <p>
                            <?php echo (int) $propiedad['habitaciones']; ?>
                        </p>
                    </li>
                </ul>

                <a
                    href="/anuncio.php?id=<?php
                        echo (int) $propiedad['id_propiedades'];
                    ?>"
                    class="boton-amarillo-block"
                >
                    Ver Propiedad
                </a>
            </div>
        </div>
    <?php endwhile; ?>
</div>