<?php 
 	
// Boot application
use Hotel\Favorite;
use Hotel\User;

require_once __DIR__ .'/../boot/boot.php';
	// var_dump(1);
	

	// Return to home if not a post request
	if (strtolower($_SERVER['REQUEST_METHOD']) !='post') {
		header('Location: /');
		return;
	}
	
    // If there is already logged in user return to main page
    if (empty(User::getCurrentUserId())) {
        header('Location: /');
        
        return;
    }
    // Check if room id is given
    $roomId = $_REQUEST['room_id'];
    // var_dump($roomId);
    if (empty($roomId)) {
        header('Location: /');
        return;
    }

    // Set room to favorites
    $favorite = new Favorite();
    // Add or remove room from favorites
    $isFavorite = $_REQUEST['is_favorite'];
    if (!$isFavorite){
        $status = $favorite->addFavorite($roomId, User::getCurrentUserId());
        // var_dump($status);
    } else {
        $favorite->removeFavorite($roomId, User::getCurrentUserId());
    }
    
    // Verify user

	
   
	// Return to home page
	header (sprintf('Location: ../assets/room.php?room_id=%s' , $roomId));