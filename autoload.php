<?php

// Register autoload function
spl_autoload_register(function ($class) {
	$class = str_replace("\\", "/", $class);
	var_dump(sprintf('app/%s.php', $class));
    require_once sprintf('app/%s.php', $class);
});

use Hotel\User;

$user=new User();

// Check if there is a token in the request
$userToken= $_REQUEST['user_token'];
var_dump($userToken);