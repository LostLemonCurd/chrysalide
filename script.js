// Redirection vers la page home avec le logo

let logo = document.querySelector('#header-logo > img');
logo.addEventListener('click', () => {
    window.location.assign("index.php");
})


// Affichage des éléments amis

let friend = document.querySelectorAll('.friend');
console.log(friend);

let friendDetail = document.querySelector('.friend-detail');
console.log(friendDetail);


// Ajout de la fonctionnalité d'affichager/masquer les détails des amis de l'utilisateur
for (const element of friend) {
    element.addEventListener('click', () => {
        if (friendDetail.style.display === 'none') {
            friendDetail.style.display = 'flex';
        } else {
            friendDetail.style.display = 'none';
        }
    })
}


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