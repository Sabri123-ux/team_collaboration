<?php
// db.php அல்லது config போன்ற உங்கள் connection file include செய்க
include 'db.php'; // இதில் $conn = new mysqli(...) இருக்கணும்

// சிறந்த படி POST சோதனை
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'error: invalid request';
    exit;
}

$doctor  = isset($_POST['doctor']) ? trim($_POST['doctor']) : '';
$patient = isset($_POST['name'])   ? trim($_POST['name'])   : '';
$phone   = isset($_POST['phone'])  ? trim($_POST['phone'])  : '';
$date    = isset($_POST['date'])   ? trim($_POST['date'])   : '';
$time    = isset($_POST['time'])   ? trim($_POST['time'])   : '';

// அடிப்படை validate
if ($doctor === '' || $patient === '' || $phone === '' || $date === '' || $time === '') {
    echo 'error: all fields are required';
    exit;
}

// Prepared statement
$sql = "INSERT INTO appointments (doctor_name, patient_name, phone, date, time) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo 'error: prepare failed - ' . $conn->error;
    exit;
}

$stmt->bind_param('sssss', $doctor, $patient, $phone, $date, $time);

if ($stmt->execute()) {
    // only plain text success
    echo 'success';
} else {
    echo 'error: execute failed - ' . $stmt->error;
}

$stmt->close();
$conn->close();
?>
