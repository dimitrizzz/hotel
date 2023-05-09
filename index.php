<?php
require __DIR__ . '/boot/boot.php';

use Hotel\Room;
use DateTime as DateTimeAlias;
use Hotel\RoomType;

// get cities
$room = new Room();
$cities = $room->getCities();
// get Room type
$type = new RoomType();
$allTypes = $type->getAllTypes();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Home</title>
  <style>
    * {
      box-sizing: border-box;
    }

    header {
      border-bottom: 1px solid grey;
      display: flex;
      grid-area: header;
      flex-direction: row;
      justify-content: space-around;
      padding: 10px;
      position: fixed;
      top: 0px;
      left: 0;
      width: 100%;
    }

    .hotels {
      color: black;
      text-decoration: none;
    }

    .hotels:hover {
      color: red;

    }

    img {
      width: 100%;

    }

    body {
      margin: 0;
      width: 100%;
      display: grid;
      grid-template-rows: 50px 900px 50px;
      grid-template-areas:
        "header"
        "main"
        "footer";
    }

    .main {
      display: flex;
      grid-area: main;
      flex-direction: column;
      justify-content: space-around;
      align-items: center;
      background-image: url(images/hotel1.jpg);
      min-width: 600px;
      /* max-width: 1000px; */
      justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .check {
      display: flex;
      width: 100%;
    }
    .home {
      color: #ff5722;
    }

    select.City,
    select.Room_Type {
      padding: 20px;
      width: 300px;
      height: 70px;
      background-color: lightgrey;
      text-align: center;
      border-radius: 10px;
    }

    .check_in input,
    .check_out input {
      padding: 20px;
      width: 200px;
      height: 70px;
    }

    .selection {
      padding: 20px;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .selection select {
      display: flex;
      align-content: center;
      align-items: center;
      width: 200px;
      background-color: #e1e0e0;

      height: 50px;
      text-align: center;
    }

    .Check {

      margin: 20px;
      display: flex;
      justify-content: center;
    }

    .button {
      text-align: center;

    }

    .button input {
      background-color: #ff5722;
      padding: 10px;
      border-radius: 5px;
      border: 1px;
      color: white;
      width: 100px;
      height: 50px;
    }
    .button input:hover{
      background-color: red;
      
    }
    .one {
      border: 1px solid white;
      background-color: white;
      border-radius: 5px;

    }

    footer {
      background-color: lightgrey;
      display: flex;
      text-align: center;
      align-items: center;
      flex-direction: column;
      color: grey;
      grid-area: footer;
      border-top: 2px solid gray;
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 50px;
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
</head>
<header>
  <a href="assets/list.php" class="hotels">Hotels</a>
  <div class="home">
    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
      <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
    </svg><a href="index.php" class="home">Home</a>
  </div>


</header>
<div class="main">
  <form name="searchForm" method="post" action="assets/list.php" onsubmit="return validateForm()">
    <select class="City" name="city" data-placeholder="City" required>
      <option value="none" disabled selected hidden>City</option>

      <?php
      foreach ($cities as $city) {
      ?>
        <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
      <?php
      }
      ?>

    </select>
    <select class="Room_Type" name="room_type" data-placeholder="Room Type">
      <option value="none" disabled selected hidden>Room Type</option>

      <?php
      foreach ($allTypes as $roomType) {
      ?>
        <option value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>
      <?php
      }
      ?>
    </select>
    <div class="check">
      <div class="Check-in-Date">
        <input onclick="(this.type='date')" type="text" name="Check-in" placeholder="Check-in-Date" value="" required style="width: 300px;
      padding-right: 10px;
      margin-top: 5px;
      height: 30px;
      text-align: center;
      border-radius: 10px;">
      </div>
      <div class=" Check-out-Date">
        <input onclick="(this.type='date')" type="text" name="Check-out" placeholder="Check-out-Date" value="" required style="width: 300px;
    padding-right: 10px;
    margin-top: 5px;
    height: 30px;
    margin-left: 5px;
    margin-bottom: 10px;
    text-align: center;
    border-radius: 10px;">
      </div>
      <div>
        <p id="check_in_date_error" class="text-danger"></p>
        <p id="check_in_date_error" class="text-danger"></p>
      </div>
    </div>
    <div class="button">
      <input type="submit" value="Search">
    </div>
  </form>
</div>
</body>
</div>
<script type=text/javascript">
  $(function() {
    $("#datepicker-start").datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
  $(function() {
    $("#datepicker-end").datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
</script>

<script type="text/javascript">
  var check_in_date = document.forms["searchForm"]["Check-in"];
  var check_out_date = document.forms["searchForm"]["Check-out"];

  var check_in_date_error = document.getElementById("check_in_date_error");
  var check_out_date_error = document.getElementById("check_out_date_error");
</script>
<footer>
  <p>collegelink2022</p>
</footer>

</html>