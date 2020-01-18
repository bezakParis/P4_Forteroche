<?php $title = 'Jean Forteroche, Billet simple pour l\'Alaska - Connexion'; ?>

<?php ob_start(); ?>

<header>
	<h1>Jean Forteroche  -  Billet simple pour l'Alaska</h1>
	<div id="h1-mobile">Jean Forteroche<br />Billet simple pour l'Alaska</div>
    <a href="../../index.php"><i class="fas fa-home"></i></a>
</header>


<section id="sect01">
	
	<div class="formulaire connexion">
		<h3>Veuillez saisir vos identifiants</h3>
	
		<form action="../../index.php?action=connexion" method="post">
			<div class="row">
					<label for="pseudo">Pseudo : </label>
					<input type="text" name="pseudo" required />
			</div>
			<div class="row">
					<label for="pwd">Mot de passe : </label>
					<input type="password" name="pwd" required />
			</div>
			<div class="row">
				<input type="submit" value="Valider" />
			</div>
		</form>
	</div>		
</section>
			
<?php $content = ob_get_clean(); ?>

<?php require('templateConnection.php'); ?>