<!DOCTYPE html>
<html>
  <head>
    <title>Confirmation</title>
    <link rel="stylesheet" href="bootstrap.min.css">

    <style>
      
    .card {
       max-width: 510px;
       padding: 30px;
       margin: auto;
      }
      .Other {
        background-color: #CDCDCD;
      }
       
    </style>

  <body style="background-color: lightblue">

    <div class="container pt-2">
    <div class="card Other">

<?php    

  $supprimer_voiture = $_GET['supprimer_imm'];

  include("connexion_base.php");
      
    $requete = $pdo->query("DELETE FROM automobile WHERE immatriculation ='$supprimer_voiture'"); 
    
    if($requete) {
      echo '<div style="text-align:center; color:blue">La suppression à bien été effectué</div>';
    }
?>

      <a href="accueil.php" style=" width: 25%; margin-top: 15px" class="btn btn-warning">Précèdent</a> 

  </div>
  </div>

  </body>
</html>
