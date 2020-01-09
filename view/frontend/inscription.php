<?php $title = 'Jean Forteroche, Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

	<section id="sect01">
	<h1>Jean Forteroche, Billet simple pour l'Alaska</h1> 
		
	<h1>Inscription</h1>
		
	<div class="formulaire">
		<h3>Veuillez remplir le formulaire ci-dessous:</h3>
		
		<form action="../../index.php?action=inscription" method="post">
			<p>
			<label for="pseudo">Pseudo : </label>
			<input type="text" name="pseudo" required />
			<br />
			<br />
			<label for="pwd">Mot de passe : </label>
			<input type="password" name="pwd" required />
			<br />
			<br />
			<label for="checkPwd">Retaper votre mot de passe : </label>
			<input type="password" name="checkPwd" required />
			<br />
			<br />
			<label for="email">Adresse email : </label>
			<input type="email" name="email" required />
			<br />
			<br />
			<input type="submit" value="Valider" />
			</p>
		</form>
		</div>		
	</section>
			
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>