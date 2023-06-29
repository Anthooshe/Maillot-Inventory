<?php
  session_start();
  include('../bdd/config.php');

  //Add USer
  if(isset($_POST['ajoutP']))
    {

            $designation=$_POST['designation'];
            $quantite = $_POST['quantite'];
            $NbProdS=$_POST['NbProdS'];
            $query="insert into objets (designation, quantite, NbProdS ) values(?,?,?)";
            $stmt = $mysqli->prepare($query); 
            $rc=$stmt->bind_param('sii',  $designation, $quantite, $NbProdS);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "Ajout du produit réussi !";
                }
                else 
                {
                    $err = "Désolé essayez plus tard";
                }
            }
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Ajout d'un produit</title>
  <link rel="stylesheet" href="ajout.css" />
  
</head>

<body>

<div class="container-fluid">
      <?php if(isset($succ)) {?>
                       <!--code d'injection cas d'alerte -->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Ajout du véhicule !","<?php echo $succ;?>!","success");
                    },
                        100);
        </script>

        <?php } ?>
        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Échec !","<?php echo $err;?>!","error");
                    },
                        100);
        </script>

        <?php } ?>

<div class="container">
      <div class="text">
        Ajoutez votre produit
      </div>
      <form method = "POST">
         <div class="form-row">
            <div class="input-data">
               <input type="text" required name= "designation">
               <div class="underline"></div>
               <label for="">Désignation</label>
            </div>
            <div class="input-data">
               <input type="text" required name= "quantite">
               <div class="underline"></div>
               <label for="">Quantités </label>
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
               <input type="text" required name="NbProdS">
               <div class="underline"></div>
               <label for="">Nombre de produits sorties</label>
           
        
            <br />
            <div class="form-row submit-btn">
               <div class="input-data">
                  <div class="inner"></div>
                  <button type="submit" name="ajoutP" class="btn btn-success">Ajouter le produit</button>
               </div>
            </div>
            
      </form>
      <div class="input-data">
                  <div class="inner"></div>
                 <a href = "inventoring.php">Retour à l'inventaire</a>
               </div>
            </div>
      </div>



</body>

</html>