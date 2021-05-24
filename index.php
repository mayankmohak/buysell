<?php session_start(); ?>
<!-- PHP starts here -->
<?php

$notify = "Sample login Username : admin@buysell.com  &  Pass : 123456."; 
$err = "";
include_once('validation.php');

if(isset($_POST['Submit'])){
  require_once('connect.php');

  $userid = $_POST['user'];
  $pass = $_POST['pass'];//do md5 at last
  $gotopage = $_POST['buy-sel'];

  //this is to check if either of the fields are vacaent
  if (empty($userid) || empty($pass) ) {
    $notify = "";
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
            header('location:./buy.php');
          }
          if ($gotopage == 's')
            header('location:./sell.php');
        }else{
          $notify = "";
          $err = "Wrong Password !!";
        }
      }
    }
    if($found==false){
      $notify = "";
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
  <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/index.css" media="screen">
  <!-- fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Philosopher&display=swap');
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
          <input type="text" id="roll" class="form-control" placeholder="E-mail or Roll" name="user" autofocus required />
            </br></br>
          <input type="password" id="userPassword" class="form-control" placeholder="Password" name="pass"required/>
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
<footer>2020 &copy; Made with <font color="red">&hearts;</font> by <a href="https://github.com/mayankmohak">Mayank Mohak</a>  </footer>
</body>
</html>
