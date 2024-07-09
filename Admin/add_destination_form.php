<?php
include('../connection.php');
include('query_functions.php');
include('navbar.html');
include('delete_functions.php');

$count = count_records("dest_destination");
$latest_id = fetch_latest_id("dest_destination", "dest_id");
$new_id = isset($latest_id['last_id']) ? (int)$latest_id['last_id'] + 1 : 1;
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="add_site_form.css">
    <title>Add Destination Record</title>
</head>
<body>
<!-- Form to collect data for a new destination record -->
<div id=title_container>
    <p id=title>Add Destination Record</p>
</div>
<div id=form_container>
    <form action="add_destination.php" method="post" autocomplete="off">
        <div id="details">
            <span>
                <label for="dest_id">Destination ID: </label>
                <label for="dest_destination">Destination: </label>
            </span>

            <span>
                <input type="number" name="dest_id" id="dest_id" value="<?php echo $new_id; ?>" readonly required>
                <input type="varchar" name="dest_destination" id="dest_destination" required maxlength="30">
            </span>
        </div>
        <input type="submit" name="submit" value="Submit"></input>
    </form>
</div>
</body>
</html>
