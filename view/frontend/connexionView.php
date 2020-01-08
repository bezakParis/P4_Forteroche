<?php $title = 'Jean Forteroche, Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

	<section id="sect01">
	<h1>Jean Forteroche, Billet simple pour l'Alaska</h1> 
		
	<h1>Connexion</h1>
		
	<div class="formulaire">
		<h3>Veuillez saisir vos identifiants</h3>
		
		<form action="../../index.php?action=connexion" method="post">
			<p>
			<label for="pseudo">Pseudo : </label>
			<input type="text" name="pseudo" required />
			<br />
			<br />
			<label for="pwd">Mot de passe : </label>
			<input type="password" name="pwd" required />
			<br />
			<br />
			<br />
			<input type="submit" value="Valider" />
			</p>
		</form>
		</div>		
	</section>
			
<?php $content = ob_get_clean(); ?>

<?php require('templateConnection.php'); ?>