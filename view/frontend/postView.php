<?php
    session_start();
    $title = 'Jean Forteroche, Billet simple pour l\'Alaska';
    ?>
	
<?php ob_start(); ?>

<header>
	<h1>Jean Forteroche  -  Billet simple pour l'Alaska</h1>
	<div class="nav">
		<button type="button" class="hello-pseudo">Bonjour <?= $_SESSION['pseudo']; ?></button>
		<a href="index.php?action=deconnexion"><button type="button" class="button btn-nav">SE DECONNECTER</button></a>
	</div>
    <a href="../../index.php"><i class="fas fa-home"></i></a>
</header>

<section id="sect01">
    <?php
        $data = $post;
        ?>
	
    <div class="contener">
		<div class="news">
			<h3><?php echo htmlspecialchars($data['title']); ?> le : <?php echo $data['creation_date_fr']; ?></h3>
			<p><?php echo $data['content']; ?>
				<br />&nbsp;
			</p>
		</div>
    </div>
    <div class="formulaire formulaire-commentaire">
        <form action="index.php?action=ajoutCommentaire" method="post">
                <label for="commentaire">Commentaire :</label>
                <br /><textarea name="commentaire"></textarea>
                <input type="hidden" name="post_id" value="<?php echo $data['id']; ?>" />
                <br /><input id="valider-commentaire" type="submit" value="Envoyer" />
        </form>
    </div>
	
	
    <h3>Commentaires</h3>
	
    <?php
		$count = $comments->rowCount();
        if ($count > 0) {
        		
        	while ($dataComment = $comments->fetch())
        	{
        ?>
	
    <div class="contener">
		<div>
			<h5><?php echo htmlspecialchars($dataComment['m_pseudo']); ?> le : <?php echo $dataComment['comment_date_fr']; ?></h5>
		</div>
		<div class="commentaires">
			<?php
				if ($dataComment['c_moderate'] == 1) {
				?>
			<p><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;à modérer</p>
			<?php	
				}
				?>
			<p><?php echo nl2br(htmlspecialchars($dataComment['c_comment']));  ?></p>
		</div>
		<?php
			if ($dataComment['c_moderate'] == 0) {
			?>
		<div>
			<a href="index.php?action=signalerComment&commentId=<?= $dataComment['c_id']; ?>&postId=<?= $data['id']; ?>"><button type="button" class="button	btnComment"><i class="far fa-flag"></i>&nbsp;&nbsp;Signaler</button></a>
		</div>
		<?php	
			}
			?>
	</div>
    <?php
        }
        $comments->closeCursor();
        
        }
        else {
        // pas de commentaire	
        ?>
    <div class="aucun-commentaires">
        <h5>Pas encore de commentaire</h5>
    </div>
    <?php	
        }
        
        ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>