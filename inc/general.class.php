<?php
	class General extends generalModele {
		
		
		
		
		
		
		
		
		
		
		public function supprimerJournal($action, $id) {
			if(isset($action)) {
			$action = urldecode($action);
			if(empty($action) or $action!='del') {
				echo "Action NON effectuée";
			}
			else {
				$verif = $this->delJournal($id);
				if($verif) {
					echo "Journal vidé";
				}
			}
			}
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}