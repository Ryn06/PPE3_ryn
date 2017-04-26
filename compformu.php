<?php require_once 'includes/fonction.php';
$b = '';
$c = '';
$e = '';
if(!empty($_POST) ){ // Verification du précédent FORMULAIRE pages inscription.html
	if(isset($_POST['mail'])){
		$_SESSION['error'] = '';
		if(empty($_POST['mail'])){
			$b = $b . '<li> Votre mail est vide </li>';

		}else{
			if($_POST['choix'] == 'free'){
				$req=$bdd->prepare('SELECT mail FROM Freelancer WHERE mail=:mail');
			}else{
				$req=$bdd->prepare('SELECT mail FROM Societe WHERE mail=:mail');		
			}
			$req->execute(array('mail'=>$_POST['mail']));
			$user=$req->fetch();
			$req->closeCursor();
			if($user){
				$b= $b . "<li> Cette email existe déja. </li>";
			}
		}

		if(empty($_POST['nom'])){
			$b = $b . "<li> Vous n'avez pas entré votre nom. </li>";
		}
		

		if(empty($_POST['mdp'])){
			$b = $b . "<li> Vous n'avez pas entré de mot de passe. </li>";
		}
		if ($_POST['mdp']!= $_POST['mdpbis']){
			$b = $b . "<li> Vous n'avez pas entré deux fois le même mot de passe. </li> ";
		}
		if($b == ''){
			$_SESSION['mail'] = $_POST['mail']; 
			$_SESSION['nom'] = $_POST['nom']; 
			$_SESSION['mdp'] = $_POST['mdp']; 
			$_SESSION['choix'] = $_POST['choix'];
		}else{
			$a = "<ul>Veuillez remplir correctement le formulaire : " . $b . "</ul>";
			$_SESSION['error'] = $a; 
			header('Location: inscription.php');
		}
	}else{

		if($_SESSION['choix'] == 'ent'){
			if(empty($_POST['nosiret']) || !ctype_digit($_POST['nosiret']) || strlen($_POST['nosiret']) != 14){
				$c = $c . "<li> Veuillez rentrer un numéro de Siret composé uniquement de 14 chiffres. </li>";
			}
			$req=$bdd->prepare('SELECT nosiret FROM Societe WHERE nosiret=?');		
			$req->execute(array($_POST['nosiret']));
			$user=$req->fetch();
			$req->closeCursor();
			if($user){
				$c = $c . "<li> Le numéro de SIRET tapé existe déjà. Si vous n'arrivez toujours pas a vous inscrire ou que l'on à utilisé a votre insu votre numéro de SIRET, veuillez contacter l'admin a : RYN@freelancer.fr </li>";
			}
			if(empty($_POST['noment'])){
				$c = $c . "<li> Veuillez rentrer le nom de l'entreprise. </li>";
			}
			if( empty($_POST['ca']) || !ctype_digit($_POST['ca']) || strlen($_POST['ca']) > 15)  {
				$c = $c . "<li> Veuillez rentrer un entier composé uniquement de chiffre et d'un maximum de 14 chiffres </li>";
			}
			if( empty($_POST['desc']) || (strlen($_POST['desc'])< 160 ) ){
				$c = $c . "<li> Veuillez rentrer une description de l'entreprise avec au minimum 160 caractères. </li>";
			}
			$sql = "SELECT mail FROM Societe WHERE mail=?";
			$req =$bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$req->execute(array($_SESSION['mail']));
			$donnees=$req->fetch();
			if(isset($donnees['mail'])){
				$c = $c . "<li> Votre mail existe déja. </li>";
			}
			if($c == ''){
				$password = password_hash($_SESSION['mdp'], PASSWORD_BCRYPT);
				$req=$bdd->prepare('INSERT INTO Societe(mail, nosiret, nom, descriptif, ca, dateinscrit, nbprojet, mdp) VALUES (:mail, :nosiret, :nom, :descriptif, :ca, CURDATE(), :nbprojet, :mdp)');
				$req->execute(array(
				        'mail' => $_SESSION['mail'],
				        'nosiret' => $_POST['nosiret'],
				        'nom' => $_POST['noment'] ,
				        'descriptif' => $_POST['desc'],
				        'ca' => $_POST['ca'] ,
				        'nbprojet' => 0,
				        'mdp' => $password
				        ));
					$c = "Inscription validé, , vous pouvez maintenant <a href='connexion.php'> vous connecter  ici </a>";


			}else{
					$c = "<ul>Veuillez remplir correctement le formulaire : " . $c . "</ul>";
			}

			
		}else{
			if(empty($_POST['numsecu']) || !ctype_digit($_POST['numsecu']) || strlen($_POST['numsecu']) != 15){
				$e = $e . "<li> Veuillez rentrer un numéro de Sécurité Sociale composé uniquement de 15 chiffres. </li>";
			}	
			$req=$bdd->prepare('SELECT nosecu FROM Freelancer WHERE nosecu=?');		
			$req->execute(array($_POST['numsecu']));
			$user=$req->fetch();
			$req->closeCursor();
			if($user){
				$e = $e . "<li> Le numéro de sécurité sociale tapé existe déjà. Si vous n'arrivez toujours pas a vous inscrire ou que l'on à utilisé a votre insu votre numéro de sécurité sociale, veuillez contacter l'admin a : RYN@freelancer.fr </li>";
			}
			if(empty($_POST['adresse'])){
				$e = $e . "<li> Veuillez rentrer votre adresse. </li>";
			}
			if(empty($_POST['ville'])){
				$e = $e . "<li> Veuillez rentrer le nom de votre ville. </li>";
			}
			if( empty($_POST['desc']) || (strlen($_POST['desc'])< 160 ) ){
				$e = $e . "<li> Veuillez rentrer une description de vous d'au moins 160 caractères. </li>";			
			}

			$sql = "SELECT mail FROM Freelancer WHERE mail=?";
			$req =$bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$req->execute(array($_SESSION['mail']));
			$donnees=$req->fetch();
			if(isset($donnees['mail'])){
				$e = $e . "<li> Votre mail existe déja. </li>";
			}
			if($e == ''){

				$password = password_hash($_SESSION['mdp'], PASSWORD_BCRYPT);
				$sql = "INSERT INTO Freelancer(nosecu, mail, mdp, nom, adresse, ville, diplome, descriptif, html, php, java, c, csharp, nbprojet, dateinscrit, valide) VALUES (:nosecu, :mail, :mdp, :nom, :adresse, :ville, :diplome, :descriptif, :html, :php, :java, :c, :csharp, :nbprojet, CURDATE(), :valide)";
				$req = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));	
				$req->execute(array(
					'nosecu' => $_POST['numsecu'],
					'mail' => $_SESSION['mail'],
					'mdp' => $password,
					'nom' => $_SESSION['nom'],
					'adresse' => $_POST['adresse'],
					'ville' => $_POST['ville'],
					'diplome' => $_POST['diplome'],
					'descriptif' => $_POST['desc'],
					'html' => $_POST['html'],
					'php' => $_POST['php'],
					'java' => $_POST['java'],
					'c' => $_POST['c'],
					'csharp' => $_POST['csharp'],
					'nbprojet' => 0,
					'valide' => 0
					));
				$e = "Inscription validée, vous pouvez maintenant <a href='connexion.php'> vous connecter  ici </a> ";

			}else{
				$e = "<ul>Veuillez remplir correctement le formulaire : " . $e . "</ul>";
			}

		}

	}
}else{
	$a = "Veuillez d'abord remplir ce formulaire pour vous inscrire";
	$_SESSION['error'] = $a;
	header('Location: inscription.php');
}




// Verification nouveau formulaire 


?>
	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>R.y.n Company</title>
	<link rel="icon" type="image/png" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/headfoot.css"/>
	
	<link rel="stylesheet" type="text/css" href="css/compformuent.css"/>
	<link rel="stylesheet" type="text/css" href="css/compformu.css"/>
<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</head>
<?php include('includes/header.php');
	if ($_SESSION['choix'] == 'free'){ ?>
<div id="main">
	<div id="compformu">
		<p id="tt">Veuillez compléter vos informations personelles avant de poursuivre.</p><hr/>

		<?php 
		if ($e != ''){
			?>
			<div style="margin-top: 50px"; class="alert alert-danger"> <p class="">
			<?php echo $e ; ?>
			</p> </div>
			<?php } ?>
		
		<form action="" method="POST">
			<div id="formu1">
				<div class="form-group">
				<label> Numéro de sécurité social:
				<input class="form-control" type="text" name="numsecu"></label><br/>
				<label>Adresse:
				<input class="form-control" type="text" name="adresse"></label><br/>
				<label>Ville:
				<input class="form-control" type="text" name="ville"></label><br/>

				<label for="diplome">Diplome le plus haut:</label>
				<p>Bac<input type="radio" name="diplome" checked="checked" value="Bac">&nbsp; Bac+2<input type="radio" name="diplome" value="Bac +2">&nbsp; Bac +3<input type="radio" name="diplome" value="Bac +3">&nbsp; Bac+5<input type="radio" name="diplome" value="Bac +5">&nbsp; Bac+6 et plus<input type="radio" name="diplome" value="Bac +6 et plus"></p>
				<label for="desc" >Descriptif:</label><br/>
				<textarea class="form-control" class="desc" name="desc"></textarea>  <br/>
				</div>
			
		</div>
		<div id="formu2">
			

				<p align="center"><b>Connaissances languages</b></p><br/>
				<label for="html">Html/Css:</label>
				<p> Notions<input type="radio" name="html" value="Notions" checked="checked" >&nbsp; Débutant<input type="radio" value="Débutant" name="html">&nbsp; Intermédiaire<input type="radio" value="Intermédiaire" name="html">&nbsp; Expert<input type="radio" value="Expert" name="html"></p>

				<label for="php">PHP:</label>
				<p> Notions<input type="radio" name="php" value="Notions" checked="checked" >&nbsp; Débutant<input type="radio" value="Débutant" name="php">&nbsp; Intermédiaire<input type="radio" value="Intermédiaire" name="php">&nbsp; Expert<input type="radio" value="Expert" name="php"></p>
				
				<label for="java">Java:</label>
				<p>; Notions<input type="radio" name="java" value="Notions" checked="checked" >&nbsp; Débutant<input type="radio" value="Débutant" name="java">&nbsp; Intermédiaire<input type="radio" value="Intermédiaire" name="java">&nbsp; Expert<input type="radio" value="Expert" name="java"></p>

				<label for="c">C:</label>
				<p> Notions<input type="radio" name="c" value="Notions" checked="checked" >&nbsp; Débutant<input type="radio" value="Débutant" name="c">&nbsp; Intermédiaire<input type="radio" value="Intermédiaire" name="c">&nbsp; Expert<input type="radio" value="Expert" name="c"></p>

				<label for="c#">C#:</label>
				<p> Notions<input type="radio" name="csharp" value="Notions" checked="checked" >&nbsp; Débutant<input type="radio" value="Débutant" name="csharp">&nbsp; Intermédiaire<input type="radio" value="Intermédiaire" name="csharp">&nbsp; Expert<input type="radio" value="Expert" name="csharp"></p>
				</div>
				<button style="margin-top:450px; margin-left:43%;"  type="submit">Valider</button>
			</form>
		
		
	</div>
	</div>
	<?php }else{ ?>
		<?php if ($c != ''){
			?>
			<div style="margin-top: 50px"; class="alert alert-danger"> <p class="">
			<?php echo $c; ?>
			</p> </div>
			<?php } ?>

			<div id="main">
	<div id="compformu2">
		
		<p id="tt">Veuillez compléter vos informations personelles avant de poursuivre.</p><hr/>
		<div id="formu3">
		<form action="" method="POST">

				<div class="form-group">
				<label> Numéro de siret:
				<input class="form-control" type="text" name="nosiret"></label><br/>
				<label>Nom de l'entreprise:
				<input class="form-control" type="text" name="noment"></label><br/>
				
				<label>Chiffre d'affaire:</label>
				<div class="input-group">
				<span class="input-group-addon">€</span>
				<input class="form-control" type="text" name="ca"></div><br/>
				
				<label for="desc" >Descriptif de l'entreprise:</label><br/>
				<textarea class="form-control" class="desc" name="desc"></textarea>  <br/>
				<button style="margin-left:43%;"  type="submit">Valider</button>
				</div>

			</form>
		</div>
		
		
	</div>
	</div>
<?php } 
include('includes/footer.php'); ?>