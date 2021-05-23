<?php session_start();
if(!isset($_SESSION['userid']) or !isset($_SESSION['username'])){
  header('location:index.php');
}

require_once('connect.php');
$err = $notify = "";

if(isset($_POST['Submit'])){

  $pname = $_POST['pname'];
  $details = $_POST['paragraph_text'];
  $img_name = $_FILES['pimg']['name'];
  $ownername = $_SESSION['roll'];

  $stmt = $con->prepare("INSERT INTO `products`(`name`,`img`,`details`,`ownerroll`) VALUES(?,?,?,?)");
			
  $stmt->bind_param("ssss", $pname, $img_name, $details, $ownername);
  
  if($stmt->execute()){
    $move = move_uploaded_file($_FILES['pimg']['tmp_name'], 'up/'.$img_name);
    if($move){
      $notify = "Added your product for Sell<br>Bring more there are lots of buyer...";
      $err = "";
    }
  }
  else{
    $notify = "";
    $err = "INSERTION FAILED";
  }

  $stmt->close();
}

if(isset($_POST['delete'])){
  // echo $_POST['delete'];
  $pid = explode("+",$_POST['delete']);
  $stmt3 = "";
  if($pid[1]=='available')
    $stmt3 = $con->prepare("UPDATE `products` SET `status` = 'cancelled' WHERE p_id = ?");
  else
    $stmt3 = $con->prepare("UPDATE `products` SET `status` = 'available' WHERE p_id = ?");
  $stmt3->bind_param('i', $pid[0]);
  $stmt3->execute();
  $res3 = $stmt3->get_result();
  $stmt3->close();
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
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/sell.css" media="screen">
  <!-- FONTS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
  <!-- Symbol -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- STYLE -->
  <style type="text/css">
  	@import url('https://fonts.googleapis.com/css2?family=Philosopher&display=swap');
  </style>
</head>
<body>
	<!-- HEADER -->
  <header>
    <div class="text-center"> BUY and SELL 
      <div class="sym user text-secondary"><div class="hide"> <?php echo $_SESSION['username']; ?></div>
        <a href="logout.php">
          <i class="fa text-secondary">
          &nbsp; &#xf08b;
          </i>
        </a>
      </div>
    </div>
  </header>
<!-- MAIN CONTAINT -->
  </br></br></br></br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
<?php
          $findby= "";
          include_once('validation.php');
          if(validate_email($_SESSION['userid'])=='good')
            $findby = "email";
          else if(validate_roll($_SESSION['userid'])=='good')
            $findby = "roll";
          
          $stmt1=$con->prepare('SELECT roll FROM `users` WHERE '.$findby.'=?');
          $stmt1->bind_param('s',$_SESSION['userid']);
          $stmt1->execute();
          $res1 = $stmt1->get_result();
          $stmt1->close();

          if($row1 = $res1->fetch_assoc()){
            $stmt2 = $con->prepare("SELECT * FROM `products` WHERE ownerroll = ? ");
            $stmt2->bind_param('s', $row1['roll']);
            $stmt2->execute();
            $res2 = $stmt2->get_result();
            $stmt2->close();
            while($row2 = $res2->fetch_assoc()){
              if($row2['status']){
?>
              <div class="wrapper">
                <div class="product-img">
<?php
                  $imgname = $row2['img'];
                  if(strlen($row2['img'])>0){
                    echo "<img class='card-img-top' src='up/$imgname' width='420' height='327' alt='NO IMAGE'>";
                  }else{
                    echo '<img class="card-img-top" src="up/default.png" width="420" height="327">';
                  }
?>
                </div>
                <div class="product-info">
                  <div class="product-text">
                    <h1><?php echo $row2['name'];?></h1>
                    <h2>by studio and friends</h2>
                    <p><?php echo $row2['details']; ?></p>
                  </div>
                  <div class="product-price-btn" style="display: inline-flex;">
                  <form method="POST" action="#">
                    <?php if($row2['status'] == "cancelled"){ ?>
                      <button class="dlt-dis" name="delete" value="<?php echo $row2['p_id']."+".$row2['status']; ?>" type="submit" >Cancelled</button>
                    <?php }else{?>
                      <button class="dlt" name="delete" value="<?php echo $row2['p_id']."+".$row2['status']; ?>" type="submit">Selling</button>
                    <?php }?>
                  </form>
                  <button name="edit" value="<?php echo $row2['p_id']; ?>" type="submit">&#8377; <?php echo $row2['price']; ?> edit</button>
                  </div>
                </div>
              </div>
<?php 
              }
            }
          }else{
            echo '<img src="img/shopping.svg" class="img-fluid">';
          }
?>
      </div>
      <div class="col-md-6">
        </br>
        <br><div class="title text-center"> ADD PRODUCT </div><br>
        </br>
        <p style="color:red"><b><?php echo $err; ?></b></p>
				<p style="color:green"><b><?php echo $notify; ?></b></p>
        <form method="POST" action="sell.php" enctype="multipart/form-data">
          <div class="lable">
            PRODUCT NAME : <input type="text" id="productName" class="form-control" placeholder="PRODUCT NAME" name="pname" style="width: 70%;" required />
          </div>
          <div class="lable">
            IMAGE : 
            <img id="blah" src="img/cam.png" width="100" height="100"  />
            <input type="file" name="pimg" accept=".jpg,.gif,.jpeg,.png" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" required>
          </div>
          <div class="lable">
            DETAILS : <br><textarea  name="paragraph_text" rows="5" id="details" class="form-control" placeholder="Give details of the product (max character 100)." name="detail" required></textarea>
          </div>
          </br></br>
          <center>
          <input class="button " type="submit" value="Submit" name="Submit">
          </center>
            </br></br></br>
        </form>
      
    </div>
  </div>
        </div>
  </br></br></br>
<!-- FOOTER -->
<footer>2020 &copy; Made with <font color="red">&hearts;</font> by <a href="https://github.com/mayankmohak">Mayank Mohak</a>  </footer>
</body>
</html>
