<?php
	require_once 'includes/fonction.php';
	onlyco();
	onlyent();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>R.y.n Company</title>
	<link rel="icon" type="image/png" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/headfoot.css"/>
	<link rel="stylesheet" type="text/css" href="css/ajoutprojet.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</head>
<?php include('includes/header.php'); ?>
	<div id="main">
	<?php 
		if(!empty($_POST) ){
			$e = "";

			if (empty($_POST['titre'])){
				$e = $e . "<li> Veuillez remplir le champ titre. </li>";
			}
			if (empty($_POST['desc'])){
				$e = $e . "<li> Veuillez remplir le champ description. </li>";
			}
			if (empty($_POST['prix']) && !is_float($_POST['prix'])) {
				$e = $e . "<li> Veuillez remplir le champ du prix avec des nombre uniquement. </li>";
			}

			if (empty($_POST['language'])){
				$e = $e . "<li> Veuillez remplir le champ language. </li>";
			}
			if ($e==""){
				$req=$bdd->prepare('INSERT INTO Projet(Titre, descriptif, prix, idso,visible,nbinscrit,language,datenais) VALUES (:Titre, :descriptif, :prix, :idso, :visible, :nbinscrit,:language,CURDATE() )');
				$req->execute(array(
				        'Titre' => $_POST['titre'],
				        'descriptif' => $_POST['desc'],
				        'prix' => $_POST['prix'] ,
				        
				        'idso' => $_SESSION['user']['idso'],
				        'visible' => 0,
				        'nbinscrit' => 0,
				        'language' =>$_POST['language']
				        ));
				echo '<br/><br/><div>Ajout projet réussi.</div>';
				sleep(3);
				header('Location: indexbis.php');

			
			}else{
				$_SESSION['erreur'] = $e; 

			}	
		} ?>
	
		<?php 
		if (isset($_SESSION['erreur'])){
			?>
			<div style="margin-top: 50px"; class="alert alert-danger"> <p class="">
			<?php echo $_SESSION['erreur']; 
			unset($_SESSION['erreur']); ?>
			</p> </div>
			<?php } ?>
	<div class="formulaire">
	<div style="margin-top:20px; margin-left:auto; margin-right:auto; width:235px;">
			<p style="font-size:40px;color:#CCAC00;font-family: 'Dancing Script', cursive;">Ajout d'un projet</p>
		</div>
		<form method="POST" action="">
		<div class="titrelang">
			<div class="form-group titre">
				<label> Titre de l'annonce:
				<input class="form-control" type="text" name="titre"></label><br/>
			</div>
			<div class="language">
			<label>Language recherché: </label>
			<input class="form-control" name="language">
		</div>
		</div>
		<div class="form-group descriptif">
			<label>Descriptif de la mission:</label>
			<textarea class="form-control" name="desc"></textarea>
			
			<!--<label for="html">Html/Css:</label>
				<select name="html/css">
					<option value="Aucunes" selected="selected">Aucunes</option>
					<option value="Notions" >Notions</option>
					<option value="Intermediaire" >Intermediaire</option>
					<option value="Expert" >Expert</option>
					
				</select>
				

				<label for="php">PHP:</label>
				<select name="php">
					<option value="Aucunes" selected="selected">Aucunes</option>
					<option value="Notions" >Notions</option>
					<option value="Intermediaire" >Intermediaire</option>
					<option value="Expert" >Expert</option>
					
				</select>
				
				<label for="java">Java:</label>
				<select name="java">
					<option value="Aucunes" selected="selected">Aucunes</option>
					<option value="Notions" >Notions</option>
					<option value="Intermediaire" >Intermediaire</option>
					<option value="Expert" >Expert</option>
					
				</select>

				<label for="c">C:</label>
				<select name="c">
					<option value="Aucunes" selected="selected">Aucunes</option>
					<option value="Notions" >Notions</option>
					<option value="Intermediaire" >Intermediaire</option>
					<option value="Expert" >Expert</option>
					
				</select>

				<label for="c#">C#:</label>
				<select name="c#">
					<option value="Aucunes" selected="selected">Aucunes</option>
					<option value="Notions" >Notions</option>
					<option value="Intermediaire" >Intermediaire</option>
					<option value="Expert" >Expert</option>
					
				</select>-->
			<div class="prix">
			<label> Montant de la mission:
			<div class="input-group">
				<span class="input-group-addon">€</span>
				<input class="form-control" type="number" min="0" name="prix"></div><br/>
	</div>
	</div>
		
		<div style="margin-left: auto;
	margin-right: auto;width:101px;padding-bottom:50px;"><button class="valide" type="submit">Valider</button></div>
		</form>
		</div>
		






		
	</div>
	<?php include('includes/footer.php'); ?>