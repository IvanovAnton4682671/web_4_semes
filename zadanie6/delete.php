<?php
    $ID_Record = $_GET['id_record'];
    $user = 'u52864';
    $password = '3567354';
    $database = new PDO('mysql:host=localhost;dbname=u52864', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $result = $database -> exec("DELETE FROM Information WHERE ID_Record = '$ID_Record'");
    $result = $database -> exec("DELETE FROM Connection WHERE ID_Record = '$ID_Record'");
?>