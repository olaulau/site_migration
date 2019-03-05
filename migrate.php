<?php

// check parameters not empty
// var_dump($_POST); die;
if (	empty ($_POST['src_shell_host']) || empty ($_POST['src_shell_user']) || empty ($_POST['src_shell_password']) || empty ($_POST['src_shell_directory']) ||
		empty ($_POST['src_url_scheme']) || empty ($_POST['src_url_host'])||
		empty ($_POST['dest_shell_host']) || empty ($_POST['dest_shell_user']) || empty ($_POST['dest_shell_password']) || empty ($_POST['dest_shell_directory']) ||
		empty ($_POST['dest_url_scheme']) || empty ($_POST['dest_url_host']) ) {
	die ("some mandatory parameters are empty. please check source and destination forms on previous page.");
}



// read template
$config = file_get_contents ("bash/migration_site.config.template.sh");

// replace in template
$config = str_replace ( '"<SRC_SHELL_HOST>"' , 		escapeshellarg ($_POST['src_shell_host']) , $config );
$config = str_replace ( '"<SRC_SHELL_USER>"' , 		escapeshellarg ($_POST['src_shell_user']) , $config );
$config = str_replace ( '"<SRC_SHELL_PASSWORD>"' , 	escapeshellarg ($_POST['src_shell_password']) , $config );
$config = str_replace ( '"<SRC_SHELL_DIRECTORY>"' , escapeshellarg ($_POST['src_shell_directory']) , $config );

$config = str_replace ( '"<SRC_DB_NAME>"' , 		escapeshellarg ($_POST['src_db_name']) , $config );
$config = str_replace ( '"<SRC_DB_USER>"' , 		escapeshellarg ($_POST['src_db_user']) , $config );
$config = str_replace ( '"<SRC_DB_PASSWORD>"' , 	escapeshellarg ($_POST['src_db_password']) , $config );

$config = str_replace ( '"<SRC_URL_SCHEME>"' , 		escapeshellarg ($_POST['src_url_scheme']) , $config );
$config = str_replace ( '"<SRC_URL_HOST>"' , 		escapeshellarg ($_POST['src_url_host']) , $config );
$config = str_replace ( '"<SRC_URL_DIRECTORY>"' , 	escapeshellarg ($_POST['src_url_directory']) , $config );


$config = str_replace ( '"<DEST_SHELL_HOST>"' , 	escapeshellarg ($_POST['dest_shell_host']) , $config );
$config = str_replace ( '"<DEST_SHELL_USER>"' , 	escapeshellarg ($_POST['dest_shell_user']) , $config );
$config = str_replace ( '"<DEST_SHELL_PASSWORD>"' , escapeshellarg ($_POST['dest_shell_password']) , $config );
$config = str_replace ( '"<DEST_SHELL_DIRECTORY>"' ,escapeshellarg ($_POST['dest_shell_directory']) , $config );

$config = str_replace ( '"<DEST_DB_NAME>"' , 		escapeshellarg ($_POST['dest_db_name']) , $config );
$config = str_replace ( '"<DEST_DB_USER>"' , 		escapeshellarg ($_POST['dest_db_user']) , $config );
$config = str_replace ( '"<DEST_DB_PASSWORD>"' , 	escapeshellarg ($_POST['dest_db_password']) , $config );

$config = str_replace ( '"<DEST_URL_SCHEME>"' , 	escapeshellarg ($_POST['dest_url_scheme']) , $config );
$config = str_replace ( '"<DEST_URL_HOST>"' , 		escapeshellarg ($_POST['dest_url_host']) , $config );
$config = str_replace ( '"<DEST_URL_DIRECTORY>"' , 	escapeshellarg ($_POST['dest_url_directory']) , $config );


// write config file
file_put_contents ("bash/migration_site.config.sh", $config);








function flush_with_blank () {
    $i = 0;
    while ($i < 50000) {
        echo ' ';
        $i ++;
    }
    @ flush();
    while (@ ob_end_flush());
}
header("Content-Encoding: none");
ini_set('zlib.output_compression', 'Off');
ini_set('output_buffering', 'Off');
ini_set('output_handler', '');
flush_with_blank ();


// execute script
set_time_limit(0);
$cmd = "cd bash && ./migration_site.sh 2>&1";
ini_set('max_execution_time', 0);
$ph = popen ($cmd,'r');
while (! feof ($ph)) {
    $s = fgets ($ph, 1048576);
    echo "$s<br/>";
    flush_with_blank ();
}
pclose($ph);
