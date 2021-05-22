<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function validate_name($name){
  if (! preg_match("/^[a-zA-Z-' ]*$/",$name) ) {
    $Msg = "Only alphabets and whitespace are allowed.";
  } else {
    $Msg = "good";
  }
  return $Msg;
}

function	validate_roll($roll){
  if (! preg_match ("/^[0-9]*$/", $roll) ) {
    $Msg = "Only Numbers are allowed.";
  } else {
    $Msg = "good";
  }
  return $Msg;
}

function	validate_email($email){
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $Msg = "Invalid email format";
  } else {
    $Msg = "good";
  }
  return $Msg;
}

function	validate_mob($mob){
  if (! preg_match ("/^[0-9]*$/", $mob) ) {
    $Msg = "Only numbers are allowed.";
  } else {
    $Msg = "good";
  }
  return $Msg;
}

?>