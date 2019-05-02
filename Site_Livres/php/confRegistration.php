<?php
/**
 * Created by PhpStorm.
 * User: dadiesa
 * Date: 17.03.2017
 * Time: 14:01
 */

session_start();
$login = $_POST['Pseudo'];
$pwd = $_POST['Password'];
$pwdCheck = $_POST['PasswordValid'];

if($pwd == $pwdCheck) {

    $pwdHash = password_hash($_POST['Password'], PASSWORD_DEFAULT);
}

//Appel de la classs pour le PDO
include "connexionPDO.php";
$insert = "INSERT INTO t_user (usePseudo,usePassword,useAdminOrNot,useRegisterDate,useBookProposition,useNbrNote) VALUES ('$login','$pwdHash','0' ,NULL, NULL ,NULL )";
$allUser = "SELECT usePseudo FROM t_user";
$co = new connexionPDO();
$getUsers = $co->executeQuerySelect($allUser);

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
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>

    <?php
    //inclue la navbar de façon dynamiques
    include '../php/navbar.php';
    ?>


    <!--Site description-->
    <div class="row">
        <div class="col s2 m3">
            <?php
            //Parcour tous les utilisateur existants
            $userexist = false;
            foreach($getUsers as $users)
            {
                //Vérifie si l'utilisateur existe déjà
                if($login == $users['usePseudo'])
                {
                    $userexist = true;
                    echo "<h4>Ce nom d'utilisateur est déja utilisé. Veuillez en choisir un autre</h4>";
                    break;
                }
            }
            //Si l'utilisateur existe pas il est créé
            if ($userexist == false){

                    echo "<h4>L'utilisateur " . $login . " à bien été créé</h4>";

                    $co->executeQuery($insert);
            }
            ?>
        </div>
    </div>
</main>
<?php
//Footer
include '../php/footer.php'
?>
</body>
</html>
