<?php

header('Access-Control-Allow-Origin: *');

// Allow specific HTTP methods
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// Allow headers
header('Access-Control-Allow-Headers: Content-Type');

include 'db.php';

// Get the POST data
$data = json_decode(file_get_contents("php://input"));

// Validate the ID
if (isset($data->id)) {
    $id = $data->id;

    // SQL query to delete the record
    $sql = "DELETE FROM data WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Bind the ID
    $stmt->bindParam(':id', $id);

    // Execute the query
    if ($stmt->execute()) {
        // Reset the AUTO_INCREMENT value to the correct number after deletion
        $sql_reset_auto_increment = "ALTER TABLE data AUTO_INCREMENT = 1";
        $pdo->exec($sql_reset_auto_increment);

        // Recalculate the correct AUTO_INCREMENT
        $sql_check_max_id = "SELECT MAX(id) AS max_id FROM data";
        $stmt_max_id = $pdo->query($sql_check_max_id);
        $max_id = $stmt_max_id->fetch(PDO::FETCH_ASSOC)['max_id'];

        if ($max_id) {
            // Set the next AUTO_INCREMENT value to the max_id + 1
            $sql_set_auto_increment = "ALTER TABLE data AUTO_INCREMENT = " . ($max_id + 1);
            $pdo->exec($sql_set_auto_increment);
        }

        echo json_encode(["message" => "Client deleted successfully"]);
    } else {
        echo json_encode(["message" => "Failed to delete client"]);
    }
} else {
    echo json_encode(["message" => "Invalid data"]);
}
?>
