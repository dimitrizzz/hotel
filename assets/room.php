<?php

require __DIR__ . '/../boot/boot.php';

use Hotel\Room;
use Hotel\Favorite;
use Hotel\Review;
use Hotel\User;
use Hotel\Booking;
use Hotel\RoomType;
// Initialize Room service
$room = new Room();
$favorite = new Favorite();
$roomtype = new RoomType();
$review = new Review();
// Check for room id

$roomId = $_REQUEST['room_id'];
if (empty($roomId)) {
  header('Location: ../index.php');
  return;
}
//Load room info
$roomInfo = $room->get($roomId);
if (empty($roomInfo)) {
  header('Location: ../index.php');
  return;
}
$allTypes = $roomtype->getAllTypes();
// $roomType = $_REQUEST['type_id'];
// $roomT = $roomtype->getAllTypes($roomType);
// Get current user id
$userId = User::getCurrentUserId();
// var_dump($userId);
// $roomType = $_REQUEST['room_type'];
// Check if room is favorite for curent user
// print_r($roomInfo);die;
$isFavorite = $favorite->isFavorite($roomId, $userId);
// var_dump($isFavorite);
// $TypeId = $_REQUEST['room_type'];
//Load all room reviews
// Check-in
$allReviews = $review->getReviewsByRoom($roomId);
// print_r($allReviews);die;
// Check for booking room
$checkInDate = $_REQUEST['check_in_date'];
$checkOutDate = $_REQUEST['check_out_date'];
$alreadyBooked = !empty($checkInDate) && !empty($checkOutDate);

if ($alreadyBooked) {
  // Look for booking
  $booking = new Booking();
  $alreadyBooked = $booking->isBooked($roomId, $checkInDate, $checkOutDate);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <script type = "text/javascript" src="room.js"></script> -->


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>Room_Page</title>
  <style>
    body {
      width: 100vw;
      height: 100vh;
      font-size: 100%;
      grid-area: main;
      position: relative;
    }

    .rating {
      border: none;
      margin: 0;
      padding: 0;
      display: inline-block;
    }

    .rating input {
      display: none;
    }

    .rating label {
      font-size: 30px;
      color: #ccc;
      cursor: pointer;
      margin-right: 5px;
    }

    .rating label:before {
      content: "\2605";
      font-family: "Font Awesome 5 Free";
      font-weight: 900;
      font-size: 30px;
      display: inline-block;
      margin-right: 5px;
    }

    .rating input:checked~label {
      color: #ffc107;
    }

    .rating input:checked~label:before {
      content: "\2605";
      color: #ffc107;
    }

    .btn1 {
      background: transparent;
      border: none;
      margin: 20px;
      font-size: 20px;
      outline: none;
      color: lightgray;
      position: relative;
      top: -20px;
    }

    .btn i:hover {
      cursor: pointer;
    }

    .checked {
      color: orange;
    }

    .prwto {
      height: 100%;
      margin: 0;
      display: grid;
      grid-template-rows: 5% 90% 5%;
      grid-template-areas:
        "header"
        "main"
        "gamo";
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
      border-right: 1px dotted;
      margin-right: 10px;
      text-decoration: none;
      color: black;
    }

    .stars {
      color: white;
      display: flex;
      flex-direction: row;
    }

    .home-profile {
      display: flex;
    }

    .info {
      display: flex;
      align-items: center;
      width: 100%;
      padding: 0px;
      margin: 0px;
      align-items: baseline; 
       }

    .menu_1 {
      display: flex;
      flex-direction: column;
      align-items: center;
      border-right: 1px dotted white;
      padding-right: 40px;
    }
    .menu_1:last-child {
      border:0;
    }
    .add_review {
      display: flex;
      padding: 10px;
    }

    .secs {
      display: flex;
      width: 100%;
      background-color: #ff5722;
      color: white;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 20px;
      margin-top: 0px;

    }

    .secs p {
      /* border-right: 1px solid; */
      width: 100%;
      padding-left: 10px;
    }

    /* .secs p:nth-child(odd) {
      border-right: 1px solid;
    } */

    .details {
      display: flex;
      width: 100%;
      background-color: #ff5722;
      color: white;
      padding: 20px;
      border-radius: 5px;
      margin-top: 20px;
      margin-bottom: 10px;
      justify-content: space-around;
      height: 120px;
    }
    

    .room_description {
      margin-bottom: 10px;
      padding-left: 20px;
      border-left: 2px solid #ff5722;
    }

    .room_description input {
      background-color: red;
      padding: 10px;
      margin: 5px;
      border: 1px;
      border-radius: 5px;
      color: white;
      width: 150px;
      margin-top: 10px;
    }

    .map {
      padding-bottom: 70px;
      border-bottom: 2px dotted grey;
    }

    .review {
      margin-top: 20px;
      padding-top: 0;
      display: flex;
      border-left: 2px solid #ff5722;
      display: flex;
      flex-direction: column;
      padding: 10px;
      width: 100%;
      margin-top: 20px;
      flex-direction: row;
      margin: 0px;
    }

    .add_review {
      margin-top: 50px;
      padding-top: 0;
      border-left: 2px solid #ff5722;
      display: flex;
      flex-direction: column;
      padding-left: 20px;
    }
    .review1 {
      display: flex;
      flex-direction: column;
      border-left: 2px solid #ff5722;
      padding-left: 20px;
    }
    .add_review input {
      background-color: #ff5722;
      padding: 10px;
      margin: 5px;
      border: 1px;
      border-radius: 5px;
      color: white;
      width: 150px;
      
    }

    .g {
      display: flex;
      width: 100%;
      justify-content: end;
    }

    .l {
      display: flex;
      width: 100%;
      justify-content: center;
    }

    header {
      grid-area: header;
      border-bottom: 1px solid grey;
      display: flex;
      flex-direction: row;
      justify-content: space-around;
      padding: 5px;
      align-items: center;
      width: 100%;
      top: 89px;
      left: 0;
      width: 100%;
      /* height: 30px; */
    }

    .f {
      grid-area: gamo;
      color: grey;
      border-top: 2px solid grey;
      text-align: center;
      background-color: lightgrey;
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 30px;
    }

    .per_Night {
      display: flex;
      width: 100%;
    }

    .star-rating {
      display: flex;
    }

    .star-rating div:nth-child(-n+5) {
      color: gold;
    }

    .stars {
      display: flex;
    }

    .review li {
      display: flex;
      align-items: center;
    }

    footer {
      margin-top: auto;
      position: sticky;
      top: 100%;
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

    @media screen and (min-width:1025px) {}

    @media screen and (min-width: 1201px) {
      body {
        font-size: 125%;
      }

      .container {
        max-width: 1400px;
        margin: 0 auto;
      }
    }
  </style>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./pages/room.js"></script>
</head>
<div class="prwto">
  <header>
    <div class="hotels">Hotels</div>
    <div class="home-profile">
      <div class="Home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
          <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
        </svg><a href="../index.php" class="home">Home</a></div>

      <div class="Profile"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
          <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
        </svg><a href="register.php" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>Profile</a>
      </div>
    </div>
  </header>

  <body>
    <div class="container">
      <div class="secs">
        <div class="info">
        <?php echo sprintf('%s - %s, %s', $roomInfo['name'],$roomInfo['city'],$roomInfo['area'] )
         ?>
        </div>
        <div class="review">
        <h5>Review:</h5>
        <?php
        $roomAvgReview = $roomInfo['avg_reviews'];
        for ($i = 1; $i <= 5; $i++) {
          if ($roomAvgReview >= $i) {
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
        </div>
        <form action="../actions/favorite.php" name="favoriteForm" id="favoriteForm" method="post">
          <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
          <input type="hidden" name="is_favorite" value="<?php echo $isFavorite ?  '1' : '0'; ?>">
          <ul>
            <div class="ss">
              <button id="btnh1" class="btn1"><i class="fa fa-heart" style="color:<?php echo $isFavorite ? 'red' : ' '; ?>;"></i> </button>
              <!-- <script>
                var btnvar1 = document.getElementById('btnh1');

                function Toggle1() {
                  if (btnvar1.style.color == "red") {
                    btnvar1.style.color = "grey"
                  } else {
                    btnvar1.style.color = "red"
                  }
                }
              </script> -->
            </div>
          </ul>
        </form>
        <div class="per_Night">
          <p>Per Night: <br> <?php echo $roomInfo['price'] ?>€</p>
        </div>
      </div>
      <div class="img">
        <img src="./images/<?php echo $roomInfo['photo_url']; ?>" alt="Room Name">
      </div>
      <div class="details">
        <div class="menu_1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
          </svg>
          <p><?php echo $roomInfo['count_of_guests'] ?></p>
          <p>COUNT OF GUESTS</p>
        </div>
        <div class="menu_1">
          <?php
          foreach ($allTypes as $roomType) {
            if ($roomInfo["type_id"] == $roomType["type_id"]) {
          ?>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1h8zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
              </svg>
              <p><?php echo $roomType['title'] ?></p>
              <p>TYPE OF ROOM</p>
            <?php
            }
            ?>
          <?php }
          ?>
        </div>
        <div class="menu_1">
          <p><?php echo $roomInfo['parking'] ?></p>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front-fill" viewBox="0 0 16 16">
            <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
          </svg>
          <P>PARKING</P>
        </div>
        <div class="menu_1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wifi" viewBox="0 0 16 16">
            <path d="M15.384 6.115a.485.485 0 0 0-.047-.736A12.444 12.444 0 0 0 8 3C5.259 3 2.723 3.882.663 5.379a.485.485 0 0 0-.048.736.518.518 0 0 0 .668.05A11.448 11.448 0 0 1 8 4c2.507 0 4.827.802 6.716 2.164.205.148.49.13.668-.049z" />
            <path d="M13.229 8.271a.482.482 0 0 0-.063-.745A9.455 9.455 0 0 0 8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065A8.46 8.46 0 0 1 8 7a8.46 8.46 0 0 1 4.576 1.336c.206.132.48.108.653-.065zm-2.183 2.183c.226-.226.185-.605-.1-.75A6.473 6.473 0 0 0 8 9c-1.06 0-2.062.254-2.946.704-.285.145-.326.524-.1.75l.015.015c.16.16.407.19.611.09A5.478 5.478 0 0 1 8 10c.868 0 1.69.201 2.42.56.203.1.45.07.61-.091l.016-.015zM9.06 12.44c.196-.196.198-.52-.04-.66A1.99 1.99 0 0 0 8 11.5a1.99 1.99 0 0 0-1.02.28c-.238.14-.236.464-.04.66l.706.706a.5.5 0 0 0 .707 0l.707-.707z" />
          </svg>
          <p><?php echo $roomInfo['wifi'] ?> WIFI</p>
        </div>
        <div class="menu_1">
          <p><?php echo $roomInfo['pet_friendly'] ?> No</p>
          <p>PET FRIENDLY</p>
        </div>
      </div>
      <div class="room_description">
        <h2>Room description</h2>
        <p><?php echo $roomInfo['description_long'] ?> </p>
        <div class="g">
          <?php
          if ($alreadyBooked) {
          ?>
            <span class="btn btn-brick button-disabled" style="background-color: red;">Already Booked</span>
          <?php
          } else {
          ?>
            <form name="bookingForm" method="post" action="../actions/book.php">
              <input type="hidden" name="room_id" value="<?php echo $roomId  ?>">
              <input type="hidden" name="check_in_date" value="<?php echo $checkInDate; ?>">
              <input type="hidden" name="check_out_date" value="<?php echo $checkOutDate; ?>">
              <button class="btn btn-brick" type="submit">Book now</button>
            </form>
          <?php
          }
          ?>
        </div>
      </div>
      <div class="map">
        <iframe src="https://maps.google.com/maps?q=<?php echo $roomInfo['location_lat']; ?>,<?php echo $roomInfo['location_long']; ?>&output=embed" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="review1" id='review'>
        <h2>Review</h2><br>
        <?php
        foreach ($allReviews as $counter => $review) {
        ?>
          <div class="stars">
            <p style="color:black;"><?php echo sprintf('%d. %s', $counter + 1,  $review['user_name']); ?></p>

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
            } ?>
            </div>
            <br><h5 style="color:black;"> Created at: <?php echo $review['created_time']; ?> </h5>
            <p style="color:black;"> <?php echo htmlentities($review['comment']); ?> </p>
          
        <?php }   ?>
      </div>
      <?php echo '<script>console.log("Your stuff here")</script>' ?>
      <div class="add_review">
        <h2>Add review</h2>
        <form name="reviewForm" class="reviewForm" method="post" action="../actions/review.php">
          <input type="hidden" name="room_id" value="<?php echo $roomId  ?>">
          <input type="hidden" name="csrf" value="<?php echo User::getCsrf();  ?>">
          <h4>
            <fieldset class="rating">
              <input type="radio" id="star1" name="rating" value="1">
              <label  for="star1" title="1 stars"> </label>
              <input type="radio" id="star2" name="rating" value="2">
              <label for="star2" title="2 stars"></label>
              <input type="radio" id="star3" name="rating" value="3">
              <label for="star3" title="3 stars"></label>
              <input type="radio" id="star4" name="rating" value="4">
              <label for="star4" title="4 stars"></label>
              <input type="radio" id="star5" name="rating" value="5">
              <label for="star5" title="5 star"></label>
            </fieldset>
          </h4>
          <textarea class="form-control_landing review-textarea" id="txtComments" name="comment" rows="4" cols="20" minlenght="20px" maxlength="20px" placeholder="Review" data-validation-required-message="Please enter a review."></textarea>

          <div class="l"><input type="submit" value="Submit"></div>
        </form>
      </div>
    </div>
  </body>
  <div class="f">
    <footer>
      <p>collegelink2022</p>
    </footer>
  </div>
</div>

</html>