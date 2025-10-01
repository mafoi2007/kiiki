		<div id ="article">
			<form method = POST action =''>
				<p>Veuillez renseigner les valeurs de a, b, c, d, e et f. Attention: Tenez compte du signe de ces nombres</p>
				<?php equadeux(); ?>
				<p><input type ='text' name ='a' placeholder='a' size= 2 maxlength=4 value='<?php if(isset($_POST['a'])) {echo $_POST['a'];}?>' />x 
				+ <input type ='text' name ='b' placeholder='b' size= 2 maxlength=4 value='<?php if(isset($_POST['b'])) {echo $_POST['b'];}?>'/>y 
				= <input type ='text' name ='c' placeholder='c' size= 2 maxlength=4 value='<?php if(isset($_POST['c'])) {echo $_POST['c'];}?>' /> </p>
				
				<p><input type ='text' name ='d' placeholder='d' size= 2 maxlength=4 value='<?php if(isset($_POST['d'])) {echo $_POST['d'];}?>' />x 
				+ <input type ='text' name ='e' placeholder='e' size= 2 maxlength=4 value='<?php if(isset($_POST['e'])) {echo $_POST['e'];}?>'/>y 
				=  <input type ='text' name ='f' placeholder='f' size= 2 maxlength=4 value='<?php if(isset($_POST['f'])) {echo $_POST['f'];}?>' /> </p>
				<p><input type ='submit' name='calculer' value='Calculer' /></p>
			</form>
			
			
			
			
		
			
		</div>
		
		
		
