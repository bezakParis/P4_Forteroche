<?php $title = 'Jean Forteroche, Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<header>
	<h1>Jean Forteroche  -  Billet simple pour l'Alaska</h1>
    <a href="../../index.php"><i class="fas fa-home"></i></a>
</header>



<section id="sect01">
	
	<h3>Veuillez remplir le formulaire ci-dessous:</h3>
	<div class="formulaire inscription">
		<form action="../../index.php?action=inscription" method="post">
			<div class="row">
				<div class="col-a">
					<label for="pseudo">Pseudo : </label>
				</div>
				<div class="col-b">
					<input type="text" name="pseudo" required />
				</div>
			</div>
			<div class="row">
				<div class="col-a">
					<label for="pwd">Mot de passe : </label>
				</div>
					<div class="col-b">
					<input type="password" name="pwd" required />
				</div>
			</div>
			<div class="row">
				<div class="col-a">
					<label for="checkPwd">Retaper votre mot de passe : </label>
				</div>
				<div class="col-b">
					<input type="password" name="checkPwd" required />
				</div>
			</div>
			<div class="row">
				<div class="col-a">
					<label for="email">Adresse email : </label>
				</div>
				<div class="col-b">
					<input type="email" name="email" required />
				</div>
			</div>
			<div class="row">
				<input type="submit" value="Valider" />
			</div>
		</form>
	</div>		
</section>
			
<?php $content = ob_get_clean(); ?>

<?php require('templateConnection.php'); ?>