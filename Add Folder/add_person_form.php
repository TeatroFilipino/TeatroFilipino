<?php
    include('connection.php');
    include('query_functions.php');
    include('navbar.html');

    $latest_id = count_records();
    $new_id = (int)$latest_id['last_id']+1;
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="add_person_form.css">
    <title>Add Person Record</title>
</head>
<body>
<!-- Form to collect data for a new property record -->
<div id=title_container>
    <p id=title>Add Person Record</p>
</div>
<div id=form_container>
    <form action="add_person.php" method="post" autocomplete="off">
        <div id="details">
            <span>
                <label for="ID">ID: </label>
                <label for="Name">Name: </label>
                <label for="Address">Address: </label>
                <label for="GeneralNum">General Number: </label>
                <label for="EmergencyNum">Emergency Number: </label>
                <label for="Email">Email: </label>
            </span>

            <span>
                <input type="number" name="new_id" id="new_id" value="<?php echo $new_id?>" readonly required>
                <input type="text" name="name" id="name" required maxlength="30">
                <input type="text" name="address" id="address" required maxlength="80">
                <input type="text" name="general_num" id="general_num" required minlength="6" maxlength="15" pattern="^[0-9\-]+$">
                <input type="text" name="emergency_num" id="emergency_num" maxlength="15" pattern="^[0-9\-]*$">
                <input type="text" name="email" id="email" maxlength="50" pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
            </span>
        </div>
            <input type="submit" name="submit" value="Submit"></input>
    </form>
</div>
</body>
</html>