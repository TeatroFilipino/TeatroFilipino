User
<!-- Display the navbar -->
<?php
include('connection.php');
include('navbar.html');
include('query_functions.php');
include('alerts.php');

// query for retrieving records
$all_units = fetch_cols("u.ParcelNo, PropAddress, UnitNo", "unit_info u, property_info p", "u.ParcelNo = p.ParcelNo");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Units</title>
    <link rel="stylesheet" type="text/css" href="units.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols-Rounded" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <!-- Search Bar -->
    <div id="search-bar">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Please Input Parcel Number">
            <input type="submit" value="Search">
        </form>
    </div>
    <div id="title_container">
        <p id="title">Units</p>
    </div>
    <div id="actions_container">
        <h1 id="actions_title">Actions</h1>
        <button id="add_button" onclick="document.location='add_unit_form.php'"><i class="material-icons">add</i> Add Unit</button>
    </div>
    <div id="table_container">
        <table>
            <tr>
                <th>Parcel No.</th>
                <th>Property Address</th>
                <th>Unit No.</th>
            </tr>
            <?php
            if (mysqli_num_rows($all_units) > 0) {
                while ($unit = mysqli_fetch_assoc($all_units)) {
                    ?>
                    <tr onclick="location.href='unit_details.php?parcelno=<?php echo $unit["ParcelNo"]; ?>&unitno=<?php echo $unit["UnitNo"]; ?>'">
                        <td><?php echo $unit['ParcelNo']; ?></td>
                        <td><?php echo $unit['PropAddress']; ?></td>
                        <td><?php echo $unit['UnitNo']; ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3">No record found</td>
                </tr>
        <?php
            }
            // to execute if the delete button is clicked and the delete var thru the url
        if(isset($_GET['delete'])){
        $id = $_GET['id']; // getting the parcelno from the url
        $delete_result = delete("unit_type","ParcelNo",$id); // the delete function is called from query_functions.php
    
    // if the delete function returns true, an alert is displayed and the page is reloaded
        if($delete_result){
            echo '<script>
                    alert("Unit deleted successfully.");
                    window.location.replace("units.php");
                </script>';
        }
        else {
            echo '<script>
                    alert("Error: '.mysqli_error($conn).'");
                    window.location.replace("unit_details.php?id='.$id.'");
                </script>';
        }
    }
    $conn->close();
    ?>
    </table>
    </div>
</body>
</html>