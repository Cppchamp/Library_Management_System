<?php
include 'db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM borrowed_books WHERE id=$id");
header("Location: admin_panel.php");