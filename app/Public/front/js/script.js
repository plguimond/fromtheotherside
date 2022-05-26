// Petit script trouvé en ligne pour recharger la page lorsque je fais bouton précédent sur le navigateur
// Permet d'empêcher certains bug d'affichage
// remplacceent de performance.navigation (deprecated) getEntriesByType

console.log(performance.getEntriesByType("navigation"))
console.log(window.performance.navigation)
window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         ( typeof window.performance != "undefined" && 
                         window.performance.getEntriesByType("navigation")[0].type === "back_forward" );
                              
  if ( historyTraversal ) {
    // recharge la page.
    window.location.reload();
  }
});

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


// Récupère l'élément du menu par l'url pour lui attribuer la class .active
let url = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
let menuLink = document.querySelector('a[href="'+url+'"]');
if(menuLink !== null){
  menuLink.classList.add('active');
}
/* ===============================================================*/
      /* Function pour valider rgpd sur le formuaire de contact*/
/* ===============================================================*/

// récupère les éléments du DOM pour les manipuler
let checkbox = document.getElementById('rgpd');
let sendForm = document.getElementById('sendForm');
let cancel   = document.getElementById('cancelForm');

// si l'élément existe faire un toggle de la classe sur l'évènement click
if(checkbox !== null){
  checkbox.addEventListener('click', function(){
    sendForm.classList.toggle('hidden');
  })
}

// si l'élément existe faire un toggle de la classe sur l'évènement click
if(cancel !== null){
  cancel.addEventListener('click', function(){
    sendForm.classList.add('hidden');
  })
}



