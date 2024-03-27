<?php

  $Modifier = $_GET['modifier_imm'];
  $Marque = $_GET['modifier_marque'];
  $Carburant = $_GET['modifier_carburant'];
  $Kilometrage = $_GET['modifier_kilometrage'];
  $Vitesse = $_GET['modifier_vitesse'];
  $Places = intval($_GET['modifier_places']);
  $Prix = $_GET['modifier_prix'];

    if(isset($_POST['modification'])) {
    
      $marque = trim($_POST['marque']);
      $carburant = trim($_POST['type_carburant']);
      $kilometrage = trim($_POST['kilometrage']);
      $vitesse = trim($_POST['boîte_vitesse']);
      $places = $_POST['nombre_places'];
      $prix = $_POST['prix'];
  
      $photo = $_FILES['photo']['tmp_name'];
      $chemin = "Images/".$_FILES['photo']['name'];
      move_uploaded_file($photo,$chemin);

      include("connexion_base.php");
       
      $req = $pdo->prepare("update automobile set photo=:photo, marque=:marque, carburant=:carburant, kilometrage=:kilometrage, vitesse=:vitesse, places=:places, prix=:prix where immatriculation=:immatriculation");
      $validation = $req->execute(array(":photo"=>$chemin,":marque"=>$marque,":carburant"=>$carburant,":kilometrage"=>$kilometrage,":vitesse"=>$vitesse,":places"=>$places,":prix"=>$prix,":immatriculation"=>$Modifier));
      
      if($validation) {
         $success = '<div class="alert alert-success">Les informations ont bien été mis à jour</div>';   
      }
     }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    
      <title>Modifier</title>
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
      .Imm, .Marque, .Carburant, .Kilometrage, .Vitesse, .Places, .Prix {
        margin-top: 30px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
      } 
      .fichier {
        margin-top: 15px;
      }
      .Fichier {
        color: blue;
      }
      
     </style>
     
  </head>
  
  <body style="background-color: lightblue">
  
  <div class="container pt-2">
   <div class="card Othercard">
   
     <form method="post" action="" id="form_javascript" enctype="multipart/form-data">
       <h3 style="color: blue">Mettre à jour une nouvelle voiture</h3>
       
       <?php if(!isset($_POST['modification'])) { ?>

       <div class="Imm">
         <label>Immatriculation :</label>
         <input type="text" name="immatriculation" value="<?php echo $Modifier; ?>" readonly>
       </div>
       
       <div class="Marque">
         <label>Marque :</label>
         <input type="text" id="marque" name="marque" value="<?php echo $Marque; ?>" placeholder="Entrez la marque :" >
       </div>
       <span id="marque_erreur" style="text-align: center"></span>
       
       <div class="Carburant">
         <label>Type de carburant :</label>
         <select id="type_carburant" name="type_carburant" >
           <option hidden><?php echo $Carburant; ?></option>
           <option>Diesel</option>
           <option>Essence</option>
         </select>
       </div>
       <span id="carburant_erreur" style="text-align: center"></span>
      
       <div class="Kilometrage">
         <label>Kilométrage :</label>
         <input type="text" id="kilometrage" name="kilometrage" value="<?php echo $Kilometrage; ?>" placeholder="Entrez le kilométrage" >
       </div>
       <span id="kilometrage_erreur" style="text-align: center"></span>
       
       <div class="Vitesse">
         <label>Boîte de vitesse :</label>
         <select id="boîte_vitesse" name="boîte_vitesse" >
           <option hidden><?php echo $Vitesse; ?></option>
           <option>Manuelle</option>
           <option>Automatique</option>
         </select>
       </div>
       <span id="vitesse_erreur" style="text-align: center"></span>
       
       <div class="Places">
         <label>Nombre de places :</label>
         <input type="number" id="nombre_places" name="nombre_places" value="<?php echo $Places; ?>" placeholder="Entrez le nombre de places" >
       </div>
       <span id="places_erreur" style="text-align: center"></span>
                
       <div class="Prix">
         <label>Prix :</label>
         <input type="text" id="prix" name="prix" value="<?php echo $Prix; ?>" placeholder="Entrez le prix de la location" >
       </div>
       <span id="prix_erreur" style="text-align: center"></span>
          
       <div class="fichier">
         <span id="label_photo">Choisir une photo</span>
         <input type="file" id="photo" name="photo" class="Fichier">
       </div>
       <span id="photo_erreur" style="text-align: center"></span>
       <button name="modification" class="form-control" style="background-color:lightgreen; margin-top:10px"><strong>Modifier</strong></button><br />
       
       <?php }  ?>
         <div style="text-align:center">
           <?php 
             global $success;
             echo $success; 
           ?>
         </div>
         <a href="accueil.php" class="btn btn-warning">Précèdent</a>
     </form> 
     
     <script>
     
      let marque = document.getElementById('marque');
      let carburant = document.getElementById('type_carburant');
      let kilometrage = document.getElementById('kilometrage');
      let vitesse = document.getElementById('boîte_vitesse');
      let places = document.getElementById('nombre_places');
      let prix = document.getElementById('prix');
      let photo = document.getElementById('photo');
      
      document.getElementById("form_javascript").addEventListener('submit', function(e) {
      
      if(marque.value.trim() == '') {
    
        document.getElementById('marque_erreur').innerHTML = '<div class="alert alert-danger">La marque est obligatoire !</div>';
        e.preventDefault();
      } else {
          document.getElementById('marque_erreur').innerHTML = "";
      }
       
      if(kilometrage.value.trim() == '') {
    
        document.getElementById('kilometrage_erreur').innerHTML = '<div class="alert alert-danger">Le kilométrage est obligatoire !</div>';
        e.preventDefault();
      } else {
          document.getElementById('kilometrage_erreur').innerHTML = "";
      }
       
      if(places.value.trim() == '') {
    
        document.getElementById('places_erreur').innerHTML = '<div class="alert alert-danger">Le nombre de places est obligatoire !</div>';
        e.preventDefault();
      } else {
          document.getElementById('places_erreur').innerHTML = "";
      }
      
      if(prix.value.trim() == '') {
    
        document.getElementById('prix_erreur').innerHTML = '<div class="alert alert-danger">Le prix est obligatoire !</div>';
        e.preventDefault();
      } else {
          document.getElementById('prix_erreur').innerHTML = "";
      }
      
      if(photo.value == '') {
    
        document.getElementById('photo_erreur').innerHTML = '<div class="alert alert-danger">La photo est obligatoire !</div>';
        e.preventDefault();
      } else {
          document.getElementById('photo_erreur').innerHTML = "";
      }
     
    });
    
    </script>
   </div>
  </div>
   
  </body>
  
</html>
