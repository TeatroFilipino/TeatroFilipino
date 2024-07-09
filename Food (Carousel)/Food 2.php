<?php
// include connection to the database
include('../connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teatro Tomasino</title>
    <link rel="stylesheet" href="Food 1.css">
    <link rel="icon" href="image/logo.png" type="image/x-icon"/>
</head>
<body>
    
    
    <a href="Food Carousel.php" class="icon-image">
        <img src="image/logo.png" alt="Logo" class="icon-image">
    </a>

    <div class="food-content">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="image/food-2-a.jpg" alt="TeaTo-1">
            </div>
            <div class="mySlides fade">
                <img src="image/food-2-b.jpg" alt="TeaTo-2">
            </div>
            <div class="mySlides fade">
                <img src="image/food-2-c.jpg" alt="TeaTo-3">
            </div>
        </div>
    </div>

        <div class="text-container">
            <h2 class="food-title">Teatro Tomasino</h2>
            <p class="food-description">
            
                        <?php
                            $siteCode = 110021;

                            $sql = "SELECT site_Desc FROM site WHERE site_Code = $siteCode";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $sitedesc = $row['site_Desc'];
                                    echo $sitedesc;
                                }
                            } else {
                                echo "No results found";
                            }

                            $conn->close();
                        ?>
            </p>
        </div>


    <script src="Food 2.js"></script>
</body>
</html>
