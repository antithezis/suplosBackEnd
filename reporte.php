<?php
require_once('./db.php');


$selectCiudad = $connection->prepare("SELECT * FROM ciudad");
$selectCiudad->execute();
$listCiudades = $selectCiudad->fetchAll(PDO::FETCH_ASSOC);

$selectTipo = $connection->prepare("SELECT * FROM bien_tipo");
$selectTipo->execute();
$listTipos = $selectTipo->fetchAll(PDO::FETCH_ASSOC);

?>
<form action="exportExcel.php" method="post">

    <div class="colContenido" id="divResultadosBusqueda">
        <div class="tituloContenido card">
            <h5>Exportar reporte:</h5>
            <div class="filtroCiudad input-field">
                <p><label for="selectCiudad">Ciudad:</label><br></p>
                <select name="ciudad" id="selectCiudad">
                    <option value="" selected>Elige una ciudad</option>
                    <?php
                    foreach ($listCiudades as $ciudad) { ?>
                        <option value=<?php echo $ciudad['id']; ?>> <?php echo $ciudad['ciudad']; ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="filtroTipo input-field">
                <p><label for="selecTipo">Tipo:</label></p>
                <br>
                <select name="tipo" id="selectTipo">

                    <option value=""> Elige un tipo </option>

                    <?php
                    foreach ($listTipos as $tipo) { ?>
                        <option value=<?php echo $tipo['id']; ?>> <?php echo $tipo['tipo']; ?> </option>
                    <?php } ?>
                </select>
            </div>
            <button name="exportar" class="button">
                Eliminar
            </button>
        </div>
    </div>
</form>