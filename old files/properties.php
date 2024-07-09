<?php
// to display the navbar in the webpage
include('navbar.html');

// include connection to the database
include('connection.php');

// including the functions for querying the database
include('query_functions.php');
include('alerts.php');

// query for retrieving records
$query = "SELECT ParcelNo, PropAddress, OwnerID FROM property_info";
// executing query
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Properties</title>
    <link rel="stylesheet" type="text/css" href="properties.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols-Rounded"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<div id="title_container"><p id="title">Properties</p></div>
<div id="actions_container">
    <h1 id="actions_title">Actions</h1>
    <button id="add_button" onclick="document.location='add_property_form.php'"><i class="material-icons">add</i> Add Property</button>
</div>
<div id="table_container">
<table>
    <tr>
        <th>Parcel No.</th>
        <th>Property Address</th>
        <th>Owner</th>
    </tr>
    <?php
        if (mysqli_num_rows($result) > 0) {
            while($record = mysqli_fetch_assoc($result)) { 
                $owner_name = fetch_by_id("Name","Persons","ID",$record['OwnerID']);?>
                <tr onclick="location.href='property_details.php?id=<?php echo $record['ParcelNo']; ?>'">
                    <td><?php echo $record['ParcelNo']; ?> </td>
                    <td><?php echo $record['PropAddress']; ?> </td>
                    <td><?php echo $owner_name['Name']; ?> </td>
                <tr>
    <?php
            }
        }
        else { ?>
            <tr>
                <td colspan="8">No record found</td>
            </tr>
    <?php
        }
    // to execute if the delete button is clicked and the delete var thru the url
    if(isset($_GET['delete'])){
        $id = $_GET['id']; // getting the parcelno from the url
        $delete_result = delete("property_info","ParcelNo",$id); // the delete function is called from query_functions.php
    
    // if the delete function returns true, an alert is displayed and the page is reloaded
        if($delete_result){
            echo '<script>
                    alert("Property deleted successfully.");
                    window.location.replace("properties.php");
                </script>';
        }
        else {
            echo '<script>
                    alert("Error: '.mysqli_error($conn).'");
                    window.location.replace("property_details.php?id='.$id.'");
                </script>';
        }
    }
    $conn->close();
    ?>
</table>
</div>
</body>
</html>