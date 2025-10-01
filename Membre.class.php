<?php
	class Membre
		{
			private $pseudo;
			private $email;
			private $signature;
			private $actif;
			
			public function getPseudo()
				{
				return $this ->pseudo;
				}
			
			public function setPseudo($nouveauPseudo)
				{
				//Vérifions que le nouveau pseudo n'est pas vide ou trop long
				if(!empty($nouveauPseudo) or strlen($nouveauPseudo) < 15)
					{
					$this->pseudo = $nouveauPseudo;;
					}
				
				}
				
			
			public function EnvoyerEmail($titre, $message)
				{
				mail($this -> email, $titre, $message);
				}
			
			
			public function bannir()
				{
				$this ->actif = false;
				$this ->EnvoyerEmail('Objet du message', 'contenu complet du message');
				}
			
			/*
			public function __construct($idMembre)
				{
				// récupère en BD les informations du membre
				// SELECT pseudo, email, signature, actif FROM membres WHERE id = ...
				
				// On définit les variables avec les résultats de la base
				$this ->pseudo = $donnees['pseudo'];
				$this ->email = $donnees['email'];
				//Etc.
				}*/
			
			public function __destruct()
				{
				echo "L'objet que vous venez de créer sera détruit. Voulez-vous continuer ?";
				}
		}
