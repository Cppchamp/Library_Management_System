<?php
include 'db.php';

session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$tableHTML = "";
$userHTML = "";
$borrowedHTML = "";
$pdo = new PDO("mysql:host=localhost;dbname=library_management_db;charset=utf8", "root", "");

$stmt1 = $pdo->query("SELECT COUNT(*) AS total_books FROM books");
$result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
$totalBooks = $result1['total_books'];

$stmt2 = $pdo->query("SELECT COUNT(*) AS total_users FROM users");
$result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$totalUsers = $result2['total_users'];

$stmt3 = $pdo->query("SELECT COUNT(*) AS total_borrowed_books FROM borrowed_books");
$result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
$totalBorrowedBooks = $result3['total_borrowed_books'];

$books = $conn->query("SELECT * FROM books");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['run_books'])) {
    $tableHTML = getBooksTable($conn);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['run_users'])) {
    $userHTML = getUsersTable($conn);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['run_borrowed_books'])) {
    $userHTML = getBorrowedBooksTable($conn);
}

function getBooksTable($conn)
{
    $books = $conn->query("SELECT * FROM books");
    $html = '';

    if ($books->num_rows > 0) {
        $html .= '<table class="table table-bordered table-striped mt-4">';
        $html .= '<thead><tr><th>ID</th><th>Title</th><th>Author</th><th>Actions</th></tr></thead>';
        $html .= '<tbody>';

        while ($row = $books->fetch_assoc()) {
            $html .= '<tr>
                        <form method="POST" action="update_book.php">
                            <td>' . $row['id'] . '</td>
                            <td><input type="text" name="title" value="' . htmlspecialchars($row['title']) . '"></td>
                            <td><input type="text" name="author" value="' . htmlspecialchars($row['author']) . '"></td>
                            <td>
                                <input type="hidden" name="id" value="' . $row['id'] . '">
                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                                <a href="delete_book.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </form>
                    </tr>';
        }

        $html .= '</tbody></table>';
    } else {
        $html .= '<p>No books found.</p>';
    }

    return $html;
}

function getUsersTable($conn)
{
    $users = $conn->query("SELECT * FROM users");
    $html = '';

    if ($users->num_rows > 0) {
        $html .= '<table class="table table-bordered table-striped mt-4">';
        $html .= '<thead><tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Actions</th></tr></thead>';
        $html .= '<tbody>';

        while ($row = $users->fetch_assoc()) {
            $html .= '<tr>
                        <form method="POST" action="update_user.php">
                            <td>' . $row['id'] . '</td>
                            <td><input type="text" name="username" value="' . htmlspecialchars($row['name']) . '"></td>
                            <td><input type="text" name="email" value="' . htmlspecialchars($row['email']) . '"></td>
                            <td><input type="text" name="role" value="' . htmlspecialchars($row['role']) . '"></td>
                            <td>
                                <input type="hidden" name="id" value="' . $row['id'] . '">
                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                                <a href="delete_user.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </form>
                    </tr>';
        }

        $html .= '</tbody></table>';
    } else {
        $html .= '<p>No users found.</p>';
    }

    return $html;
}

function getBorrowedBooksTable($conn)
{
    $borrowed = $conn->query("SELECT * FROM borrowed_books");
    $html = '';

    if ($borrowed->num_rows > 0) {
        $html .= '<table class="table table-bordered table-striped mt-4">';
        $html .= '<thead><tr><th>ID</th><th>User ID</th><th>Book ID</th><th>Borrow Date</th><th>Return Date</th><th>Actions</th></tr></thead>';
        $html .= '<tbody>';

        while ($row = $borrowed->fetch_assoc()) {
            $html .= '<tr>
                        <form method="POST" action="update_borrowed.php">
                            <td>' . $row['id'] . '</td>
                            <td><input type="text" name="user_id" value="' . htmlspecialchars($row['user_id']) . '"></td>
                            <td><input type="text" name="book_id" value="' . htmlspecialchars($row['book_id']) . '"></td>
                            <td><input type="date" name="borrow_date" value="' . $row['borrow_date'] . '"></td>
                            <td><input type="date" name="return_date" value="' . $row['return_date'] . '"></td>
                            <td>
                                <input type="hidden" name="id" value="' . $row['id'] . '">
                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                                <a href="delete_borrowed.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </form>
                    </tr>';
        }

        $html .= '</tbody></table>';
    } else {
        $html .= '<p>No borrowed books found.</p>';
    }

    return $html;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel | Online Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="theme_toggle.js"></script>

</head>
<style>
    .sidebar {
        height: 100vh;
        position: fixed;
        width: 220px;
        background-color: #343a40;
    }

    .sidebar .nav-link {
        color: white;
    }

    .sidebar .nav-link.active {
        background-color: #495057;
    }

    .content {
        margin-left: 220px;
        padding: 2rem;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<body>


    <div class="sidebar d-flex flex-column p-3" style="background-color: var(--nav-bg)">
        <h4 class="text-white mb-4">📚 Admin Panel</h4>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"><a href="admin_panel.php" class="nav-link active">Dashboard</a></li>
            <li>
                <form method="POST">
                    <button type="submit" name="run_books" class="btn btn-secondary">Manage
                        Books</button>
                </form>
            </li>
            <li>
                <form method="POST">
                    <button type="submit" name="run_users" class="btn btn-secondary">Manage
                        Users</button>
                </form>
            </li>
            <li>
                <form method="POST">
                    <button type="submit" name="run_borrowed_books" class="btn btn-secondary">Manage
                        Borrowed Books</button>
                </form>
            </li>
            <li><a href="logout.php" class="nav-link text-danger">Logout</a></li>
        </ul>
        <button class="btn btn-outline-light ms-3" id="themeToggle">
            <i class="fa-solid fa-moon"></i> Dark Mode
        </button>
    </div>

    <div class="content">
        <h1 class="mb-4">📊 Dashboard Overview</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-bg-primary mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Books</h5>
                        <p class="card-text fs-3">
                            <?php echo $totalBooks; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-success mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Registered Users</h5>
                        <p class="card-text fs-3">
                            <?php echo $totalUsers; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-warning mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Books Borrowed</h5>
                        <p class="card-text fs-3">
                            <?php echo $totalBorrowedBooks; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="print">
            <?php echo $tableHTML;
            echo $userHTML;
            echo $borrowedHTML;
            ?>
        </div>
    </div>
</body>

</html>