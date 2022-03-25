<?php
//Cresting session to receive user email
session_start();
if(empty($_SESSION)){
    header("Location:login.html");
}
$emailID=$_SESSION['email'];
//echo $emailID;

date_default_timezone_set('Asia/Kolkata');
//Get today's date
$date=date('y-m-d');
//echo $date;

$conn = mysqli_connect("localhost","root","","redvault");


if(!$conn)
{
    echo "Error";
}
/*
if(isset($_GET['CampID'])){
    $CampID=$_GET['CampID'];
}*/

//Query to find today's camps
$availablequery = "SELECT * FROM `camp` WHERE CampID not in(select CampID from register where UserID='$emailID') AND CampID not in(select CampID from donated where UserID='$emailID') AND CampDate>='$date'";
$connect = mysqli_query($conn,$availablequery);

//Query for user to register to a camp
$registrationquery="SELECT camp.CampID AS CampID,register.UserID AS UserID, camp.CampDate AS CampDate, camp.Location AS place FROM camp,register WHERE camp.CampID=register.CampID AND register.UserID='$emailID'";
$connectR = mysqli_query($conn,$registrationquery);

//Query to get the donation info of the user
$donationquery="SELECT camp.CampDate AS CampDate, camp.Location AS place,donated.Quantity AS Quantity FROM camp,donated WHERE camp.CampID=donated.CampID AND donated.UserID='$emailID'";
$connectD = mysqli_query($conn,$donationquery);

//Query to get total donations
$donutchartquery="SELECT * FROM blood";
$connectC=mysqli_query($conn,$donutchartquery);

//Query to fetch user first name
$welcomequery="SELECT FirstName AS FirstName FROM user WHERE Email='$emailID'";
$connectW=mysqli_query($conn,$welcomequery);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="stylehome.css">
        <script src="https://kit.fontawesome.com/6e9ba28a08.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@1,700&display=swap" rel="stylesheet">
    
        <!--Donut chart-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="scripthome.js"></script>

        
    

    </head>

    <body>
        <!--Header of the website-->
        <div class="header">
            <!--LOgo image-->
            <img src="../Images/blood donation logo.png" height="80" width="100">
            <div class="inner_header">
                <div class="logo_container">
                    <h1>RED<span id="s1">VAULT</span><span id="s2">  Blood Bank</span></h1>
                    
                </div>

                <ul class="navigation">
                    <!--Logout buttin-->
                  <a href="logout.php"><li><i class="fas fa-sign-out-alt"></i></li></a>
                  <!--Redirects to "About us" section-->
                  <a href="#about_us"><li>About Us</li></a>  
                  <?php
                        //$_SESSION['email']=$emailID;
                  ?>
                  <!--<a href="homepage.php"><li>Home</li></a>-->
                </ul>
            </div>
        </div>
        
        <!--Slideshow of images-->
        <div class="slideImages"></div>

        <!--Side bar-->
        <div class="wrapper">
            <div class="sidebar">
                <!--<h2>Menu</h2>-->
                <ul>
                <?php //session_start();
                        $_SESSION['email']=$emailID;
                ?>
                    <!--Redirects to the profile page of the user-->
                    <li><a href="profile.php"><i class="fas fa-user"></i>Profile</a></li>
                    <!--Moves to registered camps table-->
                    <li><a href="#registered_head"><i class="far fa-check-circle"></i> Registered Camps</a></li>
                    <!--Moves to available camps table-->
                    <li><a href="#available_head"><i class="fas fa-door-open"></i>Available Camps</a></li>
                    <!--Moves to donation history table-->
                    <li><a href="#past_head"><i class="fas fa-history"></i>Past Donations</a></li>
                    <!--Moves to total donations table-->
                    <li><a href="#chart_head"><i class="fas fa-archive"></i>Blood Bank</a></li>
                </ul>
                
            </div>

            <div class="main_content">
                <!--HEllo-->
                <div class="head"><h4>Welcome <?php $rows = mysqli_fetch_assoc($connectW);
                echo $rows['FirstName'];?></h4></div>
                <div class="info">
                    <!--Registered Info to be displayed-->
                    <br>
                    <div id="registered_head" class="registered_head"><h4>Registered Camps</h4></div>
                    <br>
                    <div class="registered_info">
                        <table>
                            <thead>
                                <tr>
                                    <th>Camp ID</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <!--<th>RegistrationID</th>-->
                                    <th>Status</th>
                                    <th id="empty"> </th>
                                </tr>
                            </thead>
                            <?php
                                while($rows = mysqli_fetch_assoc($connectR)){
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $rows['CampID'] ?></td>
                                    <td><?php echo $rows['CampDate']; ?></td>
                                    <td><?php echo $rows['place']; ?></td>
                                    <td><p class="status">Registered</p></td>
                                    <?php
                                        //Camp and user id to the deregistr.php
                                        $_SESSION['CampID']=$rows['CampID'];
                                        $_SESSION['UserID']=$rows['UserID'];
                                    ?>
                                    <!--Button for deregestration-->
                                    <td><a href="deregister.php?Camp=<?php echo $rows['CampID'];?>"><i class="fas fa-times"></i></a></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            
                        </table>
                    </div>

                    <!--Camps info table-->
                    <br>
                    <div id="available_head" class="available_head"><h4>Available Camps</h4></div>
                    <br>
                    <div class="available_info">
                        <table>
                            <thead>
                                <tr>
                                    <th>Camp ID</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <!--<th>Due for registration</th>-->
                                    <th>Status</th>
                                    <th id="empty"> </th>
                                </tr>
                            </thead>
                            <?php
                                while($rows = mysqli_fetch_assoc($connect)){
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $rows['CampID']; ?></td>
                                    <td><?php echo $rows['CampDate']; ?></td>
                                    <td><?php echo $rows['Location']; ?></td>
                                    <!--<td><//?php echo $rows['DueRegistration']; ?></td>-->
                                    <td><p class="status_available">Available</p></td>
                                    <?php
                                        //Camp and user ID for register.php
                                        $_SESSION['CampID']=$rows['CampID'];
                                        $_SESSION['UserID']=$emailID;
                                    ?>
                                    <!--BUtton for regustration-->
                                    <td><a href="register.php"><i class="fas fa-plus"></i></a></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--Past Camps info table-->
                <br>
                <div id="past_head" class="past_head"><h4>Past Donations</h4></div>
                <br>
                <div class="past_info">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Amount(mL)</th>
                            </tr>
                        </thead>
                        <?php
                                while($rows = mysqli_fetch_assoc($connectD)){
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $rows['CampDate']; ?></td>
                                    <td><?php echo $rows['place']; ?></td>
                                    <td><?php echo $rows['Quantity']; ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            
                    </table>
                </div>

                <!--Total contribution done to the blood bank-->
                <div class="blood_info">
                <br>
                <div id="chart_head" class="chart_head"><h4>Our Achievements</h4></div>
                <br>
                
                
                    <table>
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Quantity(L)</th>
                            </tr>
                        </thead>
                        <?php
                            while($rows = mysqli_fetch_assoc($connectC)){
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $rows['Name']; ?></td>
                                <td><?php echo $rows['Quantity']; ?></td>
                            </tr>
                        <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!--<div id="donutchart" style="width: 900px; height: 500px;"></div>-->

            </div>

            
        </div>

        <!--About Section-->
        <br>
        <footer>
            <div id="about_us" class="about_us">
                <h3>About Us</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea odit excepturi quidem enim commodi minima tempore, tempora deserunt quos unde natus ducimus cum, ad at pariatur voluptatem? Provident, qui quis.</p>
                <ul class="socials">
                    <li><a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
            <div class="footer-bottom">
                <p>copyright &copy;2022 RedVault</p>
            </div>
        </footer> 
    </body>
</html>                                                                                         
