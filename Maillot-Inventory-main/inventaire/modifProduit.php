<?php
  session_start();
  include('../bdd/config.php');

  //Add USer
  if(isset($_POST['ajoutP']))
    {
            $aid=$_GET["idObjet"];
            $designation=$_POST['designation'];
            $quantite = $_POST['quantite'];
            $NbProdS=$_POST['NbProdS'];
            $query="update objets set designation=? , quantite=? , NbProdS=? where idObjet=?";
            $stmt = $mysqli->prepare($query); 
            $rc=$stmt->bind_param('siii',  $designation, $quantite, $NbProdS, $aid);
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
        Modifiez votre produit
      </div>
      <?php
            $aid=$_GET["idObjet"];
            $ret="select * from objets where idObjet=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$aid);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
        {
        ?>
      <form method = "POST">
         <div class="form-row">
            <div class="input-data">
               <input type="text" required name= "designation" value ="<?php echo $row->designation;?>">
               <div class="underline"></div>
               <label for="">Désignation</label>
            </div>
            <div class="input-data">
               <input type="text" required name= "quantite" value ="<?php echo $row->quantite;?>">
               <div class="underline"></div>
               <label for="">Quantités </label>
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
               <input type="text" required name="NbProdS" value ="<?php echo $row->NbProdS;?>">
               <div class="underline"></div>
               <label for="">Nombre de produits sorties</label>
           
        
            <br />
            <div class="form-row submit-btn">
               <div class="input-data">
                  <div class="inner"></div>
                  <button type="submit" name="ajoutP" class="btn btn-success">Modifier le produit</button>
               </div>
            </div>
            
      </form>
      <?php }?>
      <div class="input-data">
                  <div class="inner"></div>
                 <a href = "inventoring.php">Retour à l'inventaire</a>
               </div>
            </div>
      </div>



</body>

</html>