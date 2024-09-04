<?php
    include '../main/db_connect.php';

    // Fetch products
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($product = $result->fetch_assoc()) {
            echo '<div class="col-lg-3 col-sm-6 col-md-4 mb-3 mb-md-0 d-flex justify-content-center">';
            echo '  <div class="card bg-black text-white">';

            // Display image
            if (!empty($product['image'])) {
                echo '    <img src="' . htmlspecialchars($product['image']) . '" class="card-img-top img-fluid img-center" alt="' . htmlspecialchars($product['item']) . '">';
            } else {
                echo '    <img src="../path/to/default-image.jpg" class="card-img-top" alt="No Image">';
            }

            echo '    <div class="card-body">';
            echo '      <h4 class="text-light">' . htmlspecialchars($product['item']) . '</h4>';
            echo '      <h5 class="text-primary"><strong>' . number_format($product['price']) . ' KS</strong></h5>';
            echo '    </div>';
            echo '    <a class="stretched-link" href="#"></a>';
            echo '  </div>';
            echo '</div>';
        }
    } else {
        echo '<p class="text-center text-white">No products available.</p>';
    }
?>
