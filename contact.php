<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $query = "INSERT INTO contact_messages (name, email, phone, message)
              VALUES ('$name', '$email', '$phone', '$message')";

    if (mysqli_query($conn, $query)) {
        echo "success"; // Frontend success message handle செய்ய
    } else {
        echo "error: " . mysqli_error($conn);
    }
}
?>
