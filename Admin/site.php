<?php
// to display the navbar in the webpage
include('navbar.html');

// include connection to the database
include('../connection.php');
include('query_functions.php');
include('delete_functions.php');

// query for retrieving records
$all_sites = fetch_all("site"); 
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="admin.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols-Rounded"/>
    <title>Sites</title>

    <script>
        $(document).ready(function () {
            $('#search_field').keyup(function () {
                var searchInput = $(this).val().trim();

                if (searchInput !== '') {
                    $.ajax({
                        url: 'search_suggestions.php',
                        method: 'POST',
                        data: {searchInput: searchInput},
                        dataType: 'json', // Expect JSON response
                        success: function (response) {
                            displaySuggestions(response);
                        }
                    });
                } else {
                    hideSuggestions();
                }
            });

            function displaySuggestions(suggestions) {
                var suggestionsContainer = $('#suggestions');
                suggestionsContainer.empty();

                for (var i = 0; i < suggestions.length; i++) {
                    var suggestionDiv = $('<div class="suggestion">' + suggestions[i] + '</div>');
                    suggestionDiv.click(function () {
                        $('#search_field').val($(this).text());
                        hideSuggestions();
                    });
                    suggestionsContainer.append(suggestionDiv);
                }

                suggestionsContainer.show();
            }

            function hideSuggestions() {
                $('#suggestions').hide();
            }
        });
    </script>
</head>
<body>
<div id="title_container">
        <p id="title">Sites</p>
        <form action="" method="get" id=search>
            <input type="text" name=search id="search_field" placeholder="Search for site...">
            <input type=submit id=submit_search value=Search>
        </form>
    </div>
    <div id=body>
    <div id="actions_container">
        <h1 id="actions_title">Actions</h1>
        <!-- ADD SITE BUTTON -->
        <button id="add_button" onclick="document.location='add_site_form.php'"><i class="material-icons">add</i> Add a Site</button>
    </div>
    <div id="table_container">
    <table id=all_records>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Address</th>
            <th>Class</th>
            <th>Category</th>
            <th>Proximity</th>
            <th>Description</th>
            <th>Itinerary Code</th>
        </tr>
        <?php
        // loops to display records (fetched as arrays with mysqli_fetch_assoc) into a table
        if (mysqli_num_rows($all_sites) > 0) {
            while($site = mysqli_fetch_assoc($all_sites)) {
            ?>
            <tr onclick="location.href='site_details.php?id=<?php echo $site['site_Code']; ?>'">
                <td><?php echo $site['site_Code']; ?> </td>
                <td><?php echo $site['site_Name']; ?> </td>
                <td><?php echo $site['site_Address']; ?> </td>
                <td><?php echo $site['site_Class']; ?> </td>
                <td><?php echo $site['site_Category']; ?> </td>
                <td><?php echo $site['site_Proximity']; ?> </td>
                <td><?php echo $site['site_Desc']; ?> </td>
                <td><?php echo $site['S_itinerary_Code']; ?> </td>
            </tr>
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

    if (isset($_GET['search'])){
        $search = $_GET['search'];
        $search_result = search_site($search); 
    ?>
        <script>
            document.getElementById("all_records").hidden = true;
        </script>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Address</th>
                <th>Class</th>
                <th>Category</th>
                <th>Proximity</th>
                <th>Description</th>
                <th>Itinerary Code</th>
            </tr>
        <?php
            if (mysqli_num_rows($search_result) > 0) {
                while($site = mysqli_fetch_assoc($search_result)) {
                ?>
                    <td><?php echo $site['site_Code']; ?> </td>
                    <td><?php echo $site['site_Name']; ?> </td>
                    <td><?php echo $site['site_Address']; ?> </td>
                    <td><?php echo $site['site_Class']; ?> </td>
                    <td><?php echo $site['site_Category']; ?> </td>
                    <td><?php echo $site['site_Proximity']; ?> </td>
                    <td><?php echo $site['site_Desc']; ?> </td>
                    <td><?php echo $site['S_itinerary_Code']; ?> </td>
                </tr>
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
    }
    $conn->close();
    ?>
</div></body>
</html>
