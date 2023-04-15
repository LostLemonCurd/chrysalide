// Requête Ajax
$(document).ready(function() {

	// Je capte l'évenement change sur la div friend :
	$('.display-sport').click(function(e) {
        e.preventDefault(); // no refresh
		// Je récupère le friendId qui est dans l'attribut html data 
		let sportId = $(this).data('sport');
        let userId = $(this).data('user');
		console.log(sportId);
		console.log(userId);

		// Je lance la fonction ajax :
		$.ajax({
			// Je mets l'URL dans laquelle je récupère les données :
			url: 'getsport.php',
			// Le type est get car je récupère des infos :
			type: 'GET',
			// Le type de donnée qu'on veut recupérer est en json :
			dataType: 'json',
			// Dans la propriété data, je mets un objet ayant comme propriété monIdEmploye (qui sera récupérable en PHP) avec comme valeur ma variable id_employe créée plus haut :
			data: {sportId: sportId, userId: userId}
		}).done(function(data) {
			// A faire après le PHP :
			console.log(data); /*je récupère données*/
		});
	});
});

