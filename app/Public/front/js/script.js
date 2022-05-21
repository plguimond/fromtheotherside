// Petit script trouvé en ligne pour recharger la page lorsque je fais bouton précédent sur le navigateur
// Permet d'empêcher certains bug d'affichage

window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         ( typeof window.performance != "undefined" && 
                              window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
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

var url = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
let menuLink = document.querySelector('a[href="'+url+'"]');
menuLink.classList.add('active');


/* ===============================================================*/
      /* Function pour valider rgpd sur le formuaire de contact*/
/* ===============================================================*/

let checkbox = document.getElementById('rgpd');
let sendForm = document.getElementById('sendForm');
let cancel   = document.getElementById('cancelForm');


checkbox.addEventListener('click', function(){
  sendForm.classList.toggle('hidden');
})

cancel.addEventListener('click', function(){
  sendForm.classList.add('hidden');
})


