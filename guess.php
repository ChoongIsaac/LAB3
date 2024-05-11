<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['random_number']))
{
  $_SESSION['random_number'] = rand(1,5);
}
$number = $_SESSION['random_number'];
$msg = false;
$guess  = (isset($_GET['guess']))? $_GET['guess'] :'';

if (!isset($_SESSION['attempt_number']))
{
$_SESSION['attempt_number'] = 0;
}
else {
	$_SESSION['attempt_number']++;
}
$attempt = $_SESSION['attempt_number'];
 ?>

<html>
<head>
<title> CHOONG WEN JIAN ISAAC 207545</title>
<link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="main.css">
</head>

<div class="container features">
<body>
<h1> Guessing game </h1>
<div class="form-group">
<form method = "GET" action = "guess.php">
<label for="guess">Guess a number: </label>
<input type = "text" name = "guess" value= " <?= htmlentities($guess) ?> " id = "guess" class="form-control"/>
<input type = "Submit" name = "submit" class="btn btn-secondary btn-block" />

</form>
</div>
<?php

if ( isset($_GET['guess']) ){
 if(!empty($guess)){
  if(strlen(strval($_GET['guess'])) != 0 && !str_contains(strval($_GET['guess']) ,'-') ){
	 if(is_numeric($guess)){
    if($guess < $number){
    	$msg = " # $attempt Attempt,Your guess is too low!";
    }

      elseif($guess > $number){
    	  $msg = "# $attempt Attempt,Your guess is too high!";

      }

      elseif($guess == $number){
			  unset($_SESSION['random_number']);
			  unset($_SESSION['attempt_number']);
      	$msg = "Congratulation! Your are right with 	# $attempt Attempt";
      }
  }
  else {
    $msg = "Your guess is not a number";
  }
 }
 else{$msg = "Your guess is too short";}
}
 else {
  $msg = "Missing guessing parameter";
 }
}


if ( $msg !== false ) {
echo("<p>$msg</p>\n");
}

?>


</body>
</div>
</html>
