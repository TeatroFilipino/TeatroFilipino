<?php 
   session_start();

   include("../database.php");
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
    <title>Update Admin Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="adminprofile.php"> Logo</a></p>
        </div>

        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="admin-logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $newPassword = $_POST['new_password'];
                $confirmPassword = $_POST['confirm_password'];

                if ($newPassword != $confirmPassword) {
                    echo "<div class='message'>
                    <p>New Password and Confirm Password do not match.</p>
                    </div> <br>";
                } else {
                    $id = $_SESSION['id'];
                    // Check if a new password is provided
                    $passwordUpdate = "";
                    if (!empty($newPassword)) {
                        $passwordUpdate = ", Password='$newPassword'";
                    }

                    $edit_query = mysqli_query($connect, "UPDATE admin SET Username='$username' $passwordUpdate WHERE Id=$id ") or die("error occurred");

                    if($edit_query){
                        echo "<div class='message'>
                        <p style='color: green;'>Profile Updated!</p>
                        </div> <br>";
                        echo "<a href='adminprofile.php'><button class='btn'>Go Home</button>";
                    }
                }
               } else {
                $id = $_SESSION['id'];
                $query = mysqli_query($connect,"SELECT * FROM admin WHERE Id=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['Username'];
                }
            ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" autocomplete="off">
                </div>

                <div class="field input">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" autocomplete="off">
                </div>
                
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update">
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>

      <a href="../index.html"><button class="btn">Go to Index</button></a>
</body>
</html>
