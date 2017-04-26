<?php require_once 'includes/fonction.php';


$_SESSION['connexion']= '';
if(!empty($_POST['mail']) && !empty($_POST['password'])){
	$req=$bdd->prepare('SELECT * FROM Admin WHERE mail=?');
	$req->execute(array($_POST['mail']));
	$user=$req->fetch();
	
	if (!empty($user['mail'])){
		if($user['mail']==$_POST['mail'] && $user['mdp']==$_POST['password']){
			$_SESSION['user']['type']='adm';
	        $_SESSION['user']['nom']='admin';
	        

		}else{

		}

	}else{

		if(!empty($_POST['choix'])){
			$req=$bdd->prepare('SELECT * FROM Societe WHERE mail=?');
			$_SESSION['choix']='ent';
		}else{
			$req=$bdd->prepare('SELECT * FROM Freelancer WHERE mail=?');
			$_SESSION['choix']='free';
		}
		
		$req->execute(array($_POST['mail']));
		$user=$req->fetch();
		if(empty($user['mail'])){
			$_SESSION['connexion']=$_SESSION['connexion']."<li>Votre mail n'existe pas, veuillez d'abord verifier que vous avez coché la case si vous êtes une société.</li>";
			header('location: connexion.php');
			exit();
		}
		if(password_verify($_POST['password'],$user['mdp'])){
			if($_SESSION['choix']=='ent'){
					$_SESSION['user']=$user;
					$_SESSION['user']['type']='ent';
			}else{
				$_SESSION['user']=$user;
				$_SESSION['user']['type']='free';	
			}
		}else{
			$_SESSION['connexion']=$_SESSION['connexion']."<li>Le mot de passe ne correspond pas a l'email.</li>";
			header('location: connexion.php');
			exit();
		}
		unset($_SESSION['connexion']);
	}
}
onlyco();

 ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>R.y.n Company</title>
	<link rel="icon" type="image/png" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/headfoot.css"/>
	<link rel="stylesheet" type="text/css" href="css/indexbis.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</head>
<?php include('includes/header.php'); ?>
	<div class="container-fluid" style="width:100%;min-height:100vh;" id="main">
	
		<div id="jesuisent">
			<p class="btn-ent">Je suis une entreprise</p>
			<div class="row" style="padding:30px 40px 70px 40px;">
        		<div class="col-xs-4 coll bleu">Trouvez en quelques heures les meilleurs intervenants pour vos projets informatiques.
Notre base comprend plus de 2500 profils.
</div>
				<div class="col-xs-4 coll bleu">Vous fixez le salaire,Vous recherchez un profil adapté à votre projet,VOUS choississez. </div>
				
				<div class="col-xs-4 coll bleu dernier">Tout les freelancer sont reçu après avoir passé un test, vous n'aurez plus de mauvaises surprises !</div>
			</div>
		</div>
		<div id="jesuisfree">
			<p class="btn-free">Je suis un freelancer</p>
			<div class="row" style="padding:30px 40px 70px 40px;">
        		<div class="col-xs-4 jaune coll">A la recherche d'une mission ? Qu'importe la durée vous êtes au bon endroit ! Inscription rapide et gratuite.</div>
				<div class="col-xs-4 jaune coll">Montrez votre expertise en passant un test d'entré, les entrprises inscrites ici recherche les meilleurs, prouvez que vous en faites parti !</div>
				
				<div class="col-xs-4 coll jaune dernier">Après la fin d'une mission, vous êtes payé immediatement, votre motivation fait parti du coeur de la platforme.</div>
			</div>
		</div>






		
	</div>
	<?php include('includes/footer.php'); ?>