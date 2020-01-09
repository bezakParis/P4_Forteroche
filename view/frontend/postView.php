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
			<form action="ajoutCommentaire.php" method="post">
				<p>
				<br />
				<br />
				<label for="message">Message :</label>
				<br />
				<br /><textarea name="message" rows="8" cols="45"></textarea>
				<br />
				<br />
				<!--<input type="hidden" name="ID_Billet" value="<?php echo $ID_var; ?>" />-->
				<br /><input type="submit" value="Envoyer" />
				</p>
			</form>				
		</div>		
		<?php
			
			if ($comment) {
				// On affiche les commentaires	
				while ($dataComment = $comment->fetch())
				{
		?>
		
					<div class="commentaires">
						<h3>Commentaires</h3>
						<h5><?php echo htmlspecialchars($dataComment['pseudo']); ?> le : <?php echo $dataComment['comment_date']; ?></h5>
						<p><?php echo nl2br(htmlspecialchars($dataComment['comment'])); // nl2br permet de convertir les retours à la ligne en balises HTML <br />  ?></p><br />
					</div>
		<?php
				}
				$comment->closeCursor(); // Termine le traitement de la requête
	
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