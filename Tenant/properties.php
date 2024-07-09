nn<?php
// to display the navbar in the webpage
include('navbar.html');

// include connection to the database
include('connection.php');

// including the functions for querying the database
include('query_functions.php');
include('delete_functions.php');

// query for retrieving records
$all_records = all_property();
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
<div id="title_container">
    <p id="title">Properties</p>
    <form action="" method="get" id=search>
        <input type="text" name=search id="search_field" placeholder="Search for parcel...">
        <input type=submit id=submit_search value=Search>
    </form>
</div>
<div id=body>
<div id="actions_container">
    <h1 id="actions_title">Actions</h1>
    <button id="add_button" onclick="document.location='add_property_form.php'"><i class="material-icons">add</i> Add a Property</button>
</div>
<div id="table_container">
<table id=all_records>
    <tr>
        <th>Parcel No.</th>
        <th>Property Address</th>
        <th>Owner</th>
    </tr>
    <?php
        if (mysqli_num_rows($all_records) > 0) {
            while($record = mysqli_fetch_assoc($all_records)) { ?>
                <tr onclick="location.href='property_details.php?id=<?php echo $record['ParcelNo']; ?>'">
                    <td><?php echo $record['ParcelNo']; ?> </td>
                    <td><?php echo $record['PropAddress']; ?> </td>
                    <td><?php echo $record['Owner']; ?> </td>
                <tr>
    <?php
            }
        }
        else { ?>
            <tr>
                <td colspan="8">No record found</td>
            </tr>
</table>
    <?php
        }

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $all_records = search_parcel($search);
    ?>
        <script>
            document.getElementById("all_records").hidden = true;
        </script>
        <table id=search_output>
            <tr>
                <th>Parcel No.</th>
                <th>Property Address</th>
                <th>Owner</th>
            </tr>
            <?php
                if (mysqli_num_rows($all_records) > 0) {
                    while($record = mysqli_fetch_assoc($all_records)) { ?>
                        <tr onclick="location.href='property_details.php?id=<?php echo $record['ParcelNo']; ?>'">
                            <td><?php echo $record['ParcelNo']; ?> </td>
                            <td><?php echo $record['PropAddress']; ?> </td>
                            <td><?php echo $record['Owner']; ?> </td>
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
    <?php
        }
    ?>
</div>
</div>
</body>
</html>