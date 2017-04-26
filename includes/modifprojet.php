<?php require_once 'fonction.php';  ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	if (isset($_POST['idprojet'])){
		if ($_POST['choix']=='0') {
				$req=$bdd->prepare('UPDATE Projet SET Titre=:titre,descriptif=:descriptif,language=:language WHERE idprojet=:idprojet');
				$req->execute(array(
					'titre'=>$_POST['titre'],
					'descriptif'=>$_POST['desc'],
					'language'=>$_POST['language'],
					'idprojet'=>$_POST['idprojet']
					));
				
                    header("Location: ../listeprojet.php");

                }else {
                    header("Location: ../listeprojet.php");


                }
       if ($_POST['choix']=='1'){
       		$req=$bdd->prepare('UPDATE Projet SET Titre=:titre,descriptif=:descriptif,language=:language,prix=:prix WHERE idprojet=:idprojet');
				$req->execute(array(
					'titre'=>$_POST['titre'],
					'descriptif'=>$_POST['desc'],
					'language'=>$_POST['language'],
					'prix'=>$_POST['prix'],
					'idprojet'=>$_POST['idprojet']
					));
				
                    header("Location: ../listeprojet.php");

                }
         }else {
                    header("Location: ../listeprojet.php");


                }

       
            

		?>
		</body>
		</html>       
