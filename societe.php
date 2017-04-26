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
	<link rel="stylesheet" type="text/css" href="css/freelancer.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</head>
<?php include('includes/header.php'); ?>
	<div class="container-fluid main" style="width: 100%;min-height:100vh;">
<?php 
			

$req =$bdd->query("SELECT * FROM Societe");
?> 
<table class='table table-condensed' style="padding-top: 100px;margin-top: 10px">
<thead>
<tr> 
<th>Nom</th> 
<th>No SIRET</th> 
<th>Chiffre d'affaires</th> 
<th>Nombre projet</th> 
<th>Date d'inscription</th> 


</tr> </thead>
<?php
while ($donnees = $req->fetch()){

echo "<tr><td><a href='profil.php?idso=".  $donnees['idso']  ."'>" . $donnees['nom'] . "</a></td>";

echo "<td> ".   $donnees['nosiret']   . "</td>";
echo "<td> ".   $donnees['ca']   . "</td>";
echo "<td> ".   $donnees['nbprojet']   . "</td>";
echo "<td> ".   $donnees['dateinscrit']   . "</td></tr>";

}



?>

</table>



		
	</div>
	<?php include('includes/footer.php'); ?>
