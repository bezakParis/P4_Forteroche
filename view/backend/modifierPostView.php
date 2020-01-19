<?php
    session_start();
    $title = 'Jean Forteroche, Billet simple pour l\'Alaska';
    ?>
	
<?php ob_start(); ?>

<header>
	<h1>Jean Forteroche  -  Billet simple pour l'Alaska</h1>
	<div id="h1-mobile">Jean Forteroche<br />Billet simple pour l'Alaska</div>
	<div class="nav">
		<a href="../../index.php?action=deconnexion"><button type="button" class="button btn-nav">SE DECONNECTER</button></a>
	</div>
	<a href="../../index.php"><i class="fas fa-home"></i></a>
</header>

<section id="sect01">

    <?php
        $data = $post;
        ?>
		
    <div class="formulaire formulaire-ajout">
        <form action="../../index.php?action=validerPost" method="post">
                <label for="titre">Titre : </label>
                <input type="text" name="titre" value="<?php echo htmlspecialchars($data['title']); ?>" />
                <label for="contenu">Contenu :</label>
                <textarea  id="redaction" name="contenu" rows="8" cols="45"><?php echo ($data['content']); ?></textarea>
                <input type="hidden" name="post_id" value="<?php echo $data['id']; ?>" />
                <input type="submit" id="valider-redaction"  value="Valider" />
        </form>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>