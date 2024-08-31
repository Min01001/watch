<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<!-- Custom CSS -->
    <link rel="stylesheet" href="../main/style.css">
</head>
<body>

<?php
include '../main/sidebar.php';
include '../main/db_connect.php';

// Correct SQL query
$sql = "SELECT * FROM products";

// Execute the query
$result = $conn->query($sql);
?>

<div class="container-fluid" style="padding-top: 15px;">
    <div class="d-flex justify-content-start">
        <a href="new_product.php">
            <button class="btn btn-primary" style="width: 150px; height: 40px;">
                <i class="fas fa-arrow-left"></i> Back
            </button>
        </a>
    </div>
</div>

<!-- Product List -->
<div class="container-fluid">
    <div class="row justify-content-center" id="product-list" style="padding-top: 60px;">
    <?php
if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        echo '<div class="col-6 col-sm-4 col-md-3 col-lg-2">';
        echo '    <div class="card cards">';
        echo '        <div class="d-flex justify-content-center align-items-center" style="height: 200px;">';

        // Use the file path directly if the image is stored as a path
        if (!empty($product['image'])) {
            echo '            <img src="' . $product['image'] . '" class="card-img-top img-fluid img-center" alt="' . $product['item'] . '">';
        } else {
            echo '            <img src="../path/to/default-image.jpg" class="card-img-top img-fluid img-center" alt="No Image">';
        }

        echo '        </div>';
        echo '        <div class="card-body">';
        echo '            <h5 class="card-text text-center">' . $product['item'] . '</h5>';
        echo '            <p class="card-text text-center"><strong>' . number_format($product['price']) . ' KS</strong></p>';
        echo '        </div>';
        echo '        <div class="d-flex justify-content-center">';
        echo '            <form method="POST" onsubmit="return confirm(\'Are you sure you want to delete?\')" action="delete.php">';
        echo '                <input type="hidden" name="id" value="' . $product['id'] . '">';
        echo '                <button type="submit" class="btn btn-danger btn-sm">Delete</button>';
        echo '            </form>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo '<p>No products found</p>';
}
?>

<!-- ================== Script for Search and Auto Refresh ================== -->

<!-- Include jQuery, Popper.js, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom JS -->
<script src="../main/script.js"></script>
</body>
</html>
