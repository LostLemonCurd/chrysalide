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
$r4 = $pdo->prepare("SELECT * FROM groupes WHERE sport = ?");
$r4->execute([$_GET['sportId']]);
$sport = $r4->fetch(PDO::FETCH_ASSOC);

// Adding the values to the array response so it can be accessed with json later
$response = [
    'sport' => $sport
];

// Converting to json:
echo json_encode($response);
