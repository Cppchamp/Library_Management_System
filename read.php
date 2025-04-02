<?php
// URL to scrape
$url = "";
$title = "";
if (isset($_GET['id'] ) && isset($_GET['title'])) {
    $url = $_GET['id'];
    $title =$_GET['title'];
} else {
    echo "No book ID received.";
}

// Fetch the HTML content
$html = file_get_contents($url);

if ($html === false) {
    die("Failed to fetch the page.");
}

// Load HTML into DOMDocument
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($html);
libxml_clear_errors();

// Extract content inside <main> tag
$xpath = new DOMXPath($dom);
$mainContent = $xpath->query("//main");

$bookContent = "";
if ($mainContent->length > 0) {
    $bookContent = $dom->saveHTML($mainContent->item(0));
} else {
    die("Main content not found.");
}

// Split content into "pages" (based on paragraphs)
$paragraphs = explode("</p>", $bookContent);
$pages = array_chunk($paragraphs, 5); // Group every 5 paragraphs into one page

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📖 Book Reader</title>
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
                    <button class="btn btn-outline-light ms-3" id="themeToggle">
                        <i class="fa-solid fa-moon"></i> Dark Mode
                    </button>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">📖 <?php echo $title ?> </h1>
        <div class="reading-container text-center">
            <p>Select a page to read:</p>
            <div class="reading-container text-center mt-4">
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <?php foreach ($pages as $index => $page): ?>
                        <button class="btn btn-outline-primary page-button fw-bold px-4 py-2 shadow-sm"
                            data-bs-toggle="modal" data-bs-target="#pageModal" onclick="showPage(<?php echo $index; ?>)">
                            📖 Page <?php echo $index + 1; ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for displaying book pages -->
    <div class="modal fade" id="pageModal" tabindex="-1" aria-labelledby="pageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: var(--bg-color)">
                <div class="modal-header">
                    <h5 class="modal-title">📖 Reading Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Page content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="prevPage">⬅ Previous</button>
                    <button class="btn btn-primary" id="nextPage">Next ➡</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let pages = <?php echo json_encode($pages); ?>;
        let currentPageIndex = 0;

        // Show selected page in modal
        function showPage(index) {
            currentPageIndex = index;
            document.getElementById("modalContent").innerHTML = pages[index].join("</p>") + "</p>";
            modalContent.style.display = "none";
            setTimeout(() => {
                modalContent.style.display = "block";
                modalContent.scrollTop = 0;
            }, 10);
        }

        // Navigation for pages in modal
        document.getElementById("prevPage").addEventListener("click", function () {
            if (currentPageIndex > 0) {
                currentPageIndex--;
                showPage(currentPageIndex);
            }
        });

        document.getElementById("nextPage").addEventListener("click", function () {
            if (currentPageIndex < pages.length - 1) {
                currentPageIndex++;
                showPage(currentPageIndex);

            }
        });
    </script>

</body>

</html>