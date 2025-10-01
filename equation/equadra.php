		<div id ="article">
			<form method = POST action =''>
				<p>Veuillez renseigner les valeurs de a, b et c. Attention: Tenez compte du signe de ces nombres</p>
				<?php equadra(); ?>
				<p><input type ='text' name ='a' placeholder='a' size= 2 maxlength=4 value='<?php if(isset($_POST['a'])) {echo $_POST['a'];}?>' />x<sup>2</sup> 
				+ <input type ='text' name ='b' placeholder='b' size= 2 maxlength=4 value='<?php if(isset($_POST['b'])) {echo $_POST['b'];}?>'/>x 
				+ <input type ='text' name ='c' placeholder='c' size= 2 maxlength=4 value='<?php if(isset($_POST['c'])) {echo $_POST['c'];}?>' /> = 0 </p>
				<p><input type ='submit' name='calculer' value='Calculer' /></p>
			</form>
			
			
			
			
		
			
		</div>
		
		
		
