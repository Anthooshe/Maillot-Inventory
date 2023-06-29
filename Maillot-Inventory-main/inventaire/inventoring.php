<?php
  session_start();
  include('../bdd/config.php');
  

  if(isset($_GET['del']))
{
      $id=intval($_GET['del']);
      $adn="delete from objets where idObjet=?";
      $stmt= $mysqli->prepare($adn);
      $stmt->bind_param('i',$id);
      $stmt->execute();
      $stmt->close();	 

        if($stmt)
        {
          $succ = "Produit Retiré";
        }
          else
          {
            $err = "Essayez plus tard";
          }
  }
  
?>
<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 

  <title>Inventaire Secteur</title>
  
  <link rel="stylesheet" href="inventaire.css" />

</head>

<body >

    <nav class="navMenu">
      
      <a href="../deconnexion.php">Déconnexion</a> 
	  <a href="ajoutProduit.php"> Ajout </a>
	  
 

      </nav>

 
      
    <div class="container">
     
        <table>
          <thead>
          <tr>
                    
		  			<th>#</th>
                    <th>Désignations</th>
                    <th>Quantité </th>                   
                    <th> Nombre de produits sorties </th>
                    <th>  </th>
                   
                    
                  </tr>
          </thead>
          
          <tbody>
          <?php

            $ret="SELECT * FROM objets "; 
            $stmt= $mysqli->prepare($ret) ;
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            $cnt=1;
            while($row=$res->fetch_object())
          {
          ?>
            <tr>
            <td><?php echo $cnt;?></td>
                    <td><?php echo $row->designation;?></td>
                    <td><?php echo $row->quantite;?></td>
                    <td><?php echo $row->NbProdS;?></td>
					<td>
                      <a href="modifProduit.php?idObjet=<?php echo $row->idObjet;?>" class="badge badge-success">Modifier</a> &nbsp; &nbsp;
                      <a href="inventoring.php?del=<?php echo $row->idObjet;?>" class="badge badge-danger">Supprimer</a>
                    </td>


             
            </tr>
            <?php  $cnt = $cnt +1; }?>
            
          </tbody>
        </table>
      </div>
    </div>

  </div>
  </div>

</div>

</body>

</html>
