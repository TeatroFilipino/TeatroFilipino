<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/lr_styles.css">
    <title>Admin Update</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">

            <?php 
                include("../database.php");
                if(isset($_POST['submit'])){

                    $username = $_POST['username'];
                    $employeeID = $_POST['employeeID'];
                    $password = $_POST['password'];
                    $confirmPassword = $_POST['confirm-password'];
                    
                    $errors = array();

                    if(strlen($password) < 8) {
                        array_push($errors, "Password must be atleast 8 characters long");
                    }
                    if($password != $confirmPassword) {
                        array_push($errors, "Password does not match");
                    }

                    if(count($errors) > 0) {
                        foreach($errors as $error) {
                            echo "<div class = 'message'>
                                    <p>$error</p> 
                                </div> <br>";
                        }
                    }

                        // verifying the existing employeeID
                        $verify_query = mysqli_query($connect, "SELECT * FROM admin WHERE EmployeeID='$employeeID'");

                        if(!$verify_query){
                            die("Query failed: " . mysqli_error($connect));
                        }


                        function checkIfRegistered($verify_query) {
                            $usernameFromDb = $verify_query->fetch_assoc();
                            $usernameString = $usernameFromDb["Username"];
                            if(strlen($usernameString) == 0) {
                                return false;
                            } else {
                                return true;
                            }
                        }
                        
                        $isRegistered = checkIfRegistered($verify_query);
                        
                        if($isRegistered){

                            echo "<div class='message'>
                                    <p>Employee ID is already registered.</p>
                                </div> <br>";

                        } elseif(mysqli_num_rows($verify_query) > 0 AND count($errors) == 0){
                            // EmployeeID exists, update the existing record
                            $update_query = mysqli_query($connect, "UPDATE admin SET Username='$username', Password='$password' WHERE EmployeeID='$employeeID'");

                            if(!$update_query){
                                die("Update query failed: " . mysqli_error($connect));
                            }

                            header("Location: admin-signup-sucess.html");
                            exit();

                        } else {
                            // EmployeeID does not exist, display an error message
                            echo "<div class='message'>
                                    <p>Invalid Employee ID. This Employee ID does not exist.</p>
                                </div> <br>";
                        }
                }

            ?>

            <header>Admin Update</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="employeeID">Employee ID</label>
                    <input type="text" name="employeeID" id="employeeID" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="confirm-password" id="confirm-password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Go back to <a href="admin-login.php">Admin Login</a>
                </div>
            </form>
        </div>
    
        <div class="home-btn">
            <a href="../index.html"><button class="btn">Go to Index</button></a>
        </div>
    </div>
</body>
</html>
