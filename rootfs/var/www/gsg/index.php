<!doctype html>
<?php include_once('json.php'); ini_set('display_errors',1);?>
<html>
    <head>
        <title>Gestion de Granulés</title>
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
    
            <div class="alert alert-warning" id="messageinfo" role="alert" style="display:none;">
            Consomation d'un sac ajoutée. Fermer ce message pour actualiser. -->
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
        
<div class="col-sm-6 cadreG">
    <p id="TitreCadre"><span class="glyphicon glyphicon-tasks"></span> Consomation Mensuelle</p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th>Mois / Année</th>
                    <th>Consomation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < 12; $i++) { ?>
                    <tr>
                    <td><?php echo $tab_mois[$i]; ?></td>
                    <td><?php echo $conso_moisF[$i]; ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                    <th><em><strong>Total</strong></em></th>
                    <th><em><strong><?php echo $TotalSacConsomes; ?></strong></em></th>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
<div class="col-sm-6 cadreD">
    <p id="TitreCadre"><span class="glyphicon glyphicon-stats"></span> Statistiques</p>
    <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th></th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Période</td>
                    <td>
                        <select id=idannee class=form-control>
                            <?php
                            $flag_an = 0;
                            $fin = count($periode);
                            foreach ($periode as $value) 
                                {
                                    if ($value != $annee) 
                                    echo '<option value="'.$value.' " >'.($value-1).'/'.$value.'</option>' ;
                                    else
                                    {
                                    echo '<option value="'.$value.' " selected>'.($value-1).'/'.$value.'</option>' ;
                                    $flag_an = 1;    
                                    }
                                }
                            if ($flag_an == 0) {
                            //echo '<option value="'.$annee.'" selected>'.($annee-1).'/'.$annee'</option>';
                            echo '<option value="'.$value.' " selected>'.($value-1).'/'.$value.'</option>' ;
                            }
                            ?>
                        </select>
                        <script>
                                $('select').on('change', function() {
                                //alert( this.value );
                                window.location.href = "index.php?an="+this.value;
                            })
                        </script>
                    </td>
                    </tr>
                    <tr>
                    <th>Stock total</th>
                    <th><?php echo ($stockini + $reliquat); ?> sacs</th>
                    </tr>
                    <tr>
                    <th>Coût de Stock</th>
                    <th><?php echo round(($reliquat*$prixsacAV)+($stockini*$prixsac), 2); ?> €</th>
                    </tr>
                    <tr>
                    <th>Consommés</th>
                    <th><?php echo $TotalSacConsomes; ?> sacs</th>
                    </tr>
                    <tr>
                    <th>Coût consommé</th>
                    <th><?php echo $CoutConsome; ?> €</th>
                    </tr>
                    <tr>
                    <th>Sacs restants</th>
                    <th><?php echo (($stockini+$reliquat)-$TotalSacConsomes); ?> sacs</th>
                    </tr>
                    <tr>
                    <th>Moyenne sur 12 mois</th>
                    <th><?php echo round($TotalSacConsomes/12, 2); ?> sacs</th>
                    </tr>
                    <tr>
                    <th>Moyenne sur période</th>
                    <th><?php 
                        if ($compteur != 0){echo round($TotalSacConsomes/$compteur, 2);} else {echo '-';} ?> sacs</th>
                    </tr>
                    <tr>
                    <th>Coût sur période</th>
                    <th><?php if ($compteur != 0){echo round($CoutConsome/$compteur, 2);} else {echo '-';} ?> €</th>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
</div>
 

<div class="row">
    <div class="col-sm-12">
        <p id="TitreCadre"><span class="glyphicon glyphicon-signal"></span> Graphique</p>
        <script>
        
$(function () {
    $('#piegraph').highcharts({

         chart: {
        type: 'pie',
             backgroundColor: '#3B3B3B',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: <?php echo "'Consomation $annee2 / $annee ( % )'";?>,
        style: {
                color: '#FFffFF',
                fontWeight: 'bold'
                    }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}',
                              style: {
                    color: '#FFf'
                }
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Consomation',
        data: [
            <?php
                        $data = array();
                        for ($i = 0; $i < 12; $i++)
                        {
                            if ($conso_moisF[$i] != 0)
                                $data[] = "['".$tab_mois[$i]."',".$conso_moisF[$i]."]";
                        }
                        echo implode(', ', $data);
                    ?>
            
        ]
    }]
});
});
        </script>  
        <div id="piegraph"> </div>
    </div>
</div>
            <br><br><br><br><br>
        
    
        
            <div>
            <?php include('footer.php'); ?>
            </div>    

        
     </div>    
    </body>
</html>