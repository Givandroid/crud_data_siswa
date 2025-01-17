<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

include 'db.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$status = $data->status;

if ($status !== 'Active' && $status !== 'Inactive') {
    echo json_encode(["message" => "Invalid status"]);
    exit();
}

$sql = "UPDATE data SET status = :status WHERE id = :id";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':status', $status);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    echo json_encode(["message" => "Client updated successfully"]);
} else {
    echo json_encode(["message" => "Failed to update client"]);
}

?>
