<?php

// Boot application
use Hotel\User;
use Hotel\Review;

require_once __DIR__ . '/../boot/boot.php';



// Return to home if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
    header('Location:/');
    return;
}

// // If there is already logged in user return to main page
// if (empty(User::getCurrentUserId())) {
//     header('Location: /');

//     return;
// }
// Check if room id is given
$roomId = $_REQUEST['room_id'];
$comment = $_REQUEST['comment'];
$rate = $_REQUEST['rating'];
if (empty($roomId)) {
    header('Location: /');
    return;
}
// Verify csrf
$csrf = $_REQUEST['csrf'];
// if ($csrf || !User::verifyCsrf($csrf)) {
//     header('Location: /');
//     return;
// }

sprintf('Location: room.php?room_id=%s', $comment, $rate);
// Add review
$review = new Review();
$review->insert($roomId, User::getCurrentUserId(), $_REQUEST['rating'], $_REQUEST['comment']);


// Return to home page
header(sprintf('Location: ../assets/room.php?room_id=%s', $roomId));
