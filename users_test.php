<?php
require __DIR__.'/boot/boot.php';
use Hotel\User;
// get users
$user=new User();
$userRecord=$user->getByEmail('dim89hor@gmail.com');
print_r($userRecord);
