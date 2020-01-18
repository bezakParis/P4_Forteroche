<?php
    session_start();
    $title = 'Jean Forteroche, Billet simple pour l\'Alaska';
    ?>
	
<?php ob_start(); ?>

<header>
	<h1>Jean Forteroche  -  Billet simple pour l'Alaska</h1>
	<div id="h1-mobile">Jean Forteroche<br />Billet simple pour l'Alaska</div>
	<div class="nav">
		<a href="view/backend/ajouterPostView.php"><button type="button" class="button btn-nav">AJOUTER EPISODE</button></a>
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
			<a href="index.php?action=modifierPost&id=<?= $data['id']; ?>"><button type="button" class="button	btnComment"><i class="far fa-edit"></i>&nbsp;&nbsp;Modifier</button></a>
			<a href="index.php?action=supprimerPost&id=<?= $data['id']; ?>"><button type="button" class="button	btnComment"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Supprimer</button></a>
			<a href="index.php?action=postAdmin&id=<?= $data['id']; ?>"><button type="button" class="button	btnComment"><i class="far fa-comment"></i>&nbsp;&nbsp;Commentaires</button></a>
		</div>
	</div>
    <br />
	
    <?php
        }
        $posts->closeCursor();
        ?>
		
</section>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>