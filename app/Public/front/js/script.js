/* ========================================*/
      /* Function pour menu burger */
/* ========================================*/

/* Sélection des éléments HTML */
let burgerLink = document.getElementById('burger-link');
let ul = document.getElementById('menu-list');
let logo = document.getElementById('logo-header');
let main = document.querySelector('main');



/* permet d'ajouter la classe blured au fond derrière le menu */
burgerLink.addEventListener('click', function() {
  main.classList.toggle('blured');
  logo.classList.toggle('blured');
})


/* ========================================*/
      /* Function pour  */
/* ========================================*/