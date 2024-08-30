<?php
include '../main/db_connect.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    // Retrieve the image path from the database
    $sql = "SELECT image FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $imagePath = $row['image'];

        // Delete the product record
        $sql = "DELETE FROM products WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Delete the image file from the server
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            echo "<script>window.location.href='view_product.php';</script>";
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
    } else {
        echo "Product not found.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No product ID provided.";
}
?>
