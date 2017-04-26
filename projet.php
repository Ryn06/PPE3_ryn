<?php require_once 'includes/fonction.php'; onlyco(); 

if(!empty($_POST)){
	if(isset($_POST['idfree'])){
		if(!empty($_POST['idfree'])){
			$inscription=$bdd->prepare('UPDATE Projet SET  nbinscrit =-1 WHERE idprojet = ? ');
			$inscription->execute(array($_POST['idprojet']));
			$inscription->closeCursor();

			$addnbprojet=$bdd->prepare('UPDATE Freelancer SET nbprojet=nbprojet+1 WHERE idfree = ? ');
			$addnbprojet->execute(array($_POST['idfree']));
			$addnbprojet->closeCursor();

			$addnbprojetso=$bdd->prepare('UPDATE Societe SET nbprojet=nbprojet+1 WHERE idso = ? ');
			$addnbprojetso->execute(array($_POST['idso']));
			$addnbprojetso->closeCursor();

			$message = "<a href='profil.php?idfreeo=" . $_POST['idfree'] . "'>" . $_SESSION['user']['nom'] . "</a> a terminé le projet <a href='projet.php?id=" . $_POST['idprojet'] ."' >projet</a>"  ;
			$messadmin=$bdd->prepare('INSERT INTO Message (id1, type1, id2, type2, message, datemess, vu) VALUES(?, ?, ?, ?, ?, CURRENT_TIMESTAMP(), 0) ');
			$messadmin->execute(array(0, "adm", $_POST['idso'],"ent", $message));
			$messadmin->closeCursor();

		}
	}else{
		$inscription=$bdd->prepare('UPDATE Projet SET visible=?, nbinscrit =1 WHERE idprojet = ? ');
		$inscription->execute(array($_POST['freelancer'],$_POST['idprojet']));
		$inscription->closeCursor();

		$message = "<a href='profil.php?idso=" . $_POST['idso'] . "'>" . $_POST['nom'] . "</a> vous a validé pour le <a href='projet.php?id=" . $_POST['idprojet'] ."' >projet</a>"  ;
		$messadmin=$bdd->prepare('INSERT INTO Message (id1, type1, id2, type2, message, datemess, vu) VALUES(?, ?, ?, ?, ?, CURRENT_TIMESTAMP(), 0) ');
		$messadmin->execute(array(0, "adm", $_POST['freelancer'],"free", $message));
		$messadmin->closeCursor();
	}
}
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
		<?php 
			if(!empty($_GET)){	
			
				$req=$bdd->prepare('SELECT * FROM Projet WHERE idprojet=?');
				$req->execute(array($_GET['id']));
				$projet=$req->fetch();
				$req->closeCursor();
				$req=$bdd->prepare('SELECT nom FROM Societe WHERE idso=?');
				$req->execute(array($projet['idso']));
				$so=$req->fetch();
				$req->closeCursor();
				if(empty($projet['idprojet'])){
					echo "<p> Le projet rechercher n'existe pas </p>";
				}else{ 

	?>

						
	<div class="contenu"><?php
	if($_SESSION['user']['type'] =='ent'){
		if($projet['idso'] == $_SESSION['user']['idso'] && $projet['visible'] !=0 && $projet['nbinscrit'] > 0){
			echo "<div> <center><p class=\"bg-info\" style='width:30%;font-size: 20px'> Le Freelancer n'a toujours pas fini le projet </p> </center></div>";
		}
	}
	if($projet['visible'] != 0 && $projet['nbinscrit'] > 0 && $_SESSION['user']['type'] == "free"){
		if($projet)
		echo "<div> <center><p class=\"bg-warning\" style='width:30%;font-size: 20px'> Ce projet à déjà été proposé à quelqu'un </p> </center></div>";
	}

	if($projet['nbinscrit'] == -1){
		echo "<div> <center><p class=\"bg-info\" style='width:30%;font-size: 20px;'> Ce projet est terminé </p> </center></div>";
	}
	?>

					<div class="titre"><b><?php echo $projet['Titre']?></b> </div>

						<div class="comp">Proposé par <a href="profil.php?idso=<?php echo $projet['idso']?>"><?php echo $so['nom']?></a></div><hr/><span class="plp"><hr/></span><br/><br/>
						<div class="descriptif"><span>Description de la mission: </span><br/><?php echo $projet['descriptif']?> </div>
						<div class="language"><span>Language recherché: </span><br/><?php echo $projet['language']?> </div>
						<div class="datenais"><hr/><span>Date de création du projet: </span><?php echo $projet['datenais']?> </div>
						<div class="prix"><span>Salaire:</span> <?php echo $projet['prix']?> €</div>


					<?php
							if($_SESSION['user']['type']== 'ent'){
							if ($_SESSION['user']['idso']==$projet['idso']) {
								echo "<a class='btn btn-warning' href='modifprojet.php?idprojet=" . $projet['idprojet'] . "'>Modifier</a>";
							}
					} ?>
					<?php 
						if ($_SESSION['user']['type']=='adm'){
							echo "<a class='btn btn-warning' href='modifprojet.php?idprojet=" . $projet['idprojet'] . "'>Modifier</a>";
							echo "<a class='btn btn-danger' href='includes/delprojet.php?idprojet=" . $projet['idprojet'] . "'>Supprimer</a>";
						}
					?>
					
					

				<?php
					if($projet['visible'] == 0) {
						if ($_SESSION['user']['type'] == 'free') {
							if ($_SESSION['user']['valide'] == 0) {
								?>
								<div class="passer">
									<hr/>
									<a href='passertest.php'><b> Veuillez passez le test pour postuler </b></a></div>
								<?php


							}else{
								$req1=$bdd->prepare('SELECT * FROM Inscription WHERE idfree = ? and idprojet = ?');
								$req1->execute(array($_SESSION['user']['idfree'], $_GET['id']));

								if($req1->fetch()){

									?>
									<button type="button" class="btn btn-lg btn-primary" disabled="disabled">Vous êtes inscris</button>
									<?php

								}else{

									?>


									<form action="mesprojets.php" method="POST">
										<input type="hidden"
											   name="idprojet" <?php echo "value='" . $_GET['id'] . "'" ?>/>
										<input type="hidden"
											   name="idso" <?php echo "value='" . $projet['idso'] . "'" ?>/>
										<div class="passer">
											<button class="boutton" type="submit">S'inscrire</button>
										</div>
									</form> <?php
								}
							}
						}

						if($_SESSION['user']['type'] == 'ent'){
							if($_SESSION['user']['idso'] == $projet['idso']){
								if($projet['nbinscrit'] >0){
									echo "<br> <br> <h2>Valider un freelancer</h2>";
								}
								?>

								
									<?php
									$reqfreeinscrit=$bdd->prepare('SELECT * FROM Freelancer INNER JOIN Inscription ON Freelancer.idfree = Inscription.idfree where idprojet=?');
									$reqfreeinscrit->execute(array($_GET['id'] ));

									if($inscrit = $reqfreeinscrit->fetch()){
										echo "<form action='' method='POST'>";
										do{
											echo "<a href='profil.php?idfree=".  $inscrit['idfree'] . "' >  " . $inscrit['nom'] . "  </a><input name='freelancer' type='radio' value='" . $inscrit['idfree'] . "' />  <br>";


										}while ($inscrit = $reqfreeinscrit->fetch());
										echo "<input name='idprojet' type='hidden' value='" . $_GET['id'] . "' />";
										echo "<input type='hidden' name='idso' value='" . $projet['idso'] . "' />";
										echo "<input type='hidden' name='nom' value='" . $so['nom'] . "' />";
?>
										<center><button class="boutton" type="submit">Valider le freelancer</button></center>
								</form>
								<?php

									}
							}
						}
					}elseif ($projet['visible'] != 0 && $projet['nbinscrit'] != -1){
						if($_SESSION['user']['type'] == 'free'){
							if($projet['visible'] == $_SESSION['user']['idfree']){ ?>

								<form method="POST" action="">
									<?php
									echo "<input name='idprojet' type='hidden' value='" . $_GET['id'] . "' />";
									echo "<input type='hidden' name='idso' value='" . $projet['idso'] . "' />";
									echo "<input type='hidden' name='idfree' value='" . $projet['visible'] . "' />";

									?>
									<center>	<button class="btn btn-success" type="submit">Validé la fin du projet</button> </center>
								</form>
<?php
							}
						}
					}
				echo'</div>';

				}
			}else{
				echo "Le projet recherché n'existe pas";
			}
		?>






		<br/>
		<br/>
	</div>
	<?php include('includes/footer.php'); ?>