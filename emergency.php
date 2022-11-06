<?php
include 'conn.php';
//$id = $_GET['id'];

$message['ambulances'] = "01116603186";
$message['police'] = "01116602971";
$message['fire'] = "01155709055";
$message['city'] = "0226940834";

echo json_encode($message)
?>