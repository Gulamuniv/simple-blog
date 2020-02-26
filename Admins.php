<?php
require_once("Includes/DB.php");
require_once("Includes/Function.php");
require_once("Includes/Session.php");
?>
<?php 
 $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login();?>
<?php
if (isset($_POST['Submit'])) {
   $UserName      = mysqli_real_escape_string($conn ,$_POST['Username']);
   $Name          = mysqli_real_escape_string($conn ,$_POST['Name']);
   $Password      = md5(mysqli_real_escape_string($conn ,$_POST['Password']));
   $ConfirmPassword = md5(mysqli_real_escape_string($conn ,$_POST['ConfirmPassword']));
  $admin =$_SESSION["UserName"];
  date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

if (empty($UserName)||empty($Password)||empty($ConfirmPassword)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("Admins.php");
    
  }elseif (strlen($Password)<5) {
    $_SESSION["ErrorMessage"]= "Password must be greater than 4 characters";
    Redirect_to("Admins.php");
  }elseif ($Password!==$ConfirmPassword) {
     $_SESSION["ErrorMessage"]= "Password and confirm Password must be same";
     Redirect_to("Admins.php");
  }elseif(CheckUserNameExistsOrNot($UserName)){
    $_SESSION["ErrorMessage"]= "Username Exists. Try Another One! ";
    Redirect_to("Admins.php");

  }else{
      //include "Includes/DB.php";
     
      // Query to insert admins in DB When everything is fine
    echo   $sql ="insert into admins(datetime,username,password,aname,addedby) values('{$DateTime}','{$UserName}','{$Password}','{$Name}','{$admin}')";
      $result = mysqli_query($conn,$sql);
         if ($result) {
           $_SESSION["SuccessMessage"] ="Admin {$Name} added Successfully";
          Redirect_to("Admins.php");
        }else{
          $_SESSION["ErrorMessage"] ="Something went wrong. Try Again !";
          Redirect_to("Admins.php");
      }
    
  }
}//Ending of Submit Button If-Condition

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admins</title>
</head>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/styles.css">
<body>
<!-- NAVBAR -->
<?php require_once("Includes/nav.php");?>
  
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h1><i class="fas fa-user" style="color:#27aae1;"></i> Manage Admins</h1>
          </div>
        </div>
      </div>
    </header>
     <!-- HEADER END -->

     <!-- Main Area -->
      <!-- Main Area -->
<section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      <?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
      <form class="" action="Admins.php" method="post">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-header">
            <h1>Add New Admin</h1>
          </div>
          <div class="card-body bg-dark">
            <div class="form-group">
              <label for="username"> <span class="FieldInfo"> Username: </span></label>
               <input class="form-control" type="text" name="Username" id="username"  value="">
            </div>
            <div class="form-group">
              <label for="Name"> <span class="FieldInfo"> Name: </span></label>
               <input class="form-control" type="text" name="Name" id="Name" value="">
               <small class="text-muted">*Optional</small>
            </div>
            <div class="form-group">
              <label for="Password"> <span class="FieldInfo"> Password: </span></label>
               <input class="form-control" type="password" name="Password" id="Password" value="">
            </div>
            <div class="form-group">
              <label for="ConfirmPassword"> <span class="FieldInfo"> Confirm Password:</span></label>
               <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword"  value="">
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Publish
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <h2>Exsiting Admins</h2>
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>No. </th>
                <th>Date&Time</th>
                <th>User Name</th>
                <th>Author Name</th>
                <th>Added By</th>
                
                <th>Action</th>
               
              </tr>
            </thead>
          <?php
          
           $sql = "SELECT * FROM `admins` order by id desc"  ; 
         $results =  mysqli_query($conn ,$sql);
          $SrNo = 0;
          if(mysqli_num_rows($results)>0) {
            while($data=mysqli_fetch_assoc($results)) {
            $AdminId            = $data["id"];
            $DateTimeOfcreated  = $data["datetime"];
            $AdminUsername      = $data["username"];
            $AdminName      = $data["aname"];
            $AddedByAdmin       =$data['addedby'];
           $SrNo++;
          ?>
          <tbody>
            <tr>
              <td><?php echo htmlentities($SrNo); ?></td>
              <td><?php echo htmlentities($DateTimeOfcreated); ?></td>
              <td><?php echo htmlentities($AdminUsername); ?></td>
              <td><?php echo htmlentities($AdminName); ?></td>
              <td><?php echo htmlentities($AddedByAdmin); ?></td>
            <td> <a href="DeleteAdmin.php?id=<?php echo $CategoryId;?>" class="btn btn-danger">Delete</a>  </td>
              
            </tr>
          </tbody>
          <?php } 
        }?>
          </table>
      
    </div>
  </div>
</section>
     <!------ Main Area End------>
<br>
    <!-- FOOTER -->
   <?php require_once('Includes/foote.php'); ?>
    <!-- FOOTER END-->
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script>
  $('#year').text(new Date().getFullYear());
</script>

</html>