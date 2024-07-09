<?php
// to display the navbar in the webpage
include('navbar.html');

// include connection to the database
include('connection.php');

// including the functions for querying the database
include('query_functions.php');

// query for retrieving records
$all_prop_types = fetch_all('property_types');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unit Types</title>
    <script src='helperFunctions.js'></script>
    <!-- <link rel="stylesheet" type="text/css" href="unit_types.css"> -->
</head>
<body>
<table border ="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>Property Type ID</th>
        <th>Property Type</th>
    </tr>
    <?php
    // loops to display records (fetched as arrays with mysqli_fetch_assoc) into a table
        if (mysqli_num_rows($all_prop_types) > 0) {
            while($type = mysqli_fetch_assoc($all_prop_types)) { ?>
            <tr>
                <td><?php echo $type['PropTypeID']; ?> </td>
                <td><?php echo $type['PropType']; ?> </td>
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
$conn->close();
?>
</table>
<br>
<!-- button for adding a property -->
<button onclick="document.location='add_prop_type.php'">Add a Property Type</button>
</body>
</html>