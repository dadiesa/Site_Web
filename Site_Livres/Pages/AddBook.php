<!DOCTYPE html>
<html>
    <?php
    session_start();
    //Récupère le paramètre donné
    $addOrModif = $_GET['type'];
    $boId = $_GET['id'];

    //Appel de la classs pour le PDO
    include "../php/connexionPDO.php";
    include "../php/RequestSQL.php";
    $cat = new connexionPDO();
    $allRequest = new RequestSQL();

    //Si l'utilisateur est connecté on récupère son id
    if(isset($_SESSION['Pseudo']))
    {
    //Récupère l'id de l'utilsateur connecté en fonction de son nom
    $pseudo = $_SESSION['Pseudo'];
    $getIdUser = $allRequest->getUser($pseudo);
        $getuserID = $cat->executeQuerySelect($getIdUser);
        if ($getuserID[0]['useAdminOrNot'] == 1) {
            //Récupère l'id de l'utilsateur connecté en fonction de son nom
            $idOfUser = $getuserID[0]['idUser'];
            //vérifie le role de l'utilisateur connecté
            if ($getuserID[0]['useAdminOrNot'] == 1) {
                $userRole = "Admin";
            }
        else {
            $userRole = "user";
        }

    $requete = 'SELECT `idCategorie`,`catName` 
                FROM `t_categorie`';
    $AllBook = 'SELECT booTitle ,booAbstract ,booPreview ,booAuthor ,booNumPages ,booEditor ,booEditingYear ,booImage ,idCategorie 
                FROM t_book 
                WHERE idBook ='.$boId;


    //Exécute les requetes SQL
    $getdata = $cat->executeQuerySelect($requete);
    $getdata2 = $cat->executeQuerySelect($AllBook);


    foreach ($getdata2 as $book) {

        $title = $book["booTitle"];
        $abstract = $book["booAbstract"];
        $preview = $book["booPreview"];
        $author = $book["booAuthor"];
        $numpage = $book["booNumPages"];
        $editor = $book["booEditor"];
        $editYear = $book["booEditingYear"];
        $cat = $book["idCategorie"];
    }

    ?>
    <!--Liens avec Materialize-->
    <head>

        <meta charset="UTF-8">
        <title>Ajouter des livres</title>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../materialize/css/cssPerso.css" rel="stylesheet">


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
    </head>

    <body>
    <main>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="materialize/js/materialize.min.js"></script>

        <?php
        //inclue la navbar de façon dynamiques
        include '../php/navbar.php';
        ?>

        <!--Site description-->
        <div class="row">
            <!--Permet de diviser le site en plusieurs parties-->
            <div class="col s2 m3"></div>
            <div class="backgroundIndex col s2 m6">
                <!--Change le titre en fonction de la modification ou de l'ajout-->
                <?php
                    if($addOrModif == "add") {
                        echo "<h1 class='center'>Ajout d'un ouvrage</h1>";
                    }
                    else
                    {
                        echo "<h1 class='center'>Modification d'un ouvrage</h1>";
                    }
                ?>
                <div class="row">
                    <!--Formulaire d'ajout-->
                    <form method="post" action="../php/confAddBook.php" class="col s12" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s6">
                                <input name="name" placeholder="Titre" id="name" type="text" class="validate" value="<?php if ($addOrModif == "modif") echo $title ?>" required>
                            </div>
                            <div class="input-field col s6">
                                <input name="author" placeholder="Auteur" id="author" type="text" class="validate" value="<?php if ($addOrModif == "modif") echo $author ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input name="pagesNumber" placeholder="Nombre de pages" id="pagesNumber" type="number" class="validate" value="<?php if ($addOrModif == "modif") echo $numpage ?>" required>
                            </div>
                            <div class="input-field col s6">
                                <input name="editor" placeholder="Editeur" id="editor" type="text" class="validate" value="<?php if ($addOrModif == "modif") echo $editor ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <p>
                                    <label>Année d'édition</label>
                                </p>
                                <input name="editionDate" placeholder="Année d'édition" id="editionDate" type="date" class="validate" value="<?php if($addOrModif == "modif") echo $editYear?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea name="Resum" placeholder="Résumé du livre" id="Resum" class="validate" value="<?php if ($addOrModif == "modif") echo $preview ?>"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Photo</span>
                                    <input name="pic" type="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <?php
                                    //Ce for permet d'afficher les différentes catégorie de façon dynamique
                                    $i =1;
                                    foreach($getdata as $line)
                                    {
                                        if($addOrModif == "modif")
                                        {
                                            //Check si c'est cette option est déja enregistrée
                                            if($i==$cat) {
                                            echo "<p><input name='Category' type='radio' id='$i' value='$i' required checked/><label for='$i'>";
                                            echo $line['catName'];
                                            }
                                            else{
                                            echo "<p><input name='Category' type='radio' id='$i' value='$i' required/><label for='$i'>";
                                            echo $line['catName'];
                                            }

                                        }//end if
                                        //Si l'utilisateur souhaite ajouter un livre et pas en modifier
                                        else
                                        {
                                            echo "<p><input name='Category' type='radio' id='$i' value='$i' required/><label for='$i'>";
                                            echo $line['catName'];
                                        }
                                            echo "</label></p>";
                                            $i++;
                                            if($i == 8)
                                            {}
                                ?>
                                <!--Permet de limiter la taille de la première colonne à 7 valeurs-->
                                </div>
                                <div class="input-field col s6">
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <!--Boutons d'envoie et de réinitialisation-->
                        <button class="btn waves-effect waves-light" type="reset" name="rez">Réinitialiser
                            <i class="material-icons right"></i>
                        </button>
                        <?php
                        if($addOrModif == "add") {
                            echo "<input name='idBook' value='0' type='hidden'>";
                            ?>
                            <!--Donne l'info si l'utilisateur veut ajouter ou modifier un livre-->
                            <input name="addOrModif" value="add" type="hidden">

                            <button class="btn waves-effect waves-light" type="submit" name="action">Valider
                                <i class="material-icons right">send</i>
                            </button>
                            <?php
                        }
                        else
                        {
                        //Donne l'info sur le livre en modification
                        echo "<input name='idBook' value='$boId' type='hidden' >";
                        ?>
                            <!--Donne l'info si l'utilisateur veut ajouter ou modifier un livre-->
                            <input name="addOrModif" value="modif" type="hidden">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Valider
                                <i class="material-icons right">send</i>
                            </button>
                        <?php
                        }
                        ?>
                    </form>
                </div >
            </div>
        </div>
    </main>
    <?php
        //inclut le footer pour ne pas le répéter sur tous les fichiers
        include '../php/footer.php';
        }//end if l'utilisateur est un admin

        else
        {
            //Si l'utilisateur n'est pas connecté en admin il se fait directement rediriger à l'accueil
            header('Location:../index.php');
        }
    }//end if connexion de l'utilisateur
    ?>
    </body>
</html>