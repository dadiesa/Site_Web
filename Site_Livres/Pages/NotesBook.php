<!DOCTYPE html>
<html>
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

    <!--Menu-->
    <?php
        include '../php/navbar.php';
    ?>

    <!--Site description-->
    <div class="row">
        <div class="col s2 m3"></div>
        <div class="col s2 m5">
            <h1 class="center">Evaluation d'un ouvrage</h1>
            <!--Tableau avec les 5 premier livre-->
            <table>
                <thead>
                <tr>
                    <th data-field="id">Titre</th>
                    <th data-field="name">Résumé</th>
                    <th data-field="price">Evaluer</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>La Bible</td>
                    <td>Bas la bible quoi un peu de culture</td>
                </tr>
                <tr>
                    <td>Le Coran</td>
                    <td>Bas le coran quoi un peu de culture</td>
                </tr>
                <tr>
                    <td>La Torah</td>
                    <td>Bas un peu de culture quoi</td>
                </tr>
                </tbody>
            </table>
    </div>

    </div>
</main>
<footer class="page-footer #00695c teal darken-3">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">Ce site a été effectué par Samuel Dadié et par Bruno Cattin.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Nous contacter</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!">cattinbr@etml.educanet2.ch</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2017 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>
</footer>
</body>
</html>