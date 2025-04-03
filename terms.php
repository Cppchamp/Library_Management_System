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
    <title>Terms & Conditions - Online Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h1 class="text-center">📜 Terms & Conditions</h1>

        <h3>1. Acceptance of Terms</h3>
        <p>By accessing or using our online library, you agree to comply with these terms.</p>

        <h3>2. Account Registration</h3>
        <p>Users must create an account to access certain features. You are responsible for keeping your login
            credentials secure.</p>

        <h3>3. Usage Restrictions</h3>
        <p>Books and other materials provided in our library are for personal use only. Redistribution or commercial use
            is prohibited.</p>

        <h3>4. Content Ownership</h3>
        <p>All books and materials belong to their respective copyright holders. We provide access for educational and
            non-commercial purposes.</p>

        <h3>5. Changes to Terms</h3>
        <p>We reserve the right to update these terms at any time. Continued use of the site implies acceptance of any
            changes.</p>

        <h3>6. Contact Us</h3>
        <p>If you have any questions, please visit our <a href="contact.php">Contact Us</a> page.</p>
    </div>

</body>

</html>