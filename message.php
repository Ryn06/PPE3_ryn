<?php require_once 'includes/fonction.php'; 
onlyco();


// MISE A JOUR DES MESSAGES VUES
if(!empty($_GET)) {
	if($_SESSION['user']['type'] == "free"){
		$idreceiver = $_SESSION['user']['idfree'];
	}else{
		$idreceiver = $_SESSION['user']['idso'];
	}
	if(isset($_GET['idso'])) {
		$idsender = $_GET['idso'];
		$typesender = "ent";
	}
	if(isset($_GET['idfree'])) {
		$idsender = $_GET['idfree'];
		$typesender = "free";
	}
	if(isset($_GET['adm'])) {
		$idsender = 0;
		$typesender = "adm";
	}

	$messvu = $bdd->prepare('UPDATE Message set vu=1 WHERE id1 = ? AND type1 = ? AND id2= ? and type2 = ? and vu=0');
	$messvu->execute(array($idsender, $typesender, $idreceiver, $_SESSION['user']['type']));
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
	<link rel="stylesheet" type="text/css" href="css/message.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</head>
<?php include('includes/header.php'); ?>
<div class="container-fluid bg" style="width:100%;min-height:100vh;">
<?php 


// ENTREE DES MESSAGES DANS LA BDD
if(!empty($_POST)){
	if(isset($_POST['id']) && isset($_POST['type']) && isset($_POST['textarea']) && !empty($_POST['id']) && !empty($_POST['type']) && !empty($_POST['textarea'])){
		if($_SESSION['user']['type'] == 'ent'){
			$type1 = 'ent';
			$id1= $_SESSION['user']['idso'];
		}else{
			$type1 = 'free';
			$id1 = $_SESSION['user']['idfree'];
		}
		if($_POST['type'] =='free'){
			$retour = 'idfree';
		}else{
			$retour  = 'idso';
		}
		$id2 = $_POST['id'];
		$type2 = $_POST['type'];
		$mess = $_POST['textarea'];
		$req=$bdd->prepare('INSERT INTO Message(id1, type1, id2, type2, message, datemess, vu) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP(), 0)');
		$req->execute(array($id1, $type1, $id2, $type2, $mess));
		$lien = "location: message.php?". $retour . "=" . $_POST['id'];
		header($lien);


	}

	

}else{

	if(!empty($_GET)){

		// PARTIE AFFICHAGE ADMIN
		if(isset($_GET['adm'])){
			if($_SESSION['user']['type'] == "free"){
				$idreceiver = $_SESSION['user']['idfree'];
			}else{
				$idreceiver = $_SESSION['user']['idso'];
			}
			$sql = "SELECT COUNT(*) AS nb FROM Message WHERE type1=? AND id2=? AND type2=?";
			$req = $bdd->prepare($sql);
			$req->execute(array("adm", $idreceiver,  $_SESSION['user']['type']));
			$array = $req->fetch();
			$req->closeCursor();
			$nb = $array['nb'];
			$sql1= "SELECT * FROM Message WHERE type1=? AND id2=? AND type2=?";
			$req = $bdd->prepare($sql1);
			$req->execute(array("adm", $idreceiver,  $_SESSION['user']['type']));
			if($nb == 0){
				echo "<div class='pasmess'><p><br> <i> Vous n'avez pas de messages.</i> </p></div>";
			}else{
				echo "<h1 style='color:#a80505;text-align:center'>Admin</h1> <br>";
				while($donne=$req->fetch()){
					if($nb<=5 && $nb>0){
						echo "<div class='container-fluid mess mess-in' style='width:50%;margin-right:auto;margin-left:auto;-moz-border-radius:17px;-webkit-border-radius:17px;border-radius:17px;background-color:rgba(255,255,255,0.7);color:#ff4747;font-weight:bold;text-align:center;vertical-align:center;margin-top:10px;border:1px solid #ccac00;'>"  . $donne['message'] . "<br> <i style='text-align:center'> " . $donne['datemess'] . " </i>    </div> ";
						}
						$nb=$nb-1;

				}
				$req->closeCursor();

			}
			echo "</table</div>";
			
			exit(); 

		}
		if($_SESSION['user']['type'] == 'ent'){
			$id2=$_SESSION['user']['idso'];
			if (isset($_GET['idso'])){
				if($_GET['idso'] == $_SESSION['user']['idso']){
					echo "Vous ne pouvez pas vous envoyez de message a vous même";
					exit();
				}
			}
		}else{
			$id2=$_SESSION['user']['idfree'];
			if(isset($_GET['idfree'])){
				if($_GET['idfree'] == $_SESSION['user']['idfree']){
					echo "Vous ne pouvez pas vous envoyez de message a vous même";
					exit();
				}
			}
		}
		if (isset($_GET['idso'])){
			$req=$bdd->prepare('SELECT * FROM Societe WHERE idso=?');
			$req->execute(array($_GET['idso']));

		}else{
			$req=$bdd->prepare('SELECT * FROM Freelancer WHERE idfree=?');
			$req->execute(array($_GET['idfree']));


		}
		$user=$req->fetch();



		if($user){
			if(isset($user['idso'])){
				$id = $user['idso'];
				$type = 'ent';
				$genre ="idso";
			}else{
				$id = $user['idfree'];
				$type = 'free';
				$genre="idfree";
			}


			echo "<p  style='padding-bottom: 40px;font-size:30px;font-family:Courgette;text-align:center'> <a class='t' href='profil.php?" . $genre . "=" .  $id . "'>" . $user['nom'] . "</a></p>";
			$sql = "SELECT COUNT(*) AS nb FROM Message WHERE (id1=? AND type1=? AND id2=? AND type2=?) OR (id1=? AND type1=? AND id2=? AND type2=?)";
			$req = $bdd->prepare($sql);
			$req->execute(array($id, $type, $id2, $_SESSION['user']['type'], $id2, $_SESSION['user']['type'], $id, $type));
			$array = $req->fetch();
			$req->closeCursor();
			$nb = $array['nb'];
			$sql1= "SELECT * FROM Message WHERE (id1=? AND type1=? AND id2=? AND type2=?) OR (id1=? AND type1=? AND id2=? AND type2=?)";
			$req = $bdd->prepare($sql1);
			$req->execute(array($id, $type, $id2, $_SESSION['user']['type'], $id2, $_SESSION['user']['type'], $id, $type));
			if($nb == 0){
				echo "<div class='pasmess' ><p><br> <i> Vous n'avez pas de messages.</i> </p></div>";
			}else{
				while($donne=$req->fetch()){
					if($nb<=5 && $nb>0){
						if($donne['id1'] == $id2 && $donne['type1'] == $_SESSION['user']['type'] ){
							echo "<div class='container-fluid mess mess-out' style='width:50%;margin-right:30%;-moz-border-radius:17px;-webkit-border-radius:17px;border-radius:17px;background-color:#3DAD00;text-align:left;vertical-align:center;margin-top:10px;'>" . $donne['message'] . "<br> <i style='text-align:center'> " . $donne['datemess'] . " </i>    </div> ";
						}else{
							echo "<div class='container-fluid mess mess-in' style='width:50%;margin-left:30%;-moz-border-radius:17px;-webkit-border-radius:17px;border-radius:17px;background-color:grey;text-align:right;vertical-align:center;margin-top:10px;'>"  . $donne['message'] . "<br> <i style='text-align:center'> " . $donne['datemess'] . " </i>    </div> ";
						}
					}else{
						$nb=$nb-1;
					}
				}
				$req->closeCursor();

			}
			echo "<div class ='container-fluid bot'> <form method='POST' action=''>";
			echo "<input type='hidden' name='id' value='".  $id . "'> ";
			echo "<input type='hidden' name='type' value='".  $type . "'> ";
			echo "<textarea name='textarea' rows='10' cols='50'>Saisir votre message ici.</textarea></div><div class='bot2'>";
			echo "<button type='submit' class='btn btn-primary'style='width:400px;margin-bottom:50px;margin-top:20px;'>Envoyer</button>";
			echo "</form> </div>";
		}


	}else{
		if ($_SESSION['user']['type'] == 'ent'){
			$id = $_SESSION['user']['idso'];
		}else{
			$id = $_SESSION['user']['idfree'];
		}

		$sql = "SELECT COUNT(*) AS nc FROM Message WHERE (id1=? AND type1=?) OR (id2=? AND type2=?)";
		$req = $bdd->prepare($sql);
		$req->execute(array($id ,$_SESSION['user']['type'], $id ,$_SESSION['user']['type']));
		$array = $req->fetch();
		$nc = $array['nc'];
		if($nc !=0){
			$j = array('');
			$t = array('');
			$vu = array('');

			$sql2 = "SELECT * FROM Message WHERE (id1=? AND type1=?) OR (id2=? AND type2=?)";
			$req = $bdd->prepare($sql2);
			$req->execute(array($id ,$_SESSION['user']['type'], $id ,$_SESSION['user']['type']));
			while($donne = $req->fetch()){
				$a = 0;
				foreach ($j as $key) {
					if($id == $donne['id1'] && $_SESSION['user']['type'] == $donne['type1']){
						if ($key ==  $donne['id2']){
							$a = 1;
						}
					}else{
						if ($key ==  $donne['id1']){
							$a = 1;
						}
					}
				}
				if ($a ==0){
					if($id == $donne['id1'] && $_SESSION['user']['type'] == $donne['type1']){
                        $j[] = $donne['id2'];
                        $t[] = $donne['type2'];
					}else{
                        $j[] = $donne['id1'];
                        $t[] = $donne['type1'];
					}
				}
			}
            
			$req->closeCursor();
			$cpt = count($j);
			
			echo "<table class='table table-condensed' style='padding-top: 100px;margin-top: 10px;width:50%;'> <thead><tr><th>Nom</th> <th>Dernier Message</th></thead>";
			
			for($i = 1; $i< $cpt; $i=$i+1) {
                if($t[$i]=="adm") {
					$reqlastmess = $bdd->prepare('SELECT * FROM Message WHERE  type1=? AND  id2=? AND type2=?  order by datemess desc');
					$reqlastmess->execute(array("adm", $id, $_SESSION['user']['type']));
					$B = $reqlastmess->fetch();
					$reqlastmess->closeCursor();

					$req = $bdd->prepare('SELECT COUNT(*) as total FROM Message WHERE id1 =0 and type1 =? and id2 = ? AND type2 = ? and vu =0');
					$req->execute(array("adm", $id, $_SESSION['user']['type']));
					$messvuadmin = $req->fetch();
					$req->closeCursor();
					if ($messvuadmin['total'] != 0) {
						$c = "&nbsp  <img alt='icon  new msg' src='img/icon.png' style='width:4%' ";
					} else {
						$c = " &nbsp";
					}
					echo "<tr><td> <a href='message.php?adm=" . 0 . "'> Admin </a>" . $c . "</td> <td> " . $B['message'] . "</td>";
				}else{
					if ($t[$i] == 'ent') {
						$req = $bdd->prepare('SELECT * FROM Societe WHERE idso=?');
					} else {
						$req = $bdd->prepare('SELECT * FROM Freelancer WHERE idfree=?');
					}
					$req->execute(array($j[$i]));

					$mess = $req->fetch();
					$req->closeCursor();
					$reqlastmess = $bdd->prepare('SELECT * FROM Message WHERE (id1=? AND type1=? AND  id2=? AND type2=?) OR (id1=? AND type1=? AND  id2=? AND type2=?)  order by datemess desc');
					if ($_SESSION['user']['type'] == 'free') {
						$reqlastmess->execute(array($_SESSION['user']['idfree'], "free", $j[$i], $t[$i], $j[$i], $t[$i], $_SESSION['user']['idfree'], "free"));
					} else {
						$reqlastmess->execute(array($_SESSION['user']['idso'], "ent", $j[$i], $t[$i], $j[$i], $t[$i], $_SESSION['user']['idso'], "ent"));
					}

					$B = $reqlastmess->fetch();

					$req = $bdd->prepare('SELECT COUNT(*) as total FROM Message WHERE id1 =? and type1 =? and id2 = ? AND type2 = ? and vu =0');
					$req->execute(array($j[$i], $t[$i], $id, $_SESSION['user']['type']));
					$messvu = $req->fetch();
					$req->closeCursor();
					if ($messvu['total'] > 0) {
						$c = "&nbsp  <img alt='icon  new msg' src='img/icon.png' style='width:4%' ";
					} else {
						$c = " &nbsp";
					}

					if ($t[$i] == 'ent') {
						echo "<tr><td> <a href='message.php?idso=" . $j[$i] . "'> " . $mess['nom'] . "</a>" . $c . "</td> <td> " . $B['message'] . "</td>";
					}
					if ($t[$i] == 'free') {
						echo "<tr><td> <a href='message.php?idfree=" . $j[$i] . "'> " . $mess['nom'] . "</a>" . $c . "</td> <td> " . $B['message'] . "</td>";
					}
				}
			}
		echo "</table>";

		}else{
			echo "<div class='pasmess'> <p> Vous n'avez aucun message </p> </div>";
		}






	}



}


?>
</div>

<?php include('includes/footer.php'); ?>
