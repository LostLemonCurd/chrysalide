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



// Récupérer toutes les informations des utilisateurs sur lesquelles on clique
$r4 = $pdo->prepare("SELECT * FROM user WHERE id_user = ?");
$r4->execute([$_GET['friendId']]);
$friend = $r4->fetch(PDO::FETCH_ASSOC);

// Vérification du statut d'amitié de l'utilisateur connecté avec les autres utilisateurs
$isAFriend = false;
$r3 = $pdo->prepare("SELECT * FROM friends WHERE id_user = ? AND id_friend = ?");
$r3->execute([$_GET['userId'], $_GET['friendId']]);
if ($r3->rowCount() >= 1) {
    $isAFriend = true;
}

// Adding the values to the array response so it can be accessed with json later
$response = [
    'friend' => $friend,
    'isAFriend' => $isAFriend
];


// Converting to json:
echo json_encode($response);
