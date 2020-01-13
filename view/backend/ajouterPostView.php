<?php
	session_start();
	$title = 'Jean Forteroche, Billet simple pour l\'Alaska';
?>

<?php ob_start(); ?>

	<header>
		<!--<p>Bonjour <?= $_SESSION['pseudo']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</p>-->
		<button type="button" class="hello-pseudo">Bonjour <?= $_SESSION['pseudo']; ?></button>
		<button type="button" class="button"><a href="http://forteroche.zakbe.fr">HOME</a></button>
		<button type="button" class="button"><a href="index.php?action=deconnexion">SE DECONNECTER</a></button>
	</header>
	<section id="sect01">
		<h1>Jean Forteroche, Billet simple pour l'Alaska</h1> 
		<div class="formulaire">
			<h3>Il faut renseigner un titre et un contenu !</h3>
			<form action="../../index.php?action=ajouterPost" method="post">
				<p>
				<label for="titre">Titre : </label>
				<input type="text" name="titre" />
				<br />
				<br />
				<label for="contenu">Contenu :</label>
				<br />
				<br /><textarea name="contenu" rows="8" cols="45"></textarea>
				<br />
				<br />
				<br /><input type="submit" value="Ajouter" />
				</p>
			</form>
		</div>		
	</section>
			
<?php $content = ob_get_clean(); ?>

<?php require('templateAjoutPost.php'); ?>