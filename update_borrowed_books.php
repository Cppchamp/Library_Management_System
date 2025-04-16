<?php
include 'db.php';


$id = $_POST['id'];
$title = $_POST['title'];
$author = $_POST['author'];

$conn->query("UPDATE books SET title='$title', author='$author' WHERE id=$id");
header("Location: admin_panel.php");