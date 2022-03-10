/* ========================================*/
      /* Function pour menu burger */
/* ========================================*/

/* Sélection des éléments HTML */
let burgerLink = document.getElementById('burger-link');
let burger = document.getElementById('burger');
let ul = document.getElementById('menu-list');


/* permet d'ajouter la classe display au burger et à l'ul du menu */
burgerLink.addEventListener('click', function() {
  burger.classList.toggle('display');
  ul.classList.toggle('display');
})

/* ========================================*/
      /* Function pour  */
/* ========================================*/