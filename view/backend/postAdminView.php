<?php
    session_start();
    $title = 'Jean Forteroche, Billet simple pour l\'Alaska';
    ?>
	
<?php ob_start(); ?>

<header>
    <button type="button" class="hello-pseudo">Bonjour <?= $_SESSION['pseudo']; ?></button>
    <button type="button" class="button"><a href="index.php">HOME</a></button>
    <button type="button" class="button"><a href="index.php?action=deconnexion">SE DECONNECTER</a></button>
</header>

<section id="sect01">

    <h1>Jean Forteroche, Billet simple pour l'Alaska</h1>
	
    <?php
        $data = $post;
        ?>
		
    <div class="news">
        <h3><?php echo htmlspecialchars($data['title']); ?> le : <?php echo $data['creation_date_fr']; ?></h3>
        <p><?php echo $data['content']; ?></p>
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
		$count = $comments->rowCount();
        if ($count > 0) {
        		
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
        <p><?php echo nl2br(htmlspecialchars($dataComment['c_comment']));  ?></p>
        <p><a href="index.php?action=supprimerComment&id=<?= $dataComment['c_id']; ?>&post_id=<?php echo $data['id']; ?>">Supprimer</a></p>
        <?php
            if ($dataComment['c_moderate'] == 1) {
            ?>
        <p><a href="index.php?action=accepterComment&id=<?= $dataComment['c_id']; ?>&post_id=<?php echo $data['id']; ?>">Accepter</a></p>
        <?php	
            }
            ?>
    </div>
	
    <p>&nbsp;</p>
	
    <?php
        }
        $comments->closeCursor(); // Termine le traitement de la requête
        
        }
        else {
        // pas de commentaire	
        ?>
		
    <div class="aucun_commentaires">
        <h5>Pas encore de commentaire</h5>
    </div>
	
    <?php	
        }
        
        ?>
		
</section>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>