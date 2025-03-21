<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Gallery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .book-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .book-item {
            width: 200px;
            text-align: center;
        }
        .book-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>
<body class="bg-dark text-light">

<div class="container mt-4">
    <h1 class="text-center">📚 Book Gallery</h1>

    <!-- Search Bar -->
    <form method="GET" class="mb-3 text-center">
        <input type="text" name="search" class="form-control w-50 mx-auto" placeholder="Search books..." required>
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>

    <div class="book-gallery">
        <?php
        // Handle search functionality
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Fetch books from database
        $sql = "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<figure class='book-item'>
                        <a href='{$row['pdf_link']}' target='_blank'>
                            <img src='{$row['cover_image']}' alt='Cover'>
                        </a>
                        <figcaption>
                            <strong>{$row['title']}</strong><br>
                            <small>by {$row['author']}</small><br>
                            <a href='{$row['epub_link']}' class='btn btn-success btn-sm'>EPUB</a>
                            <a href='{$row['txt_link']}' class='btn btn-info btn-sm'>TXT</a>
                            <a href='{$row['pdf_link']}' class='btn btn-danger btn-sm'>PDF</a>
                        </figcaption>
                    </figure>";
            }
        } else {
            echo "<p class='text-center'>No books found.</p>";
        }
        ?>
    </div>

    <a href="add_book.php" class="btn btn-secondary mt-4">➕ Add New Book</a>
</div>

</body>
</html>
