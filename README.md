# <p align="center">Annuaire Bien-Être</p>

Ce projet est un exercice pratique d’une application Symfony. Vous trouverez dans le répertoire « documents » le cahier des charges et l’analyse fonctionnel d’écrivant l’ensemble du projet.  

## 🧐 Fonctionnalités implémentées
- CU01 Afficher la page du site Bien-Être
- CU21 Consulter la description d'un service
- CU24 Consulter les catégories de services d'un prestataire
- CU02 S'inscrire
- CU03 Confirmer l'inscription

## 🛠️ Exigence minimal 
- PHP 8+  (et symfony CLI si vous souhaitez utiliser les commandes symfony)
- un serveur de base de donnée
- un serveur de mail (pour l'utilisation de la fonction de php mail())

## 🛠️ Installation des dépendances
Dans le répertoire contenant vos projets :
```bash
git clone https://github.com/albertaljeanpierre/Annuaire_Bien-Etre.git annuaire
```
Ensuite déplacer vous dans ce répertoire pour installer les dépendances : 
```bash
cd annuaire
composer install
```
## Configuration de la base de donnée
Dans le fichier .env, à la racine, modifier la ligne suivante en fonction de votre configuration serveur.
```bash
DATABASE_URL="mysql://<dbuser>:<pass>@<host>:<port>/<dbname>?serverVersion=8&charset=utf8mb4"
```

## Création de la base de donnée
```bash
php bin/console doctrine:database:create
```

## Création des tables selon les migration
Exécuter les migrations :
```bash
php bin/console doctrine:migrations:migrate
```

## Démarrer le serveur local
### En utilisant symfony CLI
```bash
symfony server:start
```
### En utilisant le serveur de développement de PHP
```bash
php -S localhost:8000 -t public
```

## 🧑🏻‍💻 Visualisation dans le navigateur
Rendez vous à l'URL  http://localhost:8000/ 

## 🛠️ Installation des données dans la base de données
**Note importante :** Vous devez avoir des données dans la table images pour insérer des données dans la table catégorie.

Pour populer la base avec les images fournies dans le répertoire images/categorie exécutez la route suivante :
http://localhost:8000/admin/addImages 

Pour populer la base avec les données de catégories des prestataires exécutez la route suivante :  
http://localhost:8000/admin/addCategories

Pour populer la base avec les données des communes, code postal et province exécuter la route suivante :
http://localhost:8000/admin/addLieu 

## ➤ Documentation
Vous trouverez dans le répertoire documments/ deux fichiers de documentation.
- Documentation-utilisateur.docx reprenant la documentation utilisateur.
- Documentation-technique.docx reprenant la documentation technique de l’application.


## 🙇 Auteur
#### Jean-Pierre ALBERTAL 
