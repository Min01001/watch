<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>new_product</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
	

</head>
<body>

	<?php include 'sidebar.php'; 

     include 'db_connect.php'; 

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {


            $item = $_POST['item'];
            $price = $_POST['price'];
            $note = $_POST['note'];


            // Handle file upload
            $target_dir = "uploads/"; // Make sure this directory exists and is writable
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is an actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["image"]["size"] > 500000) { // 500KB limit
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // File uploaded successfully, now insert into database
                    $stmt = $conn->prepare("INSERT INTO products (item, price, note, image) VALUES ( ?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $item, $price, $note, $target_file);

                    if ($stmt->execute()) {
                        echo "<script>window.location.href='new_product.php';</script>";
                        echo "New record added";
                    } else {
                        echo "Something went wrong: " . $stmt->error;
                    }

                    $stmt->close();
                    $conn->close();
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        ?>

	  <div class="container-fluid top-size">

        <form class="row" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to add')" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="col-md-12">
                <label for="item" class="form-label">Product</label>
                <input type="text" class="form-control" id="item" name="item">
            </div>
            <div class="col-md-12">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>
            <div class="col-12">
                <label for="note" class="form-label">Note</label>
                <input type="text" class="form-control" id="note" name="note">
            </div>
            <div class="col-12">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="col-12 py-4 text-center">
                <button type="submit" class="btn btn-primary" style="width: 150px;" name="submit">Add</button>
            </div>
        </form>

	</div>



  
	  <!-- Include jQuery, Popper.js, and Bootstrap JS -->
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  

    <!-- Custom JS -->
    <script src="script.js"></script>
</body>
</html>