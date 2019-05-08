<?php
/**
 * Created by PhpStorm.
 * User: dadiesa
 * Date: 17.03.2017
 * Time: 15:53
 */
?>
<!DOCTYPE html>
<html>
<?php
session_start();


//Appel de la classs pour le PDO
include "../php/connexionPDO.php";
include "../php/RequestSQL.php";
$top5 = new connexionPDO();
$allRequest = new RequestSQL();

//Si l'utilisateur est connecté on récupère son id
if(isset($_SESSION['Pseudo']))
{
    //Récupère l'id de l'utilsateur connecté en fonction de son nom
    $pseudo = $_SESSION['Pseudo'];
    $getIdUser = $allRequest->getUser($pseudo);
    $getuserID = $top5->executeQuerySelect($getIdUser);
    $idOfUser = $getuserID[0]['idUser'];
    if ($getuserID[0]['useAdminOrNot'] == 1) {
        $userRole = "Admin";
    }
    else {
        $userRole = "user";
    }
}
//Récupère les livres de la base de donnée afin de les afficher
$requete = 'SELECT t_book.idBook,t_book.booAuthor,t_book.booTitle,t_book.booAbstract,t_categorie.catName 
            FROM `t_book` 
            INNER JOIN `t_categorie` ON t_book.idCategorie = t_categorie.idCategorie
            ORDER BY t_book.booTitle ASC';
$getdata = $top5->executeQuerySelect($requete);


?>
<!--Liens avec Materialize-->
<head>

    <link href="../materialize/css/cssPerso.css" rel="stylesheet">
    <!--fait le lien avec le fichier javascript-->
    <script src="../javascript/javaPerso.js" type="text/javascript"></script>

    <meta charset="UTF-8">
    <title>Ouvrages</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css" media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>

<body>
<main>
    <?php
    //Affiche le menu de navigation
    include '../php/navbar.php';
    ?>

    <!--Site description-->
    <div class="row">
        <div class="col s2 m3"></div>
        <div class="backgroundIndex col s2 m6">
        <!--Tableau avec tous les livres-->
        <table>
            <h1>Ouvrages</h1>
            <div class="col s2 m3"></div>

            <!--Afiche le titre des colonnes-->
            <thead>
                <tr>
                    <!--Nom des colonnes-->
                    <th data-field="id">Titres</th>
                    <th data-field="name">Catégories</th>
                    <th data-field="author">Auteur(es)</th>
                    <th data-field="author">Détails</th>
                    <?php
                    //Si l'utilisateur n'est pas connecté il ne peut pas modifier les livres ou le supprimer
                    if(isset($_SESSION['Pseudo'])) {

                        if ($userRole == "Admin") {
                            ?>
                            <th data - field = "author" >Modifier</th >
                            <th data - field = "author" >Supprimer</th >
                            <?php
                        }
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
            <?php
            //Parcourt  les livres pour afficher le nom, l'auteur, etc
            foreach ($getdata as $line) {
                $bookToDelete = "../php/delete.php?id=".$line['idBook'];
                $bookDetails = "detail.php?id=".$line['idBook'];
                echo "<tr>" . "<td>" . $line["booTitle"] . "</td>";
                echo "<td>" . $line["catName"] . "</td>";
                echo "<td>" . $line["booAuthor"] . "</td>";
                echo "<td> <a  class='material-icons' style='font-size:25px;' href='$bookDetails' data-toggle=\"modal\" data-target=\"#myModal\" >assignment</a></td>";
                //echo "<td class='material-icons' style='font-size:25px;' onclick=createPop('$bookDetails') >control_point</td>";

                //Si l'utilisateur n'est pas connecté il ne peut pas modifier les livres ni le supprimer
                if(isset($_SESSION['Pseudo'])) {
                    //vérifie le rôle de l'utilisateur
                    if ($userRole == "Admin") {
                        echo "<td>" . "<a class='material-icons' style='font-size:25px;' href='AddBook.php?type=" . 'modif' . "&id=" . $line['idBook'] . "'>create</a>" . "</td>";
                        echo "<td><a class='material-icons' style='font-size:25px;' onclick=confirmDelete('$bookToDelete') >delete</a>";
                        echo "</td></tr>";
                    }
                }//end if
            }//end foreach
            ?>
            </tbody>
        </table>
    </div>
    </div>


    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <h1>ffgf</h1>
        </div>
    </div>

</main>
<!--Footer-->
<footer class="page-footer #00695c teal darken-3">
    <?php
    //inclut le footer pour ne pas le répéter sur tous les fichiers
    include '../php/footer.php';
    ?>
</footer>
</body>
</html>