<?php
// Database connection
$servername = "localhost";
$username   = "root";   // default XAMPP
$password   = "";       // default no password
$dbname     = "hospital_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_name = $_POST['patient_name'];
    $email        = $_POST['email'];
    $phone        = $_POST['phone'];
    $location     = $_POST['location'];

    // Handle image upload
    $targetDir = "uploads/";  // create "uploads" folder inside your project
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["ambulance_image"]["name"]);
    $targetFilePath = $targetDir . time() . "_" . $fileName;

    if (move_uploaded_file($_FILES["ambulance_image"]["tmp_name"], $targetFilePath)) {
        // Insert into database
        $sql = "INSERT INTO ambulance_booking (patient_name, email, phone, location, ambulance_image) 
                VALUES ('$patient_name', '$email', '$phone', '$location', '$targetFilePath')";

        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
