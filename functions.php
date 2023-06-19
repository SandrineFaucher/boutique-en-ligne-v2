<?php
//**********************************connexion à la base de données************************** */
function getConnection()
{
    //try : je tente une connexion
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=boutique_en_ligne;charset=utf8', //infos :sgbd, nom base, adress (host) +
            'root', // pseudo utilisateur (root en local)
            '', // mot de passe (aucun en local)
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC)
        ); // options PDO : 1) affichage des erreurs /2) récupération des données simplifiée

        // si ça ne marche pas : je mets fin au code php en affichant l'erreur
    } catch (Exception $erreur) { // je récupère l'erreur en paramètre
        die('Erreur : ' . $erreur->getMessage()); // je l'affiche et je mets fin au script
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


function getArticleFromId($id)
{

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


//******************************récupérer les gammes d'articles********************************/
function getGammes()
{
    //je me connecte à la bdd
    $db = getConnection();

    // j'exécute une requete qui va récupérer toutes les gammes 
    $results = $db->query('SELECT * FROM gammes');

    // je récupère les résultats et je les renvoie grâce à return
    return $results->fetchAll();
}

//************************récupérer les articles par l'id de leur gamme***********************/
function getArticlesByGamme($id)
{
    //je me connecte à la bdd
    $db = getConnection();

    //je prépare une requete pour récupérer un article par son id_gamme //
    $query = $db->prepare('SELECT * FROM articles  WHERE id_gamme  = ?');

    // je l'exécute avec le bon paramtère
    $query->execute([$id]);

    // retourne l'article sous forme de tableau associatif
    return $query->fetchAll();
}

//*************************Initialiser le pannier en début de page***************************/
function createCart()
{
    if (isset($_SESSION['panier']) == false) { //si mon panier n'existe pas encore
        $_SESSION['panier'] = [];           // je l'initialise
    }
}
//****************************Ajouter au panier *********************************************/
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


//******************************calcul du total du panier**************************************/


function totalArticles()
{
    $total = 0;

    foreach ($_SESSION['panier'] as $article) {
        $total += $article['quantite'] * $article['prix'];
    }
    return $total;
}

//******************************modification article********************************************/

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
// ****************************je supprime les éléments ***************************************/
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

// ***************************je vide le panier complet ****************************************/
function viderPanier()
{
    $_SESSION['panier'] = [];
}

// ***********************je crée une fonction qui calcule les frais de port*********************/
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

//****************fonction pour vérifier que les champs de formulaires ne sont pas vide **********/
function checkEmptyFields()
{
    foreach ($_POST as $field) {
        if (empty($field)) {
            return true;
        }
    }
    return false;
}
// fonction pour vérifier la longeur des entrées pour les modifsinfos
function checkInputLenghtInfos()
{
    $inputLenghtOk = true;

    if (strlen($_POST['nom']) > 25 || strlen($_POST['nom']) < 3) {
        $inputLenghtOk = false;
    }

    if (strlen($_POST['prenom']) > 25 || strlen($_POST['prenom']) < 3) {
        $inputLenghtOk = false;
    }

    if (strlen($_POST['email']) > 25 || strlen($_POST['email']) < 5) {
        $inputLenghtOk = false;
    }
    return $inputLenghtOk;
}



//**********fonction pour vérifier que la longueur des entrées de formulaire est valide ***********/
function checkInputLenght()
{
    $inputLenghtOk = true;

    if (strlen($_POST['nom']) > 25 || strlen($_POST['nom']) < 3) {
        $inputLenghtOk = false;
    }

    if (strlen($_POST['prenom']) > 25 || strlen($_POST['prenom']) < 3) {
        $inputLenghtOk = false;
    }

    if (strlen($_POST['email']) > 25 || strlen($_POST['email']) < 5) {
        $inputLenghtOk = false;
    }

    if (strlen($_POST['adresse']) > 100 || strlen($_POST['adresse']) < 5) {
        $inputLenghtOk = false;
    }
    return $inputLenghtOk;
}
// *****************fonction pour savoir si l'email n'existe pas *******************************/
function emailExist()
{
    // je me connecte à la base
    $db = getConnection();

    // je prépare ma requete pour recuperer si déjà un email
    $query = $db->prepare('SELECT * FROM clients WHERE email = ?');
    $query->execute([$_POST['email']]);
    $client = $query->fetch();
    return $client;
}


//************************fonction pour checker le password ************************************/
function checkPassword($password)
{

    // minimum 8 caractères et maximum 15, minimum 1 lettre, 1 chiffre et 1 caractère spécial
    $regex = "^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@$!%*?/&])(?=\S+$).{8,15}$^";
    return preg_match($regex, $password);
}

// insérer une nouvelle adresse**********************************************//
function createAdress($user_id)
{

    // je me connecte à la base
    $db = getConnection();

    // je prépare et execute ma requette d'entrée des données adresse, code postal, ville/ 
    $query = $db->prepare("INSERT INTO adresses (`id_client`, `adresse`, `code_postal`, `ville`) VALUES (:id_client, :adresse, :code_postal, :ville)");
    $query->execute(array(
        'id_client' => $user_id,
        'adresse' => strip_tags($_POST['adresse']),
        'code_postal' => strip_tags($_POST['code_postal']),
        'ville' => strip_tags($_POST['ville']),
    ));
}


//***********************************fonction create user**************************************/
function createUser()
{
    //je me connecte à la bdd
    $db = getConnection();

    // je vérifie que les champs ne sont pas vides 
    if (checkEmptyFields()) {

        // je vérifie la longueur des champs 
        if (checkInputLenght() == true) {

            // je vérifie si l'email existe déjà
            if (emailExist() == false) {

                // je vérifie si le mot de passe est suffisamment sécurisé grâce à la regex et je le hache avec password_hash()
                if (checkPassword($_POST['mot_de_passe'])) {
                    $password = password_hash(strip_tags($_POST['mot_de_passe']), PASSWORD_DEFAULT);

                    // je prépare ma requette d'insertion
                    $query = $db->prepare("INSERT INTO clients(`nom`,`prenom`,`email`, `mot_de_passe`)
                VALUES (:nom,:prenom,:email,:mot_de_passe)");

                    // j'execute ma requete
                    $query->execute([
                        'nom' => strip_tags($_POST['nom']),
                        'prenom' => strip_tags($_POST['prenom']),
                        'email' => strip_tags($_POST['email']),
                        'mot_de_passe' => strip_tags($password),
                    ]);
                    // récupération de l'id de l'utilisateur crée avec :  $id = $db->lastInsertId(); (fonction native php) 
                    $id = $db->lastInsertId();

                    // insertion de son adresse dans la table adresses
                    createAdress($id);

                    // On renvoie un message de succès
                    echo '<script>alert(\'Le compte a bien été créé !\')</script>';
                } else {
                    echo "Mot de passe non sécurisé";
                }
            } else {
                echo "Votre email existe déjà";
            }
        } else {
            echo "la longueur des champs n'est pas valide";
        }
    } else {
        echo "Des champs ne sont pas remplis";
    }
}


// je crée une fonction de connection ****************************************************
function createConnection()
{

    // je me connecte à la base
    $db = getConnection();

    // Je récupère le client s'il existe
    $client = emailExist();

    if ($client == true) {
        if (password_verify($_POST['mot_de_passe'], $client['mot_de_passe'])) {
            $_SESSION['client'] = $client;
            $_SESSION['adresse'] = recupAdressClientSession();
            echo "Vous êtes connecté !";
        } else {
            echo "Votre mot de passe est incorrect !";
        }
    } else {
        echo "Vous n'avez pas de compte client !";
    }
}


//*************************recupérer l'adresse associé au client de la session***********/
function recupAdressClientSession()
{
    //je me connecte à la bdd
    $db = getConnection();

    //requete 
    $query = $db->prepare("SELECT * FROM adresses  WHERE id_client = ?");

    // j'execute ma requete
    $query->execute([$_SESSION['client']['id']]);
    return $query->fetch();
}


//***********************fonction de déconnexion de session  ***************************/
function deconnection()
{
    $_SESSION['client'] = [];
}


//***********************fonction de modification des infos*****************************/
function modifInfos()
{
    //je me connecte à la bdd
    $db = getConnection();

    // je vérifie que les champs ne sont pas vides 
    if (!checkEmptyFields()) {
        echo "Des champs sont vides";
    }

    // je vérifie la longueur des champs
    if (checkInputLenghtInfos() == true) {

        // si la session est initialisée
        if ($_SESSION['client']['id']) {

            //je prépare ma requette pour remplacer les infos
            $query = $db->prepare("UPDATE clients SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id");

            // j'execute ma requete
            $query->execute([
                'nom' => strip_tags($_POST['nom']),
                'prenom' => strip_tags($_POST['prenom']),
                'email' => strip_tags($_POST['email']),
                'id' => intval($_SESSION['client']['id'])
            ]);

            // actualiser les infos de la session
            $_SESSION['client']['nom'] = strip_tags($_POST['nom']);
            $_SESSION['client']['prenom'] = strip_tags($_POST['prenom']);
            $_SESSION['client']['email'] = strip_tags($_POST['email']);

            // On renvoie un message de succès
            echo '<script>alert(\'Vos modifications sont enregistrées !\')</script>';
        }
    } else {
        echo "La longueur des champs n'est pas valide";
    }
}

//************************vérification de la longueur des champs pour la modif adresse****/
function checkInputLenghtAdresse()
{
    $inputLenghtOk = true;

    if (strlen($_POST['adresse']) > 100 || strlen($_POST['adresse']) < 5) {
        $inputLenghtOk = false;
    }
    if (strlen($_POST['code_postal']) > 40 || strlen($_POST['code_postal']) < 5) {
        $inputLenghtOk = false;
    }
    if (strlen($_POST['ville']) > 40 || strlen($_POST['ville']) < 5) {
        $inputLenghtOk = false;
    }

    return $inputLenghtOk;
}



//****************fonction de modification de l'adresse **********************************/
function modifAdresse()
{
    //je me connecte à la bdd
    $db = getConnection();

    // je vérifie que les champs ne sont pas vides 
    if (!checkEmptyFields()) {
        echo "Des champs sont vides";
    } else {

        // je vérifie la longueur des champs
        if (checkInputLenghtAdresse() == true) {

            // si la session est initialisée
            if ($_SESSION['client']['id']) {

                //je prépare ma requette pour remplacer les infos
                $query = $db->prepare("UPDATE adresses SET  adresse = :adresse, code_postal = :code_postal, ville = :ville WHERE id_client = :id_client");

                // j'execute ma requete
                $query->execute([
                    'adresse' => strip_tags($_POST['adresse']),
                    'code_postal' => strip_tags($_POST['code_postal']),
                    'ville' => strip_tags($_POST['ville']),
                    'id_client' => strip_tags($_SESSION['client']['id'])
                ]);

                // actualiser les infos de la session
                $_SESSION['client']['adresse'] = strip_tags($_POST['adresse']);
                $_SESSION['client']['code_postal'] = strip_tags($_POST['code_postal']);
                $_SESSION['client']['ville'] = strip_tags($_POST['ville']);

                // On renvoie un message de succès
                echo '<script>alert(\'Vos modifications sont enregistrées !\')</script>';
            } else {
                echo "Vous n'êtes pas connecté !";
            }
        } else {
            echo "La longueur des champs n'est pas valide";
        }
    }
}


// ************modification du mot de passe ***********************************************

function modifMotDePasse()
{
    //je me connecte à la bdd
    $db = getConnection();

    // je vérifie que les champs ne sont pas vides 
    if (!checkEmptyFields()) {
        echo "Des champs sont vides";
    } else {

        // je récupère le mot de passe existant 
        $query = $db->prepare('SELECT mot_de_passe FROM clients WHERE id =?');
        $query->execute([$_SESSION['client']['id']]);
        $client = $query->fetch();


        if (password_verify(strip_tags($_POST['oldPassword']), $client['mot_de_passe'])) {


            //je vérifie les critères avec la regew 
            if (checkPassword($_POST['newPassword'])) {


                //sinon je continue en le hachant 
                $newPassword = password_hash(strip_tags($_POST['newPassword']), PASSWORD_DEFAULT);

                // je prépare ma requette d'insertion
                $query = $db->prepare("UPDATE clients SET mot_de_passe = :new_mot_de_passe WHERE id = :id");

                // j'execute ma requete
                $query->execute([
                    'new_mot_de_passe' => $newPassword,
                    'id' => $_SESSION['client']['id'],
                ]);

                // On renvoie un message de succès
                echo '<script>alert(\'Votre mot de passe a bien été modifié !\')</script>';
            } else {
                echo "votre mot de passe ne respecte pas les critères";
            }
        } else {
            echo "votre email ne correspond pas à la session";
        }
    }
}

//***************************/ enregistrer la commande ********************//
function saveCommand()
{
    //je me connecte à la bdd
    $db = getConnection();


    //je récupère ma date du jour formatée
    $date = date("Y-m-d");

    // je génère un numéro de commande à partir de la fonction rand()
    $number = rand(1000000, 9999999);


    // je prépare une requete pour insérer les informations
    $query = $db->prepare("INSERT INTO `commandes` (id_client, numero, date_commande, prix)
    VALUES (:id_client,:numero,:date_commande,:prix)");

    // j'execute ma requete
    $query->execute([
        'id_client' => $_SESSION['client']['id'],
        'numero' => $number,
        'date_commande' => $date,
        'prix' => totalArticles() 
    ]);

    // je recupère l'id de la commande crée 
    $id = $db->lastInsertId();

    $query = $db->prepare("INSERT INTO `commande_articles` (`id_commande`,`id_article`, `quantite`)
    VALUES (:id_commande,:id_article,:quantite)");

    foreach ($_SESSION['panier'] as $article) {
        $query->execute([
            'id_commande' => $id,
            'id_article' => $article['id'],
            'quantite' => $article['quantite']
        ]);
    }
}

//********************************fonction pour récupérer la commande du client**************/
function recupCommande()
{
    //je me connecte à la bdd
    $db = getConnection();

    // je stocke l'id de la session dans une variable $id
    $id = $_SESSION['client']['id'];

    //je prépare une requete pour récupérer toutes les  commandes par la foreign Key //
    $query = $db->prepare('SELECT * FROM commandes  WHERE id_client = ?');

    // je l'exécute avec le bon paramtère
    $query->execute([$id]);

    // retourne la commande sous forme de tableau associatif
    return $query->fetchAll();
}

// *****************récupération les articles de chaque commande **********************/
function recupArticlesCommande(){

//je me connecte à la bdd
$db = getConnection();

// je récupère les articles de chaque commande en faisant un INNER JOIN
$query = $db->prepare('SELECT * FROM commande_articles as ca
INNER JOIN articles as a
ON ca.id_article = a.id
WHERE id_commande = ?');

// je l'exécute avec le bon paramtère
$query->execute([$_POST['commandeId']]);

// retourne la commande sous forme de tableau associatif
return $query->fetchAll();

}
