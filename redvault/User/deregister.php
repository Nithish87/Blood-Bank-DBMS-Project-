<?php
//echo "Hi";
session_start();
$campID=$_SESSION['CampID'];
$userID=$_SESSION['UserID'];
$camp=$_GET['Camp'];
echo $campID;
echo $userID;
echo $camp;

$conn = mysqli_connect("localhost","root","","redvault");

$query="DELETE FROM register WHERE CampID='$camp' AND UserID='$userID'";
$connect=mysqli_query($conn,$query);

if($connect)
{
?>
    <script type="text/javascript">
		alert("Deregistration Successful");
		window.location.href="homepage.php";
	</script>
<?php
}else{
    ?>
    <script type="text/javascript">
		alert("Cannot Unregister");
		window.location.href="homepage.php";
	</script>
<?php
}

?>