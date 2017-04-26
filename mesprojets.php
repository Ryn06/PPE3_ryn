<?php require_once 'includes/fonction.php'; onlyco();  ?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>R.y.n Company</title>
		<link rel="icon" type="image/png" href="img/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/headfoot.css"/>
		<link rel="stylesheet" type="text/css" href="css/mesprojets.css"/>
		<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
		<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

	</head>
<?php include('includes/header.php'); ?>
<div class="container-fluid bg" style="min-height:100vh;">

<?php if(isset($_POST['idprojet'])){
	$req=$bdd->prepare('INSERT INTO Inscription (date_inscrit,idfree,idprojet) VALUES(CURDATE(),:idfree,:idprojet)');
	$req->execute(array(
		'idfree'=>$_SESSION['user']['idfree'],
		'idprojet'=>$_POST['idprojet']
	));

	$req->closeCursor();
	$reqnbinscrit=$bdd->prepare('UPDATE Projet SET nbinscrit =nbinscrit+1 WHERE idprojet = ? ');
	$reqnbinscrit->execute(array($_POST['idprojet']));
	$reqnbinscrit->closeCursor();

	$message = "<a href='profil.php?idfree=" . $_SESSION['user']['idfree'] . "'>" . $_SESSION['user']['nom'] . "</a> Vient de s'inscrire à votre <a href='projet.php?id=" . $_POST['idprojet'] ."' > projet. </a>"  ;
	$messadmin=$bdd->prepare('INSERT INTO Message (id1, type1, id2, type2, message, datemess, vu) VALUES(?, ?, ?, ?, ?, CURRENT_TIMESTAMP(), 0) ');
	$messadmin->execute(array(0, "adm", $_POST['idso'],"ent", $message));
	$messadmin->closeCursor();


}
if($_SESSION['user']['type'] == "free"){
	$a = "";
	?>
	<div class="prim">
		<div>


		<table class='table table-condensed' style="margin-top:10px;">
			<caption style="text-align: center"> Liste des projets en attente de validation</caption>
			<thead>
			<tr>
				<th>Intitulé</th>
				<th>Proposé par</th>

			</tr> </thead>
			<?php
			$req=$bdd->prepare('SELECT * FROM Inscription INNER JOIN Projet ON Inscription.idprojet = Projet.idprojet where idfree =? and visible = 0');
			$req->execute(array($_SESSION['user']['idfree']));
			if($donnees = $req->fetch()){
				do{


					echo "<tr><td><a href='projet.php?id=" . $donnees['idprojet'] . "'>" . $donnees['Titre'] . "</a>";

					$req1=$bdd->prepare('SELECT * FROM Societe WHERE idso = ?');
					$req1->execute(array($donnees['idso']));
					$nn = $req1->fetch();
					echo "<td> <a href='profil.php?idso=" . $donnees['idso'] ."'> " . $nn['nom'] . "</td></tr>";
					$req1->closeCursor();

				}while ($donnees = $req->fetch());
			}else{
				echo "<td colspan='2' style='text-align: center;'> Aucun Projet </td>";
			}
			$req->closeCursor();

			?>

		</table>
	</div>


	<div>

		<table class='table table-condensed' style="margin-top:10px;">
			<caption style="text-align: center"> Liste des projets en cours</caption>
			<thead>
			<tr>
				<th>Intitulé</th>
				<th>Proposé par</th>

			</tr> </thead>

			<?php
			$req=$bdd->prepare('SELECT * FROM Inscription INNER JOIN Projet ON Inscription.idprojet = Projet.idprojet where idfree =? and visible = ?');
			$req->execute(array($_SESSION['user']['idfree'], $_SESSION['user']['idfree'] ));
			if($donnees = $req->fetch()){

				?>

					<?php
				do{


					echo "<tr><td><a href='projet.php?id=" . $donnees['idprojet'] . "'>" . $donnees['Titre'] . "</a>";

					$req1=$bdd->prepare('SELECT * FROM Societe WHERE idso = ?');
					$req1->execute(array($donnees['idso']));
					$nn = $req1->fetch();
					echo "<td> <a href='profil.php?idso=" . $donnees['idso'] ."'> " . $nn['nom'] . "</td></tr>";
					$req1->closeCursor();

				}while ($donnees = $req->fetch());
			}else{
				echo "<td colspan='2' style='text-align: center;'> Aucun Projet </td>";
			}
			$req->closeCursor();

			?>

		</table>
	</div>


	<div>

		<table class='table table-condensed'>
			<caption style="text-align: center;"> Liste des projets que vous avez fini</caption>
			<thead>
			<tr>
				<th>Intitulé</th>
				<th>Proposé par</th>

			</tr> </thead>

			<?php
			$req=$bdd->prepare('SELECT * FROM Inscription INNER JOIN Projet ON Inscription.idprojet = Projet.idprojet where idfree =? and visible = ? and nbinscrit = -1');
			$req->execute(array($_SESSION['user']['idfree'],$_SESSION['user']['idfree'] ));
			if($donnees = $req->fetch()){
			?>


			<?php
			do{


					echo "<tr><td><a href='projet.php?id=" . $donnees['idprojet'] . "'>" . $donnees['Titre'] . "</a>";

					$req1=$bdd->prepare('SELECT * FROM Societe WHERE idso = ?');
					$req1->execute(array($donnees['idso']));
					$nn = $req1->fetch();
					echo "<td> <a href='profil.php?idso=" . $donnees['idso'] ."'> " . $nn['nom'] . "</td></tr>";
					$req1->closeCursor();

				}while ($donnees = $req->fetch());
			}else{
				echo "<td colspan='2' style='text-align: center;'> Aucun Projet </td>";
			}
			$req->closeCursor();
			?>

		</table>
	</div>
</div>


<?php } else{
	?>
	<div class="prim">
	<div>


		<table class='table table-condensed' style="margin-top:10px;">
			<caption style="text-align: center"> Liste des projets ou vous n'avez pas encore accepté de freelance</caption>
			<thead>
			<tr>
				<th>Intitulé</th>
				<th>Nombre inscrit</th>

			</tr> </thead>
			<?php
			$req=$bdd->prepare('SELECT * FROM Projet where idso =? and visible = 0');
			$req->execute(array($_SESSION['user']['idso']));
			if($donnees = $req->fetch()){

				?>



					<?php
				do{


					echo "<tr><td><a href='projet.php?id=" . $donnees['idprojet'] . "'>" . $donnees['Titre'] . "</a>";
					echo "<td>" . $donnees['nbinscrit'] . "</td></tr>";
				}while ($donnees = $req->fetch());
			}else{
				echo "<td colspan='2' style='text-align: center;'> Aucun Projet </td>";
			}
			$req->closeCursor();

			?>

		</table>
	</div>

	<div>
		<table class='table table-condensed' style="margin-top:10px;">
			<caption style="text-align: center"> Liste des projets en cours</caption>
			<thead>
			<tr>
				<th>Intitulé</th>
				<th>Utilisateur choisis</th>

			</tr> </thead>
		<?php
		$req=$bdd->prepare('SELECT * FROM Projet where idso =? and visible <> 0 and nbinscrit = 1');
		$req->execute(array($_SESSION['user']['idso']));
		if($donnees = $req->fetch()){

		?>



			<?php
			do{


				echo "<tr><td><a href='projet.php?id=" . $donnees['idprojet'] . "'>" . $donnees['Titre'] . "</a>";
				$req1=$bdd->prepare('SELECT * FROM Freelancer WHERE idfree = ?');
				$req1->execute(array($donnees['visible']));
				$nn = $req1->fetch();
				echo "<td> <a href='profil.php?idfree=" . $donnees['visible'] ."'> " . $nn['nom'] . "</td></tr>";
				$req1->closeCursor();
			}while ($donnees = $req->fetch());
			}else{
				echo "<td colspan='2' style='text-align: center;'> Aucun Projet </td>";
			}
			$req->closeCursor();

			?>

		</table>
	</div>

	<div>
		<table class='table table-condensed'>
		<caption style="text-align: center;"> Liste des projets que vous avez fini</caption>
		<thead>
		<tr>
			<th>Intitulé</th>
			<th>Produit par</th>

		</tr> </thead>
		<?php
		$req=$bdd->prepare('SELECT * FROM Projet where idso =? and visible <> 0 and nbinscrit = -1');
		$req->execute(array($_SESSION['user']['idso']));
		if($donnees = $req->fetch()){

		?>



			<?php
			do{


				echo "<tr><td><a href='projet.php?id=" . $donnees['idprojet'] . "'>" . $donnees['Titre'] . "</a>";
				$req1=$bdd->prepare('SELECT * FROM Freelancer WHERE idfree = ?');
				$req1->execute(array($donnees['visible']));
				$nn = $req1->fetch();
				echo "<td> <a href='profil.php?idfree=" . $donnees['visible'] ."'> " . $nn['nom'] . "</td></tr>";
				$req1->closeCursor();
			}while ($donnees = $req->fetch());
			}else{
				echo "<td colspan='2' style='text-align: center;'> Aucun Projet </td>";
			}
			$req->closeCursor();

			?>

		</table>
	</div>
	</div>

<?php
} ?>



	</div>
	<?php include('includes/footer.php'); ?>