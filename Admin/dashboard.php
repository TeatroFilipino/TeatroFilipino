<?php include('navbar.html'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <link rel="icon" href="../logo.png" type="image/x-icon" />
</head>

<body>
    <a href="../index.php" class="logo">
        <img src="logo.png" alt="Logo" class="logo">
    </a>

    <div class="container">
        <a href="book.php" class="box" id="book" :hover>
            <h3>Booking</h3>
            <p>Includes records of customer details.</p>
        </a>
        <a href="site.php" class="box" id="site" :hover>
            <h3>Site</h3>
            <p>Indicates the different places you can find within the vicinity including churches, schools, and sites.</p>
        </a>
        <a href="itinerary.php" class="box" id="itinerary" :hover>
            <h3>Itinerary</h3>
            <p>Shows itinerary package for the whole trip.</p>
        </a>
    </div>

    <div id="about-section">
        <h2>About the Project</h2>
        <p>A database interface that tracks the record of Booking, Site, and Itinerary.</p>
    </div>
</body>

</html>
