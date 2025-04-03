<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

$errors = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate fields
    if (empty($name) || empty($email) || empty($password)) {
        echo "<div style='color: red; font-weight: bold;'>All fields are required!</div>";
        echo "<br><a href='sign_up.php'><button style='padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer;'>Try Again</button></a>";
        exit;
    }

    $check_query = "SELECT * FROM users WHERE email = ? OR name = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $email, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        if ($row['email'] === $email) {
            $emailError = "Email is already registered. Try another one.";
            $errors = true;
        }
        if ($row['name'] === $name) {
            $nameError = "Username is already taken. Choose a different one.";
            $errors = true;
        }
    }
    if (!$errors) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert into database
        $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<div class=container mt-5>Registration successful! <a href='login.php'>Login here</a></div>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="theme_toggle.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-grey">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <button class="btn btn-outline-light ms-3" id="themeToggle">
                        <i class="fa-solid fa-moon"></i> Dark Mode
                    </button>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Sign Up</h2>
        <form action="sign_up.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Username:</label>
                <input type="text" name="name"
                    class="form-control <?php echo !empty($nameError) ? 'is-invalid' : ''; ?>" required
                    value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                <div class="invalid-feedback"><?php echo $nameError; ?></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email"
                    class="form-control <?php echo !empty($emailError) ? 'is-invalid' : ''; ?>" required
                    value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                <div class="invalid-feedback"><?php echo $emailError; ?></div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
        <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>

</html>