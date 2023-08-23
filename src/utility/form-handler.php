<?php 
  // handles the form and performs server-side validation

  $invalidInputs = [];
  if(isset($_POST['username'])) {
    $username = $_POST['username'];
    if(strlen($username) < 3) array_push($invalidInputs, 'username');
  }
  
  if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $emailPattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
    if(!preg_match($emailPattern, $email)) array_push($invalidInputs, 'email');
  }
  if(isset($_POST['phone'])) {
    $phone = $_POST['phone'];
    $phonePattern = '/^\+[0-9]{1,3}[0-9]{4,14}/';
    if($phone !== "" && !preg_match( $phonePattern,$phone)) array_push($invalidInputs, 'phone');
  }
  if(isset($_POST['password'])) {
    $password = $_POST['password'];
    if(strlen($password) < 3) array_push($invalidInputs, 'password');
  }
  if(isset($_POST['rePassword'])) {
  $rePassword = $_POST['rePassword'];
  if($rePassword !== $password) array_push($invalidInputs, 'rePassword');
}

if(count($invalidInputs) > 0) {
  throw new Exception('Invalid ' . implode(', ', $invalidInputs) . ' format');
}
?>