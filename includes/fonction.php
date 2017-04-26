<?php
session_start();

try{
	$user = 'xxx';
	$mdp = 'xxx';
	$bdd = new PDO('mysql:host=xxx;dbname=xxx;charset=utf8', $user, $mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch (Exception $e){
	die('Erreur : ' . $e->getMessage());	
} 



function passertest(){
	if(isset($_SESSION['user']['type'])){
		if($_SESSION['user']['type']=='free'){
			if($_SESSION['user']['test'] == null){
				header('location: passertest.php');
				exit();
			}	
		}
	}
}

function onlynoco(){
	if (isset($_SESSION['user']['type'])){
		header('location:indexbis.php');
		exit();
	}	
}

function onlyco(){
	if (empty($_SESSION['user']['type'])){
		header('location:connexion.php');
		exit();
	}
}
function onlyent(){
	if ($_SESSION['user']['type'] =='free'){
		header('location:indexbis.php');
		exit();
	}
}

function onlyfree(){
	if ($_SESSION['user']['type']=='ent'){
		header('location:indexbis.php');
		exit();
	}
}
function onlyadmin(){
	if ($_SESSION['user']['type']!='adm'){
		header('location:indexbis.php');
		exit();
	}
}
function onlynoadmin(){
	if($_SESSION['user']['type']=='adm'){
		header('location:indexbis.php');
		exit();
	}
}
?>

