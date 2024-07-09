<?php
// to display the navbar in the webpage
include('navbar.html');

// include connection to the database
include('connection.php');

// including the functions for querying the database
include('query_functions.php');

// query for retrieving records
$all_prop_types = fetch_all('property_types');
$count = count_per_property_type();
$count_of_units = least_greatest();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Property Types</title>
    <script src='helperFunctions.js'></script>
    <link rel="stylesheet" type="text/css" href="property_types.css">
</head>
<body>
<div id="title_container"><p id="title">Property Types</p></div>
<div id=body>
    <div id=table_container>
    <table id=main>
        <tr class=tr_main>
            <th class=th_main>Property Type ID</th>
            <th class=th_main>Property Type</th>
        </tr>
        <?php
        // loops to display records (fetched as arrays with mysqli_fetch_assoc) into a table
            if (mysqli_num_rows($all_prop_types) > 0) {
                while($type = mysqli_fetch_assoc($all_prop_types)) { ?>
                <tr id=tr_main>
                    <td class=td_main><?php echo $type['PropTypeID']; ?> </td>
                    <td class=td_main><?php echo $type['PropType']; ?> </td>
                <tr>
                <?php
                }
            }
            else { ?>
                <tr class=tr_main>
                    <td colspan="8" class=td_main>No record found</td>
                </tr>
        <?php
            } ?>
    </table>
    </div>
<div id=more_info>
    <h3>More Information</h3>
    <span id=count>
        <p>Number of Properties per Property Type</p>
    <table cellpadding="10">
        <tr>
            <th>Property Type</th>
            <th>Total Count</th>
        </tr>
        <?php
            if (mysqli_num_rows($count) > 0) {
                while($type = mysqli_fetch_assoc($count)) { ?>
                <tr>
                    <td><?php echo $type['PropType']; ?> </td>
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
            } ?>
    </table>
    </span>
    
    <span id=least_greatest>
        <p>Least/Greatest Number of Units per Property Type</p>
    <table cellpadding="10">
        <tr>
            <th>Property Type</th>
            <th>Least</th>
            <th>Greatest</th>
        </tr>
        <?php
            if (mysqli_num_rows($count_of_units) > 0) {
                while($type = mysqli_fetch_assoc($count_of_units)) { ?>
                <tr>
                    <td><?php echo $type['PropType']; ?> </td>
                    <td><?php echo $type['least']; ?> </td>
                    <td><?php echo $type['greatest']; ?> </td>
                <tr>
                <?php
                }
            }
            else { ?>
                <tr>
                    <td colspan="8">No record found</td>
                </tr>
        <?php
            } ?>
    </table>
    </span>
</div>
<?php
$conn->close();
?>
</body>
</html>