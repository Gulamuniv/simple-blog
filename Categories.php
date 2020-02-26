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
  $admin =$_SESSION["UserName"];
  date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  $Category = $_POST['CategoryTitle'];
  if (empty($Category)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("Categories.php");
    
  }elseif (strlen($Category)<3) {
    $_SESSION["ErrorMessage"]= "Category title should be greater than 2 characters";
    Redirect_to("Categories.php");
  }elseif (strlen($Category)>49) {
     $_SESSION["ErrorMessage"]= "Category title should be less than than 50 characters";
     Redirect_to("Categories.php");
  }else{
      //include "Includes/DB.php";
      $title = mysqli_real_escape_string($conn ,$_POST['CategoryTitle']);
      // Query to insert category in DB When everything is fine
      $sql ="insert into category(title,author,datetime) values('{$title}','{$admin}','{$DateTime}')";
      $result = mysqli_query($conn,$sql);
         if ($result) {
           $_SESSION["SuccessMessage"] ="Category added Successfully";
          Redirect_to("Categories.php");
        }else{
          $_SESSION["ErrorMessage"] ="Something went wrong. Try Again !";
          Redirect_to("Categories.php");
      }
    
  }
}//Ending of Submit Button If-Condition

?>
<!DOCTYPE html>
<html>
<head>
	<title>categories</title>
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
          <h1><i class="fas fa-edit" style="color:#27aae1;"></i> Manage categories</h1>
          </div>
        </div>
      </div>
    </header>
     <!-- HEADER END -->

     <!-- Main Area -->
    <section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
       <form class="" action="Categories.php" method="post">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-header">
            <h1>Add New Category</h1>
              </div>
              <div class="card-body bg-dark">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Categroy Title: </span><?php echo ErrorMessage();?><?php echo SuccessMessage();?></label>
               <input class="form-control" type="text" name="CategoryTitle" id="title" placeholder="Type title here" value="">
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
       <h2>Exsiting Categories</h2>
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>No. </th>
                <th>Date&Time</th>
                <th>category Name</th>
                <th>Author Name</th>
                <th>Action</th>
               
              </tr>
            </thead>
          <?php
          
           $sql = "SELECT * FROM `category` order by id desc"  ; 
         $results =  mysqli_query($conn ,$sql);
          $SrNo = 0;
          if(mysqli_num_rows($results)>0) {
            while($data=mysqli_fetch_assoc($results)) {
            $CategoryId       = $data["id"];
            $DateTimeOfcreated = $data["datetime"];
            $CategoryTitle = $data["title"];
            $CreaterName= $data["author"];
           
              $SrNo++;
          ?>
          <tbody>
            <tr>
              <td><?php echo htmlentities($SrNo); ?></td>
              <td><?php echo htmlentities($DateTimeOfcreated); ?></td>
              <td><?php echo htmlentities($CategoryTitle); ?></td>
              <td><?php echo htmlentities($CreaterName); ?></td>
            <td> <a href="DeleteCaterory.php?id=<?php echo $CategoryId;?>" class="btn btn-danger">Delete</a>  </td>
              
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