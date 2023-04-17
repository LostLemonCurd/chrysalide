<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="lib.css">
    <link rel="stylesheet" href="chysalide.css">
    <link rel="stylesheet" href="création-chrysalide.php">
    <script src='script-chrysalide.js' defer></script>
    <script src='lib.js' defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- <script src='lib.js' defer></script> -->
    <title>Chrysalide</title>
</head>

<body>
<h6 class="error"> <?php error_reporting(E_ALL); ini_set('display_errors', 1); ?></h6>

    <?php
    include('init.php');

        // On redirige l'utilisateur s'il n'est pas connecté:
        if(!isset($_SESSION['user'])){
            header('location:connexion.php');
        }
    


    // Vérifier si le formulaire a été soumis
    $user_id = $_SESSION["user"]["id_user"];

    // $r_user_groupe = $pdo->query("SELECT * FROM groupes WHERE id_user = $user_id");
    $r_user_groupe = $pdo->query("SELECT DISTINCT nom_groupe, ville, sport, date_event FROM groupes WHERE id_user = $user_id");


    if ($_POST) {
        // Récupérer les données saisies par l'utilisateur
        $ville = $_POST["ville"];
        $places_disponibles = $_POST["places_disponibles"];
        $sport = $_POST["sport"];
        $nom_groupe = $_POST["nom_groupe"];
        $date_event = $_POST["date_event"];

        // // Générer un nom de groupe aléatoire
        // $nom_groupe = 'Groupe_' . uniqid();

        // Vérifier si le nom de groupe est déjà utilisé
        $r_nom = $pdo->prepare("SELECT * FROM groupes WHERE nom_groupe = ?");
        $r_nom->execute([$nom_groupe]);
        if ($r_nom->rowCount() >= 1) {
            // Le nom de groupe est déjà utilisé, générer un nouveau nom
            $nom_groupe = 'Groupe_' . uniqid();
        }

        // Insérer les données dans la table "groupes"
        $stmt = $pdo->prepare("INSERT INTO groupes (id_user, nom_groupe, ville, places_disponibles, sport, date_creation, date_event) VALUES (?, ?, ?, ?, ?, now(), ?)");
        $stmt->execute([$user_id, "$nom_groupe", "$ville", $places_disponibles, "$sport", $date_event]);


        $r_sport = $pdo->query("SELECT * FROM groupes");
        // Vérifier si l'insertion s'est bien déroulée
        // if ($r_sport->rowCount() > 0) {
        //     echo "Données insérées avec succès";
        // } else {
        //     echo "Erreur lors de l'insertion des données";
        // }
    }
    ?>

    <header>
        <section id="header-logo">
            <img src="img/logo.png" alt="logo de Chrysalide">
            <h5>Chrysalide</h5>
        </section>
        <section id="header-input-profil">
            <section id="header-input-buttons">
                <form method="post">
                    <svg width="27" height="27" viewBox="0 0 27 27" fill="#1C1C28" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.7351 24.3201L19.4764 18.0626C21.2904 15.8848 22.195 13.0914 22.0019 10.2635C21.8089 7.43573 20.533 4.7912 18.4398 2.88009C16.3466 0.968989 13.5972 -0.0615536 10.7635 0.00284627C7.92984 0.0672461 5.23008 1.22163 3.22586 3.22586C1.22163 5.23008 0.0672461 7.92984 0.00284627 10.7635C-0.0615536 13.5972 0.968989 16.3466 2.88009 18.4398C4.7912 20.533 7.43573 21.8089 10.2635 22.0019C13.0914 22.195 15.8848 21.2904 18.0626 19.4764L24.3201 25.7351C24.413 25.828 24.5233 25.9017 24.6447 25.952C24.7661 26.0023 24.8962 26.0282 25.0276 26.0282C25.159 26.0282 25.2891 26.0023 25.4105 25.952C25.5319 25.9017 25.6422 25.828 25.7351 25.7351C25.828 25.6422 25.9017 25.5319 25.952 25.4105C26.0023 25.2891 26.0282 25.159 26.0282 25.0276C26.0282 24.8962 26.0023 24.7661 25.952 24.6447C25.9017 24.5233 25.828 24.413 25.7351 24.3201ZM2.02763 11.0276C2.02763 9.2476 2.55547 7.50754 3.5444 6.0275C4.53334 4.54745 5.93894 3.3939 7.58348 2.71271C9.22801 2.03152 11.0376 1.85329 12.7834 2.20056C14.5293 2.54783 16.1329 3.405 17.3916 4.66367C18.6503 5.92234 19.5074 7.52599 19.8547 9.27182C20.202 11.0176 20.0237 12.8272 19.3425 14.4718C18.6614 16.1163 17.5078 17.5219 16.0278 18.5109C14.5477 19.4998 12.8077 20.0276 11.0276 20.0276C8.64149 20.025 6.35385 19.0759 4.66659 17.3887C2.97934 15.7014 2.03028 13.4138 2.02763 11.0276Z" fill="#1C1C28" />
                    </svg>
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
                <img src="img/img-profile.png" alt="photo de profil">
            </section>
        </section>

    </header>
    <main>
        <aside>
            <nav id="aside-main-buttons">
                <a href="friends.php">
                    <img src="img/friends.svg" alt="">
                    <h6>Friends</h6>
                </a>
                <a href="messagerie.php">
                    <img src="img/messages.svg" alt="">
                    <h6>Messages</h6>
                </a>
                <a href="chrysalide.php">
                    <img src="img/chrysalide.svg" alt="">
                    <h6>Chrysalide</h6>
                </a>

                <a href="favoris.php">
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
        <section id="main-content-create-chrysalide">
            <div id=encours>
                <h1>Chrysalide en cours</h1>
                <div class="loader">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div id="btn-box">
                <button class="btn-blue" onclick="openOverlay()">
                    <h6>Créer</h6>
                </button>
                <button class="btn-vide">
                    <h6>Rejoindre</h6>
                </button>
            </div>


            <div class="overlay">
                <div class="overlay-content">
                    <h1 id="titre-overlay">Créer ta Chrysalide</h1>
                    <button class="close-btn">x</button>
                    <form method="post">
                        <h2 class='espace'>Ville : </h2>
                        <input type="text" name="ville"><br>
                        <h2 class='espace'>Nom du Groupe : </h2>
                        <input type="text" name="nom_groupe"><br>
                        <h2 class='espace'>Date de l'évenement : </h2>
                        <input type="date" name="date_event"><br>
                        <h2 class='espace'>Places disponibles : </h2>
                        <select name="places_disponibles">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select><br>
                        <h2 class="espace">Sports :</h2><br>
                        <div class="sport_line">
                            <div class="carte_sport">
                                <img src="img/football.png" alt="" width="112" height="100">
                                <input type="checkbox" name="sport" value="football">Football<br>
                            </div>
                            <div class="carte_sport">
                                <img src="img/basket.png" alt="" width="112" height="100">
                                <input type="checkbox" name="sport" value="basketball">Basketball<br>
                            </div>
                            <div class="carte_sport">
                                <img src="img/golf.png" alt="" width="112" height="100">
                                <input type="checkbox" name="sport" value="golf">Golf<br>
                            </div>
                            <div class="carte_sport">
                                <img src="img/boxe.png" alt="" width="112" height="100">
                                <input type="checkbox" name="sport" value="boxe">Boxe<br>
                            </div>
                        </div>
                        <div class="sport_line">
                            <div class="carte_sport">
                                <img src="img/baseball.png" alt="" width="112" height="100">
                                <input type="checkbox" name="sport" value="baseball">Baseball<br>
                            </div>
                            <div class="carte_sport">
                                <img src="img/tennis.png" alt="" width="112" height="100">
                                <input type="checkbox" name="sport" value="tennis">Tennis<br>
                            </div>
                            <div class="carte_sport">
                                <img src="img/ping-pong.png" alt="" width="112" height="100">
                                <input type="checkbox" name="sport" value="ping-pong">Ping-pong<br>
                            </div>
                            <div class="carte_sport">
                                <img src="img/bad.png" alt="" width="112" height="100">
                                <input type="checkbox" name="sport" value="badminton">Badminton<br>
                            </div>
                        </div>
                        </select>
                        <div class="Créergroupe"><input class=btn-blue type="submit" value="Créer un groupe"></div>

                    </form>
                </div>
            </div>
            <script>
                const createBtn = document.querySelector('.btn-blue');
                const overlay = document.querySelector('.overlay');
                const closeBtn = document.querySelector('.close-btn');

                createBtn.addEventListener('click', () => {
                    overlay.style.display = 'block';
                });

                closeBtn.addEventListener('click', () => {
                    overlay.style.display = 'none';
                });
            </script>
            <div id="block-checkbox">
                <label for="public">Public</label>
                <input type="checkbox" id="public" name="access" value="public">
                <label for="private">Privée</label>
                <input type="checkbox" id="private" name="access" value="private">
            </div>

            <div id="mes-chrysalide">
                <?php 
                while ($user_groupe = $r_user_groupe->fetch(PDO::FETCH_ASSOC)){
                    switch ($user_groupe['sport']) {
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
                    echo 
                    '<div class="my-div">
                        <h5>'.$user_groupe['nom_groupe'].'</h5>
                        <img src="img/'.$sport_img.'" alt="Image" width="140" height="125">
                        <h5>'.$user_groupe['ville'].'</h5>
                        <h6>'.$user_groupe['date_event'].'</h6>
                    </div>';
                }
                ?>
            </div>
            <div id="find-a-chrysalide">
                <h1>Trouvez une chrysalide</h1>
                <div id="find-research-area-chrysalide">
                    <div id="find-a-chrysalide-research">
                        <div id="find-a-chrysalide-research-input">
                            <form class="input-search" method="post" action="">
                                <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M25.7351 24.3201L19.4764 18.0626C21.2904 15.8848 22.195 13.0914 22.0019 10.2635C21.8089 7.43573 20.533 4.7912 18.4398 2.88009C16.3466 0.968989 13.5972 -0.0615536 10.7635 0.00284627C7.92984 0.0672461 5.23008 1.22163 3.22586 3.22586C1.22163 5.23008 0.0672461 7.92984 0.00284627 10.7635C-0.0615536 13.5972 0.968989 16.3466 2.88009 18.4398C4.7912 20.533 7.43573 21.8089 10.2635 22.0019C13.0914 22.195 15.8848 21.2904 18.0626 19.4764L24.3201 25.7351C24.413 25.828 24.5233 25.9017 24.6447 25.952C24.7661 26.0023 24.8962 26.0282 25.0276 26.0282C25.159 26.0282 25.2891 26.0023 25.4105 25.952C25.5319 25.9017 25.6422 25.828 25.7351 25.7351C25.828 25.6422 25.9017 25.5319 25.952 25.4105C26.0023 25.2891 26.0282 25.159 26.0282 25.0276C26.0282 24.8962 26.0023 24.7661 25.952 24.6447C25.9017 24.5233 25.828 24.413 25.7351 24.3201ZM2.02763 11.0276C2.02763 9.2476 2.55547 7.50754 3.5444 6.0275C4.53334 4.54745 5.93894 3.3939 7.58348 2.71271C9.22801 2.03152 11.0376 1.85329 12.7834 2.20056C14.5293 2.54783 16.1329 3.405 17.3916 4.66367C18.6503 5.92234 19.5074 7.52599 19.8547 9.27182C20.202 11.0176 20.0237 12.8272 19.3425 14.4718C18.6614 16.1163 17.5078 17.5219 16.0278 18.5109C14.5477 19.4998 12.8077 20.0276 11.0276 20.0276C8.64149 20.025 6.35385 19.0759 4.66659 17.3887C2.97934 15.7014 2.03028 13.4138 2.02763 11.0276Z" fill="red" />
                                </svg>
                                <input type="text" placeholder="Rechercher">
                            </form>
                            <div id="find-a-chrysalide-research-input-checkbox">
                                <div>
                                    <input type="checkbox" id="public" name="access" value="public">
                                    <label for="public">Public</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="private" name="access" value="private">
                                    <label for="private">Privée</label>
                                </div>
                            </div>
                        </div>

                        <div id="find-a-chrysalide-sports">
                            <button class="display-sport sport-co" data-sport='football' data-user="<?php echo $user_id ?>">
                                <h6 id='btn-football'>Football</h6>
                            </button>
                            <button class="display-sport sport-co" data-sport='basketball' data-user="<?php echo $user_id ?>">
                                <h6 id='btn-basketball'>Basketball</h6>
                            </button>
                            <button class="display-sport sport-raquette" data-sport='tennis' data-user="<?php echo $user_id ?>">
                                <h6 id='btn-tennis'>Tennis</h6>
                            </button>
                            <button class="display-sport sport-co" data-sport='baseball' data-user="<?php echo $user_id ?>">
                                <h6 id='btn-baseball'>Baseball</h6>
                            </button>
                            <button class="display-sport sport-raquette" data-sport='badminton' data-user="<?php echo $user_id ?>">
                                <h6 id='btn-badminton'>Badminton</h6>
                            </button>
                            <button class="display-sport sport-raquette" data-sport='ping-pong' data-user="<?php echo $user_id ?>">
                                <h6 id='btn-ping-pong'>Ping-pong</h6>
                            </button>
                            <button class="display-sport sport-solo" data-sport='golf' data-user="<?php echo $user_id ?>">
                                <h6 id='btn-golf'>Golf</h6>
                            </button>
                            <button class="display-sport sport-solo" data-sport='boxe' data-user="<?php echo $user_id ?>">
                                <h6 id='btn-boxe'>Boxe</h6>
                            </button>
                        </div>
                    </div>
                    <div id="find-a-chrysalide-pop-up">
                        <button class="find-a-chrysalide-filter-button" onclick="showFilter()">
                            <div class="find-a-chrysalide-filter-button-line filter-open">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <h6>Filter</h6>
                        </button>

                        
                        <div id="find-a-chrysalide-content-event">

                        </div>


                        <div id="find-a-chrysalide-filter">
                            <button class="find-a-chrysalide-filter-button" onclick="hideFilter()">
                                <div class="find-a-chrysalide-filter-button-line filter-close">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <h6>Filter</h6>
                            </button>
                            <div id="find-a-chrysalide-filter-content">
                                <form class="input-search" method="" action="">
                                    <svg class="svg-in-black" width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M25.7351 24.3201L19.4764 18.0626C21.2904 15.8848 22.195 13.0914 22.0019 10.2635C21.8089 7.43573 20.533 4.7912 18.4398 2.88009C16.3466 0.968989 13.5972 -0.0615536 10.7635 0.00284627C7.92984 0.0672461 5.23008 1.22163 3.22586 3.22586C1.22163 5.23008 0.0672461 7.92984 0.00284627 10.7635C-0.0615536 13.5972 0.968989 16.3466 2.88009 18.4398C4.7912 20.533 7.43573 21.8089 10.2635 22.0019C13.0914 22.195 15.8848 21.2904 18.0626 19.4764L24.3201 25.7351C24.413 25.828 24.5233 25.9017 24.6447 25.952C24.7661 26.0023 24.8962 26.0282 25.0276 26.0282C25.159 26.0282 25.2891 26.0023 25.4105 25.952C25.5319 25.9017 25.6422 25.828 25.7351 25.7351C25.828 25.6422 25.9017 25.5319 25.952 25.4105C26.0023 25.2891 26.0282 25.159 26.0282 25.0276C26.0282 24.8962 26.0023 24.7661 25.952 24.6447C25.9017 24.5233 25.828 24.413 25.7351 24.3201ZM2.02763 11.0276C2.02763 9.2476 2.55547 7.50754 3.5444 6.0275C4.53334 4.54745 5.93894 3.3939 7.58348 2.71271C9.22801 2.03152 11.0376 1.85329 12.7834 2.20056C14.5293 2.54783 16.1329 3.405 17.3916 4.66367C18.6503 5.92234 19.5074 7.52599 19.8547 9.27182C20.202 11.0176 20.0237 12.8272 19.3425 14.4718C18.6614 16.1163 17.5078 17.5219 16.0278 18.5109C14.5477 19.4998 12.8077 20.0276 11.0276 20.0276C8.64149 20.025 6.35385 19.0759 4.66659 17.3887C2.97934 15.7014 2.03028 13.4138 2.02763 11.0276Z" fill="white" />
                                    </svg>
                                    <input type="text" class="input-in-white" placeholder="Saisissez une ville">
                                    <select id="select-ray">
                                        <option value="0">
                                            <h6>Rayon</h6>
                                        </option>
                                        <option value="5">
                                            <h6>5 KM</h6>
                                        </option>
                                        <option value="10">
                                            <h6>10 KM</h6>
                                        </option>
                                        <option value="20">
                                            <h6>20 KM</h6>
                                        </option>
                                        <option value="50">
                                            <h6>50 KM</h6>
                                        </option>
                                        <option value="100">
                                            <h6>100 KM</h6>
                                        </option>
                                    </select>
                                </form>

                            </div>
                            <div id="number-of-places">
                                <h5>Places disponibles</h5>
                                <div id="number-of-places-checkbox">
                                    <div class="the-place-checkbox">
                                        <input type="checkbox">
                                        <h6>1</h6>
                                    </div>
                                    <div class="the-place-checkbox">
                                        <input type="checkbox">
                                        <h6>2</h6>
                                    </div>
                                    <div class="the-place-checkbox">
                                        <input type="checkbox">
                                        <h6>3</h6>
                                    </div>
                                    <div class="the-place-checkbox">
                                        <input type="checkbox">
                                        <h6>4</h6>
                                    </div>
                                    <div class="the-place-checkbox">
                                        <input type="checkbox">
                                        <h6>5</h6>
                                    </div>
                                    <div class="the-place-checkbox">
                                        <input type="checkbox">
                                        <h6>6</h6>
                                    </div>
                                    <div class="the-place-checkbox">
                                        <input type="checkbox">
                                        <h6>7</h6>
                                    </div>
                                    <div class="the-place-checkbox">
                                        <input type="checkbox">
                                        <h6>8</h6>
                                    </div>
                                    <div class="the-place-checkbox">
                                        <input type="checkbox">
                                        <h6>Plus</h6>
                                    </div>
                                </div>
                            </div>
                            <div id="competition-type">
                                <h5>Type de compétition </h5>
                                <div id="competition-type-checkbox">
                                    <div class="the-competiton-checkbox">
                                        <input type="checkbox">
                                        <h6>Non classé</h6>
                                    </div>
                                    <div class="the-competiton-checkbox">
                                        <input type="checkbox">
                                        <h6>Classé</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script>
        // Récupérer les deux checkboxes
        const publicCheckbox = document.getElementById('public');
        const privateCheckbox = document.getElementById('private');

        // Ajouter un événement "click" à chaque checkbox
        publicCheckbox.addEventListener('click', function() {
            if (publicCheckbox.checked) {
                privateCheckbox.checked = false;
            }
        });

        privateCheckbox.addEventListener('click', function() {
            if (privateCheckbox.checked) {
                publicCheckbox.checked = false;
            }
        });

        const filter = document.getElementById("find-a-chrysalide-filter");



        function showFilter() {
            filter.style.display = "flex";
        }

        function hideFilter() {
            filter.style.display = "none";
        }
    </script>
</body>

</html>