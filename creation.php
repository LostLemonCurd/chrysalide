<?php
// Informations de connexion à la base de données MySQL
$serveur = "localhost";
$utilisateur = "nom_utilisateur";
$mot_de_passe = "mot_de_passe";
$base_de_donnees = "nom_base_de_donnees";

// Établir une connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);
if (!$connexion) {
    die("Connexion à la base de données impossible : " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupérer les données saisies par l'utilisateur
    $ville = $_POST["ville"];
    $places_disponibles = $_POST["places_disponibles"];
    $sports = $_POST["sports"];
    $amis = $_POST["amis"];

    // Générer un nom de groupe aléatoire
    $nom_groupe = 'Groupe_' . uniqid();

    // Vérifier si le nom de groupe est déjà utilisé
    $requete = "SELECT COUNT(*) as count FROM groupes WHERE nom_groupe = '$nom_groupe'";
    $resultat = mysqli_query($connexion, $requete);
    $donnees = mysqli_fetch_assoc($resultat);
    if ($donnees['count'] > 0) {
        // Le nom de groupe est déjà utilisé, générer un nouveau nom
        $nom_groupe = 'Groupe_' . uniqid();
    }

    // Insérer les données dans la table "groupes"
    $requete = "INSERT INTO groupes (nom_groupe, ville, places_disponibles, sports, amis) 
                VALUES ('$nom_groupe', '$ville', '$places_disponibles', '$sports', '$amis')";
    if (mysqli_query($connexion, $requete)) {
        echo "Données insérées avec succès";
    } else {
        echo "Erreur : " . $requete . "<br>" . mysqli_error($connexion);
    }

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
}
?>

<!-- Formulaire HTML -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Ville : <input type="text" name="ville"><br>
    Places disponibles : 
    <select name="places_disponibles">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
    </select><br>
    Sports :<br>
    <input type="checkbox" name="sports[]" value="Football">Football<br>
    <input type="checkbox" name="sports[]" value="Basketball">Basketball<br>
    <input type="checkbox" name="sports[]" value="Tennis">Tennis<br>
    <input type="checkbox" name="sports[]" value="Golf">Golf<br>
    <input type="checkbox" name="sports[]" value="Boxe">Boxe<br>
    <input type="checkbox" name="sports[]" value="Baseball">Baseball<br>
    <input type="checkbox" name="sports[]" value="Tennis">Tennis<br>
    <input type="checkbox" name="sports[]" value="Ping-pong">Ping-pong<br>
    <
