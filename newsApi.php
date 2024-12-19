<?php

// URL API NewsAPI
$apiUrl = "https://newsapi.org/v2/everything?q=bitcoin&apiKey=965697a9bf8f466caa0ab74e2e954211";

// Inisialisasi cURL
$ch = curl_init();

// Set opsi cURL
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Eksekusi cURL dan ambil hasil response
$response = curl_exec($ch);

// Cek jika terjadi error pada cURL
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    exit();
}

// Tutup cURL
curl_close($ch);

// Decode data JSON yang didapat
$data = json_decode($response, true);

// Cek jika ada data artikel
if ($data && $data['status'] == 'ok' && isset($data['articles'])) {
    echo "<h1>Berita Terkait Bitcoin</h1>";

    // Loop untuk menampilkan artikel
    foreach ($data['articles'] as $article) {
        $title = $article['title'];
        $image = $article['urlToImage'];
        $description = $article['description'];
        $url = $article['url'];
        $publishedAt = $article['publishedAt'];

        echo "<div style='margin-bottom: 20px;'>";
        echo "<h3><a href='$url' target='_blank'>$title</a></h3>";
        echo "<img src=\"$image\" alt=\"Gambar\" width='400px' height='400px'>";
        echo "<p><strong>Published At:</strong> " . date("d M Y, H:i", strtotime($publishedAt)) . "</p>";
        echo "<p><strong>Description:</strong> $description</p>";
        echo "</div>";
    }
} else {
    echo "<p>Tidak ada berita terkait dengan 'Bitcoin' saat ini.</p>";
}

?>
