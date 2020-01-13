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
			$data = $post;
		?>
				
		<div class="news"> 
			<h3><?php echo htmlspecialchars($data['title']); ?> le : <?php echo $data['creation_date_fr']; ?></h3>
			<p><?php echo nl2br(htmlspecialchars($data['content'])); // nl2br permet de convertir les retours à la ligne en balises HTML <br /> ?>
			<br />&nbsp;</p>
		</div>		
		
		<div class="formulaire">	
			<form action="index.php?action=ajoutCommentaire" method="post">
				<p>
				<br />
				<br />
				<label for="commentaire">Commentaire :</label>
				<br />
				<br /><textarea name="commentaire" rows="8" cols="45"></textarea>
				<br />
				<br />
				<input type="hidden" name="post_id" value="<?php echo $data['id']; ?>" />
				<br /><input type="submit" value="Envoyer" />
				</p>
			</form>				
		</div>
		<h3>Commentaires</h3>		
		<?php
			
			if ($comments) {
				// On affiche les commentaires	
				while ($dataComment = $comments->fetch())
				{
		?>
		
					<div class="commentaires">
						<?php
							if ($dataComment['c_moderate'] == 1) {
						?>
							<p><strong>Insérer symbole pour indiquer que ce commentaire a été signalé</strong></p>
						<?php	
							}
						?>
						<h5><?php echo htmlspecialchars($dataComment['m_pseudo']); ?> le : <?php echo $dataComment['comment_date_fr']; ?></h5>
						<p><?php echo nl2br(htmlspecialchars($dataComment['c_comment'])); // nl2br permet de convertir les retours à la ligne en balises HTML <br />  ?></p>
						
						<?php
							if ($dataComment['c_moderate'] == 0) {
						?>
							<p><a href="index.php?action=signalerComment&commentId=<?= $dataComment['c_id']; ?>&postId=<?= $data['id']; ?>"">Signaler</a></p>
						<?php	
							}
						?>
						<p>&nbsp;</p>
					</div>
					<p>&nbsp;</p>
		<?php
				}
				$comments->closeCursor(); // Termine le traitement de la requête
	
			}
			else {
				// pas de commentaire	
			?>
		
				<div class="commentaires">
					<h3>Commentaires</h3>
					<h5>Pas encore de commentaire</h5>
				</div>
			<?php	
				
				
			}
			
		?>
			
			
			
			
			
	</section>
			
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>