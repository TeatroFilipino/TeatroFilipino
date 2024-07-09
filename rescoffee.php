<?php
// include connection to the database
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="rescoffee.css">
  <title>Teatro Filipino | About us</title>
  <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link rel="icon" href="Logo.png" type="image/x-icon"/>
</head>

<body>
    <header>
        <div class="logo.img">
        <a href="index.php" class="logo">
            <img src="logo.png" alt="logo">
        </a>
    </div>
        <div class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="interactive-map.html">Interactive Map</a></li>
                <li><a href="all_posts.php">Reviews</a></li>
                <li class="dropdown">
                    <a href="#">More ▼</a>
                    <div class="dropdown-content">
                        <a href="medallion/dex.php">Ticketing</a>
                        <a href="LoginAdmin/login.php">Log-in as Admin</a>

                    </div>
                </li>
            </ul>
        </div>

   
    </header>

   

    <section class="about" id="about">
        <div class="about-img">
                <div class="slideshow-container">
                    <div class="mySlides fade">
                        <img src="intra5.jpg" alt="">
                    </div>
                    <div class="mySlides fade">
                        <img src="intra1.jpg" alt="Barbara-1">
                    </div>
                    <div class="mySlides fade">
                        <img src="intra2.jpg" alt="Barbara-2">
                    </div>
                    <div class="mySlides fade">
                        <img src="intra3.jpg" alt="Barbara-3">
                    </div>
                    <div class="mySlides fade">
                        <img src="intra4.jpg" alt="Barbara-3">
                    </div>
                </div>
            </div>
        </div>
      
        
        </div>
        <div class="about-text">
            <div class="transparent-box">
                <div class="box">
            <p>Our company is a technology-driven enterprise dedicated to enhancing the theater booking experience. We have developed an innovative platform that connects theatergoers with venues, simplifying the process of purchasing tickets and managing events.</p>
            <p>Our mission is to transform the way people book and enjoy theater performances, providing a seamless, user-friendly, and efficient solution for both audiences and theater managers.
            </p>
        </div>
                </div>
            </div>
        </div>
    </section>
   
<section class="customers" id="customers">
    <div class="heading">
        <h1>Our Customer's Review</h1>
    </div>

    <div class="customers-container">
        <!-- FIRST -->
        <div class="box">
            <div class="stars">
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star' ></i>
                <i class='bx bxs-star-half' ></i>
            </div>
            <!-- comment of the first reviewer -->
            <p> 
                        <?php
                            $id = 'J32EozaZA7fb8yq54etM';

                            $sql = "SELECT description FROM reviews WHERE id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('s', $id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $description = $row['description'];
                                    echo $description;
                                }
                            } else {
                                echo "No results found";
                            }
                            
                            $stmt->close();
                        ?>
            </p>
            <!-- name of the first reviewer -->
            <h2>
                        <?php
                            $id = 'jtui1k35GAiKY4Euk6kj';

                            $sql = "SELECT name FROM users WHERE id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('s', $id);
                            $stmt->execute();
                            $result = $stmt->get_result();
            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $name = $row['name'];
                                    echo $name;
                                }
                            } else {
                                echo "No results found";
                            }

                            $stmt->close();
                        ?> 
            </h2>
            <img src="user1.jpg" alt="">
        </div>
            <!-- SECOND -->
         <div class="box">
                <div class="stars">
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star-half' ></i>
                </div>
                <!-- comment of the second reviewer -->
                <p> 
                            <?php
                                $id = '50xseL08tKo6g0D3S7Pc';

                                $sql = "SELECT description FROM reviews WHERE id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('s', $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $description = $row['description'];
                                        echo $description;
                                    }
                                } else {
                                    echo "No results found";
                                }
                                
                                $stmt->close();
                            ?>
                </p>
            
                <!-- name of the second reviewer -->
                <h2>
                            <?php
                                $id = 'i5Dg5FL2uMuU8FeJvzoz';

                                $sql = "SELECT name FROM users WHERE id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('s', $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name'];
                                        echo $name;
                                    }
                                } else {
                                    echo "No results found";
                                }

                                $stmt->close();
                            ?> 
                </h2>
                <img src="user2.jpg" alt="">
            </div>
                <!-- THIRD -->
        <div class="box">
                <div class="stars">
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star-half' ></i>
                </div>
                <!-- comment of the third reviewer -->
                <p> 
                            <?php
                                $id = 'ZKPRLS0GBGEAlaMctf3j';

                                $sql = "SELECT description FROM reviews WHERE id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('s', $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $description = $row['description'];
                                        echo $description;
                                    }
                                } else {
                                    echo "No results found";
                                }
                                
                                $stmt->close();
                            ?>
                </p>
                <!-- name of the third reviewer -->
                <h2>
                            <?php
                                $id = 'ETzz6glmzX8iHzrcMDxR';

                                $sql = "SELECT name FROM users WHERE id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('s', $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name'];
                                        echo $name;
                                    }
                                } else {
                                    echo "No results found";
                                }

                                $stmt->close();
                            ?> 
                </h2>
                <img src="user3.jpg" alt="">
            </div>
            <!-- FOURTH -->
            <div class="box">
                <div class="stars">
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star' ></i>
                    <i class='bx bxs-star-half' ></i>
                </div>
                <!-- comment of the fourth reviewer -->
                <p> 
                            <?php
                                $id = 'sgzHAHdFEbQIrkw5hcw0';

                                $sql = "SELECT description FROM reviews WHERE id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('s', $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $description = $row['description'];
                                        echo $description;
                                    }
                                } else {
                                    echo "No results found";
                                }
                                
                                $stmt->close();
                            ?>
                </p>
                <!-- name of the fourth reviewer -->
                <h2>
                            <?php
                                $id = '1xoueS8m7MhiDEEPmnRE';

                                $sql = "SELECT name FROM users WHERE id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('s', $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name'];
                                        echo $name;
                                    }
                                } else {
                                    echo "No results found";
                                }

                                $stmt->close();
                            ?> 
                </h2>
                <img src="user4.jpg" alt="">
            </div>
    </div>
                   
</section>

<section class="footer">
    <div class="footer-box">
        <h2>Teatro Filipino</h2>
        <p> Description</p>
        <div class="social">
            <a href="#"><i class='bx bxl-facebook'></i></a>
            <a href="#"><i class='bx bxl-twitter'></i></a>
            <a href="#"><i class='bx bxl-instagram'></i></a>
            <a href="#"><i class='bx bxl-tiktok'></i></a>
        </div>
    </div>
    <div class="footer-box">
        <h3>Support</h3>
        <li><a href="#">Help & Support</a></li>
        <li><a href="#">Terms of Use</a></li>
    </div>
    <div class="footer-box">
        <h3>View Guide</h3>
        <li><a href="#">Features</a></li>
        <li><a href="#">Blog Posts</a></li>
    </div>
    <div class="footer-box">
        <h3>Contact</h3>
        <div class="contact">
            <span><i class='bx bxs-map'></i> Acting Galing St, Mandaluyong City, Manila, Luzon 1002, Philippines</span>
            <span><i class='bx bxs-phone'></i>+639652617461</span>
            <span><i class='bx bxs-envelope'></i>Teatro-Filipino@gmail.com</span>
        </div>
    </div>
</section>
<div class="copyright">
    <p>&#169; Teatro Filipino</p>
</div>

    <script src="Food-1.js"></script>
</body>


</html>