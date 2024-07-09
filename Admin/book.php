<?php
// to display the navbar in the webpage
include('navbar.html');

// include connection to the database
include('../connection.php');
include('query_functions.php');
include('delete_functions.php');

// query for retrieving records
$all_books = fetch_all("booked"); 
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="admin.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols-Rounded"/>
    <title>Books</title>

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
        <p id="title">Books</p>
        <form action="" method="get" id=search>
            <input type="text" name=search id="search_field" placeholder="Search for book...">
            <input type=submit id=submit_search value=Search>
        </form>
    </div>
    <div id=body>
        <div id="actions_container">
            <h1 id="actions_title">Actions</h1>
            <!-- ADD BOOK BUTTON -->
            <button id="add_button" onclick="document.location='book.php'"><i class="material-icons">add</i> Add a Booking</button>
        </div>
        <div id="table_container">
            <table id=all_records>
                <tr>
                    <th>ID</th>
                    <th>BookBy</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Departure</th>
                    <th>Destination ID</th>
                    <th>Account ID</th>
                    <th>Origin ID</th>
                    <th>Tracker</th>
                </tr>
                <?php
                // loops to display records (fetched as arrays with mysqli_fetch_assoc) into a table
                if (mysqli_num_rows($all_books) > 0) {
                    while($book = mysqli_fetch_assoc($all_books)) {
                ?>
                <tr onclick="location.href='book_details.php?id=<?php echo $book['book_id']; ?>'">
                    <td><?php echo $book['book_id']; ?> </td>
                    <td><?php echo $book['book_by']; ?> </td>
                    <td><?php echo $book['book_contact']; ?> </td>
                    <td><?php echo $book['book_address']; ?> </td>
                    <td><?php echo $book['book_name']; ?> </td>
                    <td><?php echo $book['book_age']; ?> </td>
                    <td><?php echo $book['book_gender']; ?> </td>
                    <td><?php echo $book['book_departure']; ?> </td>
                    <td><?php echo $book['dest_id']; ?> </td>
                    <td><?php echo $book['acc_id']; ?> </td>
                    <td><?php echo $book['origin_id']; ?> </td>
                    <td><?php echo $book['book_tracker']; ?> </td>
                </tr>
                <?php
                    }
                } 
                else { ?>
                    <tr>
                        <td colspan="12">No record found</td>
                    </tr>
                </table>
                <?php 
                }

                if (isset($_GET['search'])){
                    $search = $_GET['search'];
                    $search_result = search_book($search); 
                ?>
                    <script>
                        document.getElementById("all_records").hidden = true;
                    </script>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>BookBy</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Departure</th>
                            <th>Destination ID</th>
                            <th>Account ID</th>
                            <th>Origin ID</th>
                            <th>Tracker</th>
                        </tr>
                    <?php
                        if (mysqli_num_rows($search_result) > 0) {
                            while($book = mysqli_fetch_assoc($search_result)) {
                    ?>
                                <td><?php echo $book['book_id']; ?> </td>
                                <td><?php echo $book['book_by']; ?> </td>
                                <td><?php echo $book['book_contact']; ?> </td>
                                <td><?php echo $book['book_address']; ?> </td>
                                <td><?php echo $book['book_name']; ?> </td>
                                <td><?php echo $book['book_age']; ?> </td>
                                <td><?php echo $book['book_gender']; ?> </td>
                                <td><?php echo $book['book_departure']; ?> </td>
                                <td><?php echo $book['dest_id']; ?> </td>
                                <td><?php echo $book['acc_id']; ?> </td>
                                <td><?php echo $book['origin_id']; ?> </td>
                                <td><?php echo $book['book_tracker']; ?> </td>
                            </tr>
                    <?php
                            }
                        } 
                        else { ?>
                            <tr>
                                <td colspan="12">No record found</td>
                            </tr>
                    </table>
                    <?php 
                        }
                    }
                    $conn->close();
                    ?>
                </div>
            </body>
        </html>
