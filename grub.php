<?php
session_start();
include 'db.php';
// Function to fetch webpage content using cURL
function fetchPage($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignore SSL warnings
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

for ($page = 1; $page <= 100; $page++) {

    // Target website
    $url = "https://standardebooks.org/ebooks?page=" . $page; // Replace with the site you want to scrape

    // Fetch the HTML content
    $html = fetchPage($url);

    // Load the HTML into DOMDocument
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); // Prevents errors from malformed HTML
    $dom->loadHTML($html);
    libxml_clear_errors();

    // Use XPath to extract titles
    $xpath = new DOMXPath($dom);
    $books = [];

    // Loop through each book item
    foreach ($xpath->query("//ol[contains(@class, 'ebooks-list')]/li") as $li) {
        $title = $xpath->query(".//p/a/span[@property='schema:name']", $li)->item(0)->nodeValue ?? '';
        $author = $xpath->query(".//p[@class='author']", $li)->item(0)->nodeValue ?? '';
        $bookUrl = $xpath->query(".//p/a[@property='schema:url']", $li)->item(0)->getAttribute('href') ?? '';
        $imageUrl = $xpath->query(".//img[@property='schema:image']", $li)->item(0)->getAttribute('src') ?? '';

        $stmt = $conn->prepare("INSERT INTO books (title, author, bookUrl, imageUrl) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $author, $bookUrl, $imageUrl);

        if ($stmt->execute()) {
            echo "✅ Inserted: $title by $author<br>";
        } else {
            echo "❌ Error inserting: " . $conn->error . "<br>";
        }

        $books[] = [
            'title' => trim($title),
            'author' => trim($author),
            'book_url' => 'https://standardebooks.org' . trim($bookUrl),
            'image_url' => 'https://standardebooks.org' . trim($imageUrl)
        ];
    }


    
  //  echo json_encode($books, JSON_PRETTY_PRINT);
}
?>