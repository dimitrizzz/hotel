<?php
require __DIR__ . '/../boot/boot.php';

use Hotel\User;

// Check for existing logged in user
if (empty(User::getCurrentUserId())) {
  header('Location: /public/index.php');
  die;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Register User</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
  <link rel="stylesheet" type="text/css" href="register.css" media="screen" />
  <script src="register.js"></script>
</head>
<header>
  <a href="mybooking.html" class="hotels">Hotels</a>
  <div class="home">
    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
      <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
    </svg><a href="Home.html" class="home">Home</a>
  </div>
</header>
<div class="container">
  <form method="post" action="../actions/register.php">
    <!-- <?php if (empty($_GET['error'])) ?>
    <div class="alert alert-danger alert-styled-left">Register Error</div>?>
    <?php  ?> -->


    <div class="form-group">
      <label for="name">Your Name</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="Your name">
    </div>
    <div class="form-group">
      <label for="email">Your E-mail address</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Your e-mail address">
    </div>
    <div class="form-group">
      <label for="email_repeat">Verify your address</label>
      <input type="email" name="email_repeat" id="email_repeat" class="form-control" placeholder="Verify your address">
    </div>
    <div class="form-group">
      <label for="password">Your password</label>
      <input type="password" name="password" id="password" class="form-control" placeholder="Your password">
    </div>
    <div class="form-group">
      <button type="submit" class="button">
        Register
      </button>
    </div>

  </form>
</div>

<footer>
  <p>collegelink2022</p>
</footer>

</html>