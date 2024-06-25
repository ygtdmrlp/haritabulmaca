<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Admin kullanıcı kontrolü yapılmalı (varsayım olarak admin id = 1)
if ($_SESSION['user_id'] !== 1) {
    header('Location: game.php');
    exit();
}

// Kullanıcı ve skor bilgilerini al
$users = $pdo->query('SELECT * FROM users')->fetchAll();
$scores = $pdo->query('SELECT scores.*, users.username, locations.name AS location_name FROM scores JOIN users ON scores.user_id = users.id JOIN locations ON scores.location_id = locations.id')->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Admin Paneli</h1>
    <h2>Kullanıcılar</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Kullanıcı Adı</th>
            <th>Email</th>
            <th>Oluşturulma Tarihi</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2>Skorlar</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Kullanıcı</th>
            <th>Skor</th>
            <th>Konum</th>
            <th>Oluşturulma Tarihi</th>
        </tr>
        <?php foreach ($scores as $score): ?>
            <tr>
                <td><?php echo $score['id']; ?></td>
                <td><?php echo $score['username']; ?></td>
                <td><?php echo $score['score']; ?></td>
                <td><?php echo $score['location_name']; ?></td>
                <td><?php echo $score['created_at']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
