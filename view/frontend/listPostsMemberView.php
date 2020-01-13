<?php
	session_start();
	$title = 'Jean Forteroche, Billet simple pour l\'Alaska';
?>

<?php ob_start(); ?>

	<header>
		<!--<p>Bonjour <?= $_SESSION['pseudo']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</p>-->
		<button type="button" class="hello-pseudo">Bonjour <?= $_SESSION['pseudo']; ?></button>
		<button type="button" class="button"><a href="index.php?action=deconnexion">SE DECONNECTER</a></button>
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
					<p><?= $data['content']; ?></p>
					<p><a href="index.php?action=post&id=<?= $data['id']; ?>">Commentaires</a></p>
				</div>
				<br />
			
			<?php
			}
			$posts->closeCursor();
			?>
	</section>
			
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>