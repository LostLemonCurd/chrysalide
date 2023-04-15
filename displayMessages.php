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

// Récupérer toutes les informations de l'utilisateur connecté
$r3 = $pdo->prepare("SELECT * FROM user WHERE id_user = ?");
$r3->execute([$_GET['user_id']]);
$user = $r3->fetch(PDO::FETCH_ASSOC);


// Récupérer toutes les informations des utilisateurs sur lesquelles on clique
$r4 = $pdo->prepare("SELECT * FROM user WHERE id_user = ?");
$r4->execute([$_GET['friendId']]);
$friend = $r4->fetch(PDO::FETCH_ASSOC);


$friendId = $_GET['friendId'];
$user_id = $_GET['user_id'];

$messages = array();

$r_messages = $pdo->prepare("SELECT * FROM messages WHERE (id_expediteur = ? AND id_destinataire = ?) OR (id_expediteur = ? AND id_destinataire = ?) ORDER BY date ASC");
$r_messages->execute([$friendId, $user_id, $user_id, $friendId]);

while ($row = $r_messages->fetch(PDO::FETCH_ASSOC)) {
    $message = [
        'id_expediteur' => $row['id_expediteur'],
        'id_destinataire' => $row['id_destinataire'],
        'message' => $row['message'],
        'date' => $row['date']
    ];
    $messages[] = $message;
}


// Adding the values to the array response so it can be accessed with json later
$response = [
    'user' => $user,
    'friend' => $friend,
    'messages' => $messages
];

// Converting to json:
echo json_encode($response);
?>