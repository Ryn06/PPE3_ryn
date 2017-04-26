<?php require_once 'fonction.php';  ?>
<?php 
	if($_SESSION['user']['type'] == "adm"){
		if (isset($_GET['idso'])) {
			$req=$bdd->prepare('DELETE FROM Societe WHERE idso=:id');
			$req->execute(array('id'=>$_GET['idso'] ));

		}

		if (isset($_GET['idfree'])) {
			$req=$bdd->prepare('DELETE FROM Freelancer WHERE idfree=:id');
			$req->execute(array('id'=>$_GET['idfree'] ));


		
	}
}
	header("Location: ../indexbis.php");

?>