<?php
require_once("Includes/DB.php");
require_once("Includes/Function.php");
require_once("Includes/Session.php");
?>

<?php 
if(isset($_GET["id"])){
  $SearchQueryParameter = $_GET["id"];
 
  
   $query = "DELETE FROM `admins` WHERE id={$SearchQueryParameter}"; 
 $results = mysqli_query($conn, $query) or die('query is faild');
  if ($results) {
    $_SESSION["SuccessMessage"]="Admin Deleted Successfully ! ";
    Redirect_to("Admins.php");
    // code...
  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
    Redirect_to("Admins.php");
  }
}

?>