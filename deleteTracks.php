<?php
session_start();
require_once "connection.php";
extract($_GET);
$session_name = $_SESSION['user_id'];
$sql = "DELETE FROM tracks WHERE username = ? AND track_id = ? AND date = ?";
$stmt = $con->prepare($sql);
if ($stmt === false) {
    echo json_encode(["msg" => "Error preparing statement: " . $con->error]);
} else {
    $result = $stmt->execute([$session_name, $track_id, $date]);
    if ($result) {
        echo json_encode(["msg" => "Sikeres torles"]);
    } else {
        echo json_encode(["msg" => "Sikertelen torles: " . $stmt->error]);
    }
    $stmt->close();
}
$con->close();
?>
