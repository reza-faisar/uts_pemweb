<?php
require './../config/db.php';

if (isset($_POST['submit'])) {
    global $db_connect;

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];

    // Define the upload directory
    $uploadDir = __DIR__ . '/../upload/';


    // Create the directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $randomFilename = time() . '-' . md5(rand()) . '-' . $image;

    $uploadPath = $uploadDir . $randomFilename;

    if (move_uploaded_file($tempImage, $uploadPath)) {
        mysqli_query($db_connect, "INSERT INTO products (name, price, image) VALUES ('$name', '$price', 'upload/$randomFilename')");
        echo "berhasil upload";
    } else {
        echo "gagal upload";
    }
}
?>