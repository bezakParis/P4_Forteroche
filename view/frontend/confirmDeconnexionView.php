<?php $title = 'Jean Forteroche, Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<header>
	<h1>Jean Forteroche  -  Billet simple pour l'Alaska</h1>
	<div id="h1-mobile">Jean Forteroche<br />Billet simple pour l'Alaska</div>
    <a href="../../index.php"><i class="fas fa-home"></i></a>
</header>

<section id="sect01">

	<div id="message-information">
		<p>Vous êtes bien déconnecté(e).</p>
		
	</div>

	
</section>
			
<?php $content = ob_get_clean(); ?>

<?php require('templateConnection.php'); ?>