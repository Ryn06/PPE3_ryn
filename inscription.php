<?php require_once 'includes/fonction.php';
onlynoco();
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>inscription freelancer</title>
	<link rel="icon" type="image/png" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/headfoot.css"/>
	<link rel="stylesheet" type="text/css" href="css/inscription.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</head>
<?php include('includes/header.php'); ?>
	<div class="container-fluid" id="contenu">
		<?php 
		if (isset($_SESSION['error'])){
			?>
			<div style="margin-top: 50px"; class="alert alert-danger"> <p class="">
			<?php echo $_SESSION['error']; 
			unset($_SESSION['error']); ?>
			</p> </div>
			<?php } ?>
		<div id="cadre">
		<br/>

			<p>Rejoignez nous dès à present !</p><br/><br/>
			<form method="POST" action="compformu.php">
				
				<input type="text" name="nom" placeholder="Nom"/><br/><br/>			
				<input type="email" name="mail" placeholder="E-mail" /><br/><br/>
				<input type="password" name="mdp" placeholder="Mot de passe" /><br/><br/>
				<input type="password" name="mdpbis" placeholder="Confirmer Mot de passe" /><br/><br/><br/>
				<label>Vous êtes ? </label><br/>
				<input type="radio" name="choix" value="free" checked="checked"> Freelancer</radio>&nbsp;&nbsp;
				<input type="radio" name="choix" value="ent"> Entreprise</radio><br/><br/><br/>
				<button type="submit">Je m'inscrit !</button>
			</form>
		</div>		
	</div>
	<?php 	unset($_SESSION['error']); 
	include('includes/footer.php'); ?>