<?php require_once 'includes/fonction.php';
onlyfree();
?>

    <!DOCTYPE html>
    <html>
<head>
    <meta charset="utf-8">
    <title>R.y.n Company</title>
    <link rel="icon" type="image/png" href="img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="css/headfoot.css"/>
    <link rel="stylesheet" type="text/css" href="css/lecssdecettepageanepasoublierbordel.css"/>
    <link href="https://fonts.googleapis.com/css?family=Cookie|Courgette|Dancing+Script|Handlee" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</head>
<?php include('includes/header.php'); ?>
<div>
    <?Php

    if($_SESSION['user']['valide'] == 1){
        header('location:indexbis.php');
    }
    if(isset($_POST) && !empty($_POST)){
        $id = $_SESSION['user']['idfree'];
        $req=$bdd->prepare('SELECT * FROM Freelancer WHERE idfree=?');
        $req->execute(array($id));
        $user=$req->fetch();
        $req->closeCursor();
        if($user['valide'] == 0){
            $requeteupdate = $bdd->prepare('UPDATE Freelancer SET valide = ?, test = ?   WHERE idfree = ?');
            $requeteupdate->execute(array(1, $_POST['score'], $user['idfree']));
            $_SESSION['user']['valide'] = 1;
            $_SESSION['user']['test'] = $_POST['score'];
            header('location:indexbis.php');
            exit();

        }


    }
    ?>
    <center><h1><strong>Test de connaissances informatiques</h1><strong></center>
    <br> <br>
    <p> Le test est nécéssaire pour postuler à un projet. Il permet aux sociétés d'avoir un contrôle sur les connaissances que vous dites posséder.</p> <br>
    <form name="myform" method="POST" action="">
        <h3><strong>Question n: 1</strong></h3>
        Quel est le r&ocirc;le du navigateur web ?<br/>
        <ul>
            <li><input type="checkbox" name="q1r1" value="1"  id="A" /><label for="q1r1">Ecrire du code en HTML et CSS</label></li>
            <li><input type="checkbox" name="q1r2" value="2" id="B" /><label for="q1r2">Traduire le code HTML et CSS en un r&eacute;sultat visuel</label></li>
            <li><input type="checkbox" name="q1r3" value="3" id="C" /><label for="q1r3">Se connecter au r&eacute;seau Wifi</label></li>
            <li><input type="checkbox" name="q1r4" value="4" id="D" /><label for="q1r4">Fournir votre site web &agrave; vos visiteurs</label></li>
        </ul><br>

        <h3><strong>Question n: 2</strong></h3>
        Pourquoi l'attribut alt est-il obligatoire pour les images ?<br/>
        <ul>
            <li><input type="checkbox" name="q2r1" id="E"/><label for="q2r1">Parce qu'il indique la taille de l'image</label></li>
            <li><input type="checkbox" name="q2r2" id="F"/><label for="q2r2">Parce qu'il permet de conserver la compatibilit&eacute; avec les vieux navigateurs</label></li>
            <li><input type="checkbox" name="q2r3" id="G"/><label for="q2r3">Parce qu'il indique ce que contient l'image pour les non-voyants et les moteurs de recherche</label></li>
            <li><input type="checkbox" name="q2r4" id="H"/><label for="q2r4">Cet attribut n'est pas obligatoire : seul src est requis</label></li>
        </ul><br>

        <h3><strong>Question n :3</strong></h3>
        Quelle est l&acute;extension standard pour les fichiers contenant du code JavaScript ?<br/>
        <ul>
            <li><input type="checkbox" name="q3r1" id="I"id=""id=""/><label for="q3r1">.javascript</label></li>
            <li><input type="checkbox" name="q3r2" id="J"id=""/><label for="q3r2">.js</label></li>
            <li><input type="checkbox" name="q3r3" id="K"/><label for="q3r3">.html</label></li>
        </ul><br>

        <h3><strong>Question n :4</strong></h3>
        Quel type suivant n&acute;est pas l&acute;un des types de bases du langage JavaScript ?<br/>
        <ul>
            <li><input type="checkbox" name="q4r1" id="L"/><label for="q4r1">Nombre</label></li>
            <li><input type="checkbox" name="q4r2" id="M"/><label for="q4r2">Entier</label></li>
            <li><input type="checkbox" name="q4r3" id="N"/><label for="q4r3">Cha&icirc;ne</label></li>
            <li><input type="checkbox" name="q4r4" id="O"/><label for="q4r4">Bool&eacute;en</label></li>
        </ul><br>

        <h3><strong>Question n :5</strong></h3>
        Si une variable a pour r&ocirc;le de stocker le montant total d&acute;une facture, quel nom doit-on lui donner pour &ecirc;tre conforme à la norme camelCase
        <br/>
        <ul>
            <li><input type="checkbox" name="q5r1" id="P"/><label for="q5r1"></label>total_facture</li>
            <li><input type="checkbox" name="q5r2" id="Q"/><label for="q5r2"></label>totalFacture</li>
            <li><input type="checkbox" name="q5r3" id="R"/><label for="q5r3"></label>TotalFacture</li>
            <li><input type="checkbox" name="q5r4" id="S"/><label for="q5r4">F</label>totalfacture</li>
        </ul><br>

        <h3><strong>Question n :6</strong></h3>
        Qu&acute;est-ce qui est indispensable au bon fonctionnement d&acute;un site web &eacute;crit avec PHP afin qu&acute;il s&acute;affiche correctement dans un navigateur ?<br/>
        <ul>
            <li><input type="checkbox" name="q6r1" id="T"/><label for="q6r1">Un serveur web (Apache, Nginx…)</label></li>
            <li><input type="checkbox" name="q6r2" id="U"/><label for="q6r2"></label>PHP</li>
            <li><input type="checkbox" name="q6r3" id="V"/><label for="q6r3"></label>Un navigateur</li>
            <li><input type="checkbox" name="q6r4" id="W"/><label for="q6r4">F</label>Un IDE</li>
        </ul><br>

        <h3><strong>Question n :7</strong></h3>
        Quels logiciels sont inclus dans WAMP ?<br/>
        <ul>
            <li><input type="checkbox" name="q7r1" id="X"/><label for="q7r1">Apache, PHP, Winamp</label></li>
            <li><input type="checkbox" name="q7r2" id="Y"/><label for="q7r2">PHP, Apache, Chrome</label></li>
            <li><input type="checkbox" name="q7r3" id="Z"/><label for="q7r3">PHP, Apache, MySQL</label></li>
            <li><input type="checkbox" name="q7r4" id="AB"/><label for="q7r4">Comanche, Tango, Vaudou</label></li>
        </ul><br>

        <h3><strong>Question n :8</strong></h3>
        Pouvez-vous d&eacute;velopper un programme Java sans IDE ?<br/>
        <ul>
            <li><input type="checkbox" name="q8r1" id="AC"/><label for="q8r1">Non</label></li>
            <li><input type="checkbox" name="q8r2" id="AD"/><label for="q8r2">Oui, avec Word</label></li>
            <li><input type="checkbox" name="q8r3" id="AE"/><label for="q8r3">Oui, avec n&acute;importe quel &eacute;diteur de fichier texte (Notepad++, bloc note Windows…)</label></li>
            <li><input type="checkbox" name="q8r4" id="AF"/><label for="q8r4">Oui, avec Netbeans</label></li>
        </ul><br>

        <h3><strong>Question n :9</strong></h3>
        Quel est la valeur de la variable ci-dessous :<br/>
        int entier = 0xFE;
        <br/>
        <ul>
            <li><input type="checkbox" name="q9r1" id="AG"/><label for="q9r1">Rien, cette variable est mal initialis&eacute;e.</label></li>
            <li><input type="checkbox" name="q9r2" id="AH"/><label for="q9r2">Rien, FE n&acute;est pas un entier mais des caract&egrave;res !</label></li>
            <li><input type="checkbox" name="q9r3" id="AI" /><label for="q9r3">254</label></li>
            <li><input type="checkbox" name="q9r4" id="AJ"/><label for="q9r4">32</label></li>
        </ul><br>

        <h3><strong>Question n :10</strong></h3>
        Comment se construit une m&eacute;thode ?
        <br/>
        <ul>
            <li><input type="checkbox" name="q10r1" id="AK"/><label for="q10r1">Avec une port&eacute;e, un type de retour, un nom, des param&egrave;tres (ou non) et un corps</label></li>
            <li><input type="checkbox" name="q10r2" id="AL"/><label for="q10r2">Avec une port&eacute;e, un nom, des param&egrave;tres (ou non) et un corps</label></li>
            <li><input type="checkbox" name="q10r3" id="AM"/><label for="q10r3">Avec une port&eacute;e, un type de retour, des param&egrave;tres (ou non) et un corps</label></li>
            <li><input type="checkbox" name="q10r4" id="AN"/><label for="q10r4">Avec une port&eacute;e, un type de retour, des param&egrave;tres (ou non)</label></li>
            <input type="hidden" name="score" value=""/>
        </ul><br>
        <center>
            <input type="submit" value="Test" onclick="testformulaire()" />
            <input type="reset" value="Effacer"/>


        </center>


    </form>



    <script>


        function testformulaire(){

            var score = 0;


            var A = document.getElementById("A");
            var B = document.getElementById("B");
            var C = document.getElementById("C");
            var D = document.getElementById("D");
            var E = document.getElementById("E");
            var F = document.getElementById("F");
            var G = document.getElementById("G");
            var H = document.getElementById("H");
            var I = document.getElementById("I");
            var J = document.getElementById("J");
            var K = document.getElementById("K");
            var L = document.getElementById("L");
            var M = document.getElementById("M");
            var N = document.getElementById("N");
            var O = document.getElementById("O");
            var P = document.getElementById("P");
            var Q = document.getElementById("Q");
            var R = document.getElementById("R");
            var S = document.getElementById("S");
            var T = document.getElementById("T");
            var U = document.getElementById("U");
            var V = document.getElementById("V");
            var W = document.getElementById("W");
            var X = document.getElementById("X");
            var Y = document.getElementById("Y");
            var Z = document.getElementById("Z");
            var AB = document.getElementById("AB");
            var AC = document.getElementById("AC");
            var AD = document.getElementById("AD");
            var AE = document.getElementById("AE");
            var AF = document.getElementById("AF");
            var AG = document.getElementById("AG");
            var AH = document.getElementById("AH");
            var AI = document.getElementById("AI");
            var AJ = document.getElementById("AJ");
            var AK = document.getElementById("AK");
            var AL = document.getElementById("AL");
            var AM = document.getElementById("AM");
            var AN = document.getElementById("AN");






            if(A.checked == false && B.checked == true && C.checked == false && D.checked == false){
                score ++;
            }

            if(E.checked == false && F.checked == false && G.checked == true && H.checked == false){
                score ++;
            }

            if(I.checked == false && J.checked == true && K.checked == false){
                score ++;
            }

            if(L.checked == false && M.checked == true && N.checked == false && O.checked == false){
                score ++;
            }

            if(P.checked == false && Q.checked == true && R.checked == false && S.checked == false){
                score ++;
            }
            if(T.checked == true && U.checked == false && V.checked == false && W.checked == false){
                score ++;
            }

            if(X.checked == false && Y.checked == false && Z.checked == true &&  AB.checked == false ){
                score ++;
            }

            if(AC.checked == false && AD.checked == false && AE.checked == true && AF.checked == false){
                score ++;
            }

            if(AG.checked == false && AH.checked == false && AI.checked == true && AJ.checked == false){
                score ++;
            }

            if(AK.checked == true && AL.checked == false && AM.checked == false && AN.checked == false){
                score ++;
            }

            alert('Votre score est de : ' + score + "/10");
            document.getElementsByName("score")[0].value = score;

        }



    </script>

</div>
<?php include('includes/footer.php'); ?>