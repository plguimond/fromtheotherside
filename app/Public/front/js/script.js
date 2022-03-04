/* ========================================*/
      /* Function pour menu burger */
/* ========================================*/

/* Sélection des éléments HTML */
let burgerLink = document.getElementById('burger-link');
let burger = document.getElementById('burger');
let ul = document.querySelector('ul');
// let logo = document.getElementById("logo-header")

/* permet d'ajouter la classe display au burger et à l'ul du menu */
burgerLink.addEventListener('click', function() {
  burger.classList.toggle('display');
  ul.classList.toggle('display');
  // logo.classList.toggle('display')
})

/* ========================================*/
      /* Function pour  */
/* ========================================*/