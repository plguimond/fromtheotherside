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