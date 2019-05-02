<?php
/**
 * Created by PhpStorm.
 * User: dadiesa
 * Date: 27.03.2017
 * Time: 14:32
 */

session_start();
//Récupération de l'id teacher
$idBook = $_GET['id'];

//Inclus le PDOLink
include 'connexionPDO.php';


//Crée un objet venant de la classe PDOLink
$PDO = new connexionPDO();
//Stock la requete
$query = "DELETE FROM t_book WHERE idBook =$idBook";

echo $query;

//Execute la requête de $query et stock le résultat dnas $req
$req = $PDO->executeQuerySelect($query);

//include 'navbar.php';

?>
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

        <!--fait le lien avec le fichier javascript-->
        <script src="../javascript/extract.js" type="text/javascript"></script>
    </head>
	<body>

        <?php
        echo '<script type="text/javascript">confirmDelete();</script>';
        ?>

        <main>
	    	<h1 style='text-align: center'>Livre Supprimer</h1>

	    	<section>
	    	</section>
                <?php
                include '../php/footer.php';

                header('Location:../Pages/ShowBook.php');

                ?>
        </main>
	</body>


</html>

