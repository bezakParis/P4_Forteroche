<?php $title = 'Jean Forteroche, Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

	<header>
		<button type="button" class="button"><a href="view/frontend/inscription.php">S'INSCRIRE</a></button>
		<button type="button" class="button"><a href="index.php?action=connexion">SE CONNECTER</a></button>
	</header>
	<section id="sect01">
	<h1>Jean Forteroche, Billet simple pour l'Alaska</h1> 
	
		<?php
		while ($data = $posts->fetch())
		{
		?>
			
			<div class="news">
				<h3><?= htmlspecialchars($data['title']); ?>
				le : <?= $data['creation_date_fr']; ?></h3>
				<p><?= nl2br(htmlspecialchars($data['content'])); ?></p>
			</div>
			<br />
		
		<?php
		}
		$posts->closeCursor();
		?>
	</section>
			
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>