<?php session_start(); ?>
<!-- PHP starts here -->
<?php

$notify = $err = "";
include_once('validation.php');

if(isset($_POST['Submit'])){

	if (empty($_POST["name"]) && empty($_POST['gender']) && empty($_POST['roll']) && empty($_POST['email']) && empty( $_POST['mob']) && empty( $_POST['pass'])) 
	{
    $err = "All Fields are required";
  }else{
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$roll = $_POST['roll'];
		$email = strtolower($_POST['email']);
		$mob = $_POST['mob'];
		$pass = $_POST['pass'];//encrypt at last
	}

	if(validate_name($name)!="good" && $err==""){
		$err = validate_name($name);
	}
	if(validate_roll($roll)!="good" && $err==""){
		$err = validate_roll($roll);
	}
	if(validate_email($email)!="good" && $err==""){
		$err = validate_email($email);
	}
	if(validate_mob($mob)!="good" && $err==""){
		$err = validate_mob($mob);
	}
	
	// echo $name."|".$email."|".$roll."|".$gender."|".$mob."|".$pass;

	if($err == ""){
		require_once('connect.php');
		$stmt=$con->prepare('SELECT roll, email FROM users');
		$stmt->execute();
		$res = $stmt->get_result();
		$stmt->close();

		$present = false;
		while($row = $res->fetch_assoc()){
			if($roll == $row['roll'] || $email == $row['email'])
				$present = true;
		}


		if($present == true){
			$err = "User Already registered Try Sign-in";
		}
		else{
			$stmt = $con->prepare("INSERT INTO `users`(`username`,`gender`,`roll`,`email`,`contact`,`password`) VALUES (?,?,?,?,?,?)");
			
			$stmt->bind_param("ssssss", $name, $gender, $roll, $email, $mob, $pass);
			if($stmt->execute()){
				$stmt->close();
				$con->close();
				$notify = "User Registered sign-in now!!";
				// header('Location: '.$_SERVER['REQUEST_URI']);
			}		
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>buy&sell</title>
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta html-equiv = "X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/index.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">

	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Philosopher&display=swap');
		header{
			background-color: white;
			z-index: 2;
			transition: background-color 0.2s;
			min-height: 15vh;
			text-align: center;
			font-family: 'Philosopher';
			font-size: 4rem;
			position: fixed;
			width: 100%;
		}
		@media (max-width: 664px) {
			header{
				font-size: 3rem;
			}
		}
		@media (max-width: 310px) {
			header{
				font-size: 2rem;
			}
		}
		.img-fluid {
			margin: 10%;
			max-width: 70%;
			height: auto;
		}
		.title{
			font-family: "Allerta Stencil", Sans-serif;
			font-size: 2rem;
		}
		.col-md-6:hover{
			background-color: white;
		}
		.lable{
			font-family: arial;
			font-size: 1rem;
			text-align: left;
		}
		.form-control{
			display: inline-block;
			margin-top: 3px;
			margin-bottom: 4px;
			background: transparent!important;
			font-size: 18px!important;
			border-radius: 10px;
		}
	</style>
</head>
<body>
	<!-- HEADER -->
  <header>
    <div class="text-center"> BUY and SELL - register </div>
  </header>
<!-- MAIN CONTAINT -->
  </br></br></br></br>
  <div class="container">
  	<div class=row> 
  		<div class="col-md-6">
        <img src="img/shopping.svg" class="img-fluid">
      </div>
  		<div class="col-md-6 text-center"> <!-- seller -->
  			<br><div class="title"> BUYER & SELLER </div><br>
				<p style="color:red"><b><?php echo $err; ?></b></p>
				<p style="color:green"><b><?php echo $notify; ?></b></p>
  			<form method="POST" action="#">
          <center>
          <div class="lable">
          	NAME : <input type="text" id="name" class="form-control" name="name" placeholder="Full Name" style="width: 84%" required/>
          </div>
          <div class="lable">
          	SEX : &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="male" name="gender" value="male">
						<label for="male">Male</label>&nbsp;&nbsp;
						<input type="radio" id="female" name="gender" value="female">
						<label for="female">Female</label>&nbsp;&nbsp;&nbsp;&nbsp;

          	ROLL NUMBER : <input type="number" id="roll" class="form-control" name="roll" placeholder="XXX-XXX-XXX" style="width: 30%" min="100000000" max="999999999" required/>
          </div>
          <div class="lable">
          	EMAIL : <input type="email" id="mail" class="form-control" name="email" placeholder="EMAIL ID" style="width: 83%" required/>
          </div>
          <div class="lable">
          	CONTACT NUMBER : <input type="NUMBER" id="mob-num" class="form-control" name="mob" placeholder="Mobile Number" style="width: 50%"  min="5000000000" max="9999999999" required/>
          </div>
          <div class="lable">
          	PASSWORD : <input type="password" id="pass" class="form-control" name="pass" placeholder="PASSWORD" style="width: 50%" required/>
          </div>
            <br><br>
          <input class="button" type="submit" value="Submit" name="Submit">
          <br><br>
          <div><a href="index.php">Sign-in</a> instead</div>
            </br></br></br>
          </center>
        </form>
  		</div>
  	</div>
  </div>
</body>
</html>