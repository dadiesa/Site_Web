<!DOCTYPE html>
<html>
<?php
session_start();

//Appel de la classs pour le PDO
include "../php/connexionPDO.php";

$cat = new connexionPDO();



?>
<!--Liens avec Materialize-->
<head>

    <meta charset="UTF-8">
    <title>Ajouter des livres</title>

    <link href="../materialize/css/cssTest.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>



</head>



<body>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">



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


</div>
</div>





</div>

</body>
</html>