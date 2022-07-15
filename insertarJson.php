<?php
require_once('./db.php');

function floatvalue($val)
{
    $val = preg_replace('([$])', '', $val);
    $val = str_replace(",", ".", $val);
    return floatval($val);
}

$json = file_get_contents('./data-1.json');
$data = json_decode($json, true);

foreach ($data as $row) {
    switch ($row['Ciudad']) {
        case 'New York':
            $ciudad_id = 1;
            break;
        case 'Orlando':
            $ciudad_id = 2;
            break;
        case 'Los Angeles':
            $ciudad_id = 3;
            break;
        case 'Houston':
            $ciudad_id = 4;
            break;
        case 'Washington':
            $ciudad_id = 5;
            break;
        case 'Miami':
            $ciudad_id = 6;
            break;
    }

    switch ($row['Tipo']) {
        case 'Casa':
            $bien_tipo_id = 1;
            break;
        case 'Casa de Campo':
            $bien_tipo_id = 2;
            break;
        case 'Apartamento':
            $bien_tipo_id = 3;
            break;
    }

    $id = $row['Id'];
    $direccion = $row['Direccion'];
    $telefono = $row['Telefono'];
    $codigo_postal = $row['Codigo_Postal'];
    $precio = floatvalue($row['Precio']);

    // echo $precio . '<br />';

    $query = $connection->prepare("INSERT INTO bien (id, direccion, ciudad_id, telefono, codigo_postal, bien_tipo_id, precio) 
    VALUES (:id, :direccion, :ciudad_id, :telefono, :codigo_postal, :bien_tipo_id, :precio)");

    $query->execute(array(
        ':id' => $id,
        ':direccion' => $direccion,
        ':ciudad_id' => $ciudad_id,
        ':telefono' => $telefono,
        ':codigo_postal' => $codigo_postal,
        ':bien_tipo_id' => $bien_tipo_id,
        ':precio' => $precio,

    ));
}

header("Location: index.php");
exit();