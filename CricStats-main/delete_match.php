<?php
include("dbcon.php");
$match_id = $_GET['id'];
$query = "delete from matches where Match_Id = $match_id ";
mysqli_query($con, $query);
header("Location: show_match.php");
die();
?>