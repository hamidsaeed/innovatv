<?php 
include 'database.php';
if(isset($_GET) && !empty($_GET['id']) && !empty($_GET['tableid']) && !empty($_GET['table'])){
  print_r($_GET);
   $referrer = $_SERVER['HTTP_REFERER'];
       $sql= "Delete from " . $_GET['table']. " where ". $_GET['tableid']. "=" . $_GET['id'];
       $res = $conn->query($sql);
       if($res){
       	header("location: $referrer");
       }

}
?>
