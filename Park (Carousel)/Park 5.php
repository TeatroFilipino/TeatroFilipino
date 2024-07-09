<?php
// include connection to the database
include('../connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Himala</title>
    <link rel="stylesheet" href="Park 5.css">
    <link rel="icon" href="image/logo.png" type="image/x-icon"/>
</head>
<body>

<a href="Park Carousel.php" class="icon-image">
        <img src="image/logo.png" alt="Logo" class="icon-image">
    </a>

    <div class="food-content">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="image/park-5-a.jpg" alt="Himala-1">
            </div>
            <div class="mySlides fade">
                <img src="image/park-5-b.jpg" alt="Himala-2">
            </div>
            <div class="mySlides fade">
                <img src="image/park-5-c.jpg" alt="Himala-3">
            </div>
        </div>
    </div>

        <div class="text-container">
            <h2 class="food-title">Himala</h2>
            <p class="food-description">
                
            <?php
                            $siteCode = 110035;

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
            </p>
        </div>


    <script src="Park 5.js"></script>
</body>
</html>
