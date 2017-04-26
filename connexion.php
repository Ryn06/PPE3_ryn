<?php require_once 'includes/fonction.php'; 
onlynoco(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>R.y.n Company</title>
	<link rel="icon" type="image/png" href="img/favicon.ico" />

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/headfoot.css"/>
	<link rel="stylesheet" type="text/css" href="css/connexion.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</head>
<?php include('includes/header.php'); ?>
<?php 
if(isset($_SESSION['connexion'])){
	if($_SESSION['connexion']!=''){
		echo "<div style='margin:0;text-align:center;'; class='alert alert-danger'><ul> Veuillez remplir corectement le formulaire : " .  $_SESSION['connexion'] . "</ul> <br> <br></div>";
		unset($_SESSION['connexion']);
	}

}

	?>
	<div id="contenu" class="container-fluid">

		
		<div id="fenetreco">
		<form method="POST" action="indexbis.php">
		<div id="checkbox">
			<img src="img/proico.png" height="30px" width="30px" />
			<input type="checkbox" name="choix">
			<label>Connexion Société</label>

		</div>
			
				<p align="center" class="champemail">
					<label>E-Mail</label>
					<input type="email" name="mail">
					<br/>
				</p>
				<p align="center" class="champmdp" >
					<label>Mot de Passe</label>
					<input type="password" name="password">
				</p>
				<div >
					<p style="margin-top: 5px"><input id="bouton" type="submit" /></p>
				</div>
			</form>
			<div id="inscrit">
			<br/><br/>
			<font size="2px" color="#003399"><p><a href="inscription.php" >Pas encore inscrit ? Inscrivez vous !</a></p></font>			
			</div>
		</div>
	</div>
	
	<?php include('includes/footer.php'); ?>