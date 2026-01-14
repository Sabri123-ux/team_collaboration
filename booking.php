<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $query = "INSERT INTO appointments (doctor, date, time, patient_name, patient_phone)
              VALUES ('$doctor', '$date', '$time', '$name', '$phone')";

    if (mysqli_query($conn, $query)) {
        echo "success"; // Frontend success message handle செய்ய
    } else {
        echo "error: " . mysqli_error($conn);
    }
}
?>
