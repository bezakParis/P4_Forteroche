<?php $title = 'Jean Forteroche, Billet simple pour l\'Alaska- Deconnexion'; ?>

<?php ob_start(); ?>

<header>
	<h1>Jean Forteroche  -  Billet simple pour l'Alaska</h1>
	<div id="h1-mobile">Jean Forteroche<br />Billet simple pour l'Alaska</div>
	<div class="nav">
		<a href="index.php?action=connexionView"><button type="button" class="button btn-nav">SE CONNECTER</button></a>
    </div>
	<a href="../../index.php"><i class="fas fa-home"></i></a>
</header>

<section id="sect01">

	<div id="message-information">
		<p>Vous êtes bien déconnecté(e).</p>
		
	</div>

	
</section>
			
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>