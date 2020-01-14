<?php
require('controller/frontend.php');
require('controller/backend.php');

try { 
    if (isset($_GET['action'])) {
		
        if ($_GET['action'] == 'listPosts') {
			
            listPosts();
        }
		
		
        elseif ($_GET['action'] == 'post') {
			
            if (isset($_GET['id']) && $_GET['id'] > 0) {
				
                post();
            }
            else {
				
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
					$email = htmlspecialchars($_POST['email']);
					
					if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
						
						newMember($pseudo, $pass, $email);
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
					
				$pseudo = htmlspecialchars($_POST['pseudo']);
				$pass = htmlspecialchars($_POST['pwd']);
				
				connectionMember($pseudo, $pass);
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

			session_start();
			
			if ($_SESSION['droit'] == 1) {
				
				if (isset($_GET['id']) AND $_GET['id'] > 0) {
					
					postAdmin();
				}
				else {
					
					throw new Exception('Aucun identifiant de billet envoyé');
				}
			}
            else {
				
                throw new Exception('Non authorisé');
            }
        }
		
		
		elseif ($_GET['action'] == 'ajouterPost') {
			
			session_start();
			
			if ($_SESSION['droit'] == 1) {
				
				if (isset($_POST['titre']) AND isset($_POST['contenu'])
							AND $_POST['titre'] != "" AND $_POST['contenu'] != "") {
							
					$titre = htmlspecialchars($_POST['titre']);
					$contenu = $_POST['contenu'];
					
					ajouterPost($titre, $contenu);
				}
				else {
					
					throw new Exception('il manque des informations !');
				}
            }
            else {
				
                throw new Exception('Non authorisé');
            }
        }
		
		
		elseif ($_GET['action'] == 'validerPost') {
			
			session_start();
			
			if ($_SESSION['droit'] == 1) {
				
				if (isset($_POST['post_id']) AND $_POST['post_id'] != ""
							AND isset($_POST['titre']) AND isset($_POST['contenu'])
							AND $_POST['titre'] != "" AND $_POST['contenu'] != "") {
								
					$titre = htmlspecialchars($_POST['titre']);
					$contenu = htmlspecialchars($_POST['contenu']);
					
					validerPost($_POST['post_id'], $titre, $contenu);
				}
				else {
					
					throw new Exception('il manque des informations !');
				}
            }
            else {
				
                throw new Exception('Non authorisé');
            }
        }
		
		
		elseif ($_GET['action'] == 'supprimerPost') {
			
			session_start();
			
			if ($_SESSION['droit'] == 1) {
				
				if (isset($_GET['id']) AND $_GET['id'] != "") {
					
					supprimerPost($_GET['id']);
				}
				else {
					
					throw new Exception('probleme ID');
				}
            }
            else {
				
                throw new Exception('Non authorisé');
            }
        }
		
		
		elseif ($_GET['action'] == 'modifierPost') {
			
			session_start();
			
			if ($_SESSION['droit'] == 1) {
				
				if (isset($_GET['id']) AND $_GET['id'] != "") {
					
					modifierPost($_GET['id']);
				}
				else {
					
					throw new Exception('probleme ID');
				}
            }
            else {
				
                throw new Exception('Non authorisé');
            }
        }
		
		
		elseif ($_GET['action'] == 'supprimerComment') {
			
			session_start();
			
			if ($_SESSION['droit'] == 1) {
				
				if (isset($_GET['id']) AND $_GET['id'] != ""
						AND isset($_GET['post_id']) AND $_GET['post_id'] != "") {
							
					supprimerComment($_GET['id'], $_GET['post_id']);
				}
				else {
					
					throw new Exception('probleme ID');
				}
            }
            else {
				
                throw new Exception('Non authorisé');
            }
		}
		
		
		elseif ($_GET['action'] == 'accepterComment') {
			
			session_start();
			
			if ($_SESSION['droit'] == 1) {
				
				if (isset($_GET['id']) AND $_GET['id'] != ""
						AND isset($_GET['post_id']) AND $_GET['post_id'] != "") {
							
					accepterComment($_GET['id'], $_GET['post_id']);
				}
				else {
					
					throw new Exception('probleme ID');
				}
            }
            else {
				
                throw new Exception('Non authorisé');
            }
		}
		
		elseif ($_GET['action'] == 'signalerComment') {
			
            if (isset($_GET['commentId']) AND $_GET['commentId'] > 0
						AND isset($_GET['postId']) AND $_GET['postId'] > 0) {
							
			   signalerComment($_GET['commentId'], $_GET['postId']);
            }	
            else {
				
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
		
    }
    else {
		
        listPosts();
    }
}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
