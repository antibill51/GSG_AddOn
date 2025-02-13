<?php
require('config.inc.php');
$value = $_GET['value'];
if (isset($_GET['dmy'])){
    $dmy = htmlspecialchars($_GET["an"]);
}
else{
    $dmy = "";
    }

//conexion à la bdd avec class PDO
try {
$DB = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
}
catch(PDOException $e) {
echo "Impossible de se connecter!";
}

//recherche de dernier id enregistré
$reponse = $DB->query("SELECT MAX(id) FROM `domotique_granules_stock`");
$resultats = $reponse->fetch();
$maxid = $resultats['MAX(id)'];

// On consomme 1 sac
if ($value == 1)
{
$DB->exec("INSERT INTO domotique_granules_conso(value,id_stock) VALUES($value,$maxid)");
echo "ok";
}



//extraction des dates d'entretien
$reponse = $DB->query("SELECT `regulier`,`mensuel`,`annuel` FROM `domotique_granules_entretiens` where id = 1");
$resultats = $reponse->fetch();
$regulier = $resultats['regulier'];
$mensuel = $resultats['mensuel'];
$annuel = $resultats['annuel'];
$reponse->closeCursor();


//incremantation de la date regulier de X jours par defaut = 4
if ($value == 2)
{
if (!isset($dmy)){ $dmy = 4; }
$regulier = strtotime(("+$dmy days"), strtotime($regulier));
$regulier = date("Y-m-d", $regulier);
$DB->exec("UPDATE domotique_granules_entretiens SET regulier = '$regulier' WHERE id = 1");
echo "ok";
}

//incrementation de la date mensuel de X mois par defaut = 1
if ($value == 3)
{
if (!isset($dmy)){ $dmy = 1; }
$mensuel = strtotime(("+$dmy month"), strtotime($mensuel));
$mensuel = date("Y-m-d", $mensuel);
$DB->exec("UPDATE domotique_granules_entretiens SET mensuel = '$mensuel' WHERE id = 1");
echo "ok";
}

//incremantation de la date annuel de X annees par defaut = 1
if ($value == 4)
{
if (!isset($dmy)){ $dmy = 1; }
$annuel = strtotime(("+$dmy year"), strtotime($annuel));
$annuel = date("Y-m-d", $annuel);
$DB->exec("UPDATE domotique_granules_entretiens SET annuel = '$annuel' WHERE id = 1");
echo "ok";
}
?>