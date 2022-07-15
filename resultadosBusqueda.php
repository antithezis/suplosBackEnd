<?php

require_once("./db.php");
include('./header.php');

$tipoFiltro = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$ciudadFiltro = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;
$rangoPrecio = isset($_POST['precio']) ? explode(';', $_POST['precio']) : explode(';', '0;50');
$rangoPrecio = array_map('intval', $rangoPrecio);

// echo ($rangoPrecio[0]) . '-' . $rangoPrecio[1];

if ($tipoFiltro != null and $ciudadFiltro != null) {
    $selectBien = $connection->prepare("SELECT b.id, b.direccion, b.ciudad_id, b.telefono, b.codigo_postal, b.precio, b.bien_tipo_id, b.guardado, c.ciudad, bt.tipo FROM bien b 
    LEFT JOIN ciudad c on c.id = b.ciudad_id  
    LEFT JOIN bien_tipo bt on b.bien_tipo_id = bt.id
    WHERE b.ciudad_id = '$ciudadFiltro' AND b.bien_tipo_id = '$tipoFiltro'
    AND b.precio BETWEEN '$rangoPrecio[0]' AND $rangoPrecio[1];");
} elseif ($tipoFiltro == null and $ciudadFiltro != null) {
    $selectBien = $connection->prepare("SELECT b.id, b.direccion, b.ciudad_id, b.telefono, b.codigo_postal, b.precio, b.bien_tipo_id, b.guardado, c.ciudad, bt.tipo FROM bien b 
    LEFT JOIN ciudad c on c.id = b.ciudad_id  
        LEFT JOIN bien_tipo bt on b.bien_tipo_id = bt.id
        WHERE b.ciudad_id = '$ciudadFiltro'
        AND b.precio BETWEEN '$rangoPrecio[0]' AND $rangoPrecio[1];");
} elseif ($tipoFiltro != null and $ciudadFiltro == null) {
    $selectBien = $connection->prepare("SELECT b.id, b.direccion, b.ciudad_id, b.telefono, b.codigo_postal, b.precio, b.bien_tipo_id, b.guardado, c.ciudad, bt.tipo FROM bien b 
    LEFT JOIN ciudad c on c.id = b.ciudad_id  
        LEFT JOIN bien_tipo bt on b.bien_tipo_id = bt.id
        WHERE b.bien_tipo_id = '$tipoFiltro'
        AND b.precio BETWEEN '$rangoPrecio[0]' AND $rangoPrecio[1]");
} else {
    $selectBien = $connection->prepare("SELECT b.id, b.direccion, b.ciudad_id, b.telefono, b.codigo_postal, b.precio, b.bien_tipo_id, b.guardado, c.ciudad, bt.tipo FROM bien b 
    LEFT JOIN ciudad c on c.id = b.ciudad_id  
    LEFT JOIN bien_tipo bt on bt.id = b.bien_tipo_id
    WHERE b.precio BETWEEN $rangoPrecio[0] AND $rangoPrecio[1];");
}

$selectBien->execute();
$listBienes = $selectBien->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="colContenido" id="divResultadosBusqueda">
    <div class="tituloContenido card" style="justify-content: center;">
        <h5>Resultados de la búsqueda: <?php echo count($listBienes) ?></h5>
    </div>
</div>

<?php
foreach ($listBienes as $bien) { ?>
    <div class="colContenido" id="divResultadosBusqueda">
        <div class="tituloContenido card">
            <img class="homeImg" src="./img/home.jpg" alt="">
            <div style="float: right;">
                <p>
                    <b>Direccion:</b> <?php echo $bien['direccion'] ?>
                </p>
                <p>
                    <b>Ciudad:</b> <?php echo $bien['ciudad'] ?>
                </p>
                <p>
                    <b>Teléfono:</b> <?php echo $bien['telefono'] ?>
                </p>
                <p>
                    <b>Código Postal:</b> <?php echo $bien['codigo_postal']; ?>
                </p>
                <p>
                    <b>Tipo:</b> <?php echo $bien['tipo'] ?>
                </p>
                <p>
                    <b>Precio:</b> $<?php echo $bien['precio'] ?>
                </p>
                <form action="guardarBien.php" method="post">
                    <?php
                    if ($bien['guardado'] != 1) { ?>
                        <a class="button" href="guardarBien.php?id=<?php echo $bien['id'] ?>">
                            GUARDAR
                        </a>
                    <?php } ?>


                </form>
            </div>
        </div>
    </div>
<?php } ?>