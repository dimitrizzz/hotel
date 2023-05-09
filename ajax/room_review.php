<?php

// Boot application
use Hotel\User;
use Hotel\Review;

require_once __DIR__ . '/../boot/boot.php';



	// Return to home if not a post request
	if (strtolower($_SERVER['REQUEST_METHOD']) !='post') {
		echo "This is a post script.";
	}
	
    // If there is already logged in user return to main page
    if (!empty(User::getCurrentUserId())) {
        echo "No current user for this operation.";
        die;
    }
    // Check if room id is given
    $roomId = $_REQUEST['room_id'];
    if (empty($roomId)) {
        echo "No room is given for this operation.";
        die;

    }

    sprintf('Location: room.php?room_id=%s', $comment, $rate);
    // Add review
    $review = new Review();
    $review->insert($roomId, User::getCurrentUserId() , $_REQUEST['rate'], $_REQUEST['comment']);

    // Get all reviews
    $roomReviews = $review->getReviewsByRoom($roomId);
    $counter = count($roomReviews);
    // Load user
    $user = new User();
    $userInfo = $user->getByUserId(User::getCurrentUserId());
    ?>
    <div class="stars">
            <p><?php echo sprintf('%d. %s' , $counter,  $userInfo['name']); ?></p>
            
            <?php
            
            for ($i = 1; $i <= 5; $i++) {
              if ($_REQUEST['rate'] >= $i) {
                ?>
                <span class=" fa fa-star checked"></span>
                <?php
              } else {
                ?>
                <span class=" fa fa-star"></span>
                <?php
              }
            } 
            ?>
            <h5> Created at: <?php echo (new DateTime())->format('Y-m-d H:i:s'); ?> </h5>
            <p> <?php echo $_REQUEST['comment'] ?> </p>
    </div>
            
