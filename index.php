<?php
session_start();

// Veritabanı bağlantısı
$db_host = 'localhost';
$db_username = 'root';
$db_password = 'mersin33';
$db_name = 'oyun';

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Veritabanına bağlantı sağlanamadı: " . mysqli_connect_error());
}

// Tüm kullanıcıların skorlarını çekme
$sql = "SELECT users.username, scores.score 
        FROM scores 
        INNER JOIN users ON scores.user_id = users.id 
        ORDER BY scores.score DESC";
$result = mysqli_query($conn, $sql);

$users = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Harita Oyunu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Harita Oyunu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="game.php">Oyun</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Çıkış Yap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">Oyun Hakkında</a>
                    </li>
                    
                    <!-- Kullanıcı Skorları -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#userScoreModal">Skorlarım</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Giriş Yap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Kayıt Ol</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Harita Oyunu'na Hoş Geldiniz!</h1>
            <p class="lead">Harita üzerinde yer seçip oyunun tadını çıkarın.</p>
            <hr class="my-4">
            <p>Kayıt olup giriş yaparak oyuna başlayabilirsiniz.</p>
            <a class="btn btn-primary btn-lg" href="register.php" role="button">Kayıt Ol</a>
            <a class="btn btn-secondary btn-lg" href="login.php" role="button">Giriş Yap</a>
        </div>

        <!-- Kullanıcı Skorları Tablosu -->
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tüm Kullanıcı Skorları</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kullanıcı Adı</th>
                                <th scope="col">Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key => $user): ?>
                            <tr>
                                <th scope="row"><?php echo $key + 1; ?></th>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['score']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Kullanıcı Skorları Modal -->
    <div class="modal fade" id="userScoreModal" tabindex="-1" role="dialog" aria-labelledby="userScoreModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userScoreModalLabel">Kullanıcı Skorları</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Kullanıcı Adı: <?php echo $_SESSION['username']; ?></h5>
                                <p class="card-text">Skor: <?php echo $_SESSION['score']; ?></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="text-danger">Skorları görüntülemek için önce giriş yapmalısınız.</p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
