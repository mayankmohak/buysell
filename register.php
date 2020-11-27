<!-- Name: Mayank Mohak
		Email: mayank8199@gmail.com
			I am a coder. contact: 9525177622
			please feell free to ask for help and any project 
			mail me at mayank8199@gmail.com -->
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
  			<br><div class="title"> BUYER SELLER </div><br>
  			<form method="POST" action="#">
          <center>
          <div class="lable">
          	NAME : <input type="text" id="name" class="form-control" name="name" placeholder="Full Name" style="width: 84%" required/>
          </div>
          <div class="lable">
          	YEAR : <input type="number" id="year" class="form-control" name="year" placeholder="Year" style="width: 30%" min="1" max="4" required/>
          	ROLL NUMBER : <input type="number" id="roll" class="form-control" name="roll" placeholder="Roll Number" style="width: 30%" min="100000000" max="999999999" required/>
          </div>
          <div class="lable">
          	EMAIL : <input type="email" id="mail" class="form-control" name="email" placeholder="EMAIL ID" style="width: 80%" required/>
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
<!-- PHP starts here -->
<?php

if(isset($_POST['Submit'])){

	$con=mysqli_connect('localhost','root','','buy-sell');
  // $con=mysqli_connect('sql211.epizy.com','epiz_27178478','5Dkmn56NmlLvE','epiz_27178478_buysell');
	if (!$con) {
	  die("Connection failed");
	}
	else{
		$name = $_POST['name'];
		$year = $_POST['year'];
		$roll = $_POST['roll'];
		$email = $_POST['email'];
		$mob = $_POST['mob'];
		$pass = $_POST['pass'];
		
		$sql1 = "SELECT * FROM users";
    $res1 = mysqli_query($con,$sql1);
    $num_rows1 = mysqli_num_rows($res1);
    if($num_rows1){
    	$present = 'false';
      while($row1 = mysqli_fetch_array($res1)){
        if($roll == $row1['roll'])
          $present = 'true';
      }
    }

    if($present == 'true')
    	echo "<script>alert('User Already registered Try Sign-in')</script>";
    else
			$sql = "INSERT INTO `users`(`username`,`year`,`roll`,`email`,`contact`,`password`) VALUES('$name','$year','$roll','$email','$mob','$pass')";

		// $chk = mysqli_query($con , $sql);
	}
}
?>





<!-- Name: Mayank Mohak
    Email: mayank8199@gmail.com
      I am a coder. contact: 9525177622
      please feell free to ask for help and any project 
      mail me at mayank8199@gmail.com -->