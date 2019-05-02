<?php
/**
 * Created by PhpStorm.
 * User: dadiesa
 * Date: 24.03.2017
 * Time: 13:20
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
    $idOfUser = $getuserD = $getuserID[0]['idUser'];
}

//Récupère l'id du livre sur laquel la page est ouverte
$idOfActuPage = $_GET['id'];

//Supprime le commentaire
if (isset($_GET['del'])){
    if($_GET['del'] != 0){

        $commToDel = $_GET['del'];
        $delComm = "DELETE FROM t_comment WHERE t_comment.idComment = $commToDel";

        $delComms = $top5->executeQuerySelect($delComm);
    }
}

//Requete qui récupère les infos sur le livre choisit
$requete = 'SELECT t_book.idBook,t_book.booImage,t_book.booEditor,t_book.booNumPages,t_book.booAuthor,t_book.booTitle,t_book.booAbstract,t_book.booEditingYear,t_categorie.catName 
            FROM `t_book` 
            INNER JOIN `t_categorie` ON t_book.idCategorie = t_categorie.idCategorie 
            WHERE t_book.idBook='.$idOfActuPage;

//Récupère les commentaires des livres
$getComment = 'SELECT t_book.idBook ,t_comment.idComment, t_comment.CommentContent , t_user.usePseudo, t_comment.answerTo 
               FROM t_book 
               INNER JOIN t_comment on t_comment.idBook = t_Book.idBook 
               INNER JOIN t_user on t_comment.idUser = t_user.idUser
               WHERE t_book.idBook='.$idOfActuPage;

//Check si l'utilisateur est connecté
if(isset($idOfUser)) {
//Ajoute une réponse
if (isset($_GET['AnswerComment'])){
    if(isset($_POST['AnswerText'])){
        $Answer = addslashes($_POST['AnswerText']);
        if($Answer != ""){
            $todaydate = date("Y-m-d");

            $AnswerTo = $_GET['AnswerComment'];
            $addComment = "INSERT INTO `t_comment` (`idComment`, `CommentContent`, `CommentDate`, `idUser`, `idBook`, `answerTo`) 
                           VALUES (NULL,'$Answer','$todaydate',$idOfUser,$idOfActuPage, $AnswerTo)";
            $insertdata = $top5->executeQuerySelect($addComment);
        }//fin if le commentaire n'est pas vide
    }//fin if AnswerText existe
}//fin if AnswerComment existe

//Ajoute un commentaire
    if (isset($_POST['newComment'])) {
        if ($_POST['newComment'] != "") {
            $todaydate = date("Y-m-d");
            $newComment = addslashes($_POST['newComment']);
            $addComment = "INSERT INTO `t_comment` (`idComment`, `CommentContent`, `CommentDate`, `idUser`, `idBook`) 
                       VALUES (NULL,'$newComment' , '$todaydate', $idOfUser, $idOfActuPage)";
            $insertdata = $top5->executeQuerySelect($addComment);
        }//end 1er if
    }//end deuxième if
}//fin de if isset($idOfUser)

//execute les requetes définit au préalable
$getdata = $top5->executeQuerySelect($requete);
$showComment = $top5->executeQuerySelect($getComment);
?>
<!--Liens avec Materialize-->
<head>
    <?php include'../php/materializeConnexion.php' ?>
</head>

<body>
    <div>
    <!--Import jQuery before materialize.js-->
        <link href="../materialize/css/cssPerso.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
        <script src="../materialize/js/init.js"></script>
        <div>
        <?php
            //Met toutes les données dans des variables
            foreach($getdata as $line)
            {
                $Title = $line["booTitle"];
                $author = $line["booAuthor"];
                $cat = $line["catName"];
                $abstract = $line["booAbstract"];
                $numpages = $line["booNumPages"];
                $editor = $line["booEditor"];
                $picture = $line["booImage"];
                $date = $line["booEditingYear"];
            }
            echo "<h1>"."$Title"."</h1>";
        ?>
    </div>
    <div class="row">
        <!--Sépare la page en deux parties pour y placer la photo et la description-->
        <div class="col s12 m6">
            <!--Partie contenant les caractèrisitques d'un livre-->
            <div class="card">
                <div class="card-content">
                    <h5>Description</h5>
                </div>
                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width">
                        <li class="tab"><a class="active" href="#spe">caractéristique</a></li>
                        <li class="tab"><a href="#resum">Résumé</a></li>
                    </ul>
                </div>
                <!--Affiche les infos sur ce livre-->
                <div class="card-content grey lighten-4">
                    <div id="spe">
                        <?php
                            echo "<p>Auteur: ".$author."</p>";
                            echo "<p>Nombre de pages: ".$numpages."</p>";
                            echo "<p>Editeur: ".$editor."</p>";
                            echo "<p>Catégorie: ".$cat."</p>";
                            echo "<p>Année d'édition: ".$date."</p>";
                        ?>
                    </div>
                    <div id="resum">
                        <?php
                        echo $abstract;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--Partie contenant le Résumé du livre-->
        <div class="col s12 m6">
            <?php
            echo "<img width='300' height='370' class='materialboxed ' src='../images/$picture' alt=''>";
            if(isset($_SESSION['Pseudo']))
            {
                for($i=1;$i<=5;$i++)
                {
                    echo "<a href='../php/giveNotes.php?note=$i&pseudo=$idOfUser&book=$idOfActuPage' id='$i' class='fa fa-star tooltipped' data-position='bottom' data-tooltip='$i' style='font-size:25px;'>&nbsp;</a>";
                }
            }
            ?>
        </div>
    </div>


    <?php
    //Affiche les commentaires des livres
    $count = 0;
    foreach($showComment as $line)
    {
    $count++;
    }
    echo "<tr><td>&nbsp $count commentaires</td></tr>";
    ?>
        <div id="coms" class="backgroundIndex input-field ">
            <table>
                <form action="" method="post">
                    <div class="row">
                        <div class="input-field col s11">
                            <i class="material-icons prefix">textsms</i>
                            <input class="materialize-textareae" maxlength="200" name="newComment" id="autocomplete-input" type="text">
                            <label data-length="200" for="autocomplete-input">Ajouter un commentaire</label>
                        </div>
                        <div class="input-field col s1">
                           <?php echo "<button class='material-icons' style='font-size:25px;'>send</button>" ?>
                        </div>
                    </div>
                </form>
                <?php
                /**
                 * Liste les commentaires et les affiches
                 */
                $count = 0;
                foreach($showComment as $line)
                {
                    $count++;
                    $idComment = $line['idComment'];
                    $Comment = $line['CommentContent'];
                    $userName = $line['usePseudo'];
                    $commentAnswer = $line['answerTo'];

                    ?>
                    <form method="post">
                    <?php
                        if($commentAnswer == NULL){
                            echo "<tr><td><font size='+1'>" . $userName ." : </font><br> ". $Comment;

                            //supprime le commentaire
                            if(isset($pseudo))
                            {
                                if($userName == $pseudo)
                                {
                                    echo "<a href='?id=$idOfActuPage&del=$idComment' style='color: blue'>&nbsp; Supprimer</a>";
                                }
                            }

                            foreach($showComment as $line)
                            {
                                //redéfinit les variables
                                $idAnswer = $line['idComment'];
                                $Comment = $line['CommentContent'];
                                $userName = $line['usePseudo'];
                                $commentAnswer = $line['answerTo'];

                                if ($commentAnswer == $idComment)
                                {
                                    echo "<dd><b>".$userName." : </b>".$Comment;
                                    //Supprime le commentaire
                                    if(isset($pseudo))
                                    {
                                        if($userName == $pseudo)
                                        {
                                            echo "<a href='?id=$idOfActuPage&del=$idAnswer' style='color: blue'>&nbsp; Supprimer</a>";

                                        }//fin if supprime le comm
                                    }
                                }//fin if affiche la réponse
                            }//end deuxième foreach
                            ?>
                        </form>
                        <?php echo "<form  action='?id=$idOfActuPage&AnswerComment=$idComment' method='post'>" ?>
                            <div class="row">
                                <div class="input-field col s5">
                                    <input maxlength="200" name="AnswerText" id="autocomplete-input" type="text">
                                    <label data-length="200" for="autocomplete-input">Répondre</label>
                                </div>
                                <div class="input-field col s1">
                                    <?php echo "<button href='?id=$idOfActuPage&AnswerComment=$idComment'>Répondre</button>" ?>
                                </div>
                            </div>
                        </form>
                        <?php
                        }//fin check si le comm est une réponse
                    ?>
                    </td>
                    <?php
                }//end foreach
            ?>
            </tr>
            </table>
        </div>
    </main>
</body>
</html>
