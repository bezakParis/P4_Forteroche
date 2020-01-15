<?php $title = 'Jean Forteroche, Billet simple pour l\'Alaska - Connexion'; ?>

<?php ob_start(); ?>

<header>
	<h1>Jean Forteroche  -  Billet simple pour l'Alaska</h1>
    <a href="../../index.php"><button type="button" class="button">HOME</button></a>
</header>


<section id="sect01">
	
	<div class="formulaire connexion">
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