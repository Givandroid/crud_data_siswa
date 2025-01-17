<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

include 'db.php';


$sql = "SELECT * FROM data";
$stmt = $pdo->prepare($sql);
$stmt->execute();


$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($data);
?>
