<?php
include '../main/db_connect.php';

$searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Sanitize search query
$searchQuery = '%' . $conn->real_escape_string($searchQuery) . '%';

// Fetch products matching the search query
$sql = "SELECT * FROM products WHERE item LIKE ? OR note LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $searchQuery, $searchQuery);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

header('Content-Type: application/json');
echo json_encode($products);

$stmt->close();
?>
