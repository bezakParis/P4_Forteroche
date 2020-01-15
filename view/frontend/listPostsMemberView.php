<?php
    session_start();
    $title = 'Jean Forteroche, Billet simple pour l\'Alaska - Accueil membres';
    ?>
	
<?php ob_start(); ?>

<header>
	<h1>Jean Forteroche  -  Billet simple pour l'Alaska</h1>
    <button type="button" class="hello-pseudo">Bonjour <?= $_SESSION['pseudo']; ?></button>
    <a href="index.php?action=deconnexion"><button type="button" class="button">SE DECONNECTER</button></a>
</header>

<section id="sect01">
    <?php
        while ($data = $posts->fetch())
        {
        ?>
	
    <div class="contener">		
		<div class="news">	
			<h3><?= htmlspecialchars($data['title']); ?>
				le : <?= $data['creation_date_fr']; ?>
			</h3>
			<p><?= $data['content']; ?></p>
		</div>
			<a href="index.php?action=post&id=18"><button type="button" class="button	btnComment">Commentaires</button></a>
		</div>
    </div>
    <br />
	
    <?php
        }
        $posts->closeCursor();
        ?>
		
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>