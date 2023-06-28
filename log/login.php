<?php
    session_start();
    include('../bdd/config.php');
    if(isset($_POST['admin_login']))
    {
      $a_username=$_POST['a_username'];
      $a_pwd=($_POST['a_pwd']);//
      $stmt=$mysqli->prepare("SELECT a_username, a_pwd, a_id FROM admin WHERE a_username=? and a_pwd=? ");//sql to log in user
      $stmt->bind_param('ss',$a_username,$a_pwd);//bind fetched parameters
      $stmt->execute();//execute bind
      $stmt -> bind_result($a_username,$a_pwd,$a_id);//bind result
      $rs=$stmt->fetch();
      $_SESSION['a_id']=$a_id;//assaign session to admin id
      //$uip=$_SERVER['REMOTE_ADDR'];
      //$ldate=date('d/m/Y h:i:s', time());
      if($rs)
      {//if its sucessfull
        header("location:../inventaire/inventoring.php");
      }

      else
      {
      #echo "<script>alert('Access Denied Please Check Your Credentials');</script>";
      $error = " Votre nom d'utilisateur ou votre mot de passe est incorrect";
      }
  }
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="log.css" />
  
</head>

<body>

<div class="login-box">
  <h2>Page de connexion
  </h2>
  <form class="login" method = "POST" >
  <div class="user-box">
    <input type="text" name = "a_username" placeholder="Saisir votre nom d'utilisteur">
      <label>Nom d'utilisateur</label>
    </div>
    <div class="user-box">
    <input type="password" name = "a_pwd"  placeholder="Saisir votre mot de passe ">
      <label>Mot de passe</label>
    </div>
    <button  type = "submit"  name="admin_login">Se connecter </button> <br>
   
     <br><a href = "../animation.html"> Retour à l'acceuil</a>
    
  </form>
</div>

<!--Trigger Sweet Alert-->
<?php if(isset($error)) {?>
  <!--This code for injecting an alert-->
      <script>
            setTimeout(function () 
            { 
              swal("Accès refusé !","<?php echo $error;?>!","error");
            },
              100);
      </script>
					
  <?php } ?>

 
  

</body>

</html>