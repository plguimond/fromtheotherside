[![Maintainability](https://api.codeclimate.com/v1/badges/b1de6421d99a71a03388/maintainability)](https://codeclimate.com/github/plguimond/fromtheotherside/maintainability)




Marche à suivre pour installer le site:

- Utilisation de php 7.4 ou supérieur

- récupérer tous les fichiers du repository
- créer une base de donnée et importer le dump.sql dans votre base de donnée
- Adaper le .env.exemple pour vous connecter à votre base de donnée et le renommer .env
- composer install

- connexion à l'espace admin via l'onglet "connectez-vous" 
    - email: admin@admin.com et password: admin 
    - ou en créant un nouvel utilisateur manuellement en base de donnée avec le rôle 1

Le site web From The Other Side est un projet de fin de formation (Développeur intégrateur en réalisation d'applications web) pour but d'obtenir un diplôme de niveau 5.

Le site est administrable en grande partie via un compte admnistrateur.
Un utilisateur peut créer un compte ce qui lui donne la possibilité de commenter sous les articles publiés sur le site web.

Un visiteur peut envoyer un message via l'onglet "nous contacter"

Le backoffice du site permet à l'administrateur d'ajouter, modifier et supprimer les éléments suivants:
    - Le slider (affiché uniquement en écran large)
    - Les articles
    - Les membres du groupe
    - les dates de concerts

    - Permet de visualiser les messages reçus, de les supprimer et d'y répondre (avec le logiciel de mail de son appareil)

L'Administrateur du site peut supprimer les commentaires sous les différents articles.

Diagramme UML disponible en version jpeg ou drawio sur la racine du projet.

Le site est majoritairement sur une base de PHP en architecture MVC.
Une approche d'un ORM est présente sous la forme du fichier Manager.php

Merci de votre attention et n'hésitez pas à me faire parevenir vos retours.

Pierre-Luc Guimond

    




