<?php
require __DIR__.'/../boot/boot.php';
use Hotel\Room;
// get cities
$room=new Room();
// $cities=$room->getCities();
// print_r($cities);
// search rooms
$rooms = $room->search('Athens',12,new DateTime('2020-08-01'),new DateTime('2020-08-31'));
print_r($rooms)
?>