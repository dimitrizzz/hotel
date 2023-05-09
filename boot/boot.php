<?php
// error_reporting(E_ALL);

// Register autoload function
spl_autoload_register(function ($class) {
	$class = str_replace("\\", "/", $class);
	// var_dump(sprintf('app/%s.php', $class));
    require_once sprintf(__DIR__.'/../app/%s.php', $class);
	
	require_once __DIR__.'/../app/Hotel/Room.php';
	require_once __DIR__.'/../app/Hotel/RoomType.php';
});

use Hotel\User;

$user=new User();

// // Check if there is a token in the request
// $userToken= $_COOKIE['user_token'];
// if ($userToken) {
// 	// Verify user
// 	if ($user->verifyToken($userToken)) {
// 		// Set user in memory
// 		$userInfo =$user->getTokenPayload($userToken);
// 		User::setCurrentUserId($userInfo['user_id']);
// 		// var_dump(User::getCurrentUserId());die;
// 		User::setCurrentUserId($userInfo['user_id']);
// 		// var_dump(User::getCurrentUserId());die;

// 	}
// };
if (isset($_COOKIE['user_token'])) {
    $userToken = $_COOKIE['user_token'];
} else {
    // handle case where user_token cookie is not set
}
