<?php
require_once("Includes/DB.php");
require_once("Includes/Function.php");
require_once("Includes/Session.php");
?>

<?php 
if(isset($_GET["id"])){
  $SearchQueryParameter = $_GET["id"];
 
  $Admin = $_SESSION["AdminName"];
  $query = "UPDATE comments SET status='OFF', approvedby='{$Admin}' WHERE id={$SearchQueryParameter}";
 $results = mysqli_query($conn, $query) or die('query is faild');
  if ($results) {
    $_SESSION["SuccessMessage"]="Comment Dis-Approved Successfully ! ";
    Redirect_to("Comments.php");
    // code...
  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
    Redirect_to("Comments.php");
  }
}

?>