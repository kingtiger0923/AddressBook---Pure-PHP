<?php

include "dataBase/db_con.php";

$config = include "config.php"; //dataBase Config
// Open DB
$conn = openDB($config);

// Get Address Records
$result = mysqli_query( $conn, 'SELECT a.*, c.cityName FROM addr_entries a LEFT JOIN addr_cities c ON a.city = c.id' );
$cities = mysqli_query( $conn, 'SELECT * FROM addr_cities' );

// Close DB
closeDB($conn);

?>

<!DOCTYPE HTML>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
  </head>
  <body>
    <div class="popup">
      <span class="popAlign"></span>
      <div>
        <div class="popClose">&times;</div>
        <div class="popTitle">Add New Address</div>
        <div class="content">
          <div class="cell"><label for="name">Name : </label><input id="name" name="name" type="text"/></div>
          <div class="cell"><label for="firstName">First Name : </label><input id="firstName" name="firstName" type="text"/></div>
          <div class="cell"><label for="email">Email : </label><input id="email" name="email" type="text"/></div>
          <div class="cell"><label for="street">Street : </label><input id="street" name="street" type="text"/></div>
          <div class="cell"><label for="zipCode">Zip Code : </label><input id="zipCode" name="zipCode" type="text"/></div>
          <div class="cell"><label for="city">City : </label><select id="city" name="city" type="text">
          <?php while($rc = mysqli_fetch_assoc($cities)) { ?>
            <option value="<?= $rc['id'] ?>"><?= $rc['cityName'] ?></option>
          <?php } ?>
          </select></div>
          <div class="cell" style="display: none;"><label for="city">Id : </label><input id="id" name="id" type="text"/></div>
          <div class="cell"><div class="confirm" onclick="Confirm();">Confirm</div></div>
        </div>
      </div>
    </div>
    <div class="container">
      <!-- Header -->
      <?php include "_src/header.php"; ?>

      <!-- Content -->
      <div class="appContent">
        <div class="actionBar">
          <span class="btn-action" onclick="removeSelected();">Remove</span>
          <span class="btn-action" onclick="editSelected();">Edit</span>
          <span class="btn-action" onclick="addNew();">Add New</span>
          <span class="btn-action"><a href="_src/exportJSON.php">Export as JSON</a></span>
          <span class="btn-action"><a href="_src/exportXML.php">Export as XML</a></span>
        </div>
        <div class="addressBook">
          <table class="w100 addrTable" style="border-collapse: collapse;">
            <thead class="w100">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>1st Name</th>
                <th>Email</th>
                <th>Street</th>
                <th>Zip-Code</th>
                <th>City</th>
              </tr>
            </thead>
            <tbody class="addrRec">
              <?php $count = 1; while($record = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?= $count ?></td>
                <td><?= $record['name'] ?></td>
                <td><?= $record['firstName'] ?></td>
                <td><?= $record['email'] ?></td>
                <td><?= $record['street'] ?></td>
                <td><?= $record['zip_code'] ?></td>
                <td><?= $record['cityName'] ?></td>
                <td style="display:none;" class="rcId"><?= $record['id'] ?></td>
              </tr>
              <?php $count++; } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Footer -->
      <?php include "_src/footer.php"; ?>
    </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="scriptJS/script.js"> </script>
  </body>
</html>