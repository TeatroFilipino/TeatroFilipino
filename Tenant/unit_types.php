<?php
// to display the navbar in the webpage
include('navbar.html');

// include connection to the database
include('connection.php');

// including the functions for querying the database
include('query_functions.php');

// query for retrieving records
$count_per_unit_type = count_per_unit_type();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unit Types</title>
    <script src='helperFunctions.js'></script>
    <link rel="stylesheet" type="text/css" href="unit_types.css">
</head>
<body>
<div id="title_container"><p id="title">Unit Types</p></div>
<div id=body>
    <div id=table_container>
        <table>
            <tr>
                <th>Unit Type</th>
                <th>Unit Description</th>
                <th>Total Count</th>
            </tr>
            <?php
            // loops to display records (fetched as arrays with mysqli_fetch_assoc) into a table
                if (mysqli_num_rows($count_per_unit_type) > 0) {
                    while($type = mysqli_fetch_assoc($count_per_unit_type)) { ?>
                    <tr>
                        <td><?php echo $type['UnitTypeID']; ?> </td>
                        <td><?php echo $type['UnitDesc']; ?> </td>
                        <td><?php echo $type['Count']; ?> </td>
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
    </div>
</div>
</body>
</html>