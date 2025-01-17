<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

include 'db.php';


$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    $id = $data->id;

    $sql = "DELETE FROM data WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $sql_reset_auto_increment = "ALTER TABLE data AUTO_INCREMENT = 1";
        $pdo->exec($sql_reset_auto_increment);

        $sql_check_max_id = "SELECT MAX(id) AS max_id FROM data";
        $stmt_max_id = $pdo->query($sql_check_max_id);
        $max_id = $stmt_max_id->fetch(PDO::FETCH_ASSOC)['max_id'];

        if ($max_id) {
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
