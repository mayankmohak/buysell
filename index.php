<?php session_start(); ?>
<!-- PHP starts here -->
<?php

$notify = $err = "";
include_once('validation.php');

if(isset($_POST['Submit'])){
  require_once('connect.php');

  $userid = $_POST['user'];
  $pass = $_POST['pass'];//do md5 at last
  $gotopage = $_POST['buy-sel'];

  //this is to check if either of the fields are vacaent
  if (empty($userid) || empty($pass) ) {
    $err = "Please fill all the fields";
  }else{
    $stmt=$con->prepare('SELECT roll, email, password, username FROM users');
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();
    
    $found = false;
    while($row = $res->fetch_assoc()){
      if($userid == $row['roll'] || $userid == $row['email']){
        $found = true;
        if($pass == $row['password']){
          $_SESSION['userid'] = $userid;
          $_SESSION['username'] = $row['username'];

          if ($gotopage == 'b'){
            echo "correct";
            header('location:./buy.php');
            
          }
          if ($gotopage == 's')
            header('location:./sell.php');
        }else{
          $err = "Wrong Password !!";
        }
      }
    }
    if($found==false){
      $err = "UserName Not Found Do Register !!";
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
        <p style="color:red"><b><?php echo $err; ?></b></p>
				<p style="color:green"><b><?php echo $notify; ?></b></p>
        <form method="POST" action="index.php">
          <center>
          <input type="text" id="roll" class="form-control" placeholder="roll or E-mail" name="user" autofocus required />
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
  <footer>2020 &copy; Made with <font color="red">&hearts;</font> by Mayank Mohak  </footer>
</body>
</html>
