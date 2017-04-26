<?php require_once 'includes/fonction.php';  
onlyco(); 
?>
<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<title>R.y.n Company</title>
	<link rel="icon" type="image/png" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="css/headfoot.css"/>
	<link rel="stylesheet" type="text/css" href="css/modif.css"/>
	<link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

</head>
<?php include('includes/header.php'); ?>
	
		<?php
			if ($_SESSION['user']['type']=='ent'){ 

        ?>
                <div class="container-fluid" style="width:100%;min-height:100vh;background: linear-gradient(to bottom, #ebf1f6 0%,#abd3ee 48%,#89c3eb 100%,#d5ebfb 100%,#89c3eb 101%);"">
				<form action="includes/modif.php" method="POST">
				<p> <h3> Société </h3>
				<div class=princi >
                <div class="top">
				Nom : <br/><input name="nom" value="<?php echo $_SESSION['user']['nom']?>"> <br>
				N° Siret : <br/><input name="nosiret" value="<?php echo $_SESSION['user']['nosiret']?>"> <br>
                </div>
                <div class="mid">
				Descriptif : <br><textarea style="width:499px; height:250px;" name="desc" ><?php echo $_SESSION['user']['descriptif']?></textarea> <br>
				Chiffre d'affaire : <input name="ca" value="<?php echo $_SESSION['user']['ca']?>"> <br>
                </div>
                <div class="bot">
                <input type="hidden" name="idso" value="<?php echo $_SESSION['user']['idso']?>">
				<button type="submit" class="btn btn-success" href="includes/modif.php">Valider les modifications</button></div></div>
			</p></form></div>
		<?php } ?>
		<?php 
			if ($_SESSION['user']['type']=='free'){ ?>
                <div class="container-fluid" style="width:100%;min-height:100vh;background: linear-gradient(to bottom, rgba(240,249,255,1) 0%,rgba(255,255,255,1) 0%,rgba(216,208,95,1) 100%);">
				<form action="includes/modif.php" method="POST">
				<p> <h3> Freelancer </h3>
				<div class=princi >
                <div class="top">
				Nom : <br/><input name="nom" value="<?php echo $_SESSION['user']['nom']?>" ><br>
				Adresse : <br/><input name="adresse" value="<?php echo $_SESSION['user']['adresse']?>" ><br>
				<input type="hidden" name="idfree" value="<?php echo $_SESSION['user']['idfree'] ?>">
				Ville : <br/><input name="ville" value="<?php echo $_SESSION['user']['ville']?>"> <br>
				Diplôme le plus élevé :<br/> 
				<select name="diplome" id="mySelectBox">
					<option value="Bac">Bac</option>
					<option value="Bac +2">Bac +2</option>
					<option value="Bac +3">Bac +3</option>
					<option value="Bac +5">Bac +5</option>
					<option value="Bac +6 et plus">Bac +6 et plus</option>
				</select>

				 <br>
                 </div>
                 <div class="mid">
				<p>Descriptif : </p><br/><textarea style="width:499px; height:250px;" name="desc"><?php echo $_SESSION['user']['descriptif']?></textarea><br>
                </div>
                <div class="bot">
				Niveau en HTML : 
				<select name="html" id="html">
					<option value="Notions">Notions</option>
					<option value="Débutant">Débutant</option>
					<option value="Intermédiaire">Intermédiaire</option>
					<option value="Expert">Expert</option>
					
				</select>
				 <br>
				
				Niveau en PHP : 
				<select name="php" id="php">
					<option value="Notions">Notions</option>
					<option value="Débutant">Débutant</option>
					<option value="Intermédiaire">Intermédiaire</option>
					<option value="Expert">Expert</option>
					
				</select>
				 <br>
				
				Niveau en JAVA :
				<select name="java" id="java">
					<option value="Notions">Notions</option>
					<option value="Débutant">Débutant</option>
					<option value="Intermédiaire">Intermédiaire</option>
					<option value="Expert">Expert</option>
					
				</select>
				 
				<br>
				Niveau en C : 
				<select name="c" id="c">
					<option value="Notions">Notions</option>
					<option value="Débutant">Débutant</option>
					<option value="Intermédiaire">Intermédiaire</option>
					<option value="Expert">Expert</option>
					
				</select>
				 
				<br>
				Niveau en C# :
				<select name="csharp" id="csharp">
					<option value="Notions">Notions</option>
					<option value="Débutant">Débutant</option>
					<option value="Intermédiaire">Intermédiaire</option>
					<option value="Expert">Expert</option>
					
				</select>
				 <br>
                 </div>
				<button type="submit" class="btn btn-success" href="includes/modif.php">Valider les modifications</button>
				</p></form></div>

			<?php
		}
        if ($_SESSION['user']['type']=='adm') {
            if(!isset($_GET)){
                header('Location: indexbis.php');
                exit();
            }
            if (isset($_GET['idso'])) {
                echo '<div class="container-fluid" style="width:100%;min-height:100vh;background: linear-gradient(to bottom, #ebf1f6 0%,#abd3ee 48%,#89c3eb 100%,#d5ebfb 100%,#89c3eb 101%);">';
                $req = $bdd->prepare('SELECT * FROM Societe WHERE idso=?');
                $req->execute(array($_GET['idso']));
                $user = $req->fetch();
                $req->closeCursor();
                if (!empty($user['mail'])) {
                    ?>
                    <form action="includes/modif.php" method="POST">
                        <p>
                        <h3> Société </h3>
                        <div class=princi>
                        <div class="top">
                            Nom : <br/><input name="nom" value="<?php echo $user['nom'] ?>"> <br>
                            N° Siret : <br/><input name="nosiret" value="<?php echo $user['nosiret'] ?>"> <br>
                            </div>
                            <div class="mid">
                            <p>Descriptif : </p><br><textarea style="width:499px; height:250px;"
                                                       name="desc"><?php echo $user['descriptif'] ?></textarea> <br>
                                                       
                                                       
                            Chiffre d'affaire : <input name="ca" value="<?php echo $user['ca'] ?>"> <br> </div>
                <div class="bot">
                            <input type="hidden" name="idso" value="<?php echo $user['idso']?>">
                            <button type="submit" class="btn btn-success" href="includes/modif.php">Valider les modifications</button>
                       </div> </div>
                        </p></form></div>

                    <?php
                } else {
                    echo "Le profil recherché n'existe pas";
                }
            } else {
                if (isset($_GET['idfree'])) {
                    echo'<div class="container-fluid" style="width:100%;min-height:100vh;background: linear-gradient(to bottom, rgba(240,249,255,1) 0%,rgba(255,255,255,1) 0%,rgba(216,208,95,1) 100%);">';
                    $req = $bdd->prepare('SELECT * FROM Freelancer WHERE idfree=?');
                    $req->execute(array($_GET['idfree']));
                    $user = $req->fetch();
                    $req->closeCursor();
                    if (!empty($user['mail'])) {
                        ?>
                        <form action="includes/modif.php" method="POST">
                            <p>
                            <h3> Freelancer </h3>
                            <div class=princi>
                                <div class="top">
                                Nom : <br/><input name="nom" value="<?php echo $user['nom'] ?>"><br>
                                Adresse : <br/><input name="adresse" value="<?php echo $user['adresse'] ?>"><br>
                                <input type="hidden" name="idfree" value="<?php echo $user['idfree'] ?>">
                                Ville : <br/><input name="ville" value="<?php echo $user['ville'] ?>"> <br>
                                Diplôme le plus élevé :<br/>
                                <select name="diplome" id="mySelectBox">
                                    <option value="Bac">Bac</option>
                                    <option value="Bac +2">Bac +2</option>
                                    <option value="Bac +3">Bac +3</option>
                                    <option value="Bac +5">Bac +5</option>
                                    <option value="Bac +6 et plus">Bac +6 et plus</option>
                                </select>

                                <br>
                                </div>
                                <div class="mid">

                                Descriptif : <br/><textarea style="width:499px; height:250px;"
                                                       name="desc"><?php echo $user['descriptif'] ?></textarea><br>
                                </div>
                                <div class="bot">
                                Niveau en HTML :
                                <select name="html" id="html">
                                    <option value="Notions">Notions</option>
                                    <option value="Débutant">Débutant</option>
                                    <option value="Intermédiaire">Intermédiaire</option>
                                    <option value="Expert">Expert</option>

                                </select>
                                <br>

                                Niveau en PHP :
                                <select name="php" id="php">
                                    <option value="Notions">Notions</option>
                                    <option value="Débutant">Débutant</option>
                                    <option value="Intermédiaire">Intermédiaire</option>
                                    <option value="Expert">Expert</option>

                                </select>
                                <br>

                                Niveau en JAVA :
                                <select name="java" id="java">
                                    <option value="Notions">Notions</option>
                                    <option value="Débutant">Débutant</option>
                                    <option value="Intermédiaire">Intermédiaire</option>
                                    <option value="Expert">Expert</option>

                                </select>
                                
                                <br>
                                Niveau en C :
                                <select name="c" id="c">
                                    <option value="Notions">Notions</option>
                                    <option value="Débutant">Débutant</option>
                                    <option value="Intermédiaire">Intermédiaire</option>
                                    <option value="Expert">Expert</option>

                                </select>

                                <br>
                                Niveau en C# :
                                <select name="csharp" id="csharp">
                                    <option value="Notions">Notions</option>
                                    <option value="Débutant">Débutant</option>
                                    <option value="Intermédiaire">Intermédiaire</option>
                                    <option value="Expert">Expert</option>

                                </select>
                                <br>
                                </div>

                                <button type="submit" class="btn btn-success" href="includes/modif.php">Valider les modifications</button>
                                </p>
                        </form></div>


                        <?php
                    } else {
                        echo "Le profil recherché n'existe pas";

                    }

                }
            }
        }
			 ?>
<script>
<?php if($_SESSION['user']['type'] != "adm"){ ?>
$(window).on('load', function () {
    $('#mySelectBox').val("<?php echo $_SESSION['user']['diplome']; ?>");
    $('#php').val("<?php echo $_SESSION['user']['php']; ?>");
    $('#html').val("<?php echo $_SESSION['user']['html']; ?>");
    $('#java').val("<?php echo $_SESSION['user']['java']; ?>");
    $('#c').val("<?php echo $_SESSION['user']['c']; ?>");
    $('#csharp').val("<?php echo $_SESSION['user']['csharp']; ?>");
});
    <?php
}else{ ?>

$(window).on('load', function () {
    $('#mySelectBox').val("<?php echo $user['diplome']; ?>");
    $('#php').val("<?php echo $user['php']; ?>");
    $('#html').val("<?php echo $user['html']; ?>");
    $('#java').val("<?php echo $user['java']; ?>");
    $('#c').val("<?php echo $user['c']; ?>");
    $('#csharp').val("<?php echo $user['csharp']; ?>");
});

<?php
}
?>
</script>




		
	</div>
	<?php include('includes/footer.php'); ?>