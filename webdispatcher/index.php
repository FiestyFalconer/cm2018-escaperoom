<?php
/*
  Author      : Guillaume Pin
  Date        : 25.09.2018
  Description : data management
*/
require("pdo.php");
?>
<html>
<head>
</head>
<body>
<h1> Page de test </h1>
<?php
foreach (getInfoGameInProgress() as $key => $donnees)
{
  ?>
  <h1><?php echo "Numéro de partie : ".$donnees['idgameinprogress']; ?></h1></br>
  <b><?php echo "Début de la partie : ".$donnees['timestart']; ?></b></br>
  <b><?php echo "Validation de la première étape : ".$donnees['timefirststep']; ?></b></br>
  <b><?php echo "Validation de la deuxième étape : ".$donnees['timesecondestep']; ?></b></br>
	<b><?php echo "Validation de la dernière étape : ".$donnees['timeend']; ?></b></br>
	<b><?php echo "Valeur de la partie : ".$donnees['idgame']; ?></b></br>
	<br/>
<?php
}
?>
<form action="start.php" methodFR="post">
<p>
    <input type="submit" value="Start" />
</p>
</form>
<form action="step1.php" methodFR="post">
<p>
    <input type="submit" value="Etape 1" />
</p>
</form>
<form action="step2.php" methodFR="post">
<p>
    <input type="submit" value="Etape 2" />
</p>
</form>
<form action="end.php" methodFR="post">
<p>
    <input type="submit" value="Fin" />
</p>
</form>
<form action="giveup.php" methodFR="post">
<p>
    <input type="submit" value="Give Up" />
</p>
</form>
</body>
</html>
