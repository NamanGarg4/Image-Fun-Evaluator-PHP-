<?php
session_start();

if(isset($_FILES['image']) && isset($_POST['categories'])){
    $categories = $_POST['categories'];
    $uploadDir = 'uploads/';

    // Create uploads folder if it doesn't exist
    if(!is_dir($uploadDir)){
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['image']['name']);
    $targetFile = $uploadDir . time() . "_" . $fileName;

    // Validate and move uploaded file
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if(in_array($fileType, $allowedTypes)){
        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)){
            // Generate random ratings
            $ratings = [];
            foreach($categories as $category){
                $ratings[$category] = rand(1,10);
            }

            $_SESSION['image_path'] = $targetFile;
            $_SESSION['ratings'] = $ratings;
            header('Location: index.php');
            exit;
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Invalid file type. Only JPG, PNG, GIF allowed.";
    }
} else {
    echo "Please select an image and at least one category.";
}
?>
