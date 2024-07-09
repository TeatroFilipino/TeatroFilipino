<!-- Display the navbar -->
<?php
include('connection.php');
include ('navbar.html');
include ('query_functions.php');

// query for retrieving records
$all_records = all_units();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="units.css">
    <script src="helperFunctions.js"></script>
    <title>Units</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols-Rounded"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div id="title_container"><p id="title">Units</p></div>
    <div id=body>
    <div id="actions_container">
        <h1 id="actions_title">Actions</h1>
        <button id="add_button" onclick="document.location='add_unit_form.php'"> <i class="material-icons">add</i>Add a Unit</button>
    </div>
    <div id="table_container">
    <table id=all_units>
        <tr>
            <th>Parcel No.</th>
            <th>Property Address</th>
            <th>Unit No.</th>
        </tr>
        <?php
        // loops to display records (fetched as arrays with mysqli_fetch_assoc) into a table
        if (mysqli_num_rows($all_records) > 0) {
            while ($unit = mysqli_fetch_assoc($all_records)) {
                ?>
                <tr onclick="location.href='unit_details.php?parcel_no=<?php echo $unit['ParcelNo']; ?>&unit_no=<?php echo $unit['UnitNo']; ?>'">
                    <td><?php echo $unit['ParcelNo']; ?></td>
                    <td><?php echo $unit['PropAddress']; ?></td>
                    <td><?php echo $unit['UnitNo']; ?></td>
                </tr>
            <?php
            }
        } 
        else { ?>
            <tr>
                <td colspan="4">No record found</td>
            </tr>
    </table>
    <?php
        }

        if(isset($_GET['parcelno'])){
            $parcel_no = $_GET['parcelno'];
            $units = view_units($parcel_no);
            ?>
            <script>
                document.getElementById('all_units').hidden = true;
            </script>
            <table>
                <tr>
                    <th>Parcel No.</th>
                    <th>Property Address</th>
                    <th>Unit No.</th>
                </tr>
                <?php
                if (mysqli_num_rows($units) > 0) {
                    while ($unit = mysqli_fetch_assoc($units)) {
                        ?>
                        <tr onclick="location.href='unit_details.php?parcel_no=<?php echo $unit['ParcelNo']; ?>&unit_no=<?php echo $unit['UnitNo']; ?>'">
                            <td><?php echo $unit['ParcelNo']; ?></td>
                            <td><?php echo $unit['PropAddress']; ?></td>
                            <td><?php echo $unit['UnitNo']; ?></td>
                        </tr>
                    <?php
                    }
                } 
                else { ?>
                    <tr>
                        <td colspan="4">No record found</td>
                    </tr>
            </table>
            <?php
            }
        }
    $conn->close();
        ?>
    </div>
    </div>
</body>
</html>
