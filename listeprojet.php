<?php require_once 'includes/fonction.php'; 
onlyco()
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<title>R.y.n Company</title>
	<link rel="icon" type="image/png" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/headfoot.css"/>
	<link rel="stylesheet" type="text/css" href="css/listeprojet.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</head>
<?php include('includes/header.php'); ?>
	<div class="contenu">
	</br>
		<?php 

		$req=$bdd->query('SELECT idprojet,Titre,nom,language, prix FROM Projet, Societe WHERE Projet.idso=Societe.idso and visible=0 ORDER BY datenais DESC ');

		while($donnees=$req->fetch()): ?>
				<a href="projet.php?id=<?php echo $donnees['idprojet']; ?>">
				<div class="projet">
				
					<div class="ruban"><img height="100px" width="50px" src="img/977e3bc1e7866e29fa8f0f433151988d-vector-waxf-seals.png"/></div>

					<div class="titre"><h3><?php echo $donnees['Titre']; ?></h3></div>
					<br/><br/>

					<div class="ent"><p> Proposé par l'entreprise : <?php echo $donnees['nom']; ?></p></div>
					
					<div class="language"><br/><p><font> Language requis : <?php echo $donnees['language']; ?></font></p></div>

					<br/><div class="prix"><p><font > Salaire : <?php echo $donnees['prix']; ?>€</font></p></div>
					
				</div></a>
				</br>
				</br>
		<?php endwhile; ?>
					
	</div>
			
			</br>
			
		
		<?php $req->closeCursor();?>
			
			






	

	<?php include('includes/footer.php'); ?>