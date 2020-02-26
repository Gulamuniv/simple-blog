<?php
require_once("Includes/DB.php");
require_once("Includes/Function.php");
require_once("Includes/Session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog Page</title>
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
        <form class="form-inline d-none d-sm-block" action="Blog.php" method="get">
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
          <?php echo ErrorMessage();?><?php echo SuccessMessage();?>
          <?php 
           // SQL query when Searh button is active
           if(isset($_GET['SearchButton'])) {
            $search = $_GET['Search'];
            $sql ="SELECT * FROM posts where 
               title like'%{$search}%'
            OR datetime like'%{$search}%'
            OR category like'%{$search}%'
            OR post Like'%{$search}%'
            LIMIT 0, 25";
            $result = mysqli_query($conn,$sql) or die("Qery Failed");
         // Query When Pagination is Active i.e Blog.php?page=1
             }elseif(isset($_GET["page"])){
              $Page = $_GET["page"];
            if($Page==0||$Page<1){
            $ShowPostFrom=0;
             
             }else{
              $ShowPostFrom=($Page*2)-2;
             }
              $sql ="SELECT * FROM posts ORDER BY id DESC LIMIT {$ShowPostFrom},2";
              $result = mysqli_query($conn,$sql) or die("Qery Failed");
            }
             // Query When Category is active in URL Tab
            elseif(isset($_GET["category"])){
            $Category = $_GET["category"];
            $sql = "SELECT * FROM posts WHERE category='$Category' ORDER BY id desc";
            $result = mysqli_query($conn,$sql) or die("Qery Failed");
            }
               // The default SQL query
             else{
               $sql ="SELECT * FROM posts ORDER by id DESC LIMIT 3";
            $result = mysqli_query($conn,$sql) or die("Qery Failed");
            }
           
         
             if (mysqli_num_rows($result)>0) {
             while ($data   =mysqli_fetch_assoc($result)) {
                $postId     = $data['id']; 
                $DateTime   = $data['datetime']; 
                $PostTitle  = $data['title']; 
                $Category   = $data['category'];
                $Admin      = $data['author'];
                $Image      = $data['image'];
                $PostDesc   = $data['post'];
                  
           
          ?>
          <div class="card">
            <img src="Uploads/<?php echo htmlentities($Image);?>" style ="min-height: 100px; min-width: 100px;"class="img-fluid card-img-top"/>
            <div class="card-body">
              <h4 class="card-title"><?php echo htmlentities($PostTitle);?></h4>
            <small class="text-muted">Category:<a href="Blog.php?category=<?php echo htmlentities($Category); ?>"><?php echo ($Category);?></a>:Written by:<span class="text-dark"><a href="profile.php?username=<?php echo htmlentities($Admin);?>"><?php echo htmlentities($Admin);?></a></span> On <span class="text-dark"><?php echo htmlentities($DateTime);?></span></small>
              <span style="float:right;" class="badge badge-dark text-light">Comments:<?php echo ApproveCommnetAsPosts($postId);?></span>
              <hr>
              <p class="card-text">
               <?php
                if(strlen($PostDesc)>150) {
                  $PostDesc = substr($PostDesc, 0,150).'...';
                }
                echo htmlentities($PostDesc);
               ?>
               </p>
               <a href="FullPost.php?id=<?php echo $postId; ?>" style="float:right;">
                <span class="btn btn-info">Read More &rang;&rang; </span></a>
            </div>
          </div>
        </br>
          <?php
             }
           }?>

           <!-- Pagination -->
           <nav>
            <ul class="pagination pagination-lg">
              <!-- Creating Backward Button -->
              <?php if(isset($Page) ) {
                if ( $Page>1) {?>
             <li class="page-item">
                 <a href="Blog.php?page=<?php  echo $Page-1; ?>" class="page-link">&laquo;</a>
               </li>
             <?php } }?>
            <?php
           
            $sql           = "SELECT COUNT(*) FROM posts";
            $resultsCount   =mysqli_query($conn,$sql);
            $RowPagination = mysqli_fetch_assoc($resultsCount);
            $TotalPosts    = array_shift($RowPagination);
            // echo $TotalPosts."<br>";
            $PostPagination=$TotalPosts/2;
            $PostPagination=ceil($PostPagination);
            // echo $PostPagination;
            for ($i=1; $i <=$PostPagination ; $i++) {
              if(isset($Page) ){
                if ($i == $Page) {  ?>
              <li class="page-item active">
                <a href="Blog.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
              </li>
              <?php
            }else {
              ?>  <li class="page-item">
                  <a href="Blog.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
                </li>
            <?php  }
          } } ?>
          <!-- Creating Forward Button -->
          <?php if (isset($Page) && !empty($Page) ) {
            if ($Page+1 <= $PostPagination) {?>
         <li class="page-item">
             <a href="Blog.php?page=<?php  echo $Page+1; ?>" class="page-link">&raquo;</a>
           </li>
         <?php } }?>
            </ul>
          </nav>
          <!-- Pagination End -->
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