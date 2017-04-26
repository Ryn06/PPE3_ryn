<?php require_once 'fonction.php';  ?>
<?php 
	if($_SESSION['user']['type'] == "adm"){
		if (isset($_GET['idprojet'])) {
			$req=$bdd->prepare('DELETE FROM Projet WHERE idprojet=:idprojet');
			$req->execute(array('idprojet'=>$_GET['idprojet'] ));

		}

		
}
	header("Location: ../listeprojet.php");

?>