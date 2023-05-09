<?php



require __DIR__ . '/../boot/boot.php';

use Hotel\Room;
use DateTime as DateTimeAlias;
use Hotel\RoomType;
// Initialze Room service


$room = new Room();
// get Room type
$type = new RoomType();
$allTypes = $type->getAllTypes();



// Get all cities
$cities = $room->getCities();
$allCountOfGuests = $room->getAllCount();
$priceRooms = $room->getAllPrices();
// Get page parameters
$selectedCity = $_REQUEST['city'];
$selectedTypeId = $_REQUEST['room_type'];
$checkInDate = $_REQUEST['Check-in'];
$checkOutDate = $_REQUEST['Check-out'];
// Search for room

// print_r($allTypes);


$allAvailableRooms = $room->search(new DateTime($checkInDate), new DateTime($checkOutDate), $selectedCity, $selectedTypeId);
// print_r($allAvailableRooms);
$date = new DateTime('now');
// if (isset($_GET['city'])) {
//   $city = $_GET['city'];
// } else {
//   // handle case where 'city' is not set
// }
// print_r( $allAvailableRooms);die;

//   if(isset($_POST["city"])) {
//     $city = $_POST["city"];
// }
$city = isset($_REQUEST['city']) ? $_REQUEST['city'] : 'Athens';


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="author" content="Collegelink">
  <meta name="viewport" content="width=device-width , initial-scale=1 , maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Search Results</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" type="text/css" href="List.css" media="screen" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="pages/search.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<div class="main">

  <body>
    <div class="container">
      <header>
        <div class="navbar-text scroll-move visible-md visible-lg">Hotels</div>
        <div class="home-profile">
          <div class="home">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
              <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
            </svg><a href="../index.php" class="home" >Home</a>
          </div>
          <div class="Profile"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
            </svg>
            <a href="register.php" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>Profile</a>
          </div>
        </div>

      </header>
      <div class="col-md-4' slidebar-top-small">
        <form name="searchForm" class="searchForm" method="post" action="list.php" onsubmit="return validateForm()">
          <div class="opts">
            <h5 style=" color:white; background-color:#ff5722; 
            padding:10px; ">FIND THE PERFECT ROOM</h5>
            <select class="Count" name="count_of_guests" data-placeholder="Count of Guests" style="border-radius: 10px;" required>
              <?php
              foreach ($allCountOfGuests as $CountofGuests) {
              ?>
                <option value="<?php echo $CountofGuests['count_of_guests']; ?>"><?php echo $CountofGuests['count_of_guests']; ?></option>
              <?php
              }
              ?>

            </select>
            <select class="Room_Type" name="room_type" data-placeholder="Room Type" style="border-radius: 10px;">
              <option value="none" disabled selected hidden>Room Type</option>

              <?php
              foreach ($allTypes as $roomType) {
              ?>
                <option value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>
              <?php
              }
              ?>
            </select>
            <select class="City" name="city" data-placeholder="City" style="border-radius: 10px;" required>
              <option value="none"  disabled selected hidden>City</option>
              <?php
              foreach ($cities as $city) {
              ?>
                <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="card">
            <div class="price-content">
              <div>
                <label>Price Min</label>
                <p id="min-value">$50</p>
              </div>

              <div>
                <label>Price Max</label>
                <p id="max-value">$500</p>
              </div>
            </div>

            <div class="range-slider">
              <input type="range" class="min-price" value="100" min="10" max="500" step="10">
              <input type="range" class="max-price" value="250" min="10" max="500" step="10">
            </div>
          </div>

          <div class="check">
            <div class="check_in">
              <input onclick="(this.type='date')" type="text" name="Check-in" placeholder="Check-in-Date" value="<?php echo $checkInDate; ?>" required>
            </div>
            <div class="check_out">
              <input onclick="(this.type='date')" type="text" name="Check-out" placeholder="Check-out-Date" value="<?php echo $checkOutDate; ?>" required>
            </div>
          </div>
          <div class="button">
            <input type="submit" value="Find Hotel">
          </div>

        </form>



      </div>
      <div id="search-results-container" class="central_menu">
        <h2>Search Results</h2>
        <section>


          <?php
          foreach ($allAvailableRooms as $availableRoom) {
          ?>
            <?php
            foreach ($allTypes as $roomType) {
              if ($availableRoom["type_id"] == $roomType["type_id"]) { ?>

                <div class="room-flex">
                  <div class="hello">
                    <div class="img1">
                      <img class="room-preview" src="./images/<?php echo $availableRoom['photo_url']; ?>">
                      <i class="fa fa-camera"></i>
                    </div>
                    <div class="room-details">
                      <h4><?php echo $availableRoom['name'] ?></h4>
                      <p><?php echo $availableRoom['area'] ?></p>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat.
                        Duis
                        aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                        laborum.</p>
                      <form name="searchForm" method="post" action="./room.php" onsubmit="true">
                        <div class="button1">
                          <input type="text" hidden name="room_id" value="<?php echo $availableRoom['room_id'] ?>">
                          <input hidden type="text" name="Check-in" value="<?php echo $checkInDate; ?>">
                          <input hidden type="text" name="Check-out" value="<?php echo $checkOutDate; ?>">
                          <input type="submit" name="Search" value="Go to Room Page">
                        </div>
                      </form>


                    </div>
                  </div>
                  <div class="secs1">

                    <div id="per_Night">
                      <p>Per Night
                        <?php echo $availableRoom['price'] ?>
                    </div>
                    <div class="dtls">
                      <div class="guests">
                        <p>Count of Guests :
                          <?php echo $availableRoom['count_of_guests'] ?>
                        </p>
                      </div>

                      <div class="type_room">
                        <p>Type of Single Room :
                          <?php echo $roomType['title']; ?>

                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>




              <!-- <div class=" thumbnail clean list-style">
            </div> -->

            <?php
            }
            ?>

          <?php
          }
          ?>
          <?php

          ?>
        </section>






      </div>
    </div>

    <section>
      <?php if (count($allAvailableRooms) == 0) { ?>
        <h2 class="check-search">There are no room!</h2>
      <?php } ?>
    </section>


</div>

</div>
<div class="f">
  <footer>
    <p>collegelink2022</p>
  </footer>
</div>
</div>
</body>
<script type="text/javascript">
  var check_in_date = document.forms["searchForm"]["Check-in"];
  var check_out_date = document.forms["searchForm"]["Check-out"];

  var check_in_date_error = document.getElementById("check_in_date_error");
  var check_out_date_error = document.getElementById("check_out_date_error");

  function validateForm() {
    if (check_in_date.value === "") {
      check_in_date_error.textContent = "Please enter a Check-in Date."
      check_in_date.focus();
      return false;
    }
    if (check_out_date.value === "") {
      check_out_date_error.textContent = "Please enter a Check-out Date."
      check_out_date.focus();
      return false;
    }
  }
</script>

</html>