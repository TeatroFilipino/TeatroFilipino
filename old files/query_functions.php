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
function fetch_by_id($col,$table,$id_col,$id){
    global $conn;
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

function delete($table,$id_col,$id){
    global $conn;
    $query = "DELETE FROM $table WHERE $id_col = '$id'";
    $result = mysqli_query($conn, $query);
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
?>