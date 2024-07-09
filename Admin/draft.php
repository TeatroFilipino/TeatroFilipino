<?php
    include('../connection.php');
    include('query_functions.php');
    include('navbar.html');
    include('delete_functions.php');

    $latest_id = fetch_latest_id("site"); // Assuming you have a function to fetch the latest ID

    // Initialize the variable
    $new_id = isset($latest_id['last_id']) ? (int)$latest_id['last_id'] + 1 : 1;

    // Format the new site code (you can customize this as needed)
    $formatted_site_code = "SITE" . str_pad($new_id, 4, '0', STR_PAD_LEFT);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="add_site_form.css">
    <title>Add Site Record</title>
</head>
<body>
    <!-- Form to collect data for a new property record -->
    <div id="title_container">
        <p id="title">Add Site Record</p>
    </div>
    <div id="form_container">
        <form action="add_site.php" method="post" autocomplete="off">
            <div id="details">
                <span>
                    <label for="site_Code">Site Code: </label>
                    <label for="site_Name">Site Name: </label>
                    <label for="site_Address">Site Address: </label>
                    <label for="site_Class">Site Class: </label>
                    <label for="site_Category">Site Category: </label>
                    <label for="site_Proximity">Site Proximity: </label>
                    <label for="site_Desc">Site Description: </label>
                    <label for="S_itinerary_Code">Itinerary Code: </label>
                </span>

                <span>
                    <input type="number" name="site_Code" id="site_Code" value="<?php echo $id?>" readonly required>
                    <input type="varchar" name="site_Name" id="site_Name" required maxlength="30">
                    <input type="varchar" name="site_Address" id="site_Address" required maxlength="80">
                    <input type="enum('Site','Food')" name="site_Class" id="site_Class" >
                    <input type="enum('Church','Museum','Site','Fine Dining','Restaurant','Fast Food','Eatery','Cafe')" name="site_Category" id="site_Category" >
                    <input type="varchar" name="site_Proximity" id="site_Proximity" >
                    <input type="varchar" name="site_Desc" id="site_Desc" maxlength="50" pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
                    <input type="varchar" name="S_itinerary_Code" id="S_itinerary_Code" maxlength="50">
                </span>
            </div>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>
