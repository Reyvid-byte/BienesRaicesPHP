<?php
require_once __DIR__ . '/../includes/funciones.php';

if (!estaAutenticado()) {
    header('Location: /login.php');
    exit;
}

require_once __DIR__ . '/../includes/config/database.php';
$db = conectarDB();

$propiedades = mysqli_query(
    $db,
    "SELECT * FROM propiedades ORDER BY id_propiedades DESC"
);
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrar propiedades</h1>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">
        Crear propiedad
    </a>

    <a href="/index.php" class="boton boton-amarillo">
        Ver página principal
    </a>

    <?php if (($_GET['resultado'] ?? '') === '1'): ?>
    <p class="alerta exito">
        Propiedad creada correctamente.
    </p>
<?php elseif (($_GET['resultado'] ?? '') === '2'): ?>
    <p class="alerta exito">
        Propiedad actualizada correctamente.
    </p>
<?php elseif (($_GET['resultado'] ?? '') === '3'): ?>
    <p class="alerta exito">
        Propiedad eliminada correctamente.
    </p>
<?php endif; ?>
    <?php if (mysqli_num_rows($propiedades) === 0): ?>
        <p>Todavía no hay propiedades. Presiona “Crear propiedad”.</p>
    <?php else: ?>
        <table class="propiedades" style="width:100%; margin-top:3rem;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($propiedad = mysqli_fetch_assoc($propiedades)): ?>
                    <tr>
                        <td>
                            <?php echo (int) $propiedad['id_propiedades']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars(
                                $propiedad['titulo'] ?? '',
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>
                        </td>

                        <td>
                            $<?php echo number_format(
                                (float) $propiedad['precio'],
                                2
                            ); ?>
                        </td>

                        <td>
                            <a
                                href="/admin/propiedades/actualizar.php?id=<?php
                                    echo (int) $propiedad['id_propiedades'];
                                ?>"
                                class="boton boton-amarillo"
                            >
                                Actualizar
                            </a>
                            <form
    action="/admin/propiedades/borrar.php"
    method="POST"
    onsubmit="return confirm('¿Deseas eliminar esta propiedad?');"
>
    <input
        type="hidden"
        name="id"
        value="<?php echo (int) $propiedad['id_propiedades']; ?>"
    >

    <input
        type="hidden"
        name="csrf"
        value="<?php echo htmlspecialchars($_SESSION['csrf']); ?>"
    >

    <button
        type="submit"
        class="boton"
        style="background:#c62828; color:white; border:none; cursor:pointer;"
    >
        Eliminar propiedad
    </button>
</form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>

<?php incluirTemplate('footer'); ?>