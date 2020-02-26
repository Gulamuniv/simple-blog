<?php
require_once("Includes/DB.php");
require_once("Includes/Function.php");
require_once("Includes/Session.php");
?>
<?php
$SarchQueryParameter =$_GET['id'];
     echo ErrorMessage();
       echo SuccessMessage();
       // Db Connection //
       $sql = "select*from posts where id={$SarchQueryParameter}";
       $results = mysqli_query($conn,$sql);
       while ($row=mysqli_fetch_assoc($results)) {
         $titleBeDeleted = $row['title'];
         $CategroyBeDeleted = $row['category'];
         $imageBeDeleted  =$row['image'];
         $postBeDeleted  =$row['post'];
       }

if (isset($_POST['Submit'])) {
   // Query to Delete post in DB When everything is fine
      $sql ="delete  from posts where id ={$SarchQueryParameter}";
        $result = mysqli_query($conn,$sql);
        move_uploaded_file($_FILES['Image']['tmp_name'],$target);
         if ($result) {
          $target_To_Path_Delete_Img ="Uploads/$imageBeDeleted";
          unlink($target_To_Path_Delete_Img);
           $_SESSION["SuccessMessage"] ="Post Deleted Successfully";
          Redirect_to("posts.php");
        }else{
          $_SESSION["ErrorMessage"] ="Something went wrong. Try Again !";
          Redirect_to("posts.php");
        }
     
}//Ending of Submit Button If-Condition



?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete post</title>
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
          <h1><i class="fas fa-edit" style="color:#27aae1;"></i>delete post</h1>
          </div>
        </div>
      </div>
    </header>
     <!-- HEADER END -->

     <!-- Main Area -->
    <section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      
       <form class="" action="DeletePost.php?id=<?php echo $SarchQueryParameter; ?>" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          
              <div class="card-body bg-dark">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Categroy Title: </span></label>
               <input disabled  class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $titleBeDeleted;?>">
            </div>
            <div class="form-group">
               <span class="FieldInfo">Existing category:</span><?php echo$CategroyBeDeleted?>
                
             </br>
            </div>
            <div class="form-group">
               <span class="FieldInfo">Existing Image:</span>
               <img class="mb-1" src ="Uploads/<?php echo $imageBeDeleted;?>" style="width: 150px; height: 70px;"/>
             
            </div>
            <div class="form-group">
              <label for="Post"> <span class="FieldInfo"> Post: </span></label>
              <textarea disabled  class="form-control" id="Post" name="PostDescription" rows="8" cols="80">
                <?php echo $postBeDeleted;?>
              </textarea>
            </div>
             <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-danger btn-block">
                  <i class="fas fa-trash"></i>Delete
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