<?php
include 'db.php';


$id = $_POST['id'];
$userID = $_POST['user_id'];
$bookID = $_POST['book_id'];
$borrowDate = $_POST['borrow_date'];
$returnDate = $_POST['return_date'];

$conn->query("UPDATE borrowed_books SET user_id='$userID', book_id='$bookID', borrow_date='$borrowDate', return_date='$returnDate' WHERE id=$id");
header("Location: admin_panel.php");