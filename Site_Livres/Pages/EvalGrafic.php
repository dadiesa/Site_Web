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
$top5 = new connexionPDO();
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
//Récupère les livres de la base de donnée afin de les afficher
$requeteForAverage = 'SELECT averageNotes  
                FROM t_evaluation';
$requestForBooTitle = 'SELECT booTitle FROM t_book';

$getAverage = $top5->executeQuerySelect($requeteForAverage);
$gettitle = $top5->executeQuerySelect($requestForBooTitle);


?>
<!--Liens avec Materialize-->
<head>

    <link href="../materialize/css/cssPerso.css" rel="stylesheet">
    <!--fait le lien avec le fichier javascript-->
    <script src="../javascript/javaPerso.js" type="text/javascript"></script>

    <meta charset="UTF-8">
    <title>Ouvrages</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

    <!--Lien pour le premier graphics-->
    <link href="materialize/css/cssPerso.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


</head>

<body>
<main>
    <?php
    //Affiche le menu de navigation
    include '../php/navbar.php';
    ?>

    <!--Site description-->
    <div class="row">
        <div class="col s2 m3"></div>
        <div class="backgroundIndex col s2 m6">

        <?php
            $allDatas = '';
            $Titles = '';

            //Donnée de la partie vertical
            foreach ($getAverage as $line){
            $allData = $line['averageNotes'];
            $allDatas = $allDatas.$allData.',';
            }

            //Donnée du tableau horizontale
            $arrayLength = count($gettitle)-1;
            for ($i=0;$i < $arrayLength;$i++){
                $gettitle[$i]['booTitle'];
                $title = $gettitle[$i]['booTitle'];
                $Titles = $Titles."'".$title."', ";
            }
            $Titles = $Titles."'".$gettitle[$arrayLength]['booTitle']."'";

        ?>

            <canvas id="myChart" class="chartjs" ></canvas>
            <script>

                var ctx = document.getElementById('myChart');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels:[<?php echo $Titles; ?>],
                        datasets: [{
                            label: 'Moyenne des notes',
                            data: [<?php echo $allDatas;?>],
                            borderColor: 'rgb(0,0,0)',
                            //backgroundColor: 'rgb(0,0,0)',
                            backgroundColor: 'transparent',
                        }]
                    },

                    options: {
                        scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 5,
                                beginAtZero: true
                            }
                        }]
                    }
                }
                });

            </script>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <h1>ffgf</h1>
        </div>
    </div>

</main>
<!--Footer-->
<footer class="page-footer #00695c teal darken-3">
    <?php
    //inclut le footer pour ne pas le répéter sur tous les fichiers
    include '../php/footer.php';
    ?>
</footer>
</body>
</html>