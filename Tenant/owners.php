<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="owners.css">
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols-Rounded"/>
    <title>Owners</title>
</head>
<body>
    <?php
    // Include essential files at the beginning
    include('navbar.html');
    include('connection.php');
    include('connect.php');
    include('query_functions.php');

    // Query for retrieving records
    $all_owners = fetch_all("owners");
    ?>

    <div id="title_container">
        <p id="title">Owners</p>
        <form action="" method="get" id="search">
            <input type="text" name="search" id="search_field" placeholder="Search for owner...">
            <input type="submit" id="submit_search" value="Search">
        </form>
    </div>

    <div id="body">
        <div id="actions_container">
            <h1 id="actions_title">Actions</h1>
            <!-- ADD OWNER BUTTON -->
            <button id="add_button" onclick="document.location='add_owner_form.php'"><i class="material-icons">add</i> Add an Owner</button>
        </div>

        <div id="table_container">
            <table id="all_records">
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Birth Date</th>
                    <th>Contact Number</th>
                    <th>Email Address</th>
                </tr>

                <?php
                if (mysqli_num_rows($all_owners) > 0) {
                    while($owner = mysqli_fetch_assoc($all_owners)) {
                        ?>
                        <tr onclick="location.href='owner_details.php?id=<?php echo $owner['owner_ID']; ?>'">
                            <td><?php echo $owner['owner_ID']; ?> </td>
                            <td><?php echo $owner['surName']; ?> </td>
                            <td><?php echo $owner['firstName']; ?> </td>
                            <td><?php echo $owner['midName']; ?> </td>
                            <td><?php echo $owner['birthDate']; ?> </td>
                            <td><?php echo $owner['contactNo']; ?> </td>
                            <td><?php echo $owner['emailAdd']; ?> </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7">No record found</td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <?php
            if (isset($_GET['search'])){
                $search = $_GET['search'];
                $search_result = search_owner($search);
                ?>
                <script>
                    document.getElementById("all_records").hidden = true;
                </script>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Birth Date</th>
                        <th>Contact Number</th>
                        <th>Email Address</th>
                    </tr>

                    <?php
                    if (mysqli_num_rows($search_result) > 0) {
                        while($owner = mysqli_fetch_assoc($search_result)) {
                            ?>
                            <tr onclick="location.href='owner_details.php?id=<?php echo $owner['owner_ID']; ?>'">
                                <td><?php echo $owner['owner_ID']; ?> </td>
                                <td><?php echo $owner['surName']; ?> </td>
                                <td><?php echo $owner['firstName']; ?> </td>
                                <td><?php echo $owner['midName']; ?> </td>
                                <td><?php echo $owner['birthDate']; ?> </td>
                                <td><?php echo $owner['contactNo']; ?> </td>
                                <td><?php echo $owner['emailAdd']; ?> </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7">No record found</td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
            }
            $conn->close();
            ?>
        </div>
    </body>
</html>
