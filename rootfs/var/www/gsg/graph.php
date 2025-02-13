<!doctype html>
<?php include_once('json.php'); ?>
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
    <div class="col-sm-12">
        <p id="TitreCadre"><span class="glyphicon glyphicon-fire"></span> Consommation annuelle de Granulés</p>
  <!-- Chargement des variables, et paramètres de Highcharts -->
                <script type="text/javascript">
	$(function () {
    $('#piegraph2').highcharts({
    chart: {
        zoomType: 'xy',
        backgroundColor: '#3B3B3B'
    },

    xAxis: [{
        categories: [<?php echo $Tannee; ?>], 
        crosshair: true,
        labels: {
        style: {
                color: '#FFffFF',
            }}
        
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value} €',
            style: {
                color: '#FFffFF',
            }
        },
        title: {
            text: 'Cout consommés',
            style: {
                color: '#FFffFF',
            }
        }
    }, { // Secondary yAxis
        title: {
            text: 'Nombre de sacs consommés',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value} Sacs',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 10,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    series: [{
        name: 'Nombre de sacs consommés',
        type: 'column',
        yAxis: 1,
        data: [<?php echo $Ttotalconso; ?>],
        
        tooltip: {
            valueSuffix: ' Sac(s)'
        }

    }, {
        name: 'Cout consommés',
        type: 'spline',
        color: '#0511FC',
        data: [<?php echo $Ttotalcout; ?>],
        tooltip: {
            valueSuffix: '€',
            
        }
    }]
});
});
                </script>
        <div id="piegraph2"> </div>
    </div>
</div>
            <br><br><br><br><br>
        
    
        
            <div>
            <?php include('footer.php'); ?>
            </div>    

        
     </div>    
    </body>
</html>