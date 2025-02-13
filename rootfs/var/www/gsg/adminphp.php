<?php
require('config.inc.php');

// On determine l'année en cours par defaut
if (isset($_GET['an']))
    $annee = htmlspecialchars($_GET["an"]);
else
    if (date('n') >= 1 and date('n') < 9)
        $annee = date('Y')-1;
    else
        $annee = date('Y');


//conexion à la bdd avec class PDO
try {
$DB = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
}
catch(PDOException $e) {
echo "Impossible de se connecter!";
}

//recuperation de reliquat stock et prix
$req="";
$req = $DB->query("SELECT `reliquat` AS reliquat , `stockIni` AS stockini , `prixsac` AS prixsac FROM `domotique_granules_stock` WHERE YEAR(`time`) = $annee");
$d = $req->fetch();
$reliquat = $d['reliquat'];
$stockini = $d['stockini'];
$prixsac = $d['prixsac'];

//recuperation de la date de derniere consomation
$req="";
$req = $DB->query("SELECT `time` AS time FROM `domotique_granules_conso` ORDER BY `id` DESC LIMIT 0,1");
$d = $req->fetch();
$last_date = $d['time'];

//Recuperation des dates, messages...
$sql_query  = "SELECT `regulier` AS regulier, ";
$sql_query .= "       `mensuel` AS mensuel, ";
$sql_query .= "       `annuel` AS annuel, ";
$sql_query .= "       `info` AS info, ";
$sql_query .= "       `PushingBox` AS PushingBox, ";
$sql_query .= "       `PushingBoxTitre1` AS PushingBoxTitre1, ";
$sql_query .= "       `PushingBoxMsg1` AS PushingBoxMsg1, ";
$sql_query .= "       `PushingBoxTitre2` AS PushingBoxTitre2, ";
$sql_query .= "       `PushingBoxMsg2` AS PushingBoxMsg2, ";
$sql_query .= "       `PushingBoxTitre3` AS PushingBoxTitre3, ";
$sql_query .= "       `PushingBoxMsg3` AS PushingBoxMsg3 ";
$sql_query .= "FROM `domotique_granules_entretiens` WHERE id = 1";
$req="";
$req = $DB->query($sql_query);
$d = $req->fetch();
$regulier = date("Y/m/d", strtotime($d['regulier']));
$mensuel = date("Y/m/d", strtotime($d['mensuel']));
$annuel = date("Y/m/d", strtotime($d['annuel']));
$info = $d['info'];
$PushingBox = $d['PushingBox'];
$PushingBoxTitre1 = html_entity_decode($d['PushingBoxTitre1']);
$PushingBoxMsg1 = html_entity_decode($d['PushingBoxMsg1']);
$PushingBoxTitre2 = html_entity_decode($d['PushingBoxTitre2']);
$PushingBoxMsg2 = html_entity_decode($d['PushingBoxMsg2']);
$PushingBoxTitre3 = html_entity_decode($d['PushingBoxTitre3']);
$PushingBoxMsg3 = html_entity_decode($d['PushingBoxMsg3']);

?>