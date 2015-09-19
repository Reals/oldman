<?php
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  if( $username != 'admin' ) {
  	echo "username";
    return;
  }
  if( $password != '7895123' ) {
  	echo "password";
    return;  	
  }
  echo "upload_res.php";
?>