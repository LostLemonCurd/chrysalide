// Demande de confirmation avant déconnexion

let deco = document.querySelector('#deco');

deco.addEventListener('click', (e) =>{

    e.preventDefault();

    let seDeconnecter = confirm('Êtes-vous sur de vouloir vous déconnecter?');

    if(seDeconnecter){
        location.href = 'connexion.php';
    }
})