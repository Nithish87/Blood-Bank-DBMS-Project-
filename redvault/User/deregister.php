<html>
	<head>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
</html>

<?php
session_start();
$campID=$_SESSION['CampID'];
$userID=$_SESSION['UserID'];
$camp=$_GET['Camp'];


$conn = mysqli_connect("localhost","root","","redvault");

//Delete the registration from the table
$query="DELETE FROM register WHERE CampID='$camp' AND UserID='$userID'";
$connect=mysqli_query($conn,$query);

if($connect)
{
?>
    <script type="text/javascript">
		/*alert("Deregistration Successful");
		window.location.href="homepage.php";*/
		swal({
            title: "Deregistration Successful",
            icon: "success",
            button: "Sorry:)",
        })
        .then((value) => {
            window.location.href="homepage.php";;
         });
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