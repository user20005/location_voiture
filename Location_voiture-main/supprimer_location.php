<!DOCTYPE html>
<html>
  <head>
    <title>Supprimer</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    
    <style>
      
     .card {
       max-width: 510px;
       padding: 30px;
       margin: auto;
      }
      .Othercard {
        background-color: #CDCDCD;
      }
       
    </style>
  </head>
  
  <body style="background-color: lightblue">
  
    <div class="container pt-2">
    <div class="card Othercard">

    <form id="cacher" method="post" action="">   
    <div id="Cacher">
    <h5>Confirmation de suppression :</h5>
    <p>Voulez-vous vraiment supprimer :</p>
    <button name="Suppr" class="btn btn-danger">Ok</button>
    <button name="annuler" class="btn btn-warning">Annuler</button>
    </div>
    </form>

    <?php

      $Supprimer = $_GET['supprimer_imm'];

      switch(isset($_POST)) {

      case isset($_POST['Suppr']): 
         echo '<script>
           location.replace("confirmation_suppression.php?supprimer_imm='.$Supprimer.'") 
         </script>';
      
      case isset($_POST['annuler']): ?> 
        <script>
          location.replace("accueil.php"); 
       </script>
    <?php
    } 
    ?>
     
    </div>
    </div>
   
  </body>
</html>
