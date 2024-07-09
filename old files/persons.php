<?php
// to display the navbar in the webpage
include('navbar.html');

// include connection to the database
include('connection.php');
include('query_functions.php');

// query for retrieving records
$all_persons = fetch_all("persons");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="persons.css">
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols-Rounded"/>
    <title>Persons</title>
</head>
<body>
    <div id="title_container"><p id="title">Persons</p></div>
    <div id="actions_container">
        <h1 id="actions_title">Actions</h1>

    <!-- ADD PERSON BUTTON -->
        <button id="add_button" onclick="document.location='add_person_form.php'"><i class="material-icons">add</i> Add a Person</button>

    </div>
    <div id="table_container">
    <table border ="0" cellspacing="0" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>General Number</th>
            <th>Emergency Number</th>
            <th>Email Address</th>
        </tr>
        <?php
        // loops to display records (fetched as arrays with mysqli_fetch_assoc) into a table
        if (mysqli_num_rows($all_persons) > 0) {
            while($person = mysqli_fetch_assoc($all_persons)) {
            ?>
            <tr onclick="location.href='person_details.php?id=<?php echo $person['ID']; ?>'">
                <td><?php echo $person['ID']; ?> </td>
                <td><?php echo $person['Name']; ?> </td>
                <td><?php echo $person['Address']; ?> </td>
                <td><?php echo $person['GeneralNum']; ?> </td>
                <td><?php echo $person['EmergencyNum']; ?> </td>
                <td><?php echo $person['Email']; ?> </td>
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
</body>
</html>