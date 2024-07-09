<?php
// include the connection to the db
include('../connection.php');
include('query_functions.php');
include('delete_functions.php');

// to display the navbar in the webpage
include('navbar.html');

// identifier for which book to display, got from the view hyperlink
$id = $_REQUEST['id'];

// retrieves details of the book
$book_details = fetch_by_id(array(
    'col' => 'dest_id, dest_destination',
    'table' => 'destination', // table name
    'id_col' => 'dest_id', // ID column name
    'id' => $id
));

if(isset($_GET['delete'])){
    delete_book($id);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $id, " - ", $book_details['dest_destination']; ?></title>
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" type="text/css" href="admin_details.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div id="title_container">
        <a href="itinerary.php" id="title">
            Itinerary<i class="material-icons">keyboard_double_arrow_right</i>
        </a>
        <span id='dest_id' style='font-size: 30px;'><em><?php echo $id; ?></em>,&nbsp;</span> <span id='dest_destination' style='font-size: 30px;'><em><?php echo $book_details['dest_destination']; ?></em></span>
    </div>
    <hr>
    <div id=body>
        <div id="actions_container">
            <h1 id="actions_title">Actions</h1>
            <!-- button for deletion -->
            <a href="javascript:confirm_delete_book('<?php echo $id?>')">
                <button id="delete_button">
                    <i class="material-icons">delete</i>Delete
                </button>
            </a>
        </div>
        <div id='details_container'>
            <div id='row1' class="parcel-no-spacing">
                <!-- details of --- book -->
                <?php 
                if (!empty($props_owned)) { ?>
                    <h3>Owner of</h3>
                    <?php
                    foreach ($props_owned as $parcel_no) {
                        ?>
                        <p>
                            <a href="property_details.php?id=<?php echo $parcel_no; ?>">
                                <?php echo $parcel_no; ?>
                            </a>
                        </p>
                    <?php 
                    }
                }
                ?>

                <!-- details of --- book -->
                <?php
                if (!empty($props_managed)) { ?>
                    <h3>Manager at</h3>
                    <?php
                    foreach ($props_managed as $parcel_no) {
                        ?>
                        <p>
                            <a href="property_details.php?id=<?php echo $parcel_no; ?>">
                                <?php echo $parcel_no; ?>
                            </a>
                        </p>
                    <?php 
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    function confirm_delete_book(id) {
        var confirmDelete = confirm("Are you sure you want to delete this book?");
        if (confirmDelete) {
            window.location.href = 'itinerary_details.php?id=' + id + '&delete=true';
        }
    }
</script>
