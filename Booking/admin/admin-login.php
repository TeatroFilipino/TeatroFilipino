<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/lr_styles.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 

                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $defaultUser = "admin";
                    $defaultPassword = "admin";

                    if($username == $defaultUser && $password == $defaultPassword){
                        header("Location: admin-profile.php");
                        exit();
                    } else {
                        echo "<div class='message'>
                                <p>Invalid input!</p>
                              </div> <br>";
                        echo "<a href='admin-login.php'><button class='btn'>Go Back</button>";
                    }

                } else {
            ?>

            <header>Admin Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="employeeID">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>

    <div class="home-btn">
        <a href="../index.html"><button class="btn">Go to Home</button></a>
    </div>
</body>
</html>
