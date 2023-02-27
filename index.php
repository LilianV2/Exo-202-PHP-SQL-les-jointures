<?php

/**
 * 1. Commencez par importer le script SQL disponible dans le dossier SQL.
 * 2. Connectez vous à la base de données blog.
 */

$server = 'localhost';
$db = 'blog';
$user = 'root';
$pwd = '';

try {
    $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $exception) {
    echo $exception->getMessage();
}

/**
 * 3. Sans utiliser les alias, effectuez une jointure de type INNER JOIN de manière à récupérer :
 *   - Les articles :
 *     * id
 *     * titre
 *     * contenu
 *     * le nom de la catégorie ( pas l'id, le nom en provenance de la table Categorie ).
 *
 * A l'aide d'une boucle, affichez chaque ligne du tableau de résultat.
 */

// TODO Votre code ici.

$request = $bdd->prepare("
    SELECT article.id, article.title, article.content, categorie.name
    FROM article
    INNER JOIN categorie ON article.category_fk = categorie.id
");

$request->execute();

echo "<pre>";
print_r($request->fetchAll());
echo "</pre><br>";

/**
 * 4. Réalisez la même chose que le point 3 en utilisant un maximum d'alias.
 */

// TODO Votre code ici.

$request = $bdd->prepare("
    SELECT ar.id, ar.title, ar.content, ca.name
    FROM article as ar
    INNER JOIN categorie as ca ON ar.category_fk = ca.id
");

$request->execute();

echo "<pre>";
print_r($request->fetchAll());
echo "</pre><br>";

/**
 * 5. Ajoutez un utilisateur dans la table utilisateur.
 *    Ajoutez des commentaires et liez un utilisateur au commentaire.
 *    Avec un LEFT JOIN, affichez tous les commentaires et liez le nom et le prénom de l'utilisateur ayant écris le comentaire.
 */

// TODO Votre code ici.

$NewUser = $bdd->prepare("INSERT INTO utilisateur VALUES (null, 'Lilian', 'Vanhoorne', 'lilianom59@outlook.fr', 'MDPFullSecure123')");

$NewUser->execute();

$NewUser = $bdd->prepare("
    INSERT INTO commentaire VALUES (null, 'Je suis un super commentaire !', 1, 1),
                                   (null, 'Je suis également un super commentaire !', 15, 2)
                               ");

$NewUser->execute();

$request = $bdd->prepare("
    SELECT com.content, user.firstName, user.lastName
    FROM commentaire as com
    LEFT JOIN utilisateur as user ON user.id = com.user_fk
");

$request->execute();

echo "<pre>";
print_r($request->fecthAll());
echo "</pre><br>";

