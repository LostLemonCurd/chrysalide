<?php 
//If the first three characters PHP_OS are equal to "WIN",
//then PHP is running on a Windows operating system.
if (strcasecmp(substr(PHP_OS, 0, 3), 'WIN') == 0) {
    $isWindows = true;
}
//If $isWindows is TRUE, then print out a message saying so.
if ($isWindows) {
    $pdo = new PDO('mysql:host=localhost;dbname=chrysalide', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} else {
    $pdo = new PDO('mysql:host=localhost;dbname=chrysalide', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
header('Content-Type: application/json'); 


// Remove the friendship
$r6 = $pdo->prepare("DELETE FROM friends WHERE id_user = ? AND id_friend = ?");
$r6->execute([$_POST['userId'], $_POST['friendId']]);

// Return a response
$response = ['success' => true];
echo json_encode($response);
?>