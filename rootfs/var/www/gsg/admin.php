<!doctype html>
<?php include_once('adminphp.php'); ?>
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
        
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
          
          <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css"rel="stylesheet">
        
        
        <script>
          $( function() {
              $( "#datepicker" ).datepicker({language: 'fr'});
              $( "#datepicker1" ).datepicker();
              $( "#datepicker2" ).datepicker();
          } );
        </script>
        
          <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
        <div class="container">
            <?php include('navbar.php'); ?>


<div class="row">
    
                    
<div class="col-sm-6 cadreG">
    <p id="TitreCadre"><span class="glyphicon glyphicon-cog"></span> Paramétrages</p>
    <div class="table-responsive">
        <form method="post" name="myForm" action="">
            <div class="form-group">
            <table class="table">
                <thead>
                    <tr>
                    <th></th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Reliquat: </td>
                    <td><input type="text" class="form-control" name="reliquat" value="<?php echo $reliquat; ?>"></td>
                    </tr>
                    <tr>
                    <td>Stock: </td>
                    <td><input type="text" class="form-control" name="stock" value="<?php echo $stockini; ?>"></td>
                    </tr>
                    <tr>
                    <td>Total: </td>
                    <td><input type="text" class="form-control" name="total" value="<?php echo $reliquat + $stockini; ?>" disabled></td>
                    </tr>
                    <tr>
                    <td>Prix Sac: </td>
                    <td><input type="text" class="form-control" name="prixsac" value="<?php echo $prixsac; ?>"></td>
                    </tr>
                    <tr>
                    <td><button type="submit" class="btn btn-warning" onClick="javascript:document.myForm.action='verif.php'; document.getElementById('myField').value = 1;">M.A.J.</button></td>
                    <td><button type="submit" class="btn btn-success" onClick="javascript:document.myForm.action='verif.php'; document.getElementById('myField').value = 11;">Nouveau</button></td>
                    </tr>
                </tbody>
                <input type='hidden' id="myField" name='msg' value="" />
            </table>
            </div>
        </form>
        
    </div>
    
    <div class="table-responsive">
            <div class="form-group">
            <table class="table">
                <form method="post" action="verif.php">
                <thead>
                    <tr>
                    <th></th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Entretien régulier (1) </td>
                    <td>
                        <div class="input-group">
                        <input type="text" class="form-control" id="datepicker" name="date1" value="<?php echo $regulier; ?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </td>
                    <tr>
                    <td>Entretien mensuel (2)</td>
                    <td>
                        <div class="input-group">
                        <input type="text" class="form-control" id="datepicker1" name="date2" value="<?php echo $mensuel; ?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </td>
                    </tr>
                    <tr>
                    <td>Entretien annuel (3)</td>
                    <td>
                        <div class="input-group">
                        <input type="text" class="form-control" id="datepicker2" name="date3" value="<?php echo $annuel; ?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </td>
                    </tr>
                    <tr>
                    <td><button type="submit" class="btn btn-success">Enregistrer</button></td>
                    <td></td>
                    </tr>
                </tbody>
                    <input type='hidden' name='msg' value="2" />
                    </form>
            </table>
            </div>
    </div>
</div>
<div class="col-sm-6 cadreD">
    <p id="TitreCadre"><span class="glyphicon glyphicon-list-alt"></span> Gestion</p>
     <div class="table-responsive">
         <form method="post" action="verif.php">
            <table class="table">
                
                <thead>
                    <tr>
                    <th></th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Dernière consomation:</td>
                    <td><?php echo $last_date; ?></td>
                    </tr>
                    <tr>
                    <td>Envoyer infos entretiens</td>
                    <td>
                        <label class="radio-inline">
                        <input type="radio" name="info" value=1 <?php if ($info==1){echo "checked";}?>>Oui
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="info" value=0 <?php if ($info==0){echo "checked";} ?>>Non
                        </label>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><button type="submit" class="btn btn-success">Enregistrer</button></td>
                    <td></td>
                    </tr>
                    <input type='hidden' name='msg' value="3" />
                    
                </tbody>
                
            </table>
        </form>
    </div>
</div>
</div>
 

<div class="row">
    <div class="col-sm-12">
        <p id="TitreCadre"><span class="glyphicon glyphicon-envelope"></span> Messages</p>
        <div class="table-responsive">
            <form method="post" action="verif.php">
            <table class="table">
                
                <thead>
                    <tr>
                    <th></th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Code PushingBox</td>
                    <td><input type="text" class="form-control" name="PushingBox" value="<?php echo $PushingBox; ?>"/></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                    <td>Objet (1)</td>
                    <td><input type="text" class="form-control" name="PushingBoxTitre1" value="<?php echo $PushingBoxTitre1; ?>"/></td>
                    </tr>
                    <tr>
                    <td>Message (1)</td>
                    <td><input type="text" class="form-control" name="PushingBoxMsg1" value="<?php echo $PushingBoxMsg1; ?>"/></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                    <td>Objet (2)</td>
                    <td><input type="text" class="form-control" name="PushingBoxTitre2" value="<?php echo $PushingBoxTitre2; ?>"/></td>
                    </tr>
                    <tr>
                    <tr>
                    <td>Message (2)</td>
                    <td><input type="text" class="form-control" name="PushingBoxMsg2" value="<?php echo $PushingBoxMsg2; ?>"></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                    <td>Objet (3)</td>
                    <td><input type="text" class="form-control" name="PushingBoxTitre3" value="<?php echo $PushingBoxTitre3; ?>"/></td>
                    </tr>
                    <tr>
                    <tr>
                    <td>Message (3)</td>
                    <td><input type="text" class="form-control" name="PushingBoxMsg3" value="<?php echo $PushingBoxMsg3; ?>"/></td>
                    </tr>
                    <tr>
                    <td><button type="submit" class="btn btn-success">Enregistrer</button></td>
                    <td></td>
                    </tr>
                </tbody>
                    <input type='hidden' name='msg' value="4" />
                
            </table>
        </form>
    </div>
    </div>
</div>
            <br><br><br><br><br>
        
    
        
            <div>
            <?php include('footer.php'); ?>
            </div>    

        
     </div>    
    </body>
</html>