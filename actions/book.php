<?php 
 	
// Boot application
// use Hotel\Favorite;
use Hotel\Booking;
use Hotel\User;
require_once __DIR__ . '/../boot/boot.php';

	
	

	// Return to home if not a post request
	if (strtolower($_SERVER['REQUEST_METHOD']) !='post') {
		header('Location: /');
		return;
	}
	
    // If there is already logged in user return to main page
    if (empty( User::getCurrentUserId())) {
        header('Location: /');
        
        return;
    }
    // Check if room id is given
    $roomId = $_REQUEST['room_id'];
    if (empty($roomId)) {
        header('Location: /');

        return;
    }

    // Set room to booking
    $booking = new Booking();
    // Add or remove room from favorites
    $checkInDate = $_REQUEST['check_in_date'];
    $checkOutDate = $_REQUEST['check_out_date'];
    $booking->insert($roomId, User::getCurrentUserId() , $checkInDate, $checkOutDate);
    // $isFavorite=$_REQUEST['is_favorite'];
    // if ($isFavorite) {
    //     $favorite->addFavorite($roomId, User::getCurrentUserId());
    // } else {
    //     $favorite->removeFavorite($roomId, User::getCurrentUserId());
    // }
    
    // Verify user

	
   
	// Return to home page
	header (sprintf('Location: ../assets/room.php?room_id=%s&Check-in=%s&Check-out=%s' , $roomId,$checkInDate,$checkOutDate  ));