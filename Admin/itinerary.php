<?php
// to display the navbar in the webpage
include('navbar.html');

// include connection to the database
include('../connection.php');
include('query_functions.php');
include('delete_functions.php');

// query for retrieving records
$all_destinations = fetch_all("destination"); 
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="admin.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols-Rounded"/>
    <title>Destinations</title>

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
    <p id="title">Destinations</p>
    <form action="" method="get" id=search>
        <input type="text" name=search id="search_field" placeholder="Search for destination...">
        <input type=submit id=submit_search value=Search>
    </form>
</div>
<div id=body>
    <div id="actions_container">
        <h1 id="actions_title">Actions</h1>
        <!-- ADD DESTINATION BUTTON -->
        <button id="add_button" onclick="document.location=''"><i class="material-icons">add</i> Add a Destination</button>
    </div>
    <div id="table_container">
        <table id=all_records>
            <tr>
                <th>Destination ID</th>
                <th>Destination</th>
            </tr>
            <?php
            // loops to display records
            if (mysqli_num_rows($all_destinations) > 0) {
                while($destination = mysqli_fetch_assoc($all_destinations)) {
                    ?>
                    <tr onclick="location.href='itinerary_details.php?id=<?php echo $destination['dest_id']; ?>'">
                        <td><?php echo $destination['dest_id']; ?> </td>
                        <td><?php echo $destination['dest_destination']; ?> </td>
                    </tr>
                    <?php
                }
            } else { ?>
                <tr>
                    <td colspan="2">No record found</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
