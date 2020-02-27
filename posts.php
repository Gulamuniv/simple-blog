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
      
       $sql ="insert into posts(datetime,title,category,author,  image,post) values('{$DateTime}','{$PostTitle}','{$Category}','{$admin}','$Image','{$PostText}')";
      
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
	<title>Posts</title>
</head>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/styles.css">
  <style type="text/css">
    .page-link{
      color: red;
    }
    a.page-link{
      background: cyan!important;
    }
    .backlink{
      background: red;
    }
    .page-item.active .page-link{
      background-color: #ff00b1!important;
    } 
  </style>
<body>
<!-- NAVBAR -->
<?php require_once("Includes/nav.php");?>
<!-- NAVBAR END -->
    
    <!-- HEADER -->
     <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <?php
         echo ErrorMessage();
         echo SuccessMessage();
        ?>
          <div class="col-md-12">
          <h1><i class="fas fa-blog" style="color:#27aae1;"></i> Blog Posts</h1>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="AddNewPost.php" class="btn btn-primary btn-block">
              <i class="fas fa-edit"></i> Add New Post
            </a>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="Categories.php" class="btn btn-info btn-block">
              <i class="fas fa-folder-plus"></i> Add New Category
            </a>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="Admins.php" class="btn btn-warning btn-block">
              <i class="fas fa-user-plus"></i> Add New Admin
            </a>
          </div>
          <div class="col-lg-3 mb-2">
            <a href="Comments.php" class="btn btn-success btn-block">
              <i class="fas fa-check"></i> Approve Comments
            </a>
          </div>
 
        </div>
      </div>
    </header>
     <!-- HEADER END -->

     <!-- Main Area -->
      <?php
         /*echo ErrorMessage();
         echo SuccessMessage();*/
        ?>
     <section class="container py-2 mb-4">
      <div class="row">
        <div class="col-lg-12">
          <table  class="table table-striped table-hover">
          
            <thead class="thead-dark">
              <tr>
              <th>#</th>
              <th>Title</th>
              <th>Category</th>
              <th>Date&Time</th>
              <th>Author</th>
              <th>Banner</th>
              <th>Comments</th>
              <th>Action</th>
              <th>Live Preview</th>
              </tr>
            </thead>
            <?php 
            if(isset($_GET["page"])){
              $Page = $_GET["page"];
            if($Page==0||$Page<1){
            $ShowPostFrom=0;
             
             }else{
              $ShowPostFrom=($Page*2)-2;
             }
              $sql ="SELECT * FROM posts ORDER BY id DESC LIMIT {$ShowPostFrom},2";
              $result = mysqli_query($conn,$sql) or die("Qery Failed");
            
             
            $num=0;
             if (mysqli_num_rows($result)>0) {
               
              while ($rows = mysqli_fetch_assoc($result)) {
                $Id         = $rows['id'];
                $Datetime   = $rows['datetime'];
                $Title      = $rows['title'];
                $Category   = $rows['category'];
                $Author     = $rows['author'];
                $Image      = $rows['image'];
                $Post       = $rows['post'];
             $num++;
            ?>
            <tbody>

              <tr>
                <td><?php echo $num;?></td>
                <td><?php  
                  if (strlen($Title)>20) {
                    $Title =substr($Title, 0,10).'..';}
                  echo $Title;

                ?></td>
                <td><?php 
                 if (strlen($Category)>8) {
                    $Title =substr($Category, 0,8).'..';}
                echo $Category; ?></td>
                <td><?php 
                  if(strlen($Datetime)>11) {
                    $Datetime =substr($Datetime, 0,11).'..';}
                  echo $Datetime; ?></td>
                <td><?php 
                if (strlen($Author)>7) {
                    $Author =substr($Author, 0,7).'..';}
                echo $Author; ?></td>
                <td><img src="Uploads/<?php echo $Image ; ?>" width="140px;" height="50px"></td>
                <td>
                  <?php 
                    $TotalComments = ApproveCommnetAsPosts($Id);
                    if ($TotalComments>0) {
                      echo '<span class="badge badge-success">';
                      echo $TotalComments;
                    } 

                 ?>
                     </span>

                       <?php 
                          $TotalDisComments = DisApproveCommnetById($Id);
                            if ($TotalDisComments) {
                              echo '<span class="badge badge-danger">';
                              echo $TotalDisComments;
                            }
                        ?>
                      </span>
                </td>
                <td><a href="EditPost.php?id=<?php echo $Id;?>"><span class="btn btn-warning">Edit</span></a>
                <a href="DeletePost.php?id=<?php echo $Id;?>"><span class="btn btn-danger">Delete</span></a></td>
                <td><a href="FullPost.php?id=<?php echo $Id;?>" target=_blank><span class="btn btn-primary">Live Preview</span></td>

              </tr>
            </tbody>
          <?php }}
          } ?>
          </table>
        </div>
      </div>
    </section>
     <!-- Pagination -->
      <div class="justify-content-around" style="margin-left: 400px;" >
         <nav>
            <ul class="pagination pagination-lg">
              <!-- Creating Backward Button -->
       <?php $Page = $_GET["page"]; 
        
               if(isset($Page) ) {
                if ( $Page>1) {?>
             <li class="page-item">
                 <a href="Posts.php?page=<?php  echo $Page-1; ?>" class="page-link">Pri&laquo;</a>
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
                <a href="Posts.php?page=<?php  echo $i; ?>" class="page-link backlink"><?php  echo $i; ?></a>
              </li>
              <?php
            }else {
              ?>  <li class="page-item">
                  <a href="Posts.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
                </li>
            <?php  }
          } } ?>
          <!-- Creating Forward Button -->
          <?php if (isset($Page) && !empty($Page) ) {
            if ($Page+1 <= $PostPagination) {?>
         <li class="page-item">
             <a href="Posts.php?page=<?php  echo $Page+1; ?>" class="page-link">&raquo;Next</a>
           </li>
         <?php } }?>
            </ul>
          </nav>
       
       </div>
          
          <!-- Pagination End -->
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