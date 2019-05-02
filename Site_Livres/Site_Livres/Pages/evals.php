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

$requete = 'SELECT t_book.idBook,t_book.booAuthor,t_book.booTitle,t_book.booAbstract,t_categorie.catName 
            FROM `t_book` 
            INNER JOIN `t_categorie` ON t_book.idCategorie = t_categorie.idCategorie 
            ORDER BY t_categorie.catName DESC';

$top5 = new connexionPDO();

$getdata = $top5->executeQuerySelect($requete);

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
?>
<head>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <meta charset="UTF-8">
    <title>Evaluer</title>

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


    <link href="../materialize/css/cssPerso.css" rel="stylesheet">
</head>

<body>
<main>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>


    <?php
    include '../php/navbar.php';

    //check si l'utilisateur est connecté
    if(isset($_SESSION['Pseudo'])) {

    ?>

    <!--Site description-->
    <div class="row">
        <div class="col s2 m3"></div>
        <div class="backgroundIndex col s2 m6">
        <!--Tableau avec les 5 premier livre-->
        <table>
            <h1>Evaluer</h1></div>
            <thead>
            <tr>
                <th data-field="id">Titres</th>
                <th data-field="name">Catégories</th>
                <th data-field="author">Auteur(es)</th>
                <th data-field="note">Noter</th>
            </tr>
            </thead>

            <tbody>
            <?php

            //affiche les livres
            foreach ($getdata as $line) {
                    echo "<tr>" . "<td>" . " " . $line["booTitle"] . " " . "</td>";
                    echo "<td>" . " " . $line["catName"] . " " . "</td>";
                    echo "<td>" . " " . $line["booAuthor"] . " " . "</td>";
                    echo "<td>";
                    $idOfActuPage = $line["idBook"];

                    //affiche les étoiles pour noter les livres
                    for ($i = 1; $i <= 5; $i++) {
                        echo "<a href='../php/giveNotes.php?note=$i&pseudo=$idOfUser&book=$idOfActuPage' id='$i' class='fa fa-star tooltipped' data-position='bottom' data-tooltip='$i' style='font-size:25px;' >&nbsp;</a>";
                    }
                    echo "</td></tr>";
                }
            }//fin du check si connecté
            else
            {
                header('Location:../index.php');
            }
            ?>
            </tbody>
        </table>
    </div>
    </div>
</main>
<footer class="page-footer #00695c teal darken-3">
    <?php
    include '../php/footer.php';

    ?>
</footer>
</body>
</html>