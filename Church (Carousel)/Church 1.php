<?php
// include connection to the database
include('../connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ang Unang Aswang</title>
    <link rel="stylesheet" href="Church 1.css">
    <link rel="icon" href="image/logo.png" type="image/x-icon"/>
</head>
<body>

    <a href="Church Carousel.php" class="icon-image">
        <img src="image/logo.png" alt="Logo" class="icon-image">
    </a>

    <div class="food-content">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="image/church-1-a.jpg" alt="Ang Unang Aswang-1">
            </div>
            <div class="mySlides fade">
                <img src="image/church-1-b.jpg" alt="Ang Unang Aswang-2">
            </div>
        </div>
    </div>

        <div class="text-container">
            <h2 class="food-title">Ang Unang Aswang</h2>
            <p class="food-description">
                
                        <?php
                            $siteCode = 110026;

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


    <script src="Church 1.js"></script>
</body>
</html>
