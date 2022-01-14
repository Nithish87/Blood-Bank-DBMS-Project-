<?php
//echo "Hi";
session_start();
$campID=$_SESSION['CampID'];
$userID=$_SESSION['UserID'];
echo $campID;
echo $userID;

$conn = mysqli_connect("localhost","root","","redvault");

$query="INSERT INTO register(CampID,UserID) VALUES('$campID','$userID')";
$connect=mysqli_query($conn,$query);

if($connect)
{
?>
    <script type="text/javascript">
		alert("Registration Successful");
		window.location.href="homepage.php";
	</script>
<?php
}else{
    ?>
    <script type="text/javascript">
		alert("Cannot Register");
		window.location.href="homepage.php";
	</script>
<?php
}

?>