<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>new_product</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../main/style.css">
	

</head>
<body>

<?php 
include '../main/sidebar.php'; 
include '../main/db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $item = $_POST['item'];
        $price = $_POST['price'];
        $note = $_POST['note'];
        
        // Process file upload
        $imageFile = $_FILES["image"];
        $uploadDirectory = '../uploads/';
        $imagePath = $uploadDirectory . basename($imageFile["name"]);
        
        // Ensure the uploads directory exists and is writable
        if (!is_dir($uploadDirectory)) {
            if (!mkdir($uploadDirectory, 0755, true)) {
                die('Failed to create upload directory.');
            }
        }

        if (move_uploaded_file($imageFile["tmp_name"], $imagePath)) {
            // Create an image resource from the uploaded file
            $imgResource = imagecreatefromstring(file_get_contents($imagePath));
        
            if ($imgResource !== false) {
                // Set initial quality (this can be adjusted)
                $quality = 75;
        
                // Output buffer to hold the compressed image data
                ob_start();
                imagejpeg($imgResource, null, $quality);
                $imgContent = ob_get_contents();
                ob_end_clean();
        
                // Keep reducing quality until the file size is below 15 KiB
                while (strlen($imgContent) > 15 * 1024 && $quality > 10) {
                    $quality -= 5;
                    ob_start();
                    imagejpeg($imgResource, null, $quality);
                    $imgContent = ob_get_contents();
                    ob_end_clean();
                }
        
                // Free up memory
                imagedestroy($imgResource);
        
                // Escape the content to store in the database
                $imgContent = addslashes($imgContent);
        
                // Insert the product into the database
                $stmt = $conn->prepare("INSERT INTO products (item, price, note, image) VALUES (?, ?, ?, ?)");
                $stmt->bind_param('ssss', $item, $price, $note, $imgContent);
                
                if ($stmt->execute()) {
                    echo "Product added successfully.";
                    echo "<script>window.location.href='new_product.php'</script>";
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
                
                $stmt->close();
            } else {
                echo "Failed to process image.";
            }
        } else {
            echo "Failed to upload image. Error: " . error_get_last()['message'];
        }
    } else {
        echo "File upload error. Error code: " . $_FILES["image"]["error"];
    }
}
?>

<div class="container-fluid" style="padding-top: 15px;">
    <div class="d-flex justify-content-end">
        <a href="view_product.php"><button class="btn btn-primary" style="width: 150px; height: 40px;">View</button></a>
    </div>
</div>

<div class="container-fluid top-size">
    <form class="row" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to add?')" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="col-md-12">
            <label for="item" class="form-label">Product</label>
            <input type="text" class="form-control" id="item" name="item" required>
        </div>
        <div class="col-md-12">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>
        <div class="col-12">
            <label for="note" class="form-label">Note</label>
            <input type="text" class="form-control" id="note" name="note">
        </div>
        <div class="col-12">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="col-12 py-4 text-center">
            <button type="submit" class="btn btn-primary" style="width: 150px;">Add</button>
        </div>
    </form>
</div>


  
	  <!-- Include jQuery, Popper.js, and Bootstrap JS -->
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  

    <!-- Custom JS -->
    <script src="../main/script.js"></script>
</body>
</html>