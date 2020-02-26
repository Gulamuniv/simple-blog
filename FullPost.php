<?php
require_once("Includes/DB.php");
require_once("Includes/Function.php");
require_once("Includes/Session.php");
 $SearchQueryParameter = $_GET["id"]; 
?>
<?php
if (isset($_POST['submit'])) {
   
  $name = mysqli_real_escape_string($conn,$_POST['CommenterName']);
  $email = mysqli_real_escape_string($conn,$_POST['CommenterEmail']);
  $comment = mysqli_real_escape_string($conn,$_POST['CommenterThoughts']);
  date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
if (empty($name)||empty($email) ||empty($comment)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("FullPost.php?id={$SearchQueryParameter}");
    }elseif (strlen($comment)<10) {
     $_SESSION["ErrorMessage"]= "At Least 10 character message";
     Redirect_to("FullPost.php?id={$SearchQueryParameter}");
  }elseif (strlen($comment)>499) {
    $_SESSION["ErrorMessage"]= "Comment Lenth Less than 500 character";
     Redirect_to("FullPost.php?id={$SearchQueryParameter}");
  }else{
      //include "Includes/DB.php";
  $sql ="insert into comments(datetime,name,email,comment,approvedby,status,post_id
              ) values('{$DateTime}','{$name}','{$email}','{$comment}','pedding','OFF',{$SearchQueryParameter})";
         $result = mysqli_query($conn,$sql);
         
         if ($result) {
           $_SESSION["SuccessMessage"] =" Message Send Successfully";
          Redirect_to("FullPost.php?id={$SearchQueryParameter}");
        }else{
          $_SESSION["ErrorMessage"] ="Something went wrong. Try Again !";
           Redirect_to("FullPost.php?id={$SearchQueryParameter}");
}
    // Query to insert category in DB When everything is fine
  }
 
  
}//Ending of Submit Button If-Condition

?>
<!DOCTYPE html>
<html>
<head>
	<title>Full post</title>
</head>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/styles.css">
<body>
<!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand">GULAMKHAN.COM</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">About Us</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link">Blog</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Contact Us</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Features</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <form class="form-inline d-none d-sm-block" action="Blog.php">
          <div class="form-group">
          <input class="form-control mr-2" type="text" name="Search" placeholder="Search here"value="">
          <button  class="btn btn-primary" name="SearchButton">Go</button>
          
          </div>
        </form>
      </ul>
      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h1><i class="fas fa-text-height" style="color:#27aae1;"></i> Basic</h1>
          </div>
        </div>
      </div>
    </header>
     <!-- HEADER END -->
      <div class="container">
      <div class="row mt-4">
      <!-- Main Area Start-->
     <div class="col-sm-8 ">
          <h1>The Complete Responsive CMS Blog</h1>
          <h1 class="lead">The Complete blog by using PHP by Gulam</h1>
          <?php 
            // SQL query when Searh button is active
           if(isset($_GET['SearchButton'])) {
            $search = $_GET['Search'];
             $sql ='SELECT * FROM posts where 
            datetime like"%{$search}%"
            OR title like"%{$search}%"
            OR category like"%{$search}%"
            OR post Like"%{$search}%"';
             
          $result = mysqli_query($conn,$sql) or die("Qery Failed");
           }else{
            $postForm = $_GET['id'];
            if (!isset($postForm)) {
              $_SESSION['ErrorMessage'] ="Bad Request!";
              redirect_to("Blog.php?page=1");
            }
              $sql ="SELECT * FROM posts where id={$postForm}";
            $result = mysqli_query($conn,$sql) or die("Qery Failed");
           if (mysqli_num_rows($result)!=1) {
              $_SESSION["ErrorMessage"]="Bad Request!";
              Redirect_to("Blog.php?page=1");
            }
             if (mysqli_num_rows($result)>0) {

             while ($data =mysqli_fetch_assoc($result)) {
                $postId     = $data['id']; 
                $DateTime   = $data['datetime']; 
                $PostTitle  = $data['title']; 
                $Category   = $data['category'];
                $Admin      = $data['author'];
                $Image      = $data['image'];
                $PostDesc     = $data['post'];
                  }
           
          ?>
          <div class="card">
            <img src="Uploads/<?php echo htmlentities($Image);?>" style ="min-height: 100px; min-width: 100px;"class="img-fluid card-img-top"/>
            <div class="card-body">
              <h4 class="card-title"><?php echo htmlentities($PostTitle);?></h4>
              <small class="text-muted">Category:<a href="Blog.php?category=<?php echo htmlentities($Category); ?>"><?php echo ($Category);?></a>:Written by:<span class="text-dark"><a href="profile.php?username=<?php echo htmlentities($Admin);?>"><?php echo htmlentities($Admin);?></a></span> On <span class="text-dark"><?php echo htmlentities($DateTime);?></span></small>
             
              <hr>
              <p class="card-text">
               <?php
                echo nl2br($PostDesc);
               ?>
               </p>
               <a href="FullPost.php?id=<?php echo $postId; ?>" style="float:right;">
                <span class="btn btn-info">Read More &rang;&rang; </span></a>
            </div>
          </div>
          <?php
             }
        }
           ?>
          <!-- Fetching existing comment START  -->
          <span class="FieldInfo">Comments</span>
          <br><br>
        <?php
        
        $sql  = "SELECT * FROM comments
         WHERE post_id='{$SearchQueryParameter}' AND status='ON'";
        $result = mysqli_query($conn,$sql) or die("Qery Failed");
        
        while ($data =mysqli_fetch_assoc($result)) {
          $CommentDate   = $data['datetime'];
          $CommenterName = $data['name'];
          $CommentContent= $data['comment'];
        ?>
  <div>
    <div class="media CommentBlock">
      <img class="d-block img-fluid align-self-start" src="images/CXWvTxnW.png" alt="">
      <div class="media-body ml-2">
        <h6 class="lead"><?php echo $CommenterName; ?></h6>
        <p class="small"><?php echo $CommentDate; ?></p>
        <p><?php echo $CommentContent; ?></p>
      </div>
    </div>
  </div>
  <hr>
  <?php } ?>
 
        <!--  Fetching existing comment END -->
           <!-------Coomet Area started---------->
           <div>
             <?php 
           echo ErrorMessage();
          echo SuccessMessage();
            ?>
            <form class="" action="FullPost.php?id=<?php echo $SearchQueryParameter;?>" method="post">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="FieldInfo">Share your thoughts about this post</h5>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                    <input class="form-control" type="text" name="CommenterName" placeholder="Name" value="" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                    <input class="form-control" type="email" name="CommenterEmail" placeholder="Email" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea name="CommenterThoughts" class="form-control" rows="6" cols="80"></textarea>
                  </div>
                  <div class="">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>

           <!-------Coomet Area End---------->
         </div>
         <!-- Main Area End-->
          

         <!-- SideArea Star-->
         <?php require_once('Includes/sidebar.php')?>
         <!-- Side Area End -->
    </div>
</div>
         
<br>
    <!-- FOOTER -->
    <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
          <p class="lead text-center">Theme By | Gulam Khan | <span id="year"></span> &copy; ----All right Reserved.</p>
          <p class="text-center small"><a style="color: white; text-decoration: none; cursor: pointer;" href="#" target="_blank"> This site is only used for Study purpose gulamkhan.com have all the rights &trade;  Skillshare</a></p>
           </div>
         </div>
      </div>
    </footer>
        <div style="height:10px; background:#27aae1;"></div>
    <!-- FOOTER END-->
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script>
  $('#year').text(new Date().getFullYear());
</script>

</html>