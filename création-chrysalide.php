<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width'>
    <link rel='stylesheet' href='reset.css'>
    <link rel="stylesheet" href="lib.css">
    <link rel="stylesheet" href="chysalide.css">
    <script src='https://kit.fontawesome.com/3ebad5cdee.js' crossorigin='anonymous'></script>
    <title>Création | Chrysalide</title>
</head>
<body>
<?php
include('init.php');
// Vérifier si le formulaire a été soumis
$user_id = $_SESSION["user"]["id_user"];
if ($_POST) {

    // Récupérer les données saisies par l'utilisateur
    $ville = $_POST["ville"];
    $places_disponibles = $_POST["places_disponibles"];
    $sport = $_POST["sports"];


    // Générer un nom de groupe aléatoire
    $nom_groupe = 'Groupe_' . uniqid();

    // Vérifier si le nom de groupe est déjà utilisé
    $r = $pdo->query("SELECT * FROM groupes WHERE nom_groupe = '$nom_groupe'");
    if ($r->rowCount() >= 1) {
        // Le nom de groupe est déjà utilisé, générer un nouveau nom
        $nom_groupe = 'Groupe_' . uniqid();
    }

    // Insérer les données dans la table "groupes"
    $pdo->exec("INSERT INTO groupes (nom_groupe, ville, places_disponibles, sport, id_user) 
    VALUES ('$nom_groupe', '$ville', '$places_disponibles', '$sport', '$user_id')");


    if (mysqli_query($connexion, $requete)) {
        echo "Données insérées avec succès";
    } else {
        echo "Erreur : " . $requete . "<br>" . mysqli_error($connexion);
    }

   
}
?>
<!-- Formulaire HTML -->
<div class="overly">
    <div class="overlay-content">
    <h1 id="titre-overlay">Créer ta Chrysalide</h1>
    <button class="close-btn">x</button>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["chrysalide"]); ?>">
            <h2 class='espace'>Ville : </h2>
            <input type="text" name="ville"><br>
            <h2 class='espace'>Nom du Groupe : </h2>
            <input type="text" name="nom_grp"><br>
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
                <img src="img/foot.png" alt="" width="112" height="100">
                <input type="checkbox" name="sport[]" value="Football">Football<br>
            </div>
            <div class="carte_sport">
                <img src="img/foot.png" alt="" width="112" height="100">
                <input type="checkbox" name="sport[]" value="Basketball">Basketball<br>
            </div>
            <div class="carte_sport">
                <img src="img/foot.png" alt="" width="112" height="100">
                <input type="checkbox" name="sport[]" value="Golf">Golf<br>
            </div>
            <div class="carte_sport">
                <img src="img/foot.png" alt="" width="112" height="100">
                <input type="checkbox" name="sport[]" value="Boxe">Boxe<br>
            </div>
            </div>
            <div class="sport_line">
            <div class="carte_sport">
                <img src="img/foot.png" alt="" width="112" height="100">
                <input type="checkbox" name="sport[]" value="Baseball">Baseball<br>
            </div>
            <div class="carte_sport">
                <img src="img/foot.png" alt="" width="112" height="100">
                <input type="checkbox" name="sport[]" value="Tennis">Tennis<br>
            </div>
            <div class="carte_sport">
                <img src="img/foot.png" alt="" width="112" height="100">
                <input type="checkbox" name="sport[]" value="Ping-pong">Ping-pong<br>
            </div>
            <div class="carte_sport">
                <img src="img/foot.png" alt="" width="112" height="100">
                <input type="checkbox" name="sport[]" value="Badminton">Badminton<br>
            </div>
            </div>
            </select>
            <div class="Créergroupe"><input class=btn-blue type="submit" value="Créer un groupe"></div>
            
        </form>
    </div>
</div>
</body>
</html>
