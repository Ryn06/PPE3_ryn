<body>
	<!--<div class="container-fluid">
		<div id="logohead">
			<img src="img/ryn.png" height="85px" width="200px">
			
		</div>-->
		
		<div id="menu" class="container-fluid">
			<nav class="navbar navbar-inverse" style="margin:0;font-family: 'Courgette', cursive;">
			 <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			     
			      <a class="navbar-brand" href="indexbis.php"><img src="img/ryn.png" height="25px" width="60px"></a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        <li><a href="listeprojet.php">Projet</a></li>
			        <li><a href="freelancer.php">Freelancer</a></li>
			        <li><a href="societe.php">Société</a></li>
			        <?php 
			        if(isset($_SESSION['user']['type']) && $_SESSION['user']['type']=='ent'){ ?>
			        	<li><a href="ajoutprojet.php">Déposer un projet</a></li>
			    	<?php } ?>
	


			      </ul>

			      
			      <ul class="nav navbar-nav navbar-right">

			        <li class="dropdown">
			        <a  href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon Compte <span class="caret"></span></a>
			        	<ul class="dropdown-menu">
							<?php
							if (isset($_SESSION['user'])){
								if($_SESSION['user']['type'] == "ent" ||  $_SESSION['user']['type'] == "free"){
									?>
				            <li><a href="profil.php">
				            <?php 
				           	 echo $_SESSION['user']['nom'];
							$req=$bdd->prepare('SELECT COUNT(*) as total FROM Message WHERE id2 = ? AND type2 = ? and vu =0');
							if($_SESSION['user']['type'] == "ent"){
								$id = $_SESSION['user']['idso'];
							}else{
								$id = $_SESSION['user']['idfree'];
							}
							$req->execute(array($id, $_SESSION['user']['type']));
							$projet=$req->fetch();
							$req->closeCursor();
				            ?>
				            </a></li>
							<li><a href="mesprojets.php">Mes projets</a></li>

							<li><a href="message.php">Messages
									<?php
									if($projet['total'] !=0){
										echo " &nbsp  <img alt='icon  new msg' src='img/icon.png' style='width:8%' ";
									}
									?></a></li>
				            <li role="separator" class="divider"></li>
							<?php } ?>
				            <li><a href="disconnect.php">Déconexion</a></li>
				    <?php 
						}else{ 
				    	?>
				    <li><a href="inscription.php">Inscription</a></li>
				    <li> <a href='connexion.php'> Se connecter </a> </li>
				    <?php 
						} 
				    ?>       
			          	</ul>
			       	</li>
			        
			      </ul>
			   </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		</div>
	
