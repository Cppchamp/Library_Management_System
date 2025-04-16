<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Online Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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


    <div class="container mt-5">
        <h1 class="text-center">📖 About Our Library</h1>
        <p class="lead text-center">Welcome to our online library! Our mission is to provide free and easy access to
            books for everyone.</p>

        <div class="mt-4">
            <h3>📚 Our Collection</h3>
            <p>We offer a wide range of books across different genres, including fiction, non-fiction, academic, and
                more.</p>

            <h3>🚀 Our Mission</h3>
            <p>We aim to promote literacy by making books easily accessible to everyone, anywhere in the world.</p>

            <h3>🤝 Join Us</h3>
            <p>Create an account to start reading or contribute to our growing library.</p>
        </div>
    </div>

</body>

</html>