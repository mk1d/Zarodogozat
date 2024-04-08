<?php
session_start();
include "connection.php";

extract($_POST);
extract($_SESSION);
$name = $_SESSION['user_id'];
$playlist_id = mysqli_real_escape_string($con, $playlist_id);
$description = mysqli_real_escape_string($con, $description);

$sql ="INSERT INTO playlists (playlist_id, username, description) VALUES ('$playlist_id', '$name', '$description')";

try {
    $stmt = $con->query($sql);
    if ($stmt) {
        echo json_encode(["msg" => "Sikeres mentes: $name $playlist_id"]);
    } else {
        echo json_encode(["msg" => "Sikertelen mentes: $name $playlist_id"]);
    }
} catch (Exception $e) {
    echo json_encode(["msg" => "Sikertelen mentes: $e $name $playlist_id"]);
}
?>
