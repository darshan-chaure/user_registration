<?php session_start(); ?>
<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['image'])) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        $uploadFile_1 = $uploadDir . basename($_SESSION['id'] . ".jpg");

        // Check if the file is an image
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo json_encode(['success' => false, 'error' => 'Only image files are allowed.']);
            exit;
        }
        // Check if the file size is less than 2 MB
        // if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
        //     echo json_encode(['success' => false, 'error' => 'File size should be less than 2 MB.']);
        //     exit;
        // }

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile_1)) {
            echo json_encode(['success' => true, 'filePath' => $uploadFile_1]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error uploading file.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No file uploaded.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request.']);
}
?>