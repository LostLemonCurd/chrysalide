// Redirection vers la page home avec le logo

let logo = document.querySelector('#header-logo > img');
logo.addEventListener('click', () => {
    window.location.assign("index.php");
})


// // Affichage des éléments amis

// let friend = document.querySelectorAll('.friend');
// console.log(friend);

// let friendDetail = document.querySelector('.friend-detail');
// console.log(friendDetail);

// // Ajout de la fonctionnalité d'affichager/masquer les détails des amis de l'utilisateur
// for (const element of friend) {
//     element.addEventListener('click', () => {
//         if (friendDetail.style.display === 'none') {
//             friendDetail.style.display = 'flex';
//         } else {
//             friendDetail.style.display = 'none';
//         }
//     })
// }


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

	// Je capte l'évenement change sur le select :
	$('.friend').click(function(e) {
        e.preventDefault();
        $('.friend-detail').toggle().css('display', 'flex');
        console.log('You clicked');
		// Je récupère le friend_id qui est dans l'attribut html data 
		let friend_id = $(this).data('id');
		console.log(friend_id);

		// Je lance la fonction ajax :
		$.ajax({
			// Je mets l'URL dans laquelle je récupère les données :
			url: 'getFriendDetails.php',
			// Le type est get car je récupère des infos :
			type: 'GET',
			// Le type de donnée qu'on veut recupérer est en json :
			dataType: 'json',
			// Dans la propriété data, je mets un objet ayant comme propriété monIdEmploye (qui sera récupérable en PHP) avec comme valeur ma variable id_employe créée plus haut :
			data: {friendId: friend_id}
		}).done(function(data) {
			// A faire après le PHP :
			console.log(data); /*je récupère données*/
            $('.friendName').text(data.username);
            $('.friendImg').attr('src', `img/${data.userimg}`);
            $('.friendSport').text(data.favsport);
            $('.friendName').text(data.username);			
		});
	});

});
