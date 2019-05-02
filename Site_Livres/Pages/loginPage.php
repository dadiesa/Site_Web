<!DOCTYPE html>
<html>
<!--Liens avec Materialize-->
<head>
    <?php
    include "../php/materializeConnexion.php";

    ?>
    <meta charset="UTF-8">
    <title>Index</title>

    <link href="../materialize/css/cssPerso.css" rel="stylesheet">
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
<main>
    <body>
        <?php
            //inclue la navbar de façon dynamiques
            include '../php/navbar.php';
        ?>
        <!--Site description-->
        <div class="background row">
        <h1 class="center">Connexion</h1>
        <div class="col s3 m3"></div>
        <div class=" col s3 m12">
            <!--Formulaire de connexion-->
            <form method="post" action="../php/confirmConnexion.php">
                <div class="input-field col s6">

                    <input placeholder="Pseudo" id="Pseudo" type="text" class="validate" name="Pseudo">
                </div>
                <div class="input-field col s6">
                    <input placeholder="Password" id="Password" type="password" class="validate" name="Password">
                </div>
                <button class="right waves-effect waves-light btn" type="submit" name="action">Connexion
                    <i class="material-icons right">send</i>
                </button>
            </form>
                <a class="waves-effect waves-light btn" href="registration.php">Pas de compte ?</a>
                <!--Message d'errur si on se trompe de mdp-->
                <div>
                    <?php
                    //Check si un get est donné
                    if (isset($_GET['wrong'])) {
                        $wrong = $_GET['wrong'];
                        //Vérifie si l'utilisateur s'est déjà trompé
                        if ($wrong == "1") {
                            echo "<a>Nom d'utilisateur ou mot de passe erroné</a>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</main>
<!--Footer-->
<?php
include '../php/footer.php'
?>
</html>