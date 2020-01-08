<?php $title = 'Jean Forteroche, Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

	<header>
		<button type="button" class="button"><a href="view/frontend/inscriptionView.php">S'INSCRIRE</a></button>
		<button type="button" class="button"><a href="view/frontend/connexionView.php">SE CONNECTER</a></button>
	</header>
	<section id="sect01">
		<h1>Jean Forteroche, Billet simple pour l'Alaska</h1> 
	
		<div id="deconnexion">
			<p>Vous êtes bien déconnecté(e).
			<br />
			<a href="index.php">Retour sur le site</a></p>
			
		</div>
	
		
	</section>
			
<?php $content = ob_get_clean(); ?>

<?php require('templateConnection.php'); ?>