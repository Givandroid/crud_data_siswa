<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

include 'db.php';

// Get the POST data
$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$status = $data->status; // 'Active' or 'Inactive'

// Ensure the status is valid (either 'Active' or 'Inactive')
if ($status !== 'Active' && $status !== 'Inactive') {
    echo json_encode(["message" => "Invalid status"]);
    exit();
}

// SQL query to update the status
$sql = "UPDATE data SET status = :status WHERE id = :id";
$stmt = $pdo->prepare($sql);

// Bind parameters
$stmt->bindParam(':status', $status);
$stmt->bindParam(':id', $id);

// Execute the query
if ($stmt->execute()) {
    echo json_encode(["message" => "Client updated successfully"]);
} else {
    echo json_encode(["message" => "Failed to update client"]);
}

?>
