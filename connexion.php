<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width'>
    <link rel='stylesheet' href='reset.css'>
    <link rel="stylesheet" href="lib.css">
    <link rel='stylesheet' href='connexion.css'>
    <script src='script.js' defer></script>
    <script src='https://kit.fontawesome.com/3ebad5cdee.js' crossorigin='anonymous'></script>
    <title>Connexion | Chrysalide</title>
</head>
<body>
    <h6 style="color:white;"> <?php error_reporting(E_ALL); 
    ini_set('display_errors', 1); ?></h6>
    <?php 

    include('init.php');

    if($_POST){

        // Je définie une varaible qui me sert à afficher les erreurs:
        $erreur = '';

        $r = $pdo->query("SELECT * FROM user WHERE email = '$_POST[email]' or username = '$_POST[email]'");
        if ($r->rowCount() >= 1) {
            $user = $r->fetch(PDO::FETCH_ASSOC);
            var_dump($user); 
            //(pour vérifier si l'array a été crée)

            // Je vérifie si le mot de passe est correct:
                if(password_verify($_POST['mdp'], $user['mdp'])) {
                    // Enregistre les infos dans la session :
                    $_SESSION['user']['email'] = $user['email'];
                    $_SESSION['user']['username'] = $user['username'];
                    $_SESSION['user']['favsport'] = $user['favsport'];
                    $_SESSION['user']['userimg'] = $user['userimg'];
                    $_SESSION['user']['date_inscription'] = $user['date_inscription'];

                    // Je redirige l'internaute vers l'index avec la fonction header et l'attribut location: 
                    header('location:index.php');
                    
                } else {
                    $erreur .= '<p>Mot de passe incorrect</p>';
                }
        } else {
            $erreur .= '<p>Ce compte n\'existe pas</p>';
        }

        foreach($_POST as $indice => $valeur) {
            $_POST[$indice] = addslashes($valeur);
        }

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
        <h1>Connexion</h1>
        <form method="post" class="connexion">
            <input type="text" placeholder="Adresse Mail ou Pseudo" name="email">
            <input type="password" placeholder="Mot De Passe" name="mdp">
            <input type="submit" value="Valider" class="btn-valider">
        </form>
        <h6 class="account_status"><?php echo $content ?></h6>
        <h6>Vous n'avez pas de compte? C'est par <a href="inscription.php">ici</a></h6>
    </main>
</body>
</html>