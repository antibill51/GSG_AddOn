<?php
/*****************************************************************************/
/*** File   : tab.php                                                      ***/
/*** Author : R.SYREK                                                      ***/
/*** WWW    : http://domotique-home.fr                                     ***/
/*** Note   : Array file                                                   ***/
/*****************************************************************************/

$departement = htmlspecialchars($_POST["departement"]);
$altitude = htmlspecialchars($_POST["altitude"]);
$iso = htmlspecialchars($_POST["iso"]);
$pcalo = htmlspecialchars($_POST["pcalo"]);
$Tvolume = htmlspecialchars($_POST["tvolume"]);
$TmpDesJ = htmlspecialchars($_POST["TmpDesJ"]);
$TmpDesN = htmlspecialchars($_POST["TmpDesN"]);

// Determine altitude
switch ($altitude) {
    case ($altitude <= 200):
        $altitude = 0;
        break;
    case ($altitude > 200 AND $altitude <= 400):
        $altitude = 1;
        break;
    case ($altitude > 400 AND $altitude <= 600):
        $altitude = 2;
        break;
    case ($altitude > 600 AND $altitude <= 800):
        $altitude = 3;
        break;
    case ($altitude > 800 AND $altitude <= 1000):
        $altitude = 4;
        break;
    case ($altitude > 1000 AND $altitude <= 1200):
        $altitude = 5;
        break;
    case ($altitude > 1200 AND $altitude <= 1400):
        $altitude = 6;
        break;       
    case ($altitude > 1400 AND $altitude <= 1600):
        $altitude = 7;
        break;
    case ($altitude > 1600 AND $altitude <= 1800):
        $altitude = 8;
        break;
    case ($altitude > 1800 AND $altitude <= 2000):
        $altitude = 9;
        break;
    case ($altitude > 2000):
        $altitude = 10;
        break;
        }

 // Déclaration de la matrice temperatures mini par altitude et departement
 // $TmpMini[DEPARTEMENT] = array('Altidude max','400','600','800','1000','1200','1400','1600','1800','2000','2200');
$TmpMini[0] = array('200','400','600','800','1000','1200','1400','1600','1800','2000','2200');
$TmpMini[1] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[2] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[3] = array('-8','-9','-11','-13','-15','-17','-19','-21','-23','-25','-27');
$TmpMini[4] = array('-8','-9','-11','-13','-15','-17','-19','-21','-23','-25','-27');
$TmpMini[5] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[6] = array('-2','-4','-6','-8','-10','-12','-14','-16','-18','-20','-20');
$TmpMini[7] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[8] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[9] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[10] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[11] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[12] = array('-8','-9','-11','-13','-15','-17','-19','-21','-23','-25','-27');
$TmpMini[13] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[14] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[15] = array('-8','-9','-11','-13','-15','-17','-19','-21','-23','-25','-27');
$TmpMini[16] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[17] = array('-4','-5','-6','-7','-8','-9','-10','-10','-10','-10','-10');
$TmpMini[18] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[19] = array('-8','-9','-11','-13','-15','-17','-19','-21','-23','-25','-27');
$TmpMini[21] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[22] = array('-4','-5','-6','-7','-8','-9','-10','-10','-10','-10','-10');
$TmpMini[23] = array('-8','-9','-11','-13','-15','-17','-19','-21','-23','-25','-27');
$TmpMini[24] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[25] = array('-12','-13','-15','-17','-19','-21','-23','-24','-24','-24','-24');
$TmpMini[26] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[27] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[28] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[29] = array('-4','-5','-6','-7','-8','-9','-10','-10','-10','-10','-10');
$TmpMini[30] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[31] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[32] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[33] = array('-4','-5','-6','-7','-8','-9','-10','-10','-10','-10','-10');
$TmpMini[34] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[35] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[36] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[37] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[38] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[39] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[40] = array('-4','-5','-6','-7','-8','-9','-10','-10','-10','-10','-10');
$TmpMini[41] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[42] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[43] = array('-8','-9','-11','-13','-15','-17','-19','-21','-23','-25','-27');
$TmpMini[44] = array('-4','-5','-6','-7','-8','-9','-10','-10','-10','-10','-10');
$TmpMini[45] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[46] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[47] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[48] = array('-8','-9','-11','-13','-15','-17','-19','-21','-23','-25','-27');
$TmpMini[49] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[50] = array('-4','-5','-6','-7','-8','-9','-10','-10','-10','-10','-10');
$TmpMini[51] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[52] = array('-12','-13','-15','-17','-19','-21','-23','-24','-24','-24','-24');
$TmpMini[53] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[54] = array('-15','-15','-19','-21','-23','-24','-25','-25','-25','-25','-25');
$TmpMini[55] = array('-12','-13','-15','-17','-19','-21','-23','-24','-24','-24','-24');
$TmpMini[56] = array('-4','-5','-6','-7','-8','-9','-10','-10','-10','-10','-10');
$TmpMini[57] = array('-15','-15','-19','-21','-23','-24','-25','-25','-25','-25','-25');
$TmpMini[58] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[59] = array('-9','-10','-11','-12','-13','-13','-13','-13','-13','-13','-13');
$TmpMini[60] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[61] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[62] = array('-9','-10','-11','-12','-13','-13','-13','-13','-13','-13','-13');
$TmpMini[63] = array('-8','-9','-11','-13','-15','-17','-19','-21','-23','-25','-27');
$TmpMini[64] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[65] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[67] = array('-15','-15','-19','-21','-23','-24','-25','-25','-25','-25','-25');
$TmpMini[68] = array('-15','-15','-19','-21','-23','-24','-25','-25','-25','-25','-25');
$TmpMini[69] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[70] = array('-12','-13','-15','-17','-19','-21','-23','-24','-24','-24','-24');
$TmpMini[71] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[72] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[73] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[74] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[75] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[76] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[77] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[78] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[79] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[80] = array('-9','-10','-11','-12','-13','-13','-13','-13','-13','-13','-13');
$TmpMini[81] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[82] = array('-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15');
$TmpMini[83] = array('-2','-4','-6','-8','-10','-12','-14','-16','-18','-20','-20');
$TmpMini[84] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[85] = array('-4','-5','-6','-7','-8','-9','-10','-10','-10','-10','-10');
$TmpMini[86] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[87] = array('-8','-9','-11','-13','-15','-17','-19','-21','-23','-25','-27');
$TmpMini[88] = array('-15','-15','-19','-21','-23','-24','-25','-25','-25','-25','-25');
$TmpMini[89] = array('-10','-11','-13','-14','-17','-19','-21','-23','-24','-25','-29');
$TmpMini[90] = array('-15','-15','-19','-21','-23','-24','-25','-25','-25','-25','-25');
$TmpMini[91] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[92] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[93] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[94] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
$TmpMini[95] = array('-7','-8','-9','-11','-13','-14','-15','-15','-15','-15','-15');
//Corse 2A
$TmpMini[96] = array('-2','-4','-6','-8','-10','-12','-14','-16','-18','-20','-20');
//Corse 2B
$TmpMini[97] = array('-2','-4','-6','-8','-10','-12','-14','-16','-18','-20','-20');

//Determine surfface
if ($Tvolume < 1000){$volume = 0;}
if ($Tvolume >= 1000 AND $Tvolume <= 5000 ){$volume = 1;}
if ($Tvolume > 5000){$volume = 2;}

// Déclaration de la matrice Coefficient isolation K selon Volume
// < 1000 m3	/ 1000 à 5000 m3 /	> 5000 m3
// Bonne (mûrs + plafond + portes isolés)
$IsoVol[3] = array('1','0.9','0.8');
// Moyenne (plafond ou mûrs isolés)
$IsoVol[2] = array('1.5','1.3','1.1');
// Faible (mûrs)
$IsoVol[1] = array('2','1.8','1.6');
// Inéxistante (pas d’isolation)
$IsoVol[0] = array('2.4','2.2','2');

//calcule temperature moyenne desirée pour 17h nuit et 7h jour
$TmpDesMoy = round(((5 * $TmpDesJ) + (19 * $TmpDesN))/24,0);
 
 // Calcule Pussance necessaire
 $P = (($Tvolume * ($TmpDesMoy - $TmpMini[$departement][$altitude]) * $IsoVol[$iso][$volume])* 75)/100;
 $PkWh = round(($P * 24)/1000,2);
 $kg = round(($PkWh/$pcalo),2);
 $sac = round($kg/15,1);

?>
<html>
<head><title>>Consommation annuelle de Granulés</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="js/send_data.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container">
<?php include('navbar.php'); ?>
    <div class="row">
    <div class="col-sm-12">
        <p id="TitreCadre"><span class="glyphicon glyphicon-scale"></span> Résultats</p>
        <div class="table-responsive">
        <!-- Calcule de puissance -->
   
<h3>Estimation de besoins selon la température désirée par département</h3>

<h5>Département <mark><?php echo $departement; ?></mark></h5>
    
<h5>Pouvoir calorifique granulé <mark><?php echo $pcalo; ?> kWh/kg</mark></h5>
    
<h5>Température jour <mark><?php echo $TmpDesJ; ?> &deg;C</mark></h5>
    
<h5>Température nuit <mark><?php echo $TmpDesN; ?> &deg;C</mark></h5>
    
<h5>Température moyenne <mark><?php echo $TmpDesMoy; ?> &deg;C</mark></h5>
    
<h5>Puissance nécessaire <mark><?php echo $P; ?> W</mark></h5>
    
<h5>Puissance nécessaire pour 24h <mark><?php echo $PkWh; ?> kWh</mark></h5>
    
<h5>Quantité nécessaire pour 24h <mark><?php echo $kg; ?> kg</mark></h5>
    
<h5>Nbr de sacs pour 24h <mark><?php echo $sac; ?> sac(s) de 15 kg</mark></h5><br> 
            
        </div>
                
    </div>
</div>


    
<div>
<?php include('footer.php'); ?>
</div>    
</div>    
</body>
</html>
