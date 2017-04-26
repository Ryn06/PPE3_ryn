<?php require_once 'fonction.php';  ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		if (isset($_POST['idfree'])) {
				$req=$bdd->prepare('UPDATE Freelancer SET nom=:nom, adresse=:adresse, ville=:ville, diplome=:diplome, descriptif=:descriptif, html=:html, php=:php, java=:java, c=:c, csharp=:csharp WHERE idfree=:idfree');
				$req->execute(array(
					'nom'=>$_POST['nom'],
					'adresse'=>$_POST['adresse'],
					'ville'=>$_POST['ville'],
					'diplome'=>$_POST['diplome'],
					'descriptif'=>$_POST['desc'],
					'html'=>$_POST['html'],
					'php'=>$_POST['php'],
					'java'=>$_POST['java'],
					'c'=>$_POST['c'],
					'csharp'=>$_POST['csharp'],
					'idfree'=>$_POST['idfree']
					));
				if($_SESSION['user']['type'] != "adm") {
					$_SESSION['user']['nom'] = $_POST['nom'];
					$_SESSION['user']['adresse'] = $_POST['adresse'];
					$_SESSION['user']['ville'] = $_POST['ville'];

					$_SESSION['user']['diplome'] = $_POST['diplome'];
					$_SESSION['user']['descriptif'] = $_POST['desc'];
					$_SESSION['user']['html'] = $_POST['html'];
					$_SESSION['user']['php'] = $_POST['php'];
					$_SESSION['user']['java'] = $_POST['java'];
					$_SESSION['user']['c'] = $_POST['c'];
					$_SESSION['user']['csharp'] = $_POST['csharp'];
                    header("Location: ../profil.php");

                }else {
                    header("Location: ../profil.php?idfree=" . $_POST['idfree']);


                }
            echo $_POST['idfree'];

		}
		if (isset($_POST['idso'])) {
				$req=$bdd->prepare('UPDATE Societe SET nom=:nom, nosiret=:nosiret, descriptif=:descriptif, ca=:ca WHERE idso=:idso');
				$req->execute(array(
					'nom'=>$_POST['nom'],
					
					'nosiret'=>$_POST['nosiret'],
					
					'descriptif'=>$_POST['desc'],
					'ca'=>$_POST['ca'],
					
					'idso'=>$_POST['idso']
					));

				if($_SESSION['user']['type'] != "adm") {
					$_SESSION['user']['nom'] = $_POST['nom'];
					$_SESSION['user']['nosiret'] = $_POST['nosiret'];
					$_SESSION['user']['descriptif'] = $_POST['desc'];
					$_SESSION['user']['ca'] = $_POST['ca'];
                    header("Location: ../profil.php");

                }else{
					header("Location: ../profil.php?idso=" . $_POST['idso']);
                }
            echo "un utilisateur Lambda a modifié";


		}
?>


</body>
</html>