<?php
session_start();
include "connection.php";

extract($_POST);
extract($_SESSION);
$name = $_SESSION['user_id'];
$sql ="INSERT INTO tracks (track_id, username) VALUES ('{$track_id}',{$name})";

try {
    $stmt = $con -> query($sql);
    echo json_encode(["msg" => "sikeres mentes: {$name} {$track_id}"]);

} catch (Exception $e) {
    echo json_encode(["msg" => "sikertelen mentes:   {$e} {$name} {$track_id}"]);

}
?>