<!DOCTYPE html>
<html lang='fr'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width'>
    <link rel='stylesheet' href='reset.css'>
    <link rel="stylesheet" href="lib.css">
    <link rel='stylesheet' href='friends.css'>
    <script src='script.js' defer></script>
    <script src='https://kit.fontawesome.com/3ebad5cdee.js' crossorigin='anonymous'></script>
    <title>Chrysalide</title>
</head>

<body>
    <?php 
        include('init.php');
    
        // Récupération des informations de l'utilisateur connecté                                      
        $userId = $_SESSION['user']['id_user'];
        $userImg = $_SESSION['user']['userimg'];

        $r = $pdo->query("SELECT * FROM user WHERE id_user IN ");


    ?>
    <header>
        <section id="header-logo">
            <img src="img/logo.png" alt="logo de Chrysalide">
            <h5>Chrysalide</h5>
        </section>
        <section id="header-input-profil">
            <section id="header-input-buttons">
                <form method="post">
                    <img src="img/search.png" alt="Search icon">
                    <input class="search-bar" type="text" placeholder="Rechercher">
                </form>
                <div id="header-buttons">
                    <a href="#">
                        <h6>Tournois</h6>
                    </a>
                    <a href="#">
                        <h6>Chrysalide</h6>
                    </a>
                </div>
            </section>
            <section id="header-profil">
                <img src="img/<?php echo $userImg ?>" alt="photo de profil">
            </section>
        </section>
    </header>
    <main>
        <aside>
            <nav id="aside-main-buttons">
                <a href="#">
                    <img src="img/friends.svg" alt="">
                    <h6>Friends</h6>
                </a>
                <a href="#">
                    <img src="img/messages.svg" alt="">
                    <h6>Messages</h6>
                </a>
                <a href="#">
                    <img src="img/chrysalide.svg" alt="">
                    <h6>Chrysalide</h6>
                </a>
                <a href="#">
                    <img src="img/favoris.svg" alt="">
                    <h6>Favoris</h6>
                </a>
                <a href="#">
                    <img src="img/parametres.svg" alt="">
                    <h6>Paramètres</h6>
                </a>
            </nav>
            <nav id="aside-other-buttons">
                <a href="#">
                    <img src="img/aide.svg" alt="">
                    <h6>Aide</h6>
                </a>
                <a href="#">
                    <img src="img/conditions.svg" alt="">
                    <h6>Conditions</h6>
                </a>
                <a href="#">
                    <img src="img/confidentialite.svg" alt="">
                    <h6>Confidentialité</h6>
                </a>
                <a id='deco' href="sessiondestroy.php">
                    <img src="img/deco.svg" alt="Bouton de déconnexion">
                    <h6>Déconnexion</h6>
                </a>
            </nav>
        </aside>
        <div id="main-content-friends">


        </div>
    </main>
</body>