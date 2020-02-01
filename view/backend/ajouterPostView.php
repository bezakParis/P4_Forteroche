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

    <div class="formulaire formulaire-ajout">
        <form action="../../index.php?action=ajouterPost" method="post">
                <label for="titre">Titre : </label>
                <input type="text" name="titre" />
                <label for="contenu">Contenu :</label>
                <textarea id="redaction" name="contenu"></textarea>
                <input type="submit" id="valider-redaction" value="Ajouter" />
        </form>
    </div>	
</section>

<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>