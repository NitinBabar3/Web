<?php

define('DB_USERNAME', 'avtech89_root123');
define('DB_SERVER', 'iwebhostindia.com');
define('DB_PASSWORD', 'lakeshore123b');
define('DB_DATABASE', 'avtech89_share_DB');

define('USERS_TABLE_NAME', 'users');

$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
