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



/* ===============================================================*/
      /* Function pour valider rgpa sur le formuaire de contact*/
/* ===============================================================*/

let checkbox = document.getElementById('rgpd');
let sendForm = document.getElementById('sendForm');

checkbox.addEventListener('click', function(){
  sendForm.classList.toggle('hidden');
})
