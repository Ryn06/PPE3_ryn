<?php require_once 'includes/fonction.php'; onlyco(); 


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>R.y.n Company</title>
	<link rel="icon" type="image/png" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/headfoot.css"/>
	<link rel="stylesheet" type="text/css" href="css/projet.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</head>
<?php include('includes/header.php'); ?>
	<div class="container-fluid back" style="width: 100%;min-height:100vh">
		<div class="contenu">
		<?php 
			if (isset($_GET['idprojet'])){ 
				$req=$bdd->prepare('SELECT * FROM Projet WHERE idprojet=?');
				$req->execute(array($_GET['idprojet']));
				$projet=$req->fetch();
				$req->closeCursor();
				if (empty($projet['idso'])){
					header('location: listeprojet.php');
					exit();
				}else {
					if ($_SESSION['user']['type']=='adm'){ ?>
						<form action="includes/modifprojet.php" method="POST">
                        
                        <h3> Modification du projet (Mode admin) </h3>
                        <div class=princi style="text-align:center;margin-top:70px;">
                            Titre : <input class="form-control" name="titre" value="<?php echo $projet['Titre'] ?>"> <br>
                            Descriptif : <textarea class="form-control" style="width:100%; height:100px;" name="desc" ><?php echo $projet['descriptif'] ?></textarea> <br>
                            Language : <input class="form-control" name="language" value="<?php echo $projet['language'] ?>"> <br>
                            Prix : <input class="form-control" name="prix" value="<?php echo $projet['prix'] ?>"> <br>


                            <button class="btn btn-success" type="submit" >Valider les modifications</button>
                            <input type="hidden" name="choix" value="1">

                            <input type="hidden" name="idprojet" value="<?php echo $_GET['idprojet']?>">


                            
                        </div>
                        </form>
						
					

						
					<?php }elseif ($_SESSION['user']['idso']==$projet['idso']){?>
							<form action="includes/modifprojet.php" method="POST">
                        
                        <h3> Modification du projet (Mode auteur) </h3>
                        <div class=princi style="text-align:center;margin-top:70px;">
                            Titre : <input  style="box-shadow:none;margin-left:auto;margin-right:auto;text-align:center;" class="form-control" name="titre" value="<?php echo $projet['Titre'] ?>"> <br>
                            Descriptif : <textarea class="form-control" style="width:100%; height:100px;" name="desc" ><?php echo $projet['descriptif'] ?></textarea> <br>
                            Language : <input class="form-control" name="language" value="<?php echo $projet['language'] ?>"> <br>
                            <input type="hidden" name="choix" value="0">

                            <input type="hidden" name="idprojet" value="<?php echo $_GET['idprojet']?>">

                            <button class="btn btn-success" type="submit" >Valider les modifications</button>
                              
                            
                        </div>
                        </form>
					
					<?php }else{
						echo "<div>Ceci n'est pas votre projet.</div>";
					}


				}

			}else{ 
				
				header('location: listeprojet.php');
				exit();
			}
				?>

						
					
					

				
			






		<br/>
		<br/>
	</div>
	</div>

	<?php include('includes/footer.php'); ?>
