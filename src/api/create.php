<?php

header('Access-Control-Allow-Origin: *');

// Allow specific HTTP methods
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// Allow headers
header('Access-Control-Allow-Headers: Content-Type');

include 'db.php';

// Get the POST data
$data = json_decode(file_get_contents("php://input"));

// Validate the data
if (isset($data->name, $data->email, $data->username, $data->telephone, $data->status)) {
    $name = $data->name;
    $email = $data->email;
    $username = $data->username;
    $telephone = $data->telephone;
    $status = $data->status;

    // SQL query to insert data into the database
    $sql = "INSERT INTO data (name, email, username, telephone, status) VALUES (:name, :email, :username, :telephone, :status)";
    $stmt = $pdo->prepare($sql);
    
    // Bind the parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':status', $status);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["message" => "Client added successfully"]);
    } else {
        echo json_encode(["message" => "Failed to add client"]);
    }
} else {
    echo json_encode(["message" => "Invalid data"]);
}
?>
