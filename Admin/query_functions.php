<?php

include('../connection.php');

function fetch_all($table){
    global $conn;
    $query = "SELECT * FROM $table";
    $all_records = mysqli_query($conn, $query);
    return $all_records;
}

function fetch_all_with_clause($table,$clauses){
    global $conn;
    $query = "SELECT * FROM $table $clauses";
    $all_records = mysqli_query($conn, $query);
    return $all_records;
}

// can be used for multiple tables
function fetch_cols($col,$table,$where_clause){
    global $conn;
    $query = "SELECT $col FROM $table WHERE $where_clause";
    $result = mysqli_query($conn, $query);
    return $result;
}

// returns assoc array
function fetch_by_id($params){
    global $conn;
    $col = $params['col'];
    $table = $params['table'];
    $id_col = $params['id_col'];
    $id = $params['id'];
    
    $query = "SELECT $col FROM $table WHERE $id_col = '$id'";
    $result = mysqli_query($conn, $query);
    $record = mysqli_fetch_assoc($result);
    return $record;
}


// returns mysqli_query result
function fetch_by_id_result($col,$table,$id_col,$id){
    global $conn;
    $query = "SELECT $col FROM $table WHERE $id_col = '$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

function add_person($id, $name, $adrs, $gnum, $emgnum, $email){
    global $conn;
    $query = "INSERT INTO Persons (ID, Name, Address, GeneralNum, EmergencyNum, Email) 
            VALUES ('$id', '$name', '$adrs', '$gnum', '$emgnum', '$email')";
    $result = mysqli_query($conn, $query);
    return $result;
}

function add_property($id, $adrs, $num_units, $type, $owner, $mngr){
    global $conn;
    $query = "INSERT INTO property_info (ParcelNo, PropAddress, NoOfUnits, PropTypeID, OwnerID, ManagerID) 
            VALUES ('$id', '$adrs', '$num_units', '$type', '$owner', '$mngr')";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Modify the delete function to accept the third argument
function delete($table, $condition_column, $condition_value){
    global $conn; // assuming $conn is your database connection variable

    $query = "DELETE FROM $table WHERE $condition_column = '$condition_value'";
    $result = mysqli_query($conn, $query);

    // Return the result
    return $result;
}


function count_records($table){
    global $conn;
    $query = "SELECT COUNT(*) AS Count FROM $table";
    $result = mysqli_query($conn, $query);
    $count = mysqli_fetch_assoc($result);
    return $count;
}

function exclude_expired_lease(){
    global $conn;
    $query = "SELECT * FROM lease_info WHERE EndOfLease > CURDATE()";
    $result = mysqli_query($conn, $query);
    return $result;
}

function add_site($site_Code, $site_Name, $site_Address, $site_Class, $site_Category, $site_Proximity, $site_Desc, $S_itinerary_Code) {
    include('../connection.php'); // Include your database connection file

    // Check if the site_Code already exists
    $existingSite = fetch_by_id_result('site_Code', 'site', 'site_Code', $site_Code);

    if (mysqli_num_rows($existingSite) > 0) {
        // Site with the same code already exists
        return false;
    }

    // Assuming your table is named 'site'
    $query = "INSERT INTO site (site_Code, site_Name, site_Address, site_Class, site_Category, site_Proximity, site_Desc, S_itinerary_Code) 
              VALUES ('$site_Code', '$site_Name', '$site_Address', '$site_Class', '$site_Category', '$site_Proximity', '$site_Desc', '$S_itinerary_Code')";

    $result = mysqli_query($conn, $query);

    // You may want to handle errors and return appropriate values based on the query result
    if ($result) {
        // Success
        mysqli_close($conn); // Close the database connection
        return true;
    } else {
        // Error
        mysqli_close($conn); // Close the database connection
        return false;
    }
}


// search
function search_site($searchTerm) {
    global $conn; 

    // Modify the query to match your database schema
    $query = "SELECT * FROM site WHERE site_Name LIKE '%$searchTerm%'";

    $result = mysqli_query($conn, $query);

    // You can handle errors here if needed
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return false;
    }

    return $result;
}

// search
function search_book($searchTerm) {
    global $conn; 

    // Modify the query to match your database schema
    $query = "SELECT * FROM booked WHERE book_by LIKE '%$searchTerm%'";

    $result = mysqli_query($conn, $query);

    // You can handle errors here if needed
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return false;
    }

    return $result;
}

// search
function search_dest($searchTerm) {
    global $conn; 

    // Modify the query to match your database schema
    $query = "SELECT * FROM destination WHERE dest_destination LIKE '%$searchTerm%'";

    $result = mysqli_query($conn, $query);

    // You can handle errors here if needed
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return false;
    }

    return $result;
}

?>

