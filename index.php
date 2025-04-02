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
    <nav class="navbar navbar-expand-lg navbar-dark bg-grey">
        <div class="container">
            <a class="navbar-brand" href="index.php">Online Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="book_gallery.php">Books</a></li>
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
            <a href="book_gallery.php" class="btn btn-light">Browse Books</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <p>&copy; 2025 Online Library. All Rights Reserved.</p>
        <p>
            <a href="about.php" class="text">About</a> |
            <a href="contact.php" class="text">Contact</a> |
            <a href="terms.php" class="text">Terms</a>
        </p>
    </footer>
</body>

</html>