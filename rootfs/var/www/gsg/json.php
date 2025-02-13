<?php
require('config.inc.php');

//Récuperation et traitement des variables
if (isset($_GET['json']))
    $json = htmlspecialchars($_GET["json"]);
else
    $json=0;
    
// On determine l'année en cours par defaut, si superieur a septembre = an+1
if (isset($_GET['an']))
    $annee = htmlspecialchars($_GET["an"]);
else
    if (date('n') < 9 )
        $annee = date('Y');
    else
        $annee = date('Y')+1;
//conexion à la bdd avec class PDO
try {
$DB = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
}
catch(PDOException $e) {
echo "Impossible de se connecter!";
}

// Récuperation de consomation mensuelle $annee
$conso_mois = array(0,0,0,0,0,0,0,0,0,0,0,0);
$req="";
$req = $DB->query("SELECT MONTH(`time`) AS mois, COUNT(*) AS nb_sac FROM `domotique_granules_conso` WHERE YEAR(`time`) = $annee GROUP BY MONTH(`time`)");
while($d = $req->fetch()) {
$conso_mois[$d['mois']-1] = $d['nb_sac'];
}

// Récuperation de consomation mensuelle $annee-1
$annee2 = $annee-1;
$conso_mois2 = array(0,0,0,0,0,0,0,0,0,0,0,0);
$req="";
$req = $DB->query("SELECT MONTH(`time`) AS mois, COUNT(*) AS nb_sac FROM `domotique_granules_conso` WHERE YEAR(`time`) = $annee2 GROUP BY MONTH(`time`)");
while($d = $req->fetch()) {
$conso_mois2[$d['mois']-1] = $d['nb_sac'];
}

//Création de la periode $annee/$annee-1
$tab_mois = array("Septembre $annee2","Octobre $annee2","Novembre $annee2","Décembre $annee2","Janvier $annee","Février $annee","Mars $annee","Avril $annee","Mai $annee","Juin $annee","Juillet $annee","Août $annee");
//creation et remplissage de periode de Septembre/$annee-1 à Août/$annee
$conso_moisF = array(0,0,0,0,0,0,0,0,0,0,0,0);
$compteur = 0; // Determine les mois avec consomation
for ($i = 0; $i < 12; $i++) {
    if ($i<=3){
        $conso_moisF[$i] = $conso_mois2[$i+8];
        if ($conso_moisF[$i] > 0){ 
            ++$compteur;
            }
    }
    else {
        $conso_moisF[$i] = $conso_mois[$i-4];
        if ($conso_moisF[$i] > 0) {
            ++$compteur;
            }
        }
}

// Calcul de sacs consommés sur la periode
$TotalSacConsomes = array_sum($conso_moisF);

// Creation de tableau periode avec les valeurs uniques
$req="";
$periode = array();
$req = $DB->query("SELECT DISTINCT YEAR(`time`) AS periode FROM `domotique_granules_conso` ORDER BY periode DESC");
if ($annee == date('Y')+1){
        $periode[] = $annee;
    }
while($d = $req->fetch()) {
    $periode[] = $d['periode'];
    }

// Calcule de stock total + prix (prise en compte de prix de la periode precedante)
$req="";
$req = $DB->query("SELECT `reliquat` AS reliquat , `stockIni` AS stockini , `prixsac` AS prixsac FROM `domotique_granules_stock` WHERE YEAR(`time`) = $annee-1 ");
$d = $req->fetch();
$reliquat = $d['reliquat'];
$stockini = $d['stockini'];
$prixsac = $d['prixsac'];

$req="";
$req = $DB->query("SELECT `prixsac` AS prixsac FROM `domotique_granules_stock` WHERE YEAR(`time`) = $annee2-1 ");

$d = $req->fetch();
$prixsacAV = $d['prixsac'];

if (is_null($reliquat))
$reliquat = 0;
if (is_null($stockini))
$stockini = 0;
if (is_null($prixsac))
$prixsac = 0;
if (is_null($prixsacAV))
$prixsacAV = 0;

// Calcule de coût de sacs consomés
if ($TotalSacConsomes <= $reliquat)
        {
            $CoutConsome = $TotalSacConsomes * $prixsacAV;
        }
        else
        {
            $CoutConsome = ($reliquat * $prixsacAV) + (($TotalSacConsomes - $reliquat) * $prixsac);
        }

   
// Creation du tableau conso et cout par peride 09/annee-1 08/annee

    $TabAnnee = array();
    $TabConso = array(); 
    $TabCout = array();
    $req = $DB->query("SELECT * FROM `cout_consomme_periode`");
    while($d = $req->fetch()) {
    $TabAnnee[] = $d['periode'];
    $TabConso[] = $d['totalconso'];
    $TabCout[] = round($d['totalcout'], 2);
    }
    $Tannee="'".implode("', '", $TabAnnee)."'";
    $Ttotalconso=implode(', ', $TabConso);
    $Ttotalcout=implode(', ', $TabCout);

//Recuperation des dates
$sql_query  = "SELECT `regulier` AS regulier, `mensuel` AS mensuel, `annuel` AS annuel FROM `domotique_granules_entretiens` WHERE id = 1";
$req = $DB->query($sql_query);
$d = $req->fetch();
$regulier = $d['regulier'];
$mensuel = $d['mensuel'];
$annuel = $d['annuel'];

//recuperation de la date de derniere consomation
$req="";
$req = $DB->query("SELECT `time` AS time FROM `domotique_granules_conso` ORDER BY `id` DESC LIMIT 0,1");
$d = $req->fetch();
$last_date = $d['time'];


// Creation Json
    if ($json == 1)
    {
        $json_data = array();
        $json_data["Soft"] = 'Gestion Granules';
        $json_data["Auteur"] = 'R.Syrek';
        $json_data["Site"] = 'Domotique-Home.fr';
        $json_data["date"]  = time();
        $json_data["StockIni"] = $stockini;
        $json_data["Reliquat"] = $reliquat;
        $json_data["PrixSac"] = $prixsac;
        $json_data["NbrSacConso"] = $TotalSacConsomes;
        $json_data["Septembre $annee2"] = $conso_moisF[0];
        $json_data["Octobre $annee2"] = $conso_moisF[1];
        $json_data["Novembre $annee2"] = $conso_moisF[2];
        $json_data["Decembre $annee2"] = $conso_moisF[3];
        $json_data["Janvier $annee"] = $conso_moisF[4];
        $json_data["Fevrier $annee"] = $conso_moisF[5];
        $json_data["Mars $annee"] = $conso_moisF[6];
        $json_data["Avril $annee"] = $conso_moisF[7];
        $json_data["Mai $annee"] = $conso_moisF[8];
        $json_data["Juin $annee"] = $conso_moisF[9];
        $json_data["Jullet $annee"] = $conso_moisF[10];
        $json_data["Aout $annee"] = $conso_moisF[11];
        $json_data["regulier"] = $regulier;
        $json_data["mensuel"] = $mensuel;
        $json_data["annuel"] = $annuel;
        $json_data["last_date"] = $last_date;
        
        $json_output = json_encode($json_data);  
        echo $json_output;
    }


?>