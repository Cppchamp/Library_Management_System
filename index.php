<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="theme_toggle.js"></script>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Online Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="books.php">Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white px-4" href="sign_up.php">Sign
                            Up</a></li>
                    <button class="btn btn-outline-light ms-3" id="themeToggle">
                        <i class="fa-solid fa-moon"></i> Dark Mode
                    </button>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1>Welcome to Your Online Library</h1>
            <p>Explore thousands of books from different genres and read online for free.</p>
            <a href="books.php" class="btn btn-light btn-lg">Browse Books</a>
        </div>
    </div>

    <!-- Featured Books -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">📚 Featured Books</h2>
        <div class="row">
            <?php while ($book = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo $book['cover_image']; ?>" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $book['title']; ?></h5>
                            <p class="card-text">By <?php echo $book['author']; ?></p>
                            <a href="read.php?id=<?php echo $book['id']; ?>" class="btn btn-primary">Read Now</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Online Library. All Rights Reserved.</p>
        <p>
            <a href="about.php" class="text-white">About</a> |
            <a href="contact.php" class="text-white">Contact</a> |
            <a href="terms.php" class="text-white">Terms</a>
        </p>
    </footer>
</body>

</html>