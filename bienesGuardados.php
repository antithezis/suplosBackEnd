<?php 
require_once("./db.php");

$selectBien = $connection->prepare("SELECT b.id, b.direccion, b.ciudad_id, b.telefono, b.codigo_postal, b.precio, b.bien_tipo_id, c.ciudad, bt.tipo FROM bien b 
    LEFT JOIN ciudad c on c.id = b.ciudad_id  
    LEFT JOIN bien_tipo bt on b.bien_tipo_id = bt.id
    WHERE b.guardado = 1 ;");

$selectBien->execute();
$listBienes = $selectBien->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['guardar'])){
    echo 'guardando';
}

?>

<div class="colContenido" id="divResultadosBusqueda">
    <div class="tituloContenido card" style="justify-content: center;">
        <h5>Bienes guardados: <?php echo count($listBienes) ?></h5>
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
                <form action="" method="post">
                    <a class="button" href="eliminarBien.php?id=<?php echo $bien['id'] ?>" >
                        Eliminar
                    </a>
                </form>
            </div>
        </div>
    </div>
<?php } ?>