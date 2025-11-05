<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parent_name = $_POST['parent_name'];
    $student_name = $_POST['student_name'];
    $rating = intval($_POST['rating']);
    $testimonial = $_POST['testimonial'];
    $image_path = '';

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['image']['name'];
        $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $filesize = $_FILES['image']['size'];
        
        if (in_array($filetype, $allowed) && $filesize < 2097152) { // 2MB max
            $target_dir = "uploads/testimonials/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $image_path = $target_dir . time() . '_' . basename($filename);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_path)) {
                // success
            } else {
                header("Location: testimonials.php?error=2"); // 2 = image upload error
                exit();
            }
        }
    }

    $stmt = $conn->prepare("INSERT INTO testimonials (parent_name, student_name, testimonial, rating, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssís", $parent_name, $student_name, $testimonial, $rating, $image_path);

    if ($stmt->execute()) {
        header("Location: testimonials.php?success=1");
    } else {
        header("Location: testimonials.php?error=1");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: testimonials.php");
}
exit();
?>
