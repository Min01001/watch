<?php
    include '../main/db_connect.php';

    // Fetch products (initial load)
    $sql = "SELECT * FROM products"; // Adjust this query as per your actual database structure
    $result = $conn->query($sql);
?>

<!-- Products display section -->
<div id="products-container" class="row">
    <?php
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
</div>

<!-- Custom CSS for equal card width and height -->
<style>
    .card {
        width: 350px;
        height: auto;
        margin: 10px;
    }

    .card-img-top {
        height: 300px;
        object-fit: cover;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .card-text {
        margin: 0;
        text-align: center;
    }
</style>

<!-- JavaScript for AJAX search and auto-refresh -->
<script>
    function fetchProducts() {
        // Send AJAX request to fetch products
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'fetch_products.php', true); // Ensure this is the correct path to your PHP file

        xhr.onload = function() {
            if (this.status === 200) {
                const productsContainer = document.getElementById('products-container');
                productsContainer.innerHTML = this.responseText; // Replace the content with new data
            }
        };

        xhr.send();
    }

    // Automatically fetch products every 1 second
    setInterval(fetchProducts, 1000);

    // Initial fetch to load products on page load
    fetchProducts();
</script>
