<?php
require('controller/frontend.php');
require('controller/backend.php');

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
		
		
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
		
		
        elseif ($_GET['action'] == 'inscription') {	
			if (isset($_POST['pseudo']) AND $_POST['pseudo'] != "" 
						AND isset($_POST['pwd']) AND $_POST['pwd'] != ""
						AND isset($_POST['checkPwd']) AND $_POST['checkPwd'] != ""
						AND isset($_POST['email']) AND $_POST['email'] != "") {
					
				$pass_hache = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
				
				$isPasswordCorrect = password_verify($_POST['checkPwd'], $pass_hache);
				
				if (! $isPasswordCorrect) {
					throw new Exception('votre mot de passe ne corresponds pas !');
				}
				else {
					$pseudo = htmlspecialchars($_POST['pseudo']);
					$email = htmlspecialchars($_POST['email']); // On rend inoffensives les balises HTML que le visiteur a pu rentrer
					if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
						newMember($pseudo, $pass_hache, $email);
					}
					else
					{
						throw new Exception('L\'adresse ' . $email . ' n\'est pas valide, recommencez !');
					}
				}
			}
			else {
				throw new Exception('il manque des informations !');
			}
		}
		
		
        elseif ($_GET['action'] == 'connexion') {	
			if (isset($_POST['pseudo']) AND $_POST['pseudo'] != "" 
						AND isset($_POST['pwd']) AND $_POST['pwd'] != "") {
					
				$pass_hache = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
				$pseudo = htmlspecialchars($_POST['pseudo']);
				
				connectionMember($pseudo, $pass_hache);
			}
			else {
				throw new Exception('il manque des informations !');
			}
		}
		
		
        elseif ($_GET['action'] == 'deconnexion') {	
			deconnectionMember();
		}
		
		
        elseif ($_GET['action'] == 'ajoutCommentaire') {
			if (isset($_POST['commentaire']) AND $_POST['commentaire'] != ""
						AND isset($_POST['post_id']) AND $_POST['post_id'] != "" ) {
				ajouterCommentaire($_POST['commentaire'], $_POST['post_id'] );
			}
			else {
				
				throw new Exception('il manque des informations !');
			}
		}
		
		
		elseif ($_GET['action'] == 'postAdmin') {
            if (isset($_GET['id']) AND $_GET['id'] > 0) {
                postAdmin();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
		
		
		elseif ($_GET['action'] == 'supprimerComment') {
            if (isset($_GET['id']) AND $_GET['id'] > 0) {
               echo ('index: commentaire à supprimer');
			   //deleteComment();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
		
		elseif ($_GET['action'] == 'signalerComment') {
            if (isset($_GET['commentId']) AND $_GET['commentId'] > 0
				AND isset($_GET['postId']) AND $_GET['postId'] > 0) {
               //echo ('index: commentaire signalé pour modération ' . $_GET['commentId'] . $_GET['postId']);
			   signalerComment($_GET['commentId'], $_GET['postId']);
            }	
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
		
		
		
		
		
    }
    else {
        listPosts();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
