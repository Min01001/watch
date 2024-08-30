<?php
include '../main/db_connect.php';

// Get the search query from the request
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Prepare the SQL query to search for products
$sql = "SELECT * FROM products WHERE item LIKE ?";

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
$search_param = "%" . $search_query . "%";
$stmt->bind_param('s', $search_param);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = [
        'id' => $row['id'],
        'item' => htmlspecialchars($row['item'], ENT_QUOTES, 'UTF-8'),
        'price' => number_format($row['price']),
        'image' => 'get_image.php?id=' . $row['id'] // Adjust if image URL handling is different
    ];
}

// Return the results as JSON
header('Content-Type: application/json');
echo json_encode($products);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
