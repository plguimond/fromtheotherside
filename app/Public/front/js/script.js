/* ========================================*/
      /* Function pour menu burger */
/* ========================================*/

/* Sélection des éléments HTML */
let burgerLink = document.getElementById('burger-link');
let logo = document.getElementById('logo-header');
let main = document.querySelector('main');


/* permet d'ajouter la classe blured au fond derrière le menu */
burgerLink.addEventListener('click', function() {
  main.classList.toggle('blured');
  logo.classList.toggle('blured');
})


// /* ========================================*/
//       /* Function pour retourner les cards sur la page groupe  */
// /* ========================================*/

// /* Sélection des éléments HTML */
// let cardButton = document.getElementsByClassName('cardButton');
// let front = document.getElementsByClassName('memberFront-card');
// let back = document.getElementsByClassName('memberBack-card');

// /* permet de faire un toggle de la class hidden sur la card */
// for(let i = 0; i < cardButton.length; i++){
//       cardButton[i].addEventListener('click', function(e) {
//             front[i].classList.toggle('hidden');
//             back[i].classList.toggle('hidden');
//       })
// }