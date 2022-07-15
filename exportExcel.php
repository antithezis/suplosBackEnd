<?php

require_once('./db.php');

header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=documento_exportado_" .        date('Y:m:d:m:s').".xls");
header("Pragma: no-cache"); 
header("Expires: 0");

$tipoFiltro = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$ciudadFiltro = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;

if ($tipoFiltro != null and $ciudadFiltro != null) {
    $selectBien = $connection->prepare("SELECT b.id, b.direccion, b.ciudad_id, b.telefono, b.codigo_postal, b.precio, b.bien_tipo_id, c.ciudad, bt.tipo FROM bien b 
    LEFT JOIN ciudad c on c.id = b.ciudad_id  
    LEFT JOIN bien_tipo bt on b.bien_tipo_id = bt.id
    WHERE b.ciudad_id = '$ciudadFiltro' AND b.bien_tipo_id = '$tipoFiltro';");
} elseif ($tipoFiltro == null and $ciudadFiltro != null) {
    $selectBien = $connection->prepare("SELECT b.id, b.direccion, b.ciudad_id, b.telefono, b.codigo_postal, b.precio, b.bien_tipo_id, c.ciudad, bt.tipo FROM bien b 
    LEFT JOIN ciudad c on c.id = b.ciudad_id  
        LEFT JOIN bien_tipo bt on b.bien_tipo_id = bt.id
        WHERE b.ciudad_id = '$ciudadFiltro';");
} elseif ($tipoFiltro != null and $ciudadFiltro == null) {
    $selectBien = $connection->prepare("SELECT b.id, b.direccion, b.ciudad_id, b.telefono, b.codigo_postal, b.precio, b.bien_tipo_id, c.ciudad, bt.tipo FROM bien b 
    LEFT JOIN ciudad c on c.id = b.ciudad_id  
        LEFT JOIN bien_tipo bt on b.bien_tipo_id = bt.id
        WHERE b.bien_tipo_id = '$tipoFiltro'");
} else {
    $selectBien = $connection->prepare("SELECT b.id, b.direccion, b.ciudad_id, b.telefono, b.codigo_postal, b.precio, b.bien_tipo_id, c.ciudad, bt.tipo FROM bien b 
    LEFT JOIN ciudad c on c.id = b.ciudad_id  
    LEFT JOIN bien_tipo bt on bt.id = b.bien_tipo_id;");
}

$selectBien->execute();
$listBienes = $selectBien->fetchAll(PDO::FETCH_ASSOC);

?>

<table>
    <tr>
        <th> ID  </th>
        <th> Direccion  </th>
        <th> Ciudad  </th>
        <th> Telefono  </th>
        <th> Codigo Postal  </th>
        <th> Tipo  </th>
        <th> Precio  </th>
    </tr>

    <?php
    foreach ($listBienes as $bien) { ?>
        <tr>    
            <td> <?php echo $bien['id'] ?></td>
            <td> <?php echo $bien['direccion'] ?></td>
            <td> <?php echo $bien['ciudad'] ?></td>
            <td> <?php echo $bien['telefono'] ?></td>
            <td> <?php echo $bien['codigo_postal'] ?></td>
            <td> <?php echo $bien['tipo'] ?></td>
            <td> <?php echo $bien['precio'] ?></td>
        </tr>
        <?php } ?>
</table>

