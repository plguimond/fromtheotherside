<?php 
//retourne false si la session est vide ou innexistante, true si ell existe et qu'un utilisateur est enregistré dedans.
// Utilisé pour controller l'accès à certaines page
function isConnect()
{
    if (!isset($_SESSION['firstname']) || $_SESSION['firstname'] == ""){
        return false;
    }else{
        return true;
    };
}
