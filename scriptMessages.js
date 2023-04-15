// Requête Ajax
$(document).ready(function() {
// Je capte l'évenement change sur la div friend :
        $('.friend').click(function(e) {
            e.preventDefault();
            let listMessage = document.querySelector('.list-messages');
            listMessage.innerHTML = ''; // clear previous messages

            // Je récupère le friendId qui est dans l'attribut html data 
            let user_id = $(this).data('user');
            let friendId = $(this).data('friend');
            console.log(user_id);
            console.log(friendId);

            // Je lance la fonction ajax :
            $.ajax({
                // Je mets l'URL dans laquelle je récupère les données :
                url: 'displayMessages.php',
                // Le type est get car je récupère des infos :
                type: 'GET',
                // Le type de donnée qu'on veut recupérer est en json :
                dataType: 'json',
                // Dans la propriété data, je mets un objet ayant comme propriété friendId et user_id (qui sera récupérable en PHP) avec comme valeur mes variables créés plus haut :
                data: {friendId: friendId, user_id: user_id}
            }).done(function(data) {
                // A faire après le PHP :
                console.log(data); /*je récupère données*/
                // Adding the id of connected user and friend to the button for sending messages: 
                $('.btn-message').attr('data-user', user_id);
                $('.btn-message').attr('data-friend', friendId);

                for (let i = 0; i < data.messages.length; i++) {
                    if (data.messages[i].id_expediteur === data.user.id_user) {
                        // Create every element
                        let messages = document.createElement('div');
                        messages.classList.add('messages');
                        let messageContainer = document.createElement('div');
                        messageContainer.classList.add('outside-message', 'msg-bleu-fonce');
                        let msgImg = document.createElement('img');
                        msgImg.setAttribute('src', `img/${data.user.userimg}`);
                        msgImg.setAttribute('alt', "avatar utilisateur messagerie");
                        let msgDiv =document.createElement('div');
                        msgDiv.classList.add('inside-message');
                        let msgH6 = document.createElement('h6');
                        msgH6.innerHTML = data.user.username;
                        let msgContent = document.createElement('p');
                        msgContent.innerHTML = data.messages[i].message;
                        let sendDate = document.createElement('h6');
                        sendDate.classList.add('time');
                        sendDate.innerHTML = data.messages[i].date;
                        // Add these elements to the DOM
                        msgDiv.append(msgH6, msgContent);
                        messageContainer.append(msgImg, msgDiv);
                        messages.append(sendDate, messageContainer);
                        listMessage.appendChild(messages);
                    } else {
                        let sendDate = document.createElement('h6');
                        sendDate.classList.add('time');
                        sendDate.innerHTML = data.messages[i].date;
                        let messages = document.createElement('div');
                        messages.classList.add('messages');
                        let messageContainer = document.createElement('div');
                        messageContainer.classList.add('outside-message', 'msg-bleu-ciel');
                        let msgImg = document.createElement('img');
                        msgImg.setAttribute('src', `img/${data.friend.userimg}`);
                        msgImg.setAttribute('alt', "avatar utilisateur messagerie");
                        let msgDiv =document.createElement('div');
                        msgDiv.classList.add('inside-message');
                        let msgH6 = document.createElement('h6');
                        msgH6.innerHTML = data.friend.username;
                        let msgContent = document.createElement('p');
                        msgContent.innerHTML = data.messages[i].message;
                        // Add these elements to the DOM
                        msgDiv.append(msgH6, msgContent);
                        messageContainer.append(msgImg, msgDiv);
                        messages.append(messageContainer, sendDate);
                        listMessage.append(messages);
                    }
                    
                }
            });
        });

    $(document).on('click', '.btn-message', function(e) {        
        e.preventDefault();
        let friendId =  this.getAttribute("data-friend");
        let user_id =  this.getAttribute("data-user");
        console.log(user_id);
        console.log(friendId);
        let msgInput = document.querySelector('#answer-txt');
        let msgContent = document.querySelector('#answer-txt').value;
        console.log(msgContent);

		// Je lance la fonction ajax :
		$.ajax({
			// Je mets l'URL dans laquelle je récupère les données :
			url: 'sendMessage.php',
			// Le type est get car je récupère des infos :
			type: 'POST',
			// Le type de donnée qu'on veut recupérer est en json :
			dataType: 'json',
			// Dans la propriété data, je mets un objet ayant comme propriété friendId (qui sera récupérable en PHP) avec comme valeur ma variable id_employe créée plus haut :
			data: {friendId: friendId, user_id: user_id, msgContent: msgContent}
		}).done(function(data) {
			// A faire après le PHP :
            console.log(data);
            msgInput.value = '';
		});
    });
});






