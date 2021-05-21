<?php session_start();
if(!isset($_SESSION['userid']) or !isset($_SESSION['username'])){
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>buy&sell</title>
	<!-- Meta Tags -->
  <meta charset="utf-8">
  <meta html-equiv = "X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
  <!-- Symbol -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- STYLE -->
  <style type="text/css">
  	@import url('https://fonts.googleapis.com/css2?family=Philosopher&display=swap');
  	header{
      /*background-color: white;*/
      z-index: 2;
      transition: background-color 0.2s;
      min-height: 10vh;
      text-align: center;
      font-family: 'Philosopher';
      font-size: 4rem;
      position: fixed;
      width: 100%;
    }
    @media (max-width: 556px) {
      header{
        font-size: 3rem;
      }
    }

    .card{
      /*margin: 1rem;*/
      border-radius: 25px;
    }
    .col-md-5{
      margin: 2.5rem;
    }
    .user{
      font-family: arial;
      font-size: 40%;
      display: inline-block;
      float: right;
      margin-top: 2%;
    }
    .hide{
      display: inline-block;
    }
    @media (max-width: 432px) {
      header{
        font-size: 2rem;
      }
      .user{
        font-size: 70%
      }
    }
    @media (max-width: 318px){
      .hide{
        display: none;
      }
    }
  </style>
</head>
<body>
	<!-- HEADER -->
  <header>
    <div class="text-center"> BUY and SELL 
      <div class="sym user text-secondary"> <div class="hide"><?php echo $_SESSION['username']; ?></div>
        <a href="logout.php">
          <i class="fa text-secondary">
          &nbsp; &#xf08b;
          </i>
        </a>
      </div>
    </div>
  </header>
<!-- MAIN CONTAINT -->
<br><br><br><br>
<?php
  require_once('connect.php');
  
  $stmt=$con->prepare('SELECT * FROM products');
  $stmt->execute();
  $res = $stmt->get_result();
  $stmt->close();

?>
  <div class="container">
    <div class="row">';
<?php
    while($row = $res->fetch_assoc()){
?>
      <div class="col-md-5 card">
<?php
        $imgname = $row['img'];
        if($row['img']){
          echo "<img class='card-img-top' src='up/$imgname' width='100' height='300' alt='NO IMAGE'>";
        }else{
          echo '<img class="card-img-top" src="up/default.png" width="100" height="300">';
        }
?>
        <div class="card-body">
          <hr><b>
          <?php echo $row['name'];?>
          </b><hr>
<?php
          $stmt1 =$con->prepare("SELECT contact, roll FROM users WHERE roll = ? ");
          $stmt1->bind_param("s", $row['ownerroll']);
          $stmt1->execute();
          $res1 = $stmt1->get_result();
          $stmt1->close();
          $row1 = $res1->fetch_assoc();
          if($row1 && $row['ownerroll'] == $row1['roll'])
            echo '<b>CONTACT : </b>'.$row1['contact'];
          else
            echo '<b>CONTACT : </b> 9525177622';
?>
          <hr>
          <?php echo $row['details']; ?>
        </div>
      </div>
<?php 
    }
?>
    </div>
  </div>
</body>
</html>