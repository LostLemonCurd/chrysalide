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
$r1 = $pdo->prepare("SELECT * FROM user WHERE id_user = ?");
$r1->execute([$_GET['friendId']]);
$friend = $r1->fetch(PDO::FETCH_ASSOC);

$r1 = $pdo->prepare("SELECT * FROM groupes WHERE id_user = ?");
$r1->execute([$_GET['friendId']]);
while ($row = $r1->fetch(PDO::FETCH_ASSOC)){
    switch ($row['sport']) {
        case 'football':
            $sport_img = 'football.png';
            break;
        case 'basketball':
            $sport_img = 'basket.png';
            break;
        case 'golf':
            $sport_img = 'golf.png';
            break;
        case 'boxe':
            $sport_img = 'boxe.png';
            break;
        case 'baseball':
            $sport_img = 'baseball.png';
            break;
        case 'tennis':
            $sport_img = 'tennis.png';
            break;
        case 'ping-pong':
            $sport_img = 'ping-pong.png';
            break;
        case 'badminton':
            $sport_img = 'bad.png';
            break;       
        default:
            $sport_img = 'Nope';
            break;
    }

    $groupe_info = [
        'nom_groupe' => $row['nom_groupe'],
        'places_disponibles' => $row['places_disponibles'],
        'ville' => $row['ville'],
        'sport' => $row['sport'],
        'sportImg' => $sport_img,
        'date_creation' => $row['date_creation'],
        'date_event' => $row['date_event'],

    ];
    $groupe[] = $groupe_info;
}
// Vérification du statut d'amitié de l'utilisateur connecté avec les autres utilisateurs
$isAFriend = false;
$r2 = $pdo->prepare("SELECT * FROM friends WHERE (id_user = ? AND id_friend = ?)");
$r2->execute([$_GET['userId'], $_GET['friendId']]);
$r3 = $pdo->prepare("SELECT * FROM friends WHERE (id_user = ? AND id_friend = ?)");
$r3->execute([$_GET['friendId'], $_GET['userId']]);

if (($r2->rowCount() >= 1) or ($r3->rowCount() >= 1)) {
    $isAFriend = true;
}

// Adding the values to the array response so it can be accessed with json later
$response = [
    'friend' => $friend,
    'groupe' => $groupe,
    'isAFriend' => $isAFriend
];


// Converting to json:
echo json_encode($response);
