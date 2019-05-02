/**
 * Created by dadiesa on 27.03.2019.
 */

/**
 * Cette fonction supprime le livre sélectionné
 * @param bookToDelete indique qu'elle livre doit être supprimer
 */

//include "../php/connexionPDO.php";


function confirmDelete(bookToDelete) {
    var confDelete = confirm("Suppression du livre");

    if (confDelete){
        document.location.href= bookToDelete;
    }

}//end confirmDelete

var newwindow;
/**
 * Cette fonction affiche les détails des livres
 * @param url : emplacement du fichier gérant l'affichage des détails
 * @param name
 */
function createPop(url, name)
{

    var left = (screen.width - 800) / 2;
    var top = (screen.height - 600) / 4;
    window.open(url, name, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=  800  , height= 600 , top=' + top + ', left=' + left);

    if (window.focus) {newwindow.focus()}
}//end createPop


$(document).ready(function() {
    $('input#input_text, textarea#textarea2').characterCounter();
});










