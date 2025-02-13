<?php
/*****************************************************************************/
/*** File : verif.inc.php ***/
/*** Author : R.SYREK ***/
/*** WWW : http://domotique-home.fr ***/
/*** Note : Configuration file ***/
/*****************************************************************************/

require('config.inc.php');
$msg = htmlentities($_POST['msg']);

// mise a jour de stock, reliquat, prix de sac
if ($msg == 1)
{
$stock = htmlspecialchars($_POST["stock"]);
$prixsac = htmlentities($_POST['prixsac']);
$reliquat = htmlentities($_POST['reliquat']);
if(!isset($stock))
{
echo "<script type=\"text/javascript\">alert(\"Veuillez renseigner le champ 'Stock'.\");</script> ";
//header("Refresh: 0;URL=admin.php");
echo "<script> location.replace(\"admin.php\"); </script>";
exit();
}
if(empty($prixsac))
{
echo "<script type=\"text/javascript\">alert(\"Veuillez renseigner le champ 'Prix de sac' $stock\");</script>";
//header("Refresh: 0;URL=admin.php");
echo "<script> location.replace(\"admin.php\"); </script>";
exit();
}
try
{
$bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
$reponse = $bdd->query(" SELECT MAX(id) as DId FROM domotique_granules_stock ");
$donnees= $reponse->fetch();
$lastID = $donnees['DId'];
$bdd->exec(" UPDATE domotique_granules_stock SET stockIni = $stock, prixsac = $prixsac, reliquat = $reliquat WHERE id = $lastID ");
echo "<script type=\"text/javascript\">alert(\"Les données ont bien été enregistrées.\");</script>";
//header("Refresh: 0;URL=admin.php");
echo "<script> location.replace(\"admin.php\"); </script>";
}

//enregistrement d'une nouvelle periode stock, reliquat, prix de sac
if ($msg == 11)
{
$stock = htmlspecialchars($_POST['stock']);
$prixsac = htmlentities($_POST['prixsac']);
$reliquat = htmlentities($_POST['reliquat']);
if(!isset($stock))
{
echo "<script type=\"text/javascript\">alert(\Veuillez renseigner le champ 'Stock'.\");</script>";
//header("Refresh: 0;URL=admin.php");
echo "<script> location.replace(\"admin.php\"); </script>";
exit();
}
if(empty($prixsac))
{
echo "<script type=\"text/javascript\">alert(\"Veuillez renseigner le champ 'Prix de sac'.'\");</script>";
//header("Refresh: 0;URL=admin.php");
echo "<script> location.replace(\"admin.php\"); </script>";
exit();
}
try
{
$bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
// $bdd->exec(" INSERT INTO domotique_granules_stock(stockIni, prixsac, reliquat) VALUES($stock, $prixsac, $reliquat) ");



$mois_actuel = date('n'); // Récupère le mois actuel (1 à 12)
$annee = date('Y'); // Récupère l'année actuelle

// Si on est entre janvier et mai, on prend l'année précédente
if ($mois_actuel <= 5) {
    $annee--;
}

// Définit la date pour `time` (on prend le premier septembre à minuit)
$time = "$annee-09-01 00:00:00";

// $bdd->exec(" INSERT INTO domotique_granules_stock(stockIni, prixsac, reliquat, time) VALUES($stock, $prixsac, $reliquat, $time) ");
$bdd->exec("INSERT INTO domotique_granules_stock(stockIni, prixsac, reliquat, `time`) 
            VALUES($stock, $prixsac, $reliquat, '$time')");


echo "<script type=\"text/javascript\">alert(\"Les données ont bien été enregistrées.\");</script>";
//header("Refresh: 0;URL=admin.php");
echo "<script> location.replace(\"admin.php\"); </script>";
}

if ($msg == 2)
{
$date1 = htmlentities($_POST['date1']);
//$date1 = substr($date1,6,4). "-" .substr($date1,3,2). "-" .substr($date1,0,2);
$date1 = date('Y-m-d', strtotime($date1));
$date2 = htmlentities($_POST['date2']);
//$date2 = substr($date2,6,4). "-" .substr($date2,3,2). "-" .substr($date2,0,2);
$date2 = date('Y-m-d', strtotime($date2));
$date3 = htmlentities($_POST['date3']);
//$date3 = substr($date3,6,4). "-" .substr($date3,3,2). "-" .substr($date3,0,2);
$date3 = date('Y-m-d', strtotime($date3));
try
{
$bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
$bdd->exec(" UPDATE domotique_granules_entretiens SET regulier = '$date1', mensuel = '$date2', annuel = '$date3' WHERE id = 1 ");
echo "<script type=\"text/javascript\">alert(\"Les données ont bien été enregistrées.\");</script>";
//header("Refresh: 0;URL=admin.php");
echo "<script> location.replace(\"admin.php\"); </script>";
}

if ($msg == 3)
{
$info = htmlentities($_POST['info']);
try
{
$bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
$bdd->exec(" UPDATE domotique_granules_entretiens SET info = $info WHERE id = 1 ");
echo "<script type=\"text/javascript\">alert(\"Les données ont bien été enregistrées.\");</script>";
//header("Refresh: 0;URL=admin.php");
echo "<script> location.replace(\"admin.php\"); </script>";
}

if ($msg == 4)
{
$PushingBox = htmlentities($_POST['PushingBox']);
$PushingBoxTitre1 = htmlentities(addslashes($_POST['PushingBoxTitre1']));
$PushingBoxMsg1 = htmlentities(addslashes($_POST['PushingBoxMsg1']));
$PushingBoxTitre2 = htmlentities(addslashes($_POST['PushingBoxTitre2']));
$PushingBoxMsg2 = htmlentities(addslashes($_POST['PushingBoxMsg2']));
$PushingBoxTitre3 = htmlentities(addslashes($_POST['PushingBoxTitre3']));
$PushingBoxMsg3 = htmlentities(addslashes($_POST['PushingBoxMsg3']));
try
{
$bdd = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
$bdd->exec(" UPDATE domotique_granules_entretiens SET PushingBox = '$PushingBox', PushingBoxTitre1 = '$PushingBoxTitre1', PushingBoxMsg1 = '$PushingBoxMsg1', PushingBoxTitre2 = '$PushingBoxTitre2', PushingBoxMsg2 = '$PushingBoxMsg2', PushingBoxTitre3 = '$PushingBoxTitre3', PushingBoxMsg3 = '$PushingBoxMsg3' WHERE id = 1 ");
echo "<script type=\"text/javascript\">alert(\"Les données ont bien été enregistrées.\");</script>";
//header("Refresh: 0;URL=admin.php");
echo "<script> location.replace(\"admin.php\"); </script>";
}
?>