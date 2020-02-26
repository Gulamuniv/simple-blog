<?php require_once("Includes/DB.php"); ?>

<?php
function Redirect_to($new_location)
{
	header('location:'.$new_location);
	exit;
}
function CheckUserNameExistsOrNot($UserName){
 $conn = mysqli_connect("localhost","root","","cms") or die("connection Fialed");

   $sql ="SELECT username FROM admins WHERE username='{$UserName}'";
    $result = mysqli_query($conn,$sql) or die("Qery Failed");
 
   if (mysqli_num_rows($result)==1) {
   	return true;
    echo "one";
   }else{
   	 return false;
   	echo "multi pule";
   }
   
}

function Login_Attempt($UserName,$Password){
   $conn = mysqli_connect("localhost","root","","cms") or die("connection Fialed");
	 $sql ="SELECT * FROM admins WHERE username='{$UserName}' and 
     password='{$Password}' Limit 1";
      $result = mysqli_query($conn,$sql) or die("Qery Failed");
      if(mysqli_num_rows($result)==1) {
      	$data = mysqli_fetch_assoc($result);
     return $Found_Account=$data;
   }else{
    return null;
   }
}

function Confirm_Login(){
	if (isset($_SESSION["UserId"])) {
		return true; 
	}else{
		$_SESSION["ErrorMessage"]="Login Required!";
		Redirect_to('Login.php');
	}
}

function TotalPost(){
  $conn = mysqli_connect("localhost","root","","cms") or die("connection Fialed");
  $sql = "SELECT COUNT(*) FROM posts";
    $result  = mysqli_query($conn, $sql);
    $TotatRorws = mysqli_fetch_array($result);
    $totalPost = array_shift($TotatRorws);
    echo $totalPost;
}
function TotalAdmins(){
    $conn = mysqli_connect("localhost","root","","cms") or die("connection Fialed");
      $sql = "SELECT COUNT(*) FROM admins";
      $result  = mysqli_query($conn, $sql);
      $TotatRorws = mysqli_fetch_array($result);
      $totalAd = array_shift($TotatRorws);
      echo $totalAd;
}
function TotalCategory(){
  $conn = mysqli_connect("localhost","root","","cms") or die("connection Fialed");
  $sql = "SELECT COUNT(*) FROM category";
    $result  = mysqli_query($conn, $sql);
    $TotatRorws = mysqli_fetch_array($result);
    $totalCaterory = array_shift($TotatRorws);
    echo $totalCaterory;
}

function TotalCommnet(){
  $conn = mysqli_connect("localhost","root","","cms") or die("connection Fialed");
    $sql = "SELECT COUNT(*) FROM comments";
      $result  = mysqli_query($conn, $sql);
      $TotatRorws = mysqli_fetch_array($result);
      $totalCommnet = array_shift($TotatRorws);
      echo $totalCommnet;
}


function ApproveCommnetAsPosts($PostId){
  $conn = mysqli_connect("localhost","root","","cms") or die("connection Fialed");
   $sqlApprove ="SELECT COUNT(*) FROM comments where 
                   post_id ={$PostId} and status='ON'";
          $resultsArray = mysqli_query($conn,$sqlApprove);
          $TotalRowrs = mysqli_fetch_assoc($resultsArray);
          $TotalComments =array_shift($TotalRowrs);
          return $TotalComments;
}

function DisApproveCommnetById($PostId){
  $conn = mysqli_connect("localhost","root","","cms") or die("connection Fialed");
   $sqlDisApprove ="SELECT COUNT(*) FROM comments where 
              post_id ={$PostId} and status='OFF'";
              $slqApprove = mysqli_query($conn,$sqlDisApprove);
              $TotalRowrs = mysqli_fetch_assoc($slqApprove);
              $TotalComments =array_shift($TotalRowrs);
              return $TotalComments;
}
?>



