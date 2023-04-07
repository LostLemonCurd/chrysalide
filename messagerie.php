<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="lib.css">
    <link rel="stylesheet" href="messagerie.css">
    <script src='script.js' defer></script>
    <title>Librairie</title>
</head>
<body>
<?php
require 'init.php';

// Enregistrer les commentaires dans la base
// Si le formulaire est posté :
if($_POST) {
// Je corrige les '' :
$_POST['id_expediteur'] = addslashes($_POST['id_expediteur']);
$_POST['message'] = addslashes($_POST['message']);
    
// J'enregiste le commentaire dans la base :
// exec = executer 
$pdo->exec("INSERT INTO messages (id_expediteur, message, date)
VALUES ('$_POST[id_expediteur]', '$_POST[messages]', NOW())");
}

// Afficher les commentaires sur la page
// fetch stock toutes les informations 
    $r = $pdo->query('SELECT * FROM messages');
    while ($messages = $r->fetch(PDO::FETCH_ASSOC)) {
        echo $messages['user'] . ' : ' . $messages['message'] . '<br>';
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

        <section id="main-content-messagerie">
            <section class="head-messagerie">
                <h1>Messagerie<span>Chrysalide</span></h1>
                <img src="img/image_message.png" alt="image icones message">
            </section>

            <div class="messagerie-contact">
                <section class="chat-messagerie">
                    <div class="list-messages">
                        <?php
                        while ($messages = $r->fetch(PDO::FETCH_ASSOC)) {
                        echo'<div class="messages">
                            <div class="outside-message msg-bleu-ciel">
                                <img src="img/avatar_messagerie_chat_alonso.png" alt="avatar utilisateur messagerie">
                                <div class="inside-message">        
                                    <h6>'. $messages['id_expediteur'].'</h6>
                                    <p>'. $messages['message'].'</p>
                                </div>
                            </div>
                        
                            <h6 class="time">'. $messages['date'].'</h6>
                        </div>';
                        } ?>

                        <?php
                        while ($messages = $r->fetch(PDO::FETCH_ASSOC)) { 
                        echo '<div class="messages">
                            <h6 class="time">'. $messages['date'].'</h6>

                            <div class="outside-message msg-bleu-fonce">
                                <img src="img/avatar_messagerie_chat_alonso.png" alt="avatar utilisateur messagerie">
                                <div class="inside-message">        
                                    <h6>'. $_SESSION['user']['username'].'</h6>
                                    <p>'. $messages['message'].'</p>
                                </div>
                            </div>
                        </div>';
                        } ?>
                    </div>
    
                    <div class="text-input">
                        <form method="POST">
                            <input type="text" id="answer-txt" name="answer-txt">
                            <button type="submit" name="btn-send-message"><img src="img/arrow_message.png" alt="icone fleche envoie message"></button>
                        </form>
                    </div>
                </section>

                <section class="mes-amis">
                    <h2>Contact en cours</h2>
                    <form method="post">
                        <svg width="27" height="27" viewBox="0 0 27 27" fill="#1C1C28" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25.7351 24.3201L19.4764 18.0626C21.2904 15.8848 22.195 13.0914 22.0019 10.2635C21.8089 7.43573 20.533 4.7912 18.4398 2.88009C16.3466 0.968989 13.5972 -0.0615536 10.7635 0.00284627C7.92984 0.0672461 5.23008 1.22163 3.22586 3.22586C1.22163 5.23008 0.0672461 7.92984 0.00284627 10.7635C-0.0615536 13.5972 0.968989 16.3466 2.88009 18.4398C4.7912 20.533 7.43573 21.8089 10.2635 22.0019C13.0914 22.195 15.8848 21.2904 18.0626 19.4764L24.3201 25.7351C24.413 25.828 24.5233 25.9017 24.6447 25.952C24.7661 26.0023 24.8962 26.0282 25.0276 26.0282C25.159 26.0282 25.2891 26.0023 25.4105 25.952C25.5319 25.9017 25.6422 25.828 25.7351 25.7351C25.828 25.6422 25.9017 25.5319 25.952 25.4105C26.0023 25.2891 26.0282 25.159 26.0282 25.0276C26.0282 24.8962 26.0023 24.7661 25.952 24.6447C25.9017 24.5233 25.828 24.413 25.7351 24.3201ZM2.02763 11.0276C2.02763 9.2476 2.55547 7.50754 3.5444 6.0275C4.53334 4.54745 5.93894 3.3939 7.58348 2.71271C9.22801 2.03152 11.0376 1.85329 12.7834 2.20056C14.5293 2.54783 16.1329 3.405 17.3916 4.66367C18.6503 5.92234 19.5074 7.52599 19.8547 9.27182C20.202 11.0176 20.0237 12.8272 19.3425 14.4718C18.6614 16.1163 17.5078 17.5219 16.0278 18.5109C14.5477 19.4998 12.8077 20.0276 11.0276 20.0276C8.64149 20.025 6.35385 19.0759 4.66659 17.3887C2.97934 15.7014 2.03028 13.4138 2.02763 11.0276Z" fill="#1C1C28"/>
                        </svg>
                        <input class="search-bar" type="text" placeholder="Rechercher">
                        <img src="/img/add_contact.png" alt="icone pour ajouter un contact">
                    </form>
                    <div class="friend-list">
                        <div class="friend">
                            <img src="img/avatar1.png" alt="Photo de profil d'un ami">
                            <h4>Php Nom</h4>
                        </div>
                        <div class="friend">
                            <img src="img/avatar2.png" alt="Photo de profil d'un ami">
                            <h4>PHP NOM</h4>
                        </div>
                        <div class="friend">
                            <img src="img/avatar3.png" alt="Photo de profil d'un ami">
                            <h4>PHP NOM</h4>
                        </div>
                        <div class="friend">
                            <img src="img/avatar3.png" alt="Photo de profil d'un ami">
                            <h4>PHP NOM</h4>
                        </div>
                        <div class="friend">
                            <img src="img/avatar3.png" alt="Photo de profil d'un ami">
                            <h4>PHP NOM</h4>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </main>



    
</body>
</html>


<!-- <form method="post">
        <input type="text" name="user" placeholder="Pseudo">
        <br><br>
        <textarea name="message" placeholder="message"></textarea>
        <br><br>
        <input type="submit" value="Poster">
</form> -->