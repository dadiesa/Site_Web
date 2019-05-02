<?php
/**
 * Created by PhpStorm.
 * User: dadiesa
 * Date: 17.03.2017
 * Time: 13:52
 */
?>
<!DOCTYPE html>
<html>
<!--Liens avec Materialize-->
<head>

    <meta charset="UTF-8">
    <title>Index</title>

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

    <?php
    //inclue la navbar de façon dynamiques
    include '../php/navbar.php';
    ?>

    <!--Site description-->
    <div class="background row">
        <h1 class="center">Inscription</h1>
        <div>
            <!--Formulaire d'inscription-->
            <form method="post" action="../php/confRegistration.php">
                <div class="input-field col s12">
                    <input name="Pseudo" placeholder="Pseudo" id="pseudo" type="text" class="validate" >
                </div>
                <div class="input-field col s6">
                    <input name="Password" placeholder="Mot de passe" id="Password" type="password" class="validate" >
                </div>
                <div class="input-field col s6">
                    <input name="PasswordValid" placeholder="Mot de passe" id="PasswordValid" type="password" class="validate" >
                </div>
                <div class="input-field col s6">
                <!--Button d'inscription-->
                <button class="btn waves-effect waves-light" type="submit" name="action">S'inscrire
                    <i class="material-icons right">send</i>
                </button>
                </div>
            </form>
        </div>
    </div>
</main>
    <?php
    //Liens avec Footer
    include '../php/footer.php'
    ?>
</body>
</html>
