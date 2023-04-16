// Requête Ajax
let chrysalideAllContainer = document.querySelector('#find-a-chrysalide-content-event');

$(document).ready(function() {

	// Je capte l'évenement change sur la div friend :
	$('.display-sport').click(function(e) {
        e.preventDefault(); // no refresh

		// Emptying the div container eachtime we want to display something new:
		chrysalideAllContainer.innerHTML = '';

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
			for (let i = 0; i < data.sport.length; i++) {
				let chrysalideContainer = document.createElement('div');
				chrysalideContainer.setAttribute('id', 'find-a-chrysalide-event');

				let chrysalideTitle = document.createElement('div');
				chrysalideTitle.setAttribute('id', 'find-a-chrysalide-event-title');
				let chrysTitle = document.createElement('h5');
				chrysTitle.classList.add('color-purple');
				chrysTitle.innerHTML = data.sport[i].nom_groupe;
				
				let chrysalideImage =document.createElement('div');
				chrysalideImage.setAttribute('id', 'find-a-chrysalide-event-img');
				let chrysImg = document.createElement('img');
				chrysImg.setAttribute('src', `img/${data.sport[i].sportImg}`);
				chrysImg.setAttribute('alt', 'image du sport');
				let chrysVille = document.createElement('h5');
				chrysVille.setAttribute('class', 'dark-center');
				chrysVille.innerHTML = data.sport[i].ville;
				
				
				let chrysalideBtnDiv = document.createElement('div');
				chrysalideBtnDiv.setAttribute('id', 'find-a-chrysalide-event-buttons');
				
				let chrysalideBtn = document.createElement('button');
				chrysalideBtn.setAttribute('class', 'btnRejoindre');
				chrysalideBtn.setAttribute('data-groupe', data.sport[i].nom_groupe);
				chrysalideBtn.setAttribute('data-user', userId);
				chrysalideBtn.setAttribute('data-datecrea', data.sport[i].date_creation);
				chrysalideBtn.setAttribute('data-place', data.sport[i].places_disponibles);
				chrysalideBtn.setAttribute('data-ville', data.sport[i].ville);
				chrysalideBtn.setAttribute('data-sport', data.sport[i].sport);
				chrysalideBtn.setAttribute('data-dateevent', data.sport[i].date_event);

				let chrysalideBtnH5 = document.createElement('h5');
				chrysalideBtnH5.setAttribute('class', 'color-black');
				chrysalideBtnH5.innerHTML = 'Rejoindre';
				let chrysalideH5 = document.createElement('h5');
				chrysalideH5.setAttribute('class', 'color-black');
				chrysalideH5.innerHTML = `1/${data.sport[i].places_disponibles}`;
				
				chrysalideBtn.appendChild(chrysalideBtnH5);
				chrysalideBtnDiv.append(chrysalideBtn, chrysalideH5);
				chrysalideImage.append(chrysImg, chrysVille);
				chrysalideTitle.appendChild(chrysTitle);
				chrysalideContainer.append(chrysTitle, chrysalideImage, chrysalideBtnDiv);
				chrysalideAllContainer.appendChild(chrysalideContainer);
			}
		});
	});


	$(document).on('click', '.btnRejoindre', function(e) {        
        e.preventDefault();
        let groupName =  this.getAttribute("data-groupe");
        let userId =  this.getAttribute("data-user");
		let dateCrea =  this.getAttribute("data-datecrea");
        let place =  this.getAttribute("data-place");
        let ville =  this.getAttribute("data-ville");
        let sport =  this.getAttribute("data-sport");
		let dateEvent =  this.getAttribute("data-dateevent");

		// Je lance la fonction ajax :
		$.ajax({
			// Je mets l'URL dans laquelle je récupère les données :
			url: 'joinGroup.php',
			// Le type est get car je récupère des infos :
			type: 'POST',
			// Le type de donnée qu'on veut recupérer est en json :
			dataType: 'json',
			// Dans la propriété data, je mets un objet ayant comme propriété friendId (qui sera récupérable en PHP) avec comme valeur ma variable id_employe créée plus haut :
			data: {groupName: groupName, userId: userId, dateCrea: dateCrea, place: place, ville: ville, sport: sport, dateEvent: dateEvent}
		}).done(function(data) {
			// A faire après le PHP :
            console.log(data);

		});
    });

});
