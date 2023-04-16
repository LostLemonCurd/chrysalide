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

$user_id = $_GET['userId'];


$sport = array();
// Récupérer toutes les informations des utilisateurs sur lesquelles on clique
$r4 = $pdo->prepare("SELECT DISTINCT nom_groupe, ville, sport, date_event, date_creation, places_disponibles FROM groupes WHERE sport = ?");
$r4->execute([$_GET['sportId']]);
while ($row = $r4->fetch(PDO::FETCH_ASSOC)){
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

    $sport_info = [
        'nom_groupe' => $row['nom_groupe'],
        'places_disponibles' => $row['places_disponibles'],
        'ville' => $row['ville'],
        'sport' => $row['sport'],
        'sportImg' => $sport_img,
        'date_creation' => $row['date_creation'],
        'date_event' => $row['date_event'],

    ];
    $sport[] = $sport_info;
}

// Adding the values to the array response so it can be accessed with json later
$response = [
    'user' => $user_id,
    'sport' => $sport
];

// Converting to json:
echo json_encode($response);
