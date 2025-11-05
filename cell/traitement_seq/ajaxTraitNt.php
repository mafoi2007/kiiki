<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
?>
	
	Séquence : 
	<select name='sekence'>
		<option value='null' selected>-choisir-</option>
		<option value='1'>Séquence 1</option>
		<option value='2'>Séquence 2</option>
		<option value='3'>Séquence 3</option>
		<option value='4'>Séquence 4</option>
		<option value='5'>Séquence 5</option>
		<option value='6'>Séquence 6</option>
	</select>
	
	<input type='submit' name='TraiterNoteSequentielle' value='Traiter' />
	
