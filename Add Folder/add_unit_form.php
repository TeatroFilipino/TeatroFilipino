<?php
    include('connection.php');
    include('query_functions.php');
    include('navbar.html');

    $all_unit_types = fetch_all("unit_types");
    $all_parcel_no = fetch("ParcelNo","property_info");
?>

<!DOCTYPE html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="add_unit_form.css">
    <title>Add Unit Record</title>
</head>
<body>
<!-- Form to collect data for a new property record -->
<div id=title_container>
    <p id=title>Add Unit Record</p>
</div>
<div id=form_container>
    <form action="add_unit.php" method="post" autocomplete="off">
        <div id="details">
            <span id=labels>
                <label for="ParcelNo">Parcel Number: </label>
                <label for="UnitNo">Unit Number: </label>
                <label for="UnitType">Unit Type ID: </label>
            </span>

            <span id=fields>
                <select name="existing_parcel_no" id="existing_parcel_no" required>
                    <!-- default option, hints no selection -->
                    <option value='' selected disabled hidden>Select</option>
                    <!-- fetching parcel numbers to be set as options, value and text displayed is the parcel number -->
                    <?php
                    while($parcel = mysqli_fetch_array($all_parcel_no, MYSQLI_ASSOC)):
                    ?>
                    <option value="<?php echo $parcel['ParcelNo']; ?>">
                        <?php echo $parcel['ParcelNo']; ?>
                    </option>
                    <?php
                    endwhile;
                    ?>
                </select>
                <input type="text" name="unit_no" id="unit_no" required minlength="1" maxlength="3" min="1" onchange="this.value = Math.floor(Math.max(this.value,1))" pattern="[0-9]+$">
                <select name="unit_type" id="unit_type" required>
                    <!-- default option, hints no selection -->
                    <option value="" selected disabled hidden>Select</option>
                    <!-- fetching each prop type to be set as options, value is id but text displayed is the desc -->
                    <?php 
                        while($type = mysqli_fetch_array($all_unit_types,MYSQLI_ASSOC)):;
                    ?> 
                        <option value = "<?php echo $type['UnitTypeID'];?>">
                            <?php echo $type['UnitTypeID']; ?>
                        </option>
                    <?php
                        endwhile;
                    ?>
                </select>
            </span>
        </div>
            <input type="submit" name="submit" value="Submit"></input>
    </form>
</div>

<script>
    // select2 plugin for dropdown with search
    $(document).ready(function() {
        $("select").select2();
    });
</script>
</body>
</html>