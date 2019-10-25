# CERIcar

### Students:
#### Labrak Yanis
#### Vougeot Valentin

## TODO:

### Étape 1 : Prise en main

- [x] Déployez l'archive et personnalisez la (changez le nom de l’application...).
- [x] Testez le “helloWorld” pour vérifier son bon fonctionnement.
- [x] Définissez une action “superTest” qui prend deux paramètres dans l’url (param1 et
param2 par exemple) et affichez ce message: “j’ai compris <VALEUR PARAM1> ,
super : <VALEUR PARAM2>”
- [x] Dans le layout, ajoutez un bandeau de notification permettant d'afficher un
message (de notification ou d'erreur) issu de l'exécution d'une action quelconque. 

### Étape 2 : Modèle de données et doctrine 

- [x] l'ensemble des classes entités manquantes.
- [x] les méthodes dans le contrôleur vous permettant de tester votre modèle.
- [x] la classe trajetTable qui devra contenir au minimum :
  - [x] une méthode getTrajet($depart, $arrivee) permettant de récupérer un objet
du type trajet via une requête récupérant les données de la table trajet.
d. la classe voyageTable qui devra contenir au minimum :
  - [x] une méthode getVoyagesByTrajet($trajet) permettant de collecter l'ensemble
des voyages correspondant à un trajet, via une requête récupérant les
données de la table voyage. Cette méthode retournera une collection
contenant des objets de type voyage.
- [x] la classe reservationTable qui devra contenir au minimum :
une méthode getReservationByVoyage($voyage) permettant de collecter
l'ensemble des reservations correspondant à un voyage, via une requête
récupérant les données de la table reservation. Cette méthode retournera
une collection contenant des objets de type reservation.
- [x] la classe utilisateurTable qui devra contenir au minimum deux méthodes :
  - [x] l'une d'elle est déjà implémentée et est utilisée pour la connexion d'un
utilisateur à son profil, c'est la méthode « getUserByLoginAndPass ».
  - [x] une seconde méthode, getUserById($id), est destinée à récupérer les
informations d'un utilisateur selon un identifiant (id).

Sources:
 
* https://undraw.co/search - Pour les images dilustration