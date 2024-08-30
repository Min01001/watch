<?php
include '../main/db_connect.php'; // Adjust the path as needed

// Retrieve the search query from the request
$search_query = isset($_GET['search_query']) ? $conn->real_escape_string($_GET['search_query']) : '';

// SQL query to search for products
$sql = "SELECT * FROM products WHERE item LIKE '%$search_query%'";

// Execute the query
$result = $conn->query($sql);

// Prepare an array to store products
$products = [];

if ($result->num_rows > 0) {
    // Fetch the data and populate the array
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['id'],
            'image' => $row['image'],
            'item' => $row['item'],
            'price' => $row['price']
        ];
    }
}

// Set the content type to JSON and return the data
header('Content-Type: application/json');
echo json_encode($products);

// Close the database connection
$conn->close();
?>
