<?php
function registerUser($username, $password, $email, $file) {
    include 'db.php';

    // You should use prepared statements to prevent SQL injection
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $hashedPassword, $email);
    $stmt->execute();
    $stmt->close();

    // Move uploaded file to the 'uploads' directory
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($file["name"]);

    move_uploaded_file($file["tmp_name"], $targetFile);
}

function loginUser($username, $password) {
    include 'db.php';

    // You should use prepared statements to prevent SQL injection
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($userId, $hashedPassword);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION["user_id"] = $userId;
            return true;
        }
    }

    return false;
}

function isLoggedIn() {
    session_start();
    return isset($_SESSION["user_id"]);
}

function uploadFile($file) {
    // Move the file to the 'uploads' directory
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($file["name"]);

    move_uploaded_file($file["tmp_name"], $targetFile);

    return $targetFile;
}
?>