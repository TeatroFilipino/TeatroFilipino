<?php 
   session_start();

   include("../database.php");
   
   // Redirect to admin-login.php if the user is not logged in
   if(!isset($_SESSION['valid'])){
      header("Location: admin-login.php");
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/lr_styles.css">
    <title>Admin Webpage</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="adminprofile.php">Zoo</a></p>
        </div>

        <div class="right-links">
            <?php 
                $adminId = $_SESSION['id'];
                $query = mysqli_query($connect, "SELECT * FROM admin WHERE Id=$adminId");

                while($result = mysqli_fetch_assoc($query)){
                    $adminUsername = $result['Username'];
                    $adminEmployeeID = $result['EmployeeID'];
                    $adminId = $result['Id'];
                }
            
                echo "<a href='admin-update.php?Id=$adminId'>Change Profile</a>";
            ?>
            <a href="admin-logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>

    <main>
       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $adminUsername ?></b>, Welcome</p>
            </div>
            <div class="box">
                <p>Your Employee ID is <b><?php echo $adminEmployeeID ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
          </div>
       </div>
    </main>
</body>
</html>
