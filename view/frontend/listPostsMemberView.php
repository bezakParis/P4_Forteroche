<?php
    session_start();
    $title = 'Jean Forteroche, Billet simple pour l\'Alaska - Accueil membres';
    ?>
	
<?php ob_start(); ?>

<header>
	<h1>Jean Forteroche  -  Billet simple pour l'Alaska</h1>
	<div class="nav">
		<button type="button" class="hello-pseudo">Bonjour <?= $_SESSION['pseudo']; ?></button>
		<a href="index.php?action=deconnexion"><button type="button" class="button btn-nav">SE DECONNECTER</button></a>
	</div>
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
		<div>
			<a href="index.php?action=post&id=<?= $data['id']; ?>"><button type="button" class="button	btnComment"><i class="far fa-comment"></i>&nbsp;&nbsp;Commentaires</button></a>
		</div>
    </div>

    <?php
        }
        $posts->closeCursor();
        ?>
		
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>