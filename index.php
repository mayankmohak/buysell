<!-- Name: Mayank Mohak
    Email: mayank8199@gmail.com
      I am a coder. contact: 9525177622
      please feell free to ask for help and any project 
      mail me at mayank8199@gmail.com -->
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>buy&sell</title>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta html-equiv = "X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/index.css" media="screen"> -->
  <!-- <link rel="stylesheet" href="css/login.css"media="screen"> -->
  <!-- fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Philosopher&display=swap');
  </style>
  <style type="text/css">/*index.css*/
    .img-fluid {
      margin: 10%;
        max-width: 70%;
        height: auto;
    }
    header{
      background-color: white;
      z-index: 2;
      transition: background-color 0.2s;
      min-height: 10vh;
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
    footer{
      background-color: #454B69;
      transition: background-color 0.2s; 
      min-height: 10vh;
      text-align: center;
      font-family: Syne, sans-serif;
      color: white;
      bottom: 0;
      position: fixed;
      width: 100%;
    }
  </style>
  <style type="text/css">/*login.css*/
    .form-control{
      background: transparent!important;
      font-size: 18px!important;
      width: 80%;
      border-radius: 10px;
    }

    h4 {
      font-family: "Allerta Stencil", Sans-serif;
      border: 0 solid #fff; 
      border-bottom-width:1px;
      padding-bottom:10px;
      text-align: center;
    }
  </style>
</head>
<body>
<!-- HEADER -->
  <header>
    <div class="text-center"> BUY and SELL </div>
  </header>
<!-- MAIN CONTAINT -->
  </br></br></br></br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <img src="img/shopping.svg" class="img-fluid">
      </div>
      <div class="col-md-6 text-center">
        </br>
        <h4>LOGIN</h4>
          </br>
        <form method="POST" action="index.php">
          <center>
          <input type="text" id="roll" class="form-control" placeholder="roll number" name="roll" autofocus required />
            </br></br>
          <input type="password" id="userPassword" class="form-control" placeholder="password" name="pass"required/>
            </br>
          <input type="radio" id="buy" name="buy-sel" value="b" required>
          <label for="buy"> BUYER </label>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio" id="sell" name="buy-sel" value="s" required>
          <label for="sell"> SELLLER </label><br>
            </br>
          <input class="button" type="submit" value="Submit" name="Submit">
            </br></br></br>
          <div>Don't have account?
          <a href="register.php">register</a></div>
          </center>
        </form>
      </div>
    </div>
  </div>
  </br></br></br>
<!-- FOOTER -->
  <footer>2020 &copy; Made with <font color="red">&hearts;</font> by Lakshya  </footer>
</body>
</html>
<!-- PHP starts here -->
<?php

if(isset($_POST['Submit'])){
  
    $con=mysqli_connect('localhost','root','','buy-sell');
    // $con=mysqli_connect('sql211.epizy.com','epiz_27178478','5Dkmn56NmlLvE','epiz_27178478_buysell');

  if (!$con) {
    die("DB Connection failed");
  }
  else{
    $roll = $_POST['roll'];
    $pass = $_POST['pass'];//do md5 at last

    $sql = "SELECT * FROM users";
    $result = mysqli_query($con,$sql);
    $num_row = mysqli_num_rows($result);

    if($num_row > 0){
      while($row = mysqli_fetch_array($result)){

        //this is to check if either of the fields are vacaent
        if (empty($roll) || empty($pass) ) {
          echo '<script>alert("please fill all the fields")</script>';
        } 
        
        //this part is to chk if the pass and username are correct
        else if($roll == $row["roll"] && $pass == $row["password"]){

          $_SESSION['roll'] = $roll;
          $_SESSION['username'] = $row['username'];


          if ($_POST['buy-sel'] == 'b')
            header('location:buy.php');
          if ($_POST['buy-sel'] == 's') 
            header('location:sell.php');
        }
        
        else 
          echo '<script>alert("Wrong Password or UserName")</script>';
      }
    }
  }
}
?>





<!-- Name: Mayank Mohak
    Email: mayank8199@gmail.com
      I am a coder. contact: 9525177622
      please feell free to ask for help and any project 
      mail me at mayank8199@gmail.com -->