<?php 

    //By default, we assume that PHP is NOT running on windows.
    $isWindows = false;

    //If the first three characters PHP_OS are equal to "WIN",
    //then PHP is running on a Windows operating system.
    if(strcasecmp(substr(PHP_OS, 0, 3), 'WIN') == 0){
        $isWindows = true;
    }

    //If $isWindows is TRUE, then print out a message saying so.
    if($isWindows){
        $pdo = new PDO('mysql:host=localhost;dbname=chrysalide', 'root', '', array( PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    } else {
        $pdo = new PDO('mysql:host=localhost;dbname=chrysalide', 'root', 'root', array( PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }
    // var_dump($pdo) . '<br>';
    // J'ouvre une session pour y enregistrer des infos
    session_start();

// Création d'une variable qui permettra d'y ajouter du contenu :
    $content= '';

// S'il y a une action dans l'URL et si elle est égale à deconnexion alors je détruis la session:
    if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
        session_destroy();
        header('location:index.php');
    }

?>