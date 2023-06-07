<?php
//**********************************connexion à la base de données************************** */
function getConnection()
{
//try : je tente une connexion
try{
    $db = new PDO(
        'mysql:host=localhost;dbname=boutique_en_ligne;charset=utf8',//infos :sgbd, nom base, adress (host) +
        'root', // pseudo utilisateur (root en local)
        '',// mot de passe (aucun en local)
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC)
    ); // options PDO : 1) affichage des erreurs /2) récupération des données simplifiée

    // si ça ne marche pas : je mets fin au code php en affichant l'erreur
    } catch (Exception $erreur) {// je récupère l'erreur en paramètre
        die('Erreur : '. $erreur->getMessage()); // je l'affiche et je mets fin au script
    }


    // je retourne la connextion stockée dans une variable
    return $db;
}


//****************************************récupérer la liste des articles *********************/
function getArticles()
{
    // je me connecte à la base de données
    $db = getConnection();

    // j'exécute une requete qui va récupérer tous les articles
    $results = $db->query('SELECT * FROM articles');

    // je récupère les résultats et je les renvoie grâce à return
    return $results->fetchAll();
}
//******************récupérer le produit qui correspond à l'id fourni en paramètre ************/


function getArticleFromId($id){
   
    // je me connecte à la bdd
    $db = getConnection();
     
    // /!\ JAMAIS DE VARIABLE PHP DIRECTEMENT DANS UNE REQUETE /!\ (risque d'injection SQL)
    // je mets en place ma requete préparée
    $query = $db->prepare('SELECT * FROM Articles WHERE id = ?');

    // je l'exécute avec le bon paramtère
    $query->execute([$id]);
    
    // retourne l'article sous forme de tableau associatif
    return $query->fetch(); 
    }

//*************************Initialiser le pannier en début de page********************/
function createCart()
{
    if (isset($_SESSION['panier']) == false) { //si mon panier n'existe pas encore
        $_SESSION['panier'] = [];           // je l'initialise
    }
}
//****************************Ajouter au panier *************************************/
function addToCart($article)
{
    // j'attribue une quantite de 1 (par défaut) à l'article
    $article['quantite'] = 1;

    // je vérifie si l'article n'est pas déjà présent en comparant les id
    // for (
    //$i = index de la boucle
    //$i < count ($_SESSION['panier]) = condition de maintien de la boucle (évaluée AVANT chaque tour)
    // (si condition vraie => on lance la boucle)
    // $i++ = évolution de index $i à la FIN de chaque boucle
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {

        // si présent => quantite + 1
        if ($_SESSION['panier'][$i]['id'] == $article['id']) {
            $_SESSION['panier'][$i]['quantite']++;
            return; //permet de sortir de la fonction
        }
    }

    // si pas présent => ajout classique via array_push
    array_push($_SESSION['panier'], $article);
}


//******************************calcul du total du panier*********************************** */


function totalArticles()
{
    $total = 0;

    foreach ($_SESSION['panier'] as $article) {
        $total += $article['quantite'] * $article['price'];
    }
    return $total;
}

//******************************modification article***************************************** */

function modifQuantite($nouvelleQuantite, $id)
{
    //je boucle sur le panier => je cherche l'article à modifier
    for ($i = 0; $i < count($_SESSION['panier']); $i++) {

        // dès que je trouve mon article 
        if ($_SESSION['panier'][$i]['id'] == $id) {

            // je remplace son ancienne quantite par la nouvelle
            $_SESSION['panier'][$i]['quantite'] = $nouvelleQuantite;

            // j'affiche un message de succès dans une petite fenetre via Javascript
            echo "<script> alert(\"Quantité modifiée !\");</script>";

            // je sors de la fonction pour éviter de boucler sur les articles suivants
            return;
        }
    }
}
// je supprime les éléments *******************************************************************
function delateArticle($id)
{
    // je boucle sur le panier => je cherche l'article à supprimer
    for ($i = 0; $i < count($_SESSION['panier']); $i++)

        // dès que je trouve mon article 
        if ($_SESSION['panier'][$i]['id'] == $id) {

            // je supprime un élément du panier 
            array_splice($_SESSION['panier'], $i, 1);
        }
}

// je vide le panier complet *******************************************************************
function viderPanier()
{
    $_SESSION['panier'] = [];
}

// je crée une fonction qui calcule les frais de port*****************************************************************
// je boucle sur mon panier
function fraisDePort($article)
{
    $fraisParArticle = 3;
    $total = 0;

    foreach ($_SESSION['panier'] as $article) {
        $total += $article['quantite'] * $fraisParArticle;
    }
    return $total;
}
