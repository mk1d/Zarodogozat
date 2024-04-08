<?php
session_start();
require_once "connection.php";
$session_name = $_SESSION['user_id'];
$sql = "SELECT playlists.playlist_id, playlists.date, playlists.description FROM playlists WHERE ? = playlists.username";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $session_name);
$stmt->execute();
$result = $stmt->get_result();
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
$stmt->close();
$con->close();
?>
