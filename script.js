// Redirection vers la page home avec le logo

let logo = document.querySelector('#header-logo > img');
logo.addEventListener('click', () => {
    window.location.assign("index.php");
})


// Inscription

function redirectionToHomapage(){
    setTimeout(() =>{
        var myWindow = window.open("index.php", "_self");
    },3000)
}


// Demande de confirmation avant déconnexion

let deco = document.querySelector('#deco');

deco.addEventListener('click', (e) =>{

    e.preventDefault();

    let seDeconnecter = confirm('Êtes-vous sur de vouloir vous déconnecter?');

    if(seDeconnecter){
        location.href = 'connexion.php';
    }
})


// Requête Ajax
$(document).ready(function() {

	// Je capte l'évenement change sur la div friend :
	$('.friend').click(function(e) {
        e.preventDefault();
        $('.friend-detail').toggle().css('display', 'flex');
		// Je récupère le friend_id qui est dans l'attribut html data 
		let friend_id = $(this).data('id');
        let userId = $(this).data('conuser');
		console.log(friend_id);
		console.log(userId);

		// Je lance la fonction ajax :
		$.ajax({
			// Je mets l'URL dans laquelle je récupère les données :
			url: 'getFriendDetails.php',
			// Le type est get car je récupère des infos :
			type: 'GET',
			// Le type de donnée qu'on veut recupérer est en json :
			dataType: 'json',
			// Dans la propriété data, je mets un objet ayant comme propriété monIdEmploye (qui sera récupérable en PHP) avec comme valeur ma variable id_employe créée plus haut :
			data: {friendId: friend_id, userId: userId}
		}).done(function(data) {
			// A faire après le PHP :
			console.log(data); /*je récupère données*/
            $('.friendName').text(data.friend.username);
            $('.friendImg').attr('src', `img/${data.friend.userimg}`);
            $('.friendSport').text(data.friend.favsport);
            if (data.isAFriend !== true) {
                $('.request-f').text('Suivre');
            } else {
                $('.request-f').text('Se désabonner');      
            }

		});
	});

    // 	// Je capte l'évenement change sur le select :
	// $('.request-f').click(function(e) {
    //     e.preventDefault();
	// 	// Je récupère le friend_id qui est dans l'attribut html data 
    //     let friendIdBis = $(this).attr('data-id');
    //     let userId = $(this).data('conuser');
	// 	console.log(friendIdBis);
    //     console.log(userId);
	// 	// Je lance la fonction ajax :
	// 	$.ajax({
	// 		// Je mets l'URL dans laquelle je récupère les données :
	// 		url: 'isAFriendStatus.php',
	// 		// Le type est get car je récupère des infos :
	// 		type: 'GET',
	// 		// Le type de donnée qu'on veut recupérer est en json :
	// 		dataType: 'json',
	// 		// Dans la propriété data, je mets un objet ayant comme propriété monIdEmploye (qui sera récupérable en PHP) avec comme valeur ma variable id_employe créée plus haut :
    //         data: {friendIdBis: friendIdBis, userId: userId}
	// 	}).done(function(data) {
	// 		console.log(data); /*je récupère données*/
    //         if (data === false) {
    //             $(this).text('Suivre');
    //         } else {
    //             $(this).text('Se désabonner');
    //         }
    //         // if (data.)
    //         // $('.request-f').text('');
    //         // $('.request-f').data('id') = data.id_user;
	// 	});
	// });
});
