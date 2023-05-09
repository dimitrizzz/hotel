<?php
require __DIR__ . '/boot/boot.php';

use Hotel\Favorite;
use Hotel\Review;
use Hotel\Booking;
use Hotel\User;




// Check for logged in user
$userId = User::getCurrentUserId();
// if (empty($userId)){
//   header('Location: index.php' );
//   return;
// }
// Get all favorites
$favorite = new Favorite();
$userFavorites = $favorite->getListByUser($userId);
print_r($userFavorites);die;
//Get all reviews
$review =new Review();
$userReviews = $review->getListByUser($userId);

// Get all user booking
$booking = new Booking();
$userBookings = $booking->getListByUser($userId);
// print_r($userBookings);die;

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">


 <head>
  <meta charset="utf-8">
  <script src="./Entry/entry.js"></script>
  <title>Profile Page</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
    }

    body {
      width: 100vw;
      height: 100vh;
      font-size: 100%;
    }

    h2 {
      color: #ff5722;
      font-size: 20px;
      text-align: center;
      padding: 20px;
    }

    h3 {
      margin: 0;
      width: 100%;
    }

    p {
      margin: 0;
    }
        .Profile a {
      padding-right: 10px;
      margin-right: 10px;
      text-decoration: none;
      color: black;
    }
    .home a {
      padding-right: 10px;
      border-right:1px dotted;
      margin-right: 10px;
      text-decoration: none;
      color: black;
    }
    .home-profile {
      display: flex;

    }
    .Profile {
      color:#ff5722;
      text-decoration:none;
    }
    

    .container {
      height: 100%;
      margin: 0;
      display: grid;
      grid-template-rows: 5% 90% 5%;
      grid-template-columns: 250px 1fr;
      grid-template-areas:
        "header header"
        "select central_menu"
        "gamo gamo";
      margin: 0;
    }

    .select {
      grid-area: select;
      padding-bottom: 10px;
      margin-bottom: 10px;
    }

    .secs1 {
      display: flex;
      width: 100%;
      justify-content: space-between;
      align-items: center;
      text-align: center;
      padding-bottom: 10px;
    }

    .button input {
      background-color: #ff5722;
      padding: 10px;
      margin: 5px;
      border: 1px;
      border-radius: 5px;
      color: white;
      width: 150px;
      width: 100%;
      margin-top: 10px;
    }

    .button1 input {
      background-color: #ff5722;
      padding: 10px;
      margin: 5px;
      border: 1px;
      border-radius: 5px;
      color: white;
      width: 150px;
    }

    .opts {
      display: flex;
      flex-direction: column;
    }

    .price2 {
      font-size: 10px;
      display: flex;
      justify-content: space-between;
    }

    .opts {
      display: flex;
      flex-direction: column;
    }

    .opts select {
      padding: 20px;
      margin-bottom: 10px;
      background-color: lightgrey;
    }

    header {
      grid-area: header;
      border-bottom: 1px solid grey;
      display: flex;
      flex-direction: row;
      justify-content: space-around;
      margin: 20px;

      align-items: center;
    }

    .room-flex {

      display: flex;
      flex-wrap: wrap;
    }

    .hello {
      display: flex;
    }

    .dtls {
      display: flex;
      flex-direction: row;
      background-color: lightgrey;
      width: 100%;
      justify-content: space-around;
      padding: 20px;
      margin: 10px;
    }

    .room-preview {
      height: 150px;
      width: 150px;
      background-color: lightgrey;
    }

    .room-details {

      display: flex;
      flex-wrap: wrap;
      padding-left: 20px;
      border-left: 2px solid #ff5722;
    }

    .room_details p {
      padding-bottom: 20px;
    }

    .room {
      display: flex;
    }

    img {
      width: 30%;
      grid-area: image;
      margin: 20px;

    }

    .button1 {
      border-radius: 5px;
      color: white;
      width: 150px;
      display: flex;
      width: 100%;
      justify-content: flex-end;
    }

    .central_menu {
      padding-left: 10px;
    }

    #per_Night {
      background-color: darkgray;
      padding: 20px;
      width: 21%;
      color: white;
    }

    .f {
      grid-area: gamo;
      color: grey;
      border-top: 2px solid grey;
      text-align: center;
      background-color: lightgrey;

    }

    footer {
      margin-top: auto;
      position: sticky;
      top: 100%;
    }

    .central_menu h2 {
      background-color: #ff5722;
      color: white;
      text-align: left;
    }

    .main {
      height: 100%;
    }

    @media screen and (min-width: 572px) {
      footer {
        margin-top: auto;
      }
    }

    @media screen and (min-width: 769px) {
      body {
        font-size: 112%;
      }
    }

    @media screen and (min-width:1025px) {
      body {
        font-size: 120%;
      }
    }
    @media screen and (min-width: 1201px) {
      body {
        font-size: 135%;
      }
            
      .container {
        max-width: 1400px;
        margin: 0 auto;

      }
    }

    .star-rating {

      display: flex;
    }

    .star-rating1 {

      display: flex;
    }

    .star-rating div:nth-child(-n+4) {
      color: gold;
    }

    .star-rating1 div:nth-child(-n+5) {
      color: gold;
    }


    

    
  </style>
</head>
<div class="main">

  <header>
    <div class="hotels">Hotels</div>
    <div class="home-profile">
      <div class="home">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
          <path
            d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
        </svg><a href="Home.html" class="home">Home</a>
      </div>
      <div class="Profile"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
          <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
        </svg>
        <a href="Profile.html" class="Profile">Profile</a>
      </div>
    </div>

  </header>

  <body>
    <div class="container">
      <div class="secs">

        <div class="select">
          <div class="favorites">
            <h2>FAVORITES</h2>
            <?php
            if (count($userFavorites) > 0) {
            ?>  
            
            <ol>
              <?php
                  foreach ($userFavorites as $favorite) {
              ?>      
                  
              <h3>
                <li>
                  <h3>
                     <a href="room.php?room_id=<?php echo $favorite['room_id'];  ?>"><?php echo $favorite['name']; ?></a>
                  </h3>
                </li>
              </h3>
              <?php
                  }
              ?>
            </ol>
            <?php 
               } else  {
            ?>    
              
             <h2 class="alert-profile">You don't have any favorite Hotel !!!</h2>
            <?php
              } 
            ?> 
          </div>
          <div class="reviews">
            <h2>REVIEWS</h2>
            <?php 
               if (count ($userReviews) > 0) {
            ?>    
            <ol>
             <?php
                  foreach ($userReviews as $review) {
              ?>  
              <h2>
                <li>
                  <h3>
                  <a href="room.php?room_id=<?php echo $review ['room_id']?>"><?php echo $review['name']; ?></a>
                    <br>
                    <?php
                      for ($i = 1; $i <= 5; $i++) {
                        if ($review['rate'] >= $i) {
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
                    
                  </h3>

                </li>
              </h2>
              <?php
                  }
              ?>    
            </ol>
            <?php 
               } else {
            ?>    
               
            <h4 class="alert-profile">You haven't made any review yet!!!</h4>
            <?php
               }
            ?>
          </div>
        </div>

      </div>
      <div class="central_menu">
        <h2>My booking</h2>
        <div class="room-flex">
          <div class="hello">
            <section>
               <?php
               if (count($userBookings) > 0) {
              ?>
                <section>
                <?php 
                    foreach ($userBookings as $booking) {}
                ?>
                <div>
              <img class="room-preview" src="/assets/images/<?php echo $booking['photo_url']; ?>" alt="">
            </div>
            <div class="room-details">
              <section>
                <?php
                  } else {
                ?>

              </section>

              <h3><?php echo $booking['name']; ?><br><small> <?php echo sprintf('%s, %s', $booking['city'], $booking['area']); ?></small></h3>
              <p><?php echo $booking['description_short']; ?></p>
              <div class="links">
                <a href="/room.php?room_id=<?php echo $booking ['description_short']; ?>" class="btn btn-brick button-profile_page">Go to Room Page</a>
              </div>
                <h4 class="alert-profile">You don't have any booking!!</h4>
                  <hr>
                  <?php 
                     }
                  ?>
                <div class="button1">
                <input type="button" name="Search" value="Go to Room Page">
              </div>
            </div>
          </div>
          <div class="secs1">

            <div id="per_Night">
              <p>Per Night: <?php echo $booking['total_price']; ?>euro </p>
            </div>
            <div class="dtls">
              <div class="guests">
                <p>Check-in Date: <?php echo $booking['check_in_date']; ?></p>
              </div>
              <div class="dtls">
              <div class="guests">
                <p>Check_out Date: <?php echo $booking['check_out_date']; ?></p>
              </div>

              <div class="type_room">
                <p>Type of Room:<?php echo $booking['type_']; ?> </p>
              </div>
            </div>
          </div>
        </div>
        <div class="room-flex">
          <div class="hello">
            <div>
              <img class="room-preview" src="images/room-2.jpg" alt="">
            </div>
            <div class="room-details">
              <h3>GRAND BRETAGNE</h3>
              <p>ATHENS,SYNTAGMA</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat.
                Duis
                aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum.</p>
              <div class="button1">
                <input type="button" name="Search" value="Go to Room Page">
              </div>
            </div>
          </div>
          <div class="check_out">
            <input id="my-input" onclick="changeType()" type="text" name="Check-out" value="Check-out-Date" required>
          </div>
          <div class="secs1">
            <div id="per_Night">
              <p>Per Night 500$</p>
            </div>
            <div class="dtls">
              <div class="guests">
                <p>Count of Guests</p>
              </div>
              <div class="type_room">
                <p>Type of Single Room</p>
              </div>
            </div>
          </div>
        </div>
                </section> 
              


            </section>
            
      </div>

    </div>
    <div class="f">
      <footer>
        <p>collegelink2022</p>
      </footer>
    </div>
  </body>




</html>