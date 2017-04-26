<?php require_once 'includes/fonction.php'; 
onlyco(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>R.y.n Company</title>
	<link rel="icon" type="image/png" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/headfoot.css"/>
	<link rel="stylesheet" type="text/css" href="css/profil.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</head>
<?php include('includes/header.php'); ?>



			<?php 
		if(!empty($_GET)){	
			if(isset($_GET['idso'])){ ?>
				<div class="container-fluid" style="width:100%;min-height:100vh;background: linear-gradient(to bottom, #ebf1f6 0%,#abd3ee 48%,#89c3eb 100%,#d5ebfb 100%,#89c3eb 101%);">
				<?php $req=$bdd->prepare('SELECT * FROM Societe WHERE idso=?');
				$req->execute(array($_GET['idso']));
				$user=$req->fetch();
				$req->closeCursor();
				if(empty($user['mail'])){
					echo "<p> Le profil rechercher n'existe pas </p>";
				}else{ 
					?>
					
					<img height="130px" src="img/proico.png"/>
					<div class="princi" >
					<div class="top">
					<b>Nom : </b><?php echo $user['nom']?> <br>
					<b>N° Siret : </b><?php echo $user['nosiret']?> <br>
					</div>
					<div class="mid">
					 <b>Descriptif : </b><br><div class="text" style=""> <?php echo $user['descriptif']?> </div><br>
					 </div>
					 <div class="bot">
					<b>Chiffre d'affaire : </b><?php echo $user['ca']?> <br>
					<b>Date d'inscription : </b><?php echo $user['dateinscrit']?> <br>
					<b>Nombre de projet posté : </b><?php echo $user['nbprojet']?> <br>
					</div>
						<?php
						if($_SESSION['user']['type'] == "free") {
							?>
							<div class="mid">
								<form method="GET" action="message.php">
									<?php echo "<input type='hidden' name ='idso' value='" . $user['idso'] . "' >" ?>
									<button type="submit" class="btn btn-primary">Envoyer un message</button>
								</form>
							</div>
							<?php
						}else{
							if($_SESSION['user']['type'] == "adm"){
								echo "<p style='width:200px;margin-left:auto;margin-right:auto;' class='mid'><a class='btn btn-warning' href='modif.php?idso=". $user['idso'] . "'>Modifier</a></p>";
								echo "<p style='width:200px;margin-left:auto;margin-right:auto;' class='mid'><a class='btn btn-danger' href='includes/delprofil.php?idso=". $user['idso'] . "'>Supprimer</a></p>";
							}
							if(isset($_SESSION['user']['idso'])){
								if($user['idso'] == $_SESSION['user']['idso']){
									echo "<p style='width:200px;margin-left:auto;margin-right:auto;' class='mid'><a class='btn btn-primary' href='modif.php?idso=". $user['idso'] . "'>Modifier</a></p>";
								}
							}
						}

							?>
					</div></p>
					</div>

			<?php

					}
			}
			if(isset($_GET['idfree']) ){ ?>
				<div class="container-fluid" style="width:100%;min-height:100vh;background: linear-gradient(to bottom, rgba(240,249,255,1) 0%,rgba(255,255,255,1) 0%,rgba(216,208,95,1) 100%);">
				<?php $req=$bdd->prepare('SELECT * FROM Freelancer WHERE idfree=?');
				$req->execute(array($_GET['idfree']));
				$user=$req->fetch();
				$req->closeCursor();
				if(empty($user['mail'])){
					echo "<p> Le profil rechercher n'existe pas </p>";
				}else {

					?>
					<img height="150px" src="img/freework.png"/>
					<div class="princi">
					<div class="top">

					<b>Nom : </b><?php echo $user['nom'] ?><br>
					<b>Ville : </b><?php echo $user['ville'] ?><br>
					<b>Diplôme le plus élevé : </b><?php echo $user['diplome'] ?><br>
					</div>
					<div class="mid">
					<b>Descriptif : </b><br>
					
					<div class="text" style=""> <?php echo $user['descriptif'] ?></div><br>
					<b>Niveau en HTML : </b><?php echo $user['html'] ?><br>
					<b>Niveau en PHP : </b><?php echo $user['php'] ?><br>
					<b>Niveau en JAVA : </b><?php echo $user['java'] ?><br>
					<b>Niveau en C : </b><?php echo $user['c'] ?><br>
					<b>Niveau en C# </b><?php echo $user['csharp'] ?><br>
					</div>
					<div class="bot">
					<?php if ($user['valide']==1){ ?>
						<b>Note du test : </b><?php echo $user['test'] ?><br>
					<?php }?>
					<b></b>
					<b>Date d'inscription : </b><?php echo $user['dateinscrit'] ?><br>
					<b>Nombre de projet réalisé : </b><?php echo $user['nbprojet'] ?><br>
					</div>
					<?php
					if ($_SESSION['user']['type'] == "ent") {

						?>
						<div class="mid">
							<form method="GET" action="message.php">
								<?php echo "<input type='hidden' name ='idfree' value='" . $user['idfree'] . "' >" ?>
								<button type="submit" class="btn btn-primary">Envoyer un message</button>
							</form>
						</div>
						<?php
					}else{
						if($_SESSION['user']['type'] == "adm"){
							echo '<p style="width:200px;margin-left:auto;margin-right:auto;" class="mid"><a class="mid btn btn-warning" href="modif.php?idfree='. $user["idfree"] . '">Modifier</a></p>';
							echo "<p style='width:200px;margin-left:auto;margin-right:auto;' class='mid'><a class='btn btn-danger' href='includes/delprofil.php?idfree=". $user['idfree'] . "'>Supprimer</a></p>";
						}
						if(isset($_SESSION['user']['idfree'])){
							if($_SESSION['user']['idfree'] == $user['idfree']) {
								echo "<p style='width:200px;margin-left:auto;margin-right:auto;' class='mid'><a class='btn btn-warning' href='modif.php?idfree=" . $user['idfree'] . "'>Modifier</a></p>";
							}
						}
					}
						?>
					</div> </p>
					</div>
			<?php 
				}
			}
		}else{
			if ($_SESSION['user']['type']=='ent'){ ?>
				<div class="container-fluid" style="width:100%;min-height:100vh;background: linear-gradient(to bottom, #ebf1f6 0%,#abd3ee 48%,#89c3eb 100%,#d5ebfb 100%,#89c3eb 101%);">
				<img height="130px" src="img/proico.png"/>
				<div class="princi">
				<div class="top">
				<b>Nom : </b><?php echo $_SESSION['user']['nom']?> <br>
				<b>N° Siret : </b><?php echo $_SESSION['user']['nosiret']?> <br>
				</div>
				<div class="mid">
				<b>Descriptif : </b><br><div class="text" style=""> <?php echo $_SESSION['user']['descriptif']?></div> <br>
				</div>
				<div class="bot">
				<b>Chiffre d'affaire : </b><?php echo $_SESSION['user']['ca']?> <br>
				<b>Date d'inscription : </b><?php echo $_SESSION['user']['dateinscrit']?> <br>
				<b>Nombre de projet posté : </b><?php echo $_SESSION['user']['nbprojet']?> <br>
				<p class="mid"><a  class="btn btn-primary" href="modif.php">Modifier</a></p>
				</div>
				</div>
				</div>
			</p>
		<?php } ?>
		<?php 
			if ($_SESSION['user']['type']=='free'){ ?>
				<div class="container-fluid" style="width:100%;min-height:100vh;background: linear-gradient(to bottom, rgba(240,249,255,1) 0%,rgba(255,255,255,1) 0%,rgba(216,208,95,1) 100%);">
				<img height="150px" src="img/freework.png"/>
				<div class="princi">
				<div class="top">
				<b>Nom : </b><?php echo $_SESSION['user']['nom']?><br>
				<b>Numéro de sécurité sociale : </b><?php echo $_SESSION['user']['nosecu']?><br>
				<b>Ville : </b><?php echo $_SESSION['user']['ville']?><br>
				<b>Diplôme le plus élevé : </b><?php echo $_SESSION['user']['diplome']?><br>
				</div>
				<div class="mid">
				<b>Descriptif : </b><br><div class="text" style=""> <?php echo $_SESSION['user']['descriptif']?></div><br>
				
				<b>Niveau en HTML : </b><?php echo $_SESSION['user']['html']?><br>
				<b>Niveau en PHP : </b><?php echo $_SESSION['user']['php']?><br>
				<b>Niveau en JAVA : </b><?php echo $_SESSION['user']['java']?><br>
				<b>Niveau en C : </b><?php echo $_SESSION['user']['c']?><br>
				<b>Niveau en C# : </b><?php echo $_SESSION['user']['csharp']?><br>
				</div>
				<div class="bot">
				<?php if ($_SESSION['user']['valide']==1){ ?>
						<b>Note du test : </b><?php echo $_SESSION['user']['test']; ?><br>
					<?php }?>
				<b>Date d'inscription : </b><?php echo $_SESSION['user']['dateinscrit']?><br>
				<b>Nombre de projet réalisé : </b><?php echo $_SESSION['user']['nbprojet']?><br> 
				</div>
				<p class="mid"><a class="btn btn-warning" href="modif.php?type='free'?&id">Modifier</a></p>
				</div></p>
				</div>


			<?php
			}
		}
			 ?>





		
	</div>
	<?php include('includes/footer.php'); ?>
