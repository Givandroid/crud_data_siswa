<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

include 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->name, $data->email, $data->username, $data->telephone, $data->status)) {
    $name = $data->name;
    $email = $data->email;
    $username = $data->username;
    $telephone = $data->telephone;
    $status = $data->status;

    $sql = "INSERT INTO data (name, email, username, telephone, status) VALUES (:name, :email, :username, :telephone, :status)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Client added successfully"]);
    } else {
        echo json_encode(["message" => "Failed to add client"]);
    }
} else {
    echo json_encode(["message" => "Invalid data"]);
}
?>
