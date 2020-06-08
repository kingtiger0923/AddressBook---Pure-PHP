<?php
  header('Content-Type: application/json');

  include "../dataBase/db_con.php";
  $config = include "../config.php"; //dataBase Config

  // Open DB
  $conn = openDB($config);

  $result = array();

  if( !isset($_POST['func']) ) { $result['error'] = "Function Name not specified!"; }
  if( !isset($_POST['arguments']) ) { $result['error'] = "Arguments not specified!"; }
  if( !isset($result['error']) ) {
    if( $_POST['func'] == 'remove' ) {
      $args = json_decode($_POST['arguments'][0]);
      for( $i = 0; $i < count($args); $i ++ )
      {
        $query_res = mysqli_query($conn, "DELETE FROM addr_entries WHERE id='".$args[$i]."'");
        if( $query_res == FALSE ) {
          $result['error'] = "Failed to delete a record where id=".$args[$i];
        }
      }
    } else if( $_POST['func'] == 'edit' ) {
      $args = json_decode($_POST['arguments'][0]);
      $query_str = "UPDATE addr_entries SET name='".$args->name."', firstName='".$args->firstName."', email='".$args->email."', street='".$args->street."', zip_code='".$args->zipCode."', city='".$args->city."' WHERE id='".$args->id."'";
      if( mysqli_query($conn, $query_str) == FALSE) {
        $result['error'] = "Failed to Update a record where id=".$args->id;
      }
    } else if( $_POST['func'] == 'add' ) {
      $args = json_decode($_POST['arguments'][0]);
      $query_str = "INSERT INTO addr_entries (name, firstName, email, street, zip_code, city) VALUES ('".$args->name."', '".$args->firstName."', '".$args->email."', '".$args->street."', '".$args->zipCode."', '".$args->city."')";
      if( mysqli_query($conn, $query_str) == FALSE) {
        $result['error'] = "Failed to Add a new record";
      } else if( $_POST['func'] == 'XML' ) {
        
      } else if( $_POST['func'] == 'JSON' ) {
      }
    } 
  }

  // Close DB
  closeDB($conn);


  echo json_encode($_POST['arguments']);
?>