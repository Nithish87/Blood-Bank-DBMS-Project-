<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Document</title>
</head>
<body>
    
<?php

$host="localhost";
$user="root";
$password="";
$db="redvault";
//echo "Hello";
try{
    $conn=mysqli_connect($host, $user, $password, $db);
} 
catch(mysqli_sql_exception $e){
    echo 'Message: ' .$e->getMessage();
}
    
//echo "Checking connection";
{
    if(!$conn)
    {
        die("connection failed".mysqli_connect_error());
    }

}

//echo "Successful connection, intaking values";
if(isset($_POST['save']))
echo " Recieved";
    {
        $email=$_POST['emailID'];
        //echo " Recieved Email";
        $password=$_POST['password'];
        //echo " Recieved password";
        $sql="select * from admin where Email='".$email."'AND Password='".$password."'limit 1";

        //Creating session for admin email
        session_start();
        $_SESSION['email']=$email;

        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1)
        {
            //GO to admin home is authentication successful
            ?>
            <script type="text/javascript">
			    /*alert("You have successfully logged in");
			    window.location.href="adminhome.php";*/
                swal({
                    title: "Login successful!!",
                    icon: "success",
                    button: "Of course",
                })
                    .then((value) => {
                        window.location.href="adminhome.php";
                });
			</script>
            <?php
        }
        else
        {
            //User info is wrong
            ?>
            <script type="text/javascript">
			    /*alert("You have entered incorrect email or password");
			    window.location.href="loginAdmin.html";*/
                swal({
                    title: "Incorrect email or password",
                    icon: "error",
                    button: "Retry",
                })
                    .then((value) => {
                        window.location.href="loginAdmin.html";
                });
			</script>
            <?php
        }
    }?>
</body>
</html>