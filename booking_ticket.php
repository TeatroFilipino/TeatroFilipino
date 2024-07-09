<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $package = $_POST["package"];
    $tour_guide = $_POST["tour_guide"];

    // Process the data (you can customize this part based on your needs)
    $confirmation_message = "Thank you, $name! Your ticket for $package on $date at $time with tour guide $tour_guide has been booked.";

    // Display confirmation message
    echo "<p>$confirmation_message</p>";
}
?>
