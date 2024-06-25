<?php
// Oyun hakkında bilgiler
$gameTitle = "Harita Tahmin Oyunu";
$gameDescription = "Bu oyun, dünya haritası üzerinde belirli bir konumu tahmin etme becerisine dayanır. Kullanıcıya rastgele bir konum gösterilir ve kullanıcıdan o konumu doğru şekilde tahmin etmesi istenir. Doğru tahminler puan kazandırır.";
$howToPlay = "Oyunu oynamak için aşağıdaki adımları izleyebilirsiniz:
1. Sayfadaki dünya haritasına bakın ve gösterilen konumu inceleyin.
2. Tahmin ettiğiniz konumun adını yazın ve 'Tahmin Et' butonuna tıklayın.
3. Doğru tahminlerinizde puan kazanacak ve yeni bir konum gösterilecektir.";

// Bootstrap ile HTML çıktısı oluşturma
$htmlOutput = '
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>'.$gameTitle.'</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Oyun Sitesi</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="game.php">Oyun</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">Oyun Hakkında</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">İletişim</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">'.$gameTitle.'</h1>
        <h2 class="text-center">Oyun Hakkında</h2>
        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">Oyun Hakkında</h3>
                <p class="card-text">'.$gameDescription.'</p>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">Nasıl Oynanır?</h3>
                <p class="card-text">'.$howToPlay.'</p>
            </div>
        </div>
    </div>

    <footer class="footer mt-5 py-3 bg-dark text-light">
        <div class="container text-center">
            <span class="text-muted">Oyun Sitesi &copy; 2024</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
';

// HTML çıktısını göster
echo $htmlOutput;
?>
