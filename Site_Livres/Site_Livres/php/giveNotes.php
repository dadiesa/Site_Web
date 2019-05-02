<?php
/**
 * Created by PhpStorm.
 * User: dadiesa
 * Date: 28.04.2017
 * Time: 13:35
 */
?>
<!DOCTYPE html>
<html>
<?php
session_start();

//Appel de la classs pour le PDO
include "../php/connexionPDO.php";

//Déclaration des variables
$note = $_GET['note'];
$pseudo = $_GET['pseudo'];
$book = $_GET['book'];
$NotesCumul = 0;
$average = 0;

$top5 = new connexionPDO();

//Ajoute la nouvelle note
$requete = 'INSERT INTO t_evaluation (idEvaluation, evaNote, averageNotes,idBook, idUser) VALUES (NULL, '.$note.',NULL,'.$book.','.$pseudo.')';
$addNote = $top5->executeQuerySelect($requete);

//Récupère toutes les notes ainsi que la nouvelle
$getallNotes = "SELECT evaNote FROM t_evaluation WHERE idBook = $book";
$makeAverage = $top5->executeQuerySelect($getallNotes);


//Calcule le total des notes
$i=0;
foreach($makeAverage as $line)
{
   $NotesCumul = $NotesCumul + $line["evaNote"];
   $i++;

}
//Si c'est la première note à être ajoutée alors on ne calcule pas la moyenne
if($i == "0"){
    $average = $note;
}
//Calcul la moyenne si on a plusieur notes
else
{
    $average = $NotesCumul/$i;
}
//Enregistre la nouvelles notes ainsi que la moyenne
$setAverage = "UPDATE t_evaluation 
               SET averageNotes = $average 
               ORDER BY idEvaluation 
               DESC LIMIT 1";
$getAverage = $top5->executeQuerySelect($setAverage);

?>
<!--Liens avec Materialize-->
<head>

    <meta charset="UTF-8">
    <title>Index</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../materialize/css/cssPerso.css" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<main>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>

    <!--navbar-->
    <nav id="menu-haut">
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        <div class="nav-wrapper #00695c teal darken-3">

            <!--Menu en mode normal-->
            <ul class="left hide-on-med-and-down">
                <li><i class="material-icons"><a href="../index.php">class</a></i></li>
                <li><a href="../Pages/ShowBook.php">Ouvrages</a></li>

                <?php
                //Si l'utilisateur n'est pas connecté il ne peut pas aller ajouter un livre ou l'évaluer
                if(isset($_SESSION['Pseudo'])) {
                    echo "<li><a href='../Pages/AddBook.php?type=add&id=0'>Ajouter un ouvrage</a></li>";
                    echo "<li><a href=\"../Pages/evals.php\">Evaluer</a></li>";
                }
                ?>
            </ul>
            <ul class="right hide-on-med-and-down">
                <?php
                //Si l'utilisateur n'est pas connecté il peut se connecter ou s'incrire. Sinon il peut se déco
                if(isset($_SESSION['Pseudo']))
                {
                    echo "<li><b>$_SESSION[Pseudo]</b></li>";
                    echo "<li><a href='disconnection.php' class='waves-effect waves-light btn red'>Déconnexion</a></li>";
                }
                else
                {
                    echo "<li><a href='../Pages/loginPage.php' class='waves-effect waves-light btn'>Connexion</a></li>";
                    echo "<li><a href='../Pages/registration.php' class='waves-effect waves-light btn'>Inscription</a></li>";
                }
                ?>
            </ul>
            <!--Menu en mode mobile-->
            <ul id="nav-mobile" class="side-nav">
                <li><i class="material-icons"><a href="../index.php">class</a></i></li>
                <li><a href="../Pages/ShowBook.php">Ouvrage</a></li>
                <li><a href="../Pages/AddBook.php">Ajouter un ouvrage</a></li>
                <li><a href="#">Evaluer</a></li>
                <!--</ul>
                <ul class="right hide-on-med-and-down">-->
                <?php
                if(isset($_SESSION['Pseudo']))
                {
                    echo "<li><a href='disconnection.php' class='waves-effect waves-light btn red'>Déconnexion</a></li>";
                    echo "<li><a>$_SESSION[Pseudo]</a></li>";

                }
                else
                {
                    echo "<li><a href='../Pages/loginPage.php' class='waves-effect waves-light btn'>Connexion</a></li>";
                    echo "<li><a href='../Pages/registration.php' class='waves-effect waves-light btn'>Inscription</a></li>";
                }
                ?>
            </ul>
        </div>
    </nav>
    <?php
    echo "<h2>Votre note de ".$note ." a bien été attribué</h2>"
    ?>
</main>
<!--Footer-->
<footer class="page-footer #00695c teal darken-3">
    <?php
    //include '../php/footer.php';
    header("Location:../Pages/ShowBook.php?id=$book");
    ?>
</footer>
</body>
</html>