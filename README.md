# <p align="center">Annuaire Bien-Être</p>

Ce projet est un exercice pratique d’une application Symfony. Vous trouverez dans le répertoire « documents » le cahier des charges et l’analyse fonctionnel d’écrivant l’ensemble du projet.  

## 🧐 Fonctionnalités implémentées
- CU01 Afficher la page du site Bien-Être
- CU21 Consulter la description d'un service
- CU24 Consulter les catégories de services d'un prestataire
- CU02 S'inscrire
- CU03 Confirmer l'inscription
## 🛠️ Installation des dépendances
Dans le répertoire contenant vos projets :
```bash
git clone https://github.com/albertaljeanpierre/Annuaire_Bien-Etre.git
```
Ensuite déplacer vous dans ce répertoire pour installer les dépendances : 
```bash
cd Annuaire_Bien-Etre
composer install
```
## Démarrer le serveur symfony
```bash
symfony server:start
```
## 🛠️ Migration
Exécuter les migrations : 
```bash
php bin/console doctrine:migrations:migrate
```
## Visualisation dans le navigateur
Rendez vous à l'URL  http://localhost:8000/ 


## 🛠️ Installation des données dans la base de données
Pour populer la base avec les données de catégories des prestataires exécutez la route suivante :  
http://localhost:8000/admin/addCategories

## 🙇 Auteur
#### Jean-Pierre ALBERTAL 
