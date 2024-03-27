<?php
     
  $erreur = [];
  $data = [];
      
    if(empty(trim($_POST['immatriculation']))) {
      $erreur['immatriculation'] = "L'immatriculation est obligatoire !";
    }
    if(empty(trim($_POST['marque']))) {
      $erreur['marque'] = 'La marque est obligatoire !';
    } 
    if($_POST['carburant'] == 'choisir_carburant') {
      $erreur['carburant'] = 'Le type de carburant est obligatoire !';
    } 
    if(empty(trim($_POST['kilometrage']))) {
      $erreur['kilometrage'] = 'Le kilométrage est obligatoire !';
    }
    if($_POST['vitesse'] == 'choisir_vitesse') {
      $erreur['vitesse'] = 'Le type de boîte de vitesse est obligatoire !';
    }  
    if(empty($_POST['places'])) {
      $erreur['places'] = 'Le nombre de places est obligatoire !';
    } 
    if(empty(trim($_POST['prix']))) {
      $erreur['prix'] = 'Le prix de la location est obligatoire !';
    } 
    if(empty($_FILES['photo']['tmp_name'])) {
      $erreur['photo'] = 'La photo est obligatoire !'; 
    }

    if(empty($erreur)) {

      $chemin = "Images/".$_FILES['photo']['name'];

      move_uploaded_file(  $_FILES['photo']['tmp_name'],$chemin);

       include("connexion_base.php");

        $req = $pdo->prepare("SELECT * FROM automobile WHERE immatriculation = ?");
        $req->execute(array($_POST['immatriculation']));
        $tab = $req->fetchAll();
        
        if($tab) {
          $erreur['err_imm'] = "L'immatriculation existe déjà";
        } else {
        $requete = $pdo->prepare("INSERT INTO automobile(immatriculation,photo,marque,carburant,kilometrage,vitesse,places,prix) VALUES (?,?,?,?,?,?,?,?)");
        $requete->execute(array($_POST['immatriculation'],$chemin,$_POST['marque'],$_POST['carburant'],$_POST['kilometrage'],$_POST['vitesse'],$_POST['places'],$_POST['prix']));
        }
    }
   
    if(!empty($erreur)) {
      $data['success'] = false;
      $data['erreur'] = $erreur;
    } else {
      $data['success'] = true;
      $data['message'] = 'Les informations ont bien été insérés.';
    }
      echo json_encode($data);

?>
