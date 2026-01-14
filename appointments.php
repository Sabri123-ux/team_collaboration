<?php
$servername = "localhost";
$username = "root";   // XAMPP default
$password = "";       // XAMPP default
$dbname = "hospital_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form values
$doctor = $_POST['doctor'];
$patient = $_POST['name'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$time = $_POST['time'];

// Prepare & bind
$sql = "INSERT INTO appointments (doctor_name, patient_name, phone, date, time) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Something went wrong! Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssss", $doctor, $patient, $phone, $date, $time);

if ($stmt->execute()) {
    echo "✅ Appointment booked successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
