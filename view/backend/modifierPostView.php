<?php
    session_start();
    $title = 'Jean Forteroche, Billet simple pour l\'Alaska';
    ?>
	
<?php ob_start(); ?>

<header>
    <button type="button" class="hello-pseudo">Bonjour <?= $_SESSION['pseudo']; ?></button>
    <button type="button" class="button"><a href="http://forteroche.zakbe.fr">HOME</a></button>
    <button type="button" class="button"><a href="index.php?action=deconnexion">SE DECONNECTER</a></button>
</header>

<section id="sect01">

    <h1>Jean Forteroche, Billet simple pour l'Alaska</h1>
	
    <?php
        $data = $post;
        ?>
		
    <div class="formulaire">
        <h3>Ci-dessous le post à modifier</h3>
        <form action="../../index.php?action=validerPost" method="post">
            <p>
                <label for="titre">Titre : </label>
                <input type="text" name="titre" value="<?php echo htmlspecialchars($data['title']); ?>" />
                <br />
                <br />
                <label for="contenu">Contenu :</label>
                <br />
                <br /><textarea name="contenu" rows="8" cols="45"><?php echo $data['content']; ?></textarea>
                <br />
                <br />
                <input type="hidden" name="post_id" value="<?php echo $data['id']; ?>" />
                <br /><input type="submit" value="Valider" />
            </p>
        </form>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>