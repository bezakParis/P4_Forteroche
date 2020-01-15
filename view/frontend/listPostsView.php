<?php $title = 'Jean Forteroche, Billet simple pour l\'Alaska - Accueil'; ?>

<?php ob_start(); ?>

<header>
	<h1>Jean Forteroche  -  Billet simple pour l'Alaska</h1>
    <a href="view/frontend/inscriptionView.php"><button type="button" class="button">S'INSCRIRE</button></a>
    <a href="view/frontend/connexionView.php"><button type="button" class="button">SE CONNECTER</button></a>
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
    </div>
    <br />
	
    <?php
        }
        $posts->closeCursor();
        ?>		
		
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>