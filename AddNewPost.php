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
   $PostTitle   =  mysqli_real_escape_string($conn,$_POST['PostTitle']);
   $Category    =  mysqli_real_escape_string($conn,$_POST['Category']);
   $Image       =  mysqli_real_escape_string($conn,$_FILES['Image']['name']);
   $target      ="Uploads/".basename($_FILES['Image']['name']); 
   $PostText    = mysqli_real_escape_string($conn,$_POST['PostDescription']);

  $admin =$_SESSION["UserName"];
  date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  if (empty($PostTitle)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("AddNewPost.php");
    
  }elseif (strlen($PostTitle)<5) {
    $_SESSION["ErrorMessage"]= "Post Title title should be greater than 5 characters";
    Redirect_to("AddNewPost.php");
  }elseif (strlen($PostTitle)>49) {
     $_SESSION["ErrorMessage"]= "Post Title title should be less than than 50 characters";
     Redirect_to("AddNewPost.php");
  }elseif(strlen($PostText)>1000){
      $_SESSION["ErrorMessage"]= "Post Text  should be less than than 1000 characters";
  }else{
     // Query to insert post in DB When everything is fine
      
      echo $sql ="insert into posts(datetime,title,category,author,  image,post) values('{$DateTime}','{$PostTitle}','{$Category}','{$admin}','$Image','{$PostText}')";
      
          $result = mysqli_query($conn,$sql);
          move_uploaded_file($_FILES['Image']['tmp_name'],$target);
         if ($result) {
           $_SESSION["SuccessMessage"] ="Post added Successfully";
          Redirect_to("AddNewPost.php");
        }else{
          $_SESSION["ErrorMessage"] ="Something went wrong. Try Again !";
          Redirect_to("AddNewPost.php");
        }
      }
}//Ending of Submit Button If-Condition



?>
<!DOCTYPE html>
<html>
<head>
	<title>Add post:</title>
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
          <h1><i class="fas fa-edit" style="color:#27aae1;"></i>  Add New Post </h1>
          </div>
        </div>
      </div>
    </header>
     <!-- HEADER END -->

     <!-- Main Area -->
    <section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      <?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
       <form class="" action="AddNewPost.php" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          
              <div class="card-body bg-dark">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Categroy Title: </span></label>
               <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="">
            </div>
            <div class="form-group">
               <label for="CategoryTitle"> <span class="FieldInfo"> Chose Categroy </span></label>
              <select class="form-control" id="CategoryTitle"  name="Category">
                <?php 
                  echo $sql ="select*from category";
                  $result = mysqli_query($conn,$sql) or die("Qery Failed");
                  
                  while($row= mysqli_fetch_array($result)) {
                   $id =$row['id'];
                   echo $CategoryName =$row['title'];
                  
                 
                  print_r($row);
                 ?>
          <option><?php echo $CategoryName;?></option>
          <?php } ?>
                  
               </select>
            </div>
            <div class="form-group">
              <div class="custom-file">
              <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
              <label for="imageSelect" class="custom-file-label">Select Image </label>
              </div>
            </div>
            <div class="form-group">
              <label for="Post"> <span class="FieldInfo"> Post: </span></label>
              <textarea class="form-control" id="Post" name="PostDescription" rows="8" cols="80"></textarea>
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