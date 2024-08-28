<?php
include 'db_connect.php';

// Fetch all product data
$sql = "SELECT item, price, note, image FROM products";
$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($products);
?>
