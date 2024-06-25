<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Mevcut kullanıcının toplam puanını al
$stmt = $pdo->prepare('SELECT SUM(score) as total_score FROM scores WHERE user_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$total_score = $stmt->fetch(PDO::FETCH_ASSOC)['total_score'];
$total_score = $total_score ? $total_score : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_guess = $_POST['location_name'];
    $actual_location = $_POST['actual_location'];

    // Kullanıcı tahminini kontrol et
    if (strcasecmp($user_guess, $actual_location) == 0) {
        // Doğru tahmin, puan ekle
        $stmt = $pdo->prepare('INSERT INTO scores (user_id, score, location_id) VALUES (?, ?, ?)');
        $stmt->execute([$_SESSION['user_id'], 10, $_POST['location_id']]);
        $total_score += 10; // Puanı hemen güncelle
        echo json_encode(['message' => 'Tebrikler, doğru tahmin! 10 puan kazandınız.', 'success' => true]);
    } else {
        echo json_encode(['message' => 'Üzgünüz, yanlış tahmin. Doğru cevap: ' . $actual_location, 'success' => false]);
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Harita Oyunu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Harita Oyunu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Çıkış Yap</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Oyun</h2>
        <p>Toplam Puanınız: <strong><?php echo $total_score; ?></strong></p>
        <div id="map" style="height: 500px;"></div>
        <form id="guess-form" action="game.php" method="post" class="mt-3">
            <div class="form-group">
                <label for="location_name">Konum İsmi:</label>
                <input type="text" class="form-control" id="location_name" name="location_name" required>
            </div>
            <input type="hidden" id="actual_location" name="actual_location" value="">
            <input type="hidden" id="location_id" name="location_id" value="">
            <button type="submit" class="btn btn-primary">Tahmin Et</button>
        </form>
    </div>

    <script src="js/map.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
