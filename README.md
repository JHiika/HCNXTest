# HCNXTest
Test technique

Script réalisé en 4H (Création des tables, modifications de celles-ci, ainsi que le script qui lit le fichier CSV et l'insert en tableau SQL)

Pour run les commandes : 
  Création des tables : php bin/console app.createbasetables
  Lecture du CSV et insertion en BDD : php bin/console app.csvtotable
  
Explication des scripts :
  Le premier script :
    Créer deux tables nommées "numero_dons" et "numero_zipcode". Ensuite ajoute des clés uniques. Pour la première table, créer une clé unique sur le numéro. Pour la seconde table, créer une clé unique sur le couple numéro,zipcode.
  Le second script : 
    Ouvre le fichier CSV pour le lire, supprime la première colonne contenant l'en-tête des colonnes et boucle sur chaque ligne du fichier CSV.
    La boucle contient une connexion à la base de données, une insertion du numero et du montant dans "numero_dons". Lors d'insertion d'un numéro déjà existant, met à jour le montant total des dons. Il contient également l'insertion du numéro et du code postal dans la table "numero_zipcode". Lors d'une duplication du couple numero,zipcode; ne créer pas la ligne.
    Ferme le fichier CSV.
    
 Pour les graphiques :
    Un graphique qui calcule le nombre de donateur pour chaques montant
    Un graphique qui compte le nombre de donateur pour les 10 code postaux les plus utilisé, puis comptabilise le reste.
    Un graphique qui comptabilise le top 10 des donateurs
