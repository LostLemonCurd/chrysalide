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
		// Je récupère le friendId qui est dans l'attribut html data 
		let friendId = $(this).data('id');
        let userId = $(this).data('conuser');
		console.log(friendId);
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
			data: {friendId: friendId, userId: userId}
		}).done(function(data) {
			// A faire après le PHP :
			console.log(data); /*je récupère données*/
            $('.friendName').text(data.friend.username);
            $('.friendImg').attr('src', `img/${data.friend.userimg}`);
            $('.friendSport').text(data.friend.favsport);
            if (data.isAFriend !== true) {
                $('#request-f').text('Suivre');
                $('#request-f').attr('data-isfriend', 0);
                $('#request-f').attr('data-friendid', friendId);
            } else {
                $('#request-f').text('Se désabonner'); 
                $('#request-f').attr('data-isfriend', 1);    
                $('#request-f').attr('data-friendid', friendId); 
            }

		});
	});

    $('#request-f').on('click', function(e) {
        e.preventDefault();
        console.log('you clicked');
        let friendId = $(this).data('friendid');
        let userId = $(this).data('conuser');
        console.log(friendId);
		console.log(userId);
        let isFriend = $(this).data('isfriend');
        console.log(isFriend);
        if (isFriend === 0) {
            url = 'addFriend.php';
        } else {
            url = 'removeFriend.php';
        }
        console.log(url);
		// Je lance la fonction ajax :
		$.ajax({
			// Je mets l'URL dans laquelle je récupère les données :
			url: url,
			// Le type est get car je récupère des infos :
			type: 'POST',
			// Le type de donnée qu'on veut recupérer est en json :
			dataType: 'json',
			// Dans la propriété data, je mets un objet ayant comme propriété friendId (qui sera récupérable en PHP) avec comme valeur ma variable id_employe créée plus haut :
			data: {friendId: friendId, userId: userId}
		}).done(function(data) {
			// A faire après le PHP :
            console.log(data);
            if (url === 'addFriend.php') {
                $('#request-f').text('Se désabonner'); 
                $('#request-f').attr('data-isfriend', 1);   
                $('#request-f').attr('data-friendid', friendId);
            } else if (url === 'removeFriend.php'){
                $('#request-f').text('Suivre');
                $('#request-f').attr('data-isfriend', 0);
                $('#request-f').attr('data-friendid', friendId);
            }

		});
    });
});
