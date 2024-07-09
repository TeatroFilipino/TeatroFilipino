<?php
include('../connection.php');
include('navbar.html');
include('query_functions.php');

$site_Code = $_REQUEST['site_Code'];
$site_Name = trim($_REQUEST['site_Name']);
$site_Address = trim($_REQUEST['site_Address']);
$site_Class = trim($_REQUEST['site_Class']);
$site_Category = trim($_REQUEST['site_Category']);
$site_Proximity = trim($_REQUEST['site_Proximity']);
$site_Desc = trim($_REQUEST['site_Desc']);
$S_itinerary_Code = trim($_REQUEST['S_itinerary_Code']);

$adding_site = add_site($site_Code, $site_Name, $site_Address, $site_Class, $site_Category, $site_Proximity, $site_Desc, $S_itinerary_Code);

if ($adding_site) {
    echo '<script>
            alert("Site added successfully.");
            window.location.replace("site.php");
        </script>';
} else {
    echo '<script>
            alert("Error: ' . mysqli_error($conn) . '");
            window.location.replace("site.php");
        </script>';
}
?>
