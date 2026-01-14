<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: login.php");
    exit;
}

include 'db.php';
$result = $conn->query("SELECT * FROM appointments ORDER BY id DESC");
?>

<h2>All Appointments</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Doctor</th>
        <th>Date</th>
        <th>Time</th>
        <th>Name</th>
        <th>Phone</th>
    </tr>
    <?php while($row = $result->fetch_assoc()){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['doctor']; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td><?php echo $row['time']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['phone']; ?></td>
    </tr>
    <?php } ?>
</table>

<a href="admin_dashboard.php">Back to Dashboard</a>
