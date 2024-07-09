<?php
    include('connection.php');
    include('query_functions.php');
    include('navbar.html');
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="add_property_form.css">
    <title>Add Unit Type</title>
</head>
<body>
<!-- Form to collect data for a new property record -->
<div id=title_container>
    <p id=title>Add Unit Type</p>
</div>
<div id=form_container>
    <form action="add_unit_type.php" method="post" autocomplete="off">
        <div id="details">
            <span>
                <label for="UnitType">Unit Type: </label>
                <label for="UnitDesc">Unit Description: </label>
            </span>

            <span>
                <input type="text" name="unit_type" id="unit_type" required>
                <input type="text" name="unit_desc" id="unit_desc" required>
            </span>
        </div>
            <input type="submit" name="submit" value="Submit"></input>
    </form>
</div>
</body>
</html>