<!DOCTYPE html>
<html>
  <head>
    <title>Accueil</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    
    <style>
    
      .Image {
        width: 100%;
        height: 300px;  
        position: relative;
      }
      .texte {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        text-align: center;
        font-size: 50px;
        color: lightgreen;
      }
      .table {
        margin-top: 25px;
      }
      .image1 {
        width: 500px;
        height: 250px;
      }
      .image2, .image3, .image4 {
        width: 70px;
      }
      .Table {
        overflow-x: auto;
      }
      
    </style>
    
  </head>
    
  <body>
  
  <?php require_once "connexion_base.php";
           
      if(isset($_POST["validation"])) {

        $rechercher = $_POST["rechercher"];
                
        $req = $pdo->query("SELECT * FROM automobile WHERE marque LIKE '%$rechercher%'");

      if(empty($rechercher)) $erreur = '<div style="color:red; font-size:20px">Veuillez entrer la marque !</div>';
     }
      else {
        $req = $pdo->query("SELECT * FROM automobile");
     } 
   ?>
       <div class="pt-2">
        <img src="images_location/voiture-exemple2.png" class="Image">
        <p class="texte"><strong>Location de voiture</strong></p>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="container pt-3">
            <input type="text" name="rechercher" placeholder="Recherchez par marque" style="width: 300px">
            <button name="validation" class="btn btn-primary">Recherchez</button>
            <?php 
              global $erreur;
              echo $erreur; 
            ?>
          </div>

          <div class="container pt-3">
            <a href="ajouter_location.html" class="navbar-brand"><img src="images_location/bouton_ajouter.jpeg" class="image2"><strong>Ajouter</strong></a>
          </div>
       
          <div class="container-fluid Table">
           <table width="100%" border="2" class="table table-striped table-bordered border-primary">
          </div>
       
        <tr class="table-secondary">
          <th>Photo</th>
          <th>Immatriculation</th>
          <th>Marque</th>
          <th>Type de carburant</th>
          <th>Kilométrage</th>
          <th>Boîte de vitesse</th>
          <th>Nombre de places</th>
          <th>Prix de la location</th>
          <th>Supprimer</th>
          <th>Modifier</th>
        </tr>
        
        <?php
          
          if(empty($row))  {
            $Err = '<div style="text-align:center">Aucune résultat</div>';
         } 

          while($row = $req->fetch()) {
             unset($Err);
        ?>
          <tr class="table-primary">
            <td><img src="<?php echo $row['photo']; ?>" class="image1"></td>
            <td><?php echo $row['immatriculation']; ?></td>
            <td><?php echo $row['marque']; ?></td>
            <td><?php echo $row['carburant']; ?></td>
            <td><?php echo $row['kilometrage']; ?></td>
            <td><?php echo $row['vitesse']; ?></td>
            <td><?php echo $row['places']; ?></td>
            <td><?php echo $row['prix']; ?></td>
            <td><a href="supprimer_location.php?supprimer_imm=<?php echo $row['immatriculation']; ?>"><img src="images_location/supprimer-bouton.jpg" class="image3"></a></td>
            <td><a href="modifier_location.php?modifier_imm=<?php echo $row['immatriculation']; ?> &modifier_marque=<?php echo $row['marque']; ?> &modifier_carburant=<?php echo $row['carburant']; ?> &modifier_kilometrage=<?php echo $row['kilometrage']; ?> &modifier_vitesse=<?php echo $row['vitesse']; ?> &modifier_places=<?php echo $row['places']; ?> &modifier_prix=<?php echo $row['prix']; ?> &modifier_photo=<?php echo $row['photo']; ?>"><img src="images_location/bouton_modifier.jpg" class="image4"></a></td>
          </tr>
          
        <?php
         } 
         ?>
        </table>
          <?php
            global $Err;
            echo $Err;
          ?>
    </form>
   </div>
  </body>
  
</html>
