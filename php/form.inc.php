<?php

function echo_form ($side, $shell_host, $shell_user) {
	if ($side === 'src' || $side === 'dest') {
		?>
			<h4>shell</h4>
			
			<label for="<?=$side?>_shell_host">host</label>
			<input type="text" id="<?=$side?>_shell_host" name="<?=$side?>_shell_host" value="<?= $shell_host ?>" placeholder="<?=$side?>_shell_host"> <br/>
			
			<label for="<?=$side?>_shell_user">user</label>
			<input type="text" id="<?=$side?>_shell_user" name="<?=$side?>_shell_user" value="<?= $shell_user ?>" placeholder="<?=$side?>_shell_user"> <br/>
			
			<label for="<?=$side?>_shell_password">password</label>
			<input type="password" id="<?=$side?>_shell_password" name="<?=$side?>_shell_password" value="" placeholder="<?=$side?>_shell_password"> <br/>
			
			<label for="<?=$side?>_shell_directory">directory</label>
			<input type="text" id="<?=$side?>_shell_directory" name="<?=$side?>_shell_directory" value="" placeholder="<?=$side?>_shell_directory" size="70"> <br/>
			
			<h4>db</h4>
			
			<label for="<?=$side?>_db_name">name</label>
			<input type="text" id="<?=$side?>_db_name" name="<?=$side?>_db_name" value="" placeholder="<?=$side?>_db_name"> <br/>
			
			<label for="<?=$side?>_db_user">user</label>
			<input type="text" id="<?=$side?>_db_user" name="<?=$side?>_db_user" value="" placeholder="<?=$side?>_db_user"> <br/>
			
			<label for="<?=$side?>_db_password">password</label>
			<input type="password" id="<?=$side?>_db_password" name="<?=$side?>_db_password" value="" placeholder="<?=$side?>_db_password"> <br/>
			
			<h4>url</h4>
			
			<label for="<?=$side?>_url_scheme">scheme</label>
			<input type="text" id="<?=$side?>_url_scheme" name="<?=$side?>_url_scheme" value="https" placeholder="<?=$side?>_url_scheme"> <br/>
			
			<label for="<?=$side?>_url_host">host</label>
			<input type="text" id="<?=$side?>_url_host" name="<?=$side?>_url_host" value="" placeholder="<?=$side?>_url_host"> <br/>
			
			<label for="<?=$side?>_url_directory">directory</label>
			<input type="text" id="<?=$side?>_url_directory" name="<?=$side?>_url_directory" value="" placeholder="<?=$side?>_url_directory"> <br/>
	<?php
	}
	else {
		die ("wrong side");
	}
}
