<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$url = "https://standardebooks.org";
$bookUrl = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pagination Setup
    $booksPerPage = 12; // Limit books per page
    $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $offset = ($currentPage - 1) * $booksPerPage;

    // Fetch books with pagination
    $stmt = $pdo->prepare("SELECT title, author, imageUrl, bookUrl FROM books LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':limit', $booksPerPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count total books for pagination 
    $countStmt = $pdo->query("SELECT COUNT(*) FROM books");
    $totalBooks = $countStmt->fetchColumn();
    $totalPages = ceil($totalBooks / $booksPerPage);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="theme_toggle.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-grey">
        <div class="container">
            <a class="navbar-brand" href="index.php">Online Library</a>
            <button class="btn btn-outline-light ms-3" id="themeToggle">
                <i class="fa-solid fa-moon"></i> Dark Mode
            </button>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">📚 Book Gallery</h1>

        <div class="row">
            <?php if ($books): ?>
                <?php foreach ($books as $book): ?>
                    <?php $book_id = $book['bookUrl']; ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <a href="read.php?id=<?php echo $url . $book_id . "/text/single-page"; ?>&title=<?php echo $book['title']; ?>"
                            class="text-decoration-none">
                            <div class="card book-card shadow">
                                <img src="<?php echo htmlspecialchars(rtrim($url, '/') . '/' . ltrim($book['imageUrl'], '/')); ?>"
                                    class="card-img-top" alt="<?php echo htmlspecialchars($book['title']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h5>
                                    <p class="card-text">by <?php echo htmlspecialchars($book['author']); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No books available.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination Controls -->
        <nav>
            <ul class="pagination justify-content-center mt-4">
                <?php
                $maxPagesToShow = 10; // Adjust this to 5 if you want to show 5 pages instead of 10
                $halfRange = floor($maxPagesToShow / 2);

                $startPage = max(1, $currentPage - $halfRange);
                $endPage = min($totalPages, $currentPage + $halfRange);

                // Ensure we show exactly $maxPagesToShow pages if possible
                if ($endPage - $startPage < $maxPagesToShow - 1) {
                    if ($startPage == 1) {
                        $endPage = min($totalPages, $startPage + $maxPagesToShow - 1);
                    } else {
                        $startPage = max(1, $endPage - $maxPagesToShow + 1);
                    }
                }

                // "Previous" Button
                if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Previous</a>
                    </li>
                <?php endif; ?>

                <!-- Show first page and dots if needed -->
                <?php if ($startPage > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
                    <?php if ($startPage > 2): ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Display Dynamic Page Numbers -->
                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Show last page and dots if needed -->
                <?php if ($endPage < $totalPages): ?>
                    <?php if ($endPage < $totalPages - 1): ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>
                    <li class="page-item"><a class="page-link"
                            href="?page=<?php echo $totalPages; ?>"><?php echo $totalPages; ?></a></li>
                <?php endif; ?>

                <!-- "Next" Button -->
                <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>
</body>

</html>