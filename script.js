let logo = document.querySelector('#header-logo > img');
logo.addEventListener('click', () => {
    window.location.assign("index.php");
})


let friend = document.querySelectorAll('.friend');
let friendDetail = document.querySelector('.friend-detail');
let count = 1;


for (let index = 0; index < friend.length; index++) {
    friend[index].addEventListener('click', () => {
        if (count % 2 == 0){
            friendDetail.style.display = 'flex';
        } else {
            friendDetail.style.display = 'none';
        }
        count++;
    })
}


/* Inscription */

function redirectionToHomapage(){
    setTimeout(() =>{
        var myWindow = window.open("index.php", "_self");
    },3000)
}