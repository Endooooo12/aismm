<?php
include 'db.php';

$sql = "SELECT * FROM services";
$result = $conn->query($sql);

$services = [];
while ($row = $result->fetch_assoc()) {
    $services[] = $row;
}

echo json_encode(['status' => 'success', 'services' => $services]);
?>
