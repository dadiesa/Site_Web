<!DOCTYPE html>
<main>
    <?php
    session_start();
    //Appel de la classs pour le PDO
    include "php/connexionPDO.php";
    //Récupère les infos sur les livres dans BD
    $requete = 'SELECT `idBook`, `booTitle`,`booAbstract` 
                FROM `t_book` 
                ORDER BY RAND() LIMIT 5';
    $getAverage = 'SELECT t_evaluation.idEvaluation, t_evaluation.averageNotes, t_evaluation.idBook 
                   FROM t_evaluation 
                   INNER JOIN t_book ON t_evaluation.idBook = t_book.idBook 
                   ORDER BY idEvaluation DESC';
    $top5 = new connexionPDO();
    $getdata = $top5->executeQuerySelect($requete);
    $showAverage = $top5->executeQuerySelect($getAverage);
    //Permet de vérifier si l'utilisateur est connecté
    if(isset($_SESSION['Pseudo'])) {
        $pseudo = $_SESSION['Pseudo'];
        $getIdUser = "SELECT idUser,useAdminOrNot 
                  FROM t_user 
                  WHERE usePseudo = '$pseudo'";
        $getuserID = $top5->executeQuerySelect($getIdUser);
        //Récupère l'id de l'utilsateur connecté en fonction de son nom
        $idOfUser = $getuserID[0]['idUser'];
        if ($getuserID[0]['useAdminOrNot'] == 1) {
            $userRole = "Admin";
        }
        else {
            $userRole = "user";
        }
    }
    ?>
    <!--Fait le lien avec le template materialize-->
    <head>
        <link href="materialize/css/cssPerso.css" rel="stylesheet">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = "stylesheet"
              href = "https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel = "stylesheet"
              href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
        <script type = "text/javascript"
                src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
        </script>

        <script src="javascript/javaPerso.js" type="text/javascript"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <meta charset="UTF-8">
        <title>Index</title>

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
    </head>
    <body>
        <main>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
        <script src="materialize/js/init.js"></script>
        <!--navbar-->
        <nav id="menu-haut">
            <div class="nav-wrapper #00695c teal darken-3">
                <a href="#" data-activates="mobile-demo" class="button-collapse">
                    <i class="material-icons">menu</i>
                </a>
                <!--Menu en mode normal-->
                <ul class="left hide-on-med-and-down">
                    <li><i class="material-icons"><a href="index.php">class</a></i></li>
                    <li><a href="Pages/ShowBook.php">Ouvrages</a></li>

                    <?php
                    //Si l'utilisateur n'est pas connecté il ne peut pas aller ajouter un livre ou l'évaluer
                    if(isset($_SESSION['Pseudo'])) {
                        if ($userRole == "Admin") {
                            echo "<li><a href='Pages/AddBook.php?type=add&id=0'>Ajouter un ouvrage</a></li>";
                        }echo "<li><a href='Pages/evals.php'>Evaluer</a></li>";
                    }
                    ?>
                </ul>
                <ul class="right hide-on-med-and-down">
                    <?php
                    //Si l'utilisateur n'est pas connecté il peut se connecter ou s'incrire. Sinon il peut se déco
                    if(isset($_SESSION['Pseudo']))
                    {
                        //afiche le nom d'utilisateur
                        echo "<li><a class='waves-effect waves-light modal-trigger' href='#user1'>$_SESSION[Pseudo]</a></li>";
                        echo "<li><a href='php/disconnection.php' class='waves-effect waves-light btn red'>Déconnexion</a></li>";
                    }
                    else
                    {
                        echo "<li><a href='Pages/loginPage.php' class='waves-effect waves-light btn'>Connexion</a></li>";
                        echo "<li><a href='Pages/registration.php' class='waves-effect waves-light btn'>Inscription</a></li>";
                    }
                    ?>
                </ul>
                <!--Menu en mode mobile-->
                <ul id="mobile-demo" class="side-nav">
                    <li><i class="material-icons"><a href="index.php">class</a></i></li>
                    <li><a href="Pages/ShowBook.php">Ouvrage</a></li>
                    <?php
                    if(isset($_SESSION['Pseudo'])) {
                        echo "<li><a href='Pages/AddBook.php?type=add&id=0'>Ajouter un ouvrage</a></li>";
                        echo "<li><a href='Pages/evals.php'>Evaluer</a></li>";
                    }
                    ?>
                    <!--</ul>
                    <ul class="right hide-on-med-and-down">-->
                    <?php
                    if(isset($_SESSION['Pseudo']))
                    {
                        echo "<li><a href='php/disconnection.php' class='waves-effect waves-light btn red'>Déconnexion</a></li>";
                        echo "<li><a>$_SESSION[Pseudo]</a></li>";
                    }
                    else
                    {
                        echo "<li><a href='Pages/loginPage.php' class='waves-effect waves-light btn'>Connexion</a></li>";
                        echo "<li><a href='Pages/registration.php' class='waves-effect waves-light btn'>Inscription</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </nav>
        <!-- Affiche les caractèristique de l'utilisateur -->
        <div id="bg-text">
            <!--Site description-->
            <div class="row">
                <div class="col s12 m3"></div>
                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Accueil</span>
                            <p>Ce site Web a pour but de lister différents livres. Vous pouvez y retrouver toute leurs spécification ainsi que l'avis des lecteurs
                                Si vous désirez donner votre avis sur une oeuvre vous pouvez vous inscrir ou vous connecter et ensuite donnez une note entre 1 et 5 à ce livre.</p>
                        </div>
                    </div>

                    <!--Tableau avec les 5 derniers livres ajouter-->
                    <table class="">
                        <thead>
                        <tr>
                            <th data-field="id">Titre</th>
                            <th data-field="name">Résumé</th>
                            <th data-field="price">Note moyenne</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //Affiche le titre du livre et le résumé
                        foreach($getdata as $line)
                        {
                            echo "<tr>"."<td>"." ".$line["booTitle"]." "."</td>";
                            echo "<td><p align='justify'>"." ".$line["booAbstract"]." "."</p></td>";
                            //Affiche la moyenne des notes
                            $i= 0;
                            foreach($showAverage as $allAverage)
                            {
                                //Affiche la bonne moyenne au bon livre
                                if($line["idBook"] == $allAverage["idBook"] and $i == 0){
                                    echo "<td>"." ".$allAverage["averageNotes"].""."/5</td>"."</tr>";
                                    $i++;
                                }//end if
                            }//end foreach
                        }//foreach 2
                        ?>
                        </tbody>
                    </table>
                </div><!--fin div col s2 m6-->
            </div><!--fin div row-->
        </div>
        </body>
    </main>
    <!--Footer-->
    <?php
    include 'php/footer.php'
    ?>
    </html>




