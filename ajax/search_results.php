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
<section>


<?php
foreach ($allAvailableRooms as $availableRoom) {
?>
  <?php
  foreach ($allTypes as $roomType) {
    if ($availableRoom["type_id"] == $roomType["type_id"]) { ?>

      <div class="room-flex">
        <div class="hello">
          <div>
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
                <input type="submit" name="Search" value="Go to Room Page">
              </div>
            </form>

            <form name="listForm" method="post"  action="assets/room.php">
              <div class="button1">
                <a href="/public/assets/room.php?room_id=<?php echo $availableRoom['room_id'] ?>&check_in_date=2020-01-01&check_out_date=2020-01-02" class="btn brn-brick button-list_page"></a>
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




    <div class=" thumbnail clean list-style">
  </div>

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