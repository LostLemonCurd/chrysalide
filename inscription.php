<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width'>
    <link rel='stylesheet' href='reset.css'>
    <link rel="stylesheet" href="lib.css">
    <link rel='stylesheet' href='inscription.css'>
    <script src='script.js' defer></script>
    <script src='https://kit.fontawesome.com/3ebad5cdee.js' crossorigin='anonymous'></script>
    <title>Inscription | Chrysalide</title>
</head>
<body>
    <h6 style="color:white;"> <?php     error_reporting(E_ALL); 
    ini_set('display_errors', 1); ?></h6>
    <?php 

    include('init.php');

    if($_POST){
        
        // Je définie une varaible qui me sert à afficher les erreurs:
        $erreur = '';
        //Je verifie si le prénom n'est pas trop court ou trop long:
        if(strlen($_POST['email']) <= 2 || strlen($_POST['email']) > 100) {
            $erreur .= '<p>Votre email est trop court ou trop long.<p>';
        }
        
        // Je vérifie que l'email n'a pas déjà été utilisé
        $r = $pdo->query("SELECT * FROM user WHERE email = '$_POST[email]'");
        if ($r->rowCount() >= 1) {
            $erreur .= '<p>Compte déjà existant!</p>';
        }

        // Je vérifie que le pseudo n'a pas déjà été utilisé
        $r2 = $pdo->query("SELECT * FROM user WHERE username = '$_POST[username]'");
        if ($r2->rowCount() >= 1) {
            $erreur .= '<p>Ce pseudo est déjà utilisé!</p>';
        }

        // Pour chaque champ, je corrige le problème d'apostrophe : 
        // A revoir, pas suffisant pour protéger des query injections
        foreach($_POST as $indice => $valeur) {
            $_POST[$indice] = addslashes($valeur);
        }

        // Je hash le mdp:
        $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        $userImg = $_POST['userimg'];

        // Si la variable erreur est vide : 
        if(empty($erreur)){
            //j'enregistre les infos dans la BDD:
            $pdo->exec("INSERT INTO user (email, mdp, username, favsport, userimg) VALUES ('$_POST[email]', '$_POST[mdp]', '$_POST[username]', '$_POST[favsport]', '$userImg')");
        // J'ajoute un message de succès:
            $content .= '<p>Votre inscription a bien été prise en compte !</p>';
        }
        // J'ajoute les messages d'erreur dans la variable content : 
        $content .= $erreur;
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
                        <path d="M25.7351 24.3201L19.4764 18.0626C21.2904 15.8848 22.195 13.0914 22.0019 10.2635C21.8089 7.43573 20.533 4.7912 18.4398 2.88009C16.3466 0.968989 13.5972 -0.0615536 10.7635 0.00284627C7.92984 0.0672461 5.23008 1.22163 3.22586 3.22586C1.22163 5.23008 0.0672461 7.92984 0.00284627 10.7635C-0.0615536 13.5972 0.968989 16.3466 2.88009 18.4398C4.7912 20.533 7.43573 21.8089 10.2635 22.0019C13.0914 22.195 15.8848 21.2904 18.0626 19.4764L24.3201 25.7351C24.413 25.828 24.5233 25.9017 24.6447 25.952C24.7661 26.0023 24.8962 26.0282 25.0276 26.0282C25.159 26.0282 25.2891 26.0023 25.4105 25.952C25.5319 25.9017 25.6422 25.828 25.7351 25.7351C25.828 25.6422 25.9017 25.5319 25.952 25.4105C26.0023 25.2891 26.0282 25.159 26.0282 25.0276C26.0282 24.8962 26.0023 24.7661 25.952 24.6447C25.9017 24.5233 25.828 24.413 25.7351 24.3201ZM2.02763 11.0276C2.02763 9.2476 2.55547 7.50754 3.5444 6.0275C4.53334 4.54745 5.93894 3.3939 7.58348 2.71271C9.22801 2.03152 11.0376 1.85329 12.7834 2.20056C14.5293 2.54783 16.1329 3.405 17.3916 4.66367C18.6503 5.92234 19.5074 7.52599 19.8547 9.27182C20.202 11.0176 20.0237 12.8272 19.3425 14.4718C18.6614 16.1163 17.5078 17.5219 16.0278 18.5109C14.5477 19.4998 12.8077 20.0276 11.0276 20.0276C8.64149 20.025 6.35385 19.0759 4.66659 17.3887C2.97934 15.7014 2.03028 13.4138 2.02763 11.0276Z" fill="#1C1C28"/>
                    </svg>
                    <input class="search-bar" type="text" placeholder="Rechercher">
                </form>
                <div id="header-buttons">
                    <a href="#"><h6>Tournois</h6></a>
                    <a href="#"><h6>Chrysalide</h6></a>
                </div>
            </section>
            <section id="header-profil">
                <img src="img/img-profile.png" alt="photo de profil">
            </section>
        </section>
        
    </header>
    <main>
        <h1>Inscription</h1>
        <form method="post" class="inscription">
            <input type="email" placeholder="Adresse Mail" name="email">
            <input type="password" placeholder="Mot De Passe" name="mdp">
            <input type="text" placeholder="Pseudo Utilisateur" name="username">
            <input type="text" placeholder="Vos Sports De Prédilection" name="favsport">
            <h6>Choissisez une icône</h6>
            <div class="profile-pic">
                <div class="profile-choice">
                    <label for="img1"><img src="img/avatar-1.png" alt="Avatar à choisir"></img></label>
                    <input type="radio" id="img1" name="userimg" value="Avatar1">  
                </div>
                <div class="profile-choice">
                    <label for="img2"><img src="img/avatar-2.png" alt="Avatar à choisir"></img></label>
                    <input type="radio" id="img2" name="userimg" value="Avatar2">
                </div>
                <div class="profile-choice">
                    <label for="img3"><img src="img/avatar-3.png" alt="Avatar à choisir"></img></label>
                    <input type="radio" id="img3" name="userimg" value="Avatar3">
                </div>
                <div class="profile-choice">
                    <label for="img4"><img src="img/avatar-4.png" alt="Avatar à choisir"></img></label>
                    <input type="radio" id="img4" name="userimg" value="Avatar4">
                </div>
            </div>
            <input type="submit" value="Valider" class="btn-valider">
        </form>
        <h6 class="account_status"><?php echo $content ?></h6>
        <h6>Vous avez déjà un compte? C'est par <a href="connexion.php">ici</a></h6>
    </main>
</body>
</html>