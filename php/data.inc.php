<?php

function echo_data ($side, $type) {
	if ($type === 'vhffs') {
		?>
		<label for="<?= $side ?>_user">user</label>
		<select id="<?= $side ?>_user">
			<option value=""></option>
		</select>
		<label for="<?= $side ?>_project">project</label>
		<select id="<?= $side ?>_project">
			<option value=""></option>
		</select>
		<br/>
		
		<label for="<?= $side ?>_website">website</label>
		<select id="<?= $side ?>_website">
			<option value=""></option>
		</select>
		<br/>
		
		<label for="<?= $side ?>_dbname">dbname</label>
		<select id="<?= $side ?>_dbname">
		</select>
		
		<script type="text/javascript" src="js/vhffs_data.js"></script>
		<?php
	}
	
	elseif ($type === 'ispconfig') {
		?>
		<label for="<?= $side ?>_user">user</label>
		<select id="<?= $side ?>_user">
		<option value=""></option>
		</select>
		<br/>
		
		<label for="<?= $side ?>_website">website</label>
		<select id="<?= $side ?>_website">
		<option value=""></option>
		</select>
		<label for="<?= $side ?>_shelluser">shelluser</label>
		<select id="<?= $side ?>_shelluser">
		<option value=""></option>
		</select>
		<br/>
		
		<label for="<?= $side ?>_dbuser">dbuser</label>
		<select id="<?= $side ?>_dbuser">
		<option value=""></option>
		</select>
		<label for="<?= $side ?>_dbname">dbname</label>
		<select id="<?= $side ?>_dbname">
		<option value=""></option>
		</select>
		
		<script type="text/javascript" src="js/ispconfig_data.js"></script>
		<?php
	}
	
	else {
		die ("wrong type");
	}
}
