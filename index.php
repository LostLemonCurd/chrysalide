<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width'>
    <link rel='stylesheet' href='reset.css'>
    <link rel='stylesheet' href='lib.css'>
    <script src='script.js' defer></script>
    <script src='https://kit.fontawesome.com/3ebad5cdee.js' crossorigin='anonymous'></script>
    <title>Chrysalide</title>
</head>
<body>
    <?php 
    include('init.php');
    
    
    $userImage = $_SESSION['user']['userimg'];
    $userName =  $_SESSION['user']['username'];
    // $usertoken = $_SESSION['user']['usercoins'];
    // $usertoken = $_SESSION['user']['usertrophees'];
    
        $r = $pdo->query('SELECT * FROM user');
    // while ($user = $r->fetch(PDO::FETCH_ASSOC)) {
    //     $userImg = $user['userimg'];
    // }

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
                <img src="img/<?php echo $userImage ?>" alt="photo de profil">
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
            </nav>
        </aside>
        <section id="main-content">
            <section id="main-content-homepage">
                <div id="main-welcome">
                    <div id="main-welcome-text">
                        <div id="main-welcome-text-title">
                            <h1>Bienvenue</h1>
                            <h2>sur</h2>
                            <p class="font-lalezard">Chrysalide</p>
                        </div>
                        <div id="main-welcome-text-description">
                            <p>Découvrez de nombreux sports en créant ou rejoignant une  chrysalide et organisez de nouvelles rencontres sportives proches de chez vous</p>
                        </div>
                    </div>
                    <div id="main-welcome-img">
                        <img src="img/all_sports.png" alt="image équipement de sport">
                    </div>
                </div>

                <section id="profil-organisation-chrysalide">
                    <div id="profil-in-organisation">
                        <h2><?php echo $userName ?></h2> <!-- PHP name -->
                        <img src="img/<?php echo $userImage ?>" alt="photo de profil">
                        <div id="profil-statistic">
                            <div id="profil-trophee">
                                <img src="img/trophe.svg" alt="">
                                <span>
                                    <?php  ?>
                                </span>
                            </div>

                            <div id="profil-coins">
                                <img src="img/mini_logo_coins.png" alt="">
                                <span>
                                    <?php  ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div id="create-organisation-chrysalide">
                        <h2>Organisez votre prochaine</h2>
                        <div id="logo-chrysalide-animation">
                            <svg width="118" height="208" viewBox="0 0 118 208" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.822632 106.838L66.4302 207.65L116.069 132.977H104.232L66.4302 189.276L12.7793 106.693L66.4331 19.0763L104.124 78.634L116.069 78.6547L66.3165 0" fill="#1C1C28"/>
                                <path d="M0.822632 106.838L66.4302 207.65L116.069 132.977H104.232L66.4302 189.276L12.7793 106.693L66.4331 19.0763L104.124 78.634L116.069 78.6547L66.3165 0" stroke="#1C1C28" stroke-miterlimit="10"/>
                            </svg>
                            <svg width="76" height="147" viewBox="0 0 76 147" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M46.0085 0.858704L75.9524 47.7304H63.9838L46.176 19.9202L12.109 75.9761L46.0653 128.406L64.0048 102.26H75.7581L46.0653 146.792L0.0686035 75.9761L46.0085 0.858704Z" fill="#1C1C28"/>
                            </svg>
                            <svg width="66" height="46" viewBox="0 0 66 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M33.2486 5.30274L20.2037 5.21979L13.578 13.9477L6.95239 22.6756L9.25462 25.8189C10.5223 27.5491 13.4076 31.4953 15.6769 34.5942C17.9433 37.6961 19.8419 40.2469 19.8419 40.2469C19.8419 40.2469 23.6421 40.2913 28.2405 40.318C32.839 40.3476 38.6992 40.3832 41.2616 40.401L45.9258 40.4306L52.5515 31.7027L59.1771 22.9748L52.8235 14.2913C49.3283 9.51559 46.4311 5.55753 46.3833 5.49828L46.2966 5.38866L33.2516 5.30571L33.2486 5.30274Z" stroke="#3E7BFA" stroke-width="10" stroke-miterlimit="10"/>
                            </svg>
                        </div>
                        <p class="font-lalezard">Chrysalide</p>
                    </div>
                </section>
                <section id="prochaine-chrysalide">
                    <h2>Mes prochaines chrysalides</h2>
                    <a class="voir-plus" href="#">Voir plus</a>
                </section>
                <section id="teams">
                    <div class="team-card">
                        <div class="team-card-title">
                            <h3 class="color-white">Équipe</h3>
                            <h3 class="color-purple">Rangers</h3>
                        </div>
                        <img src="img/image_football.png" alt="">
                        <div class="team-card-date">
                            <h5 class="color-white">Montreuil</h5>
                            <h5 class="color-white">12/03/2023</h5>
                        </div>
                    </div>
                    <div class="team-card">
                        <div class="team-card-title">
                            <h3 class="color-white">Équipe</h3>
                            <h3 class="color-orange">Rigolo</h3>
                        </div>
                        <img src="img/image_tennis.png" alt="">
                        <div class="team-card-date">
                            <h5 class="color-white">Paris</h5>
                            <h5 class="color-white">12/03/2023</h5>
                        </div>
                    </div>
                    <div class="team-card">
                        <div class="team-card-title">
                            <h3 class="color-white">Équipe</h3>
                            <h3 class="color-purple">Supreme</h3>
                        </div>
                        <img src="img/image_football.png" alt="">
                        <div class="team-card-date">
                            <h5 class="color-white">Paris</h5>
                            <h5 class="color-white">12/03/2023</h5>
                        </div>
                    </div>

                </section>
                <section>
                    <h2>Tournois en cours</h2>
                </section>
                <section>
                    
                </section>
            </section>

        </section>

    </main>

</body>
</html>