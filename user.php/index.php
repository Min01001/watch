<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>home</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../main/style.css">
	

</head>
<body>

<?php include '../main/sidebar.php'; ?>

<!-- ================== search bar start =================================== -->
<div class="container-fluid search-btn d-flex justify-content-center align-items-center">
    <form class="d-flex w-50" role="search" style="padding-top: 50px;" onsubmit="return false;">
        <input id="search-input" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button id="search-button" class="btn btn-outline-dark d-flex align-items-center" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
            <span class="ms-2 text-dark">Search</span>
        </button>
    </form>
</div>

<!-- ================== search bar end =================================== -->

<!-- Product List -->
 
<div class="container-fluid">
    <div class="row justify-content-center" id="product-list" style="padding-top: 60px;">
        <!-- Product cards will be dynamically injected here -->
    </div>
</div>

<!-- ================== Script for Search and Auto Refresh ================== -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    let allProducts = [];

    // Function to fetch and display products
    function fetchProducts() {
        $.getJSON('search_product.php')
            .done(function(data) {
                allProducts = data;
                displayProducts(allProducts); // Display all products
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching products:', textStatus, errorThrown);
                $('#product-list').html('<p>An error occurred while fetching products.</p>');
            });
    }

    // Function to display products dynamically
    function displayProducts(products) {
        const productList = $('#product-list');
        productList.empty(); // Clear the product list before updating

        if (products.length > 0) {
            products.forEach(product => {
                productList.append(`
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="card cards">
                            <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                <img src="${product.image}" class="card-img-top img-fluid img-center" alt="${product.item}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-text text-center">${product.item}</h5>
                                <p class="card-text text-center"><strong>${parseInt(product.price).toLocaleString()} KS</strong></p>
                            </div>
                        </div>
                    </div>
                `);
            });
        } else {
            productList.append('<p>No products found.</p>');
        }
    }

    // Search function triggered by typing in the search bar
    $('#search-input').on('input', function() {
        const searchText = $(this).val().toLowerCase();

        // Filter the products based on search input
        const filteredProducts = allProducts.filter(product =>
            product.item.toLowerCase().includes(searchText)
        );

        // Display the filtered products
        displayProducts(filteredProducts);
    });

    // Fetch products every 1 second (1000 milliseconds)
    setInterval(fetchProducts, 1000);

    // Initial fetch
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