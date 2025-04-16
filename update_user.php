<?php
include 'db.php';


$id = $_POST['id'];
$username = $_POST['name'];
$email = $_POST['email'];
$role = $_POST['role'];


$conn->query("UPDATE users SET name='$username', email='$email', role = '$role' WHERE id=$id");
header("Location: admin_panel.php");