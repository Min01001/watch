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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="../main/style.css">
 
	

</head>

<style>
body{
    background-color: black;
}

.bg-holder {
    background-image: url('../assets/header-bg.png');
    background-position: right top;
    background-size: contain; /* Adjust size as needed */
    background-repeat: no-repeat;
    height: 500px; /* Adjust height as needed */
    width: 100%; /* Ensures it spans the full width */

    
}

.second-image {
    background-image: url('../assets/store-bg.png');
    background-position: left top;
    background-size: contain; /* Adjust size as needed */
    background-repeat: no-repeat;
    height: 500px; /* Adjust height as needed */
    width: 100%; /* Ensures it spans the full width */


    
}


h3{
    font-size: 70px;
    color: white;
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}

h2{
    font-size: 30px;
    color: white;
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}

.btn-outline-light {
            border-color: white;
            color: white;
            background-color: transparent;
            border-radius: 4px;
            padding: 8px 16px;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: black;
        }

</style>

<body>

        <?php
        include '../main/sidebar.php';


        // Fetch products (initial load)

        ?>

    <div class="container-fluid">
        <section>
            <div class="bg-holder"></div>
        </section>
        <div class="position-relative" style="top: -480px; left: 50px;">
            <h3>CUSTOM WATCHES <br> FOR ANY <br> OCCASION</h3>
            <div class="d-flex justify-content-start mt-3">
                <button class="btn btn-outline-light">DESIGN & ORDER</button>
                <button class="btn btn-outline-light ms-3 mx-3">DESIGN & ORDER</button>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <section>
            <div class="second-image"></div>
        </section>
        <div class="position-relative" style="top: -480px; left: 50px;">
            <h2>CUSTOM WATCHES <br> FOR ANY <br> OCCASION</h2>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam dolore eaque libero, autem modi labore eum atque ipsum at delectus quibusdam suscipit, soluta ipsam nostrum quasi sunt recusandae architecto nobis?</p>
        </div>
    </div>




  
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