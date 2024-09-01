<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>home</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>


	<!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <link rel="stylesheet" href="style.css">
	

</head>
<body>

<?php
include 'sidebar.php';
include '../main/db_connect.php';

// Fetch products (initial load)
$sql = "SELECT * FROM products"; // Ensure this matches your actual query
$result = $conn->query($sql);
?>

<!-- Search Bar -->
<div class="containersearch-btn d-flex justify-content-center align-items-center py-4">
    <form class="d-flex w-50" role="search" style="padding-top: 50px;" onsubmit="return false;">
        <input id="search-input" class="form-control me-2 text-dark" type="search" placeholder="Search" aria-label="Search">
        <!-- <button id="search-button" class="btn btn-outline-dark d-flex align-items-center" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
            <span class="ms-2 text-dark">Search</span>
        </button> -->
    </form>
</div>

<!-- Product List -->
<div class="container">
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
    </div>
</div>

<?php
$conn->close(); // Close the database connection
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    let typingTimer;
    const doneTypingInterval = 1000; // Time in milliseconds (1 second)

    // Function to fetch and display products based on search input
    function fetchProducts() {
        const searchQuery = searchInput.value.trim();
        fetch('search_product.php?search_query=' + encodeURIComponent(searchQuery))
            .then(response => response.json())
            .then(data => displayProducts(data))
            .catch(error => console.error('Error:', error));
    }

    // Function to display the products
    function displayProducts(products) {
        const container = document.getElementById('product-list');
        container.innerHTML = ''; // Clear existing products

        if (products.length > 0) {
            products.forEach(product => {
                const productHtml = `
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="card cards">
                            <img src="${product.image}" class="card-img-top img-fluid img-center" alt="${product.item}">
                            <div class="card-body">
                                <p class="card-title text-center text-dark">${product.item}</p>
                                <p class="card-text text-center text-dark">${product.price} KS</p>
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', productHtml);
            });
        } else {
            container.innerHTML = '<p class="text-dark">No products found.</p>';
        }
    }

    // Event listener for search input with a 1-second delay
    searchInput.addEventListener('input', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchProducts, doneTypingInterval); // 1-second delay after user stops typing
    });

    // Automatically fetch products every 1 second
    setInterval(fetchProducts, 1000);

    // Initial fetch to load products on page load
    fetchProducts();
});


</script>

  
	  <!-- Include jQuery, Popper.js, and Bootstrap JS -->
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>



  

    <!-- Custom JS -->
    <script src="../main/script.js"></script>
</body>
</html>