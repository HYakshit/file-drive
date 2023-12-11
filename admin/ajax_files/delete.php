<?php
require_once '../../database/countryClass.php';
$areaObj = new Area();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $data = explode('.',$_GET['table_index']);
    $tableName = $data[0];
    $index = $data[1];
    $delete = $areaObj->deleteRow($tableName, $index);
    echo $delete;
    exit;
    if($delete) {
        return true;
    }
    return false;
}
?>