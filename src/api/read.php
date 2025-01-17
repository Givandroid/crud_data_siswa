<?php

header('Access-Control-Allow-Origin: *');

// Allow specific HTTP methods
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// Allow headers
header('Access-Control-Allow-Headers: Content-Type');

include 'db.php';

// SQL query to fetch all data
$sql = "SELECT * FROM data";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Fetch all rows as associative array
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the data as JSON
echo json_encode($data);
?>
