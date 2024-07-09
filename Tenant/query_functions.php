<?php

include('connection.php');

// main properties page
// SIMPLE 1 - Display all properties' parcel number, property address, and owner's name
function all_property(){
    global $conn;
    $query = "SELECT ParcelNo, PropAddress, Name as 'Owner'
            FROM property_info p, persons pr
            WHERE p.OwnerID = pr.ID";
    $all_records = mysqli_query($conn, $query);
    return $all_records;
}

// property details page
// SIMPLE 2 - Retrieve the property parcel number and display its property type, and manager's name
function more_property_details(){
    global $conn;
    $query = "SELECT ParcelNo, PropType, NoOfUnits, Name as 'Manager'
            FROM property_info p, property_types pt, persons pr
            WHERE p.PropTypeID = pt.PropTypeID AND p.ManagerID = pr.ID";
    $result = mysqli_query($conn, $query);
    return $result;
}

// linked from main properties page's 'view units' button
// SIMPLE 3 - Display the parcel number, property address, and unit number of each unit belonging to a particular property
function view_units($id){
    global $conn;
    $query = "SELECT p.ParcelNo, PropAddress, UnitNo
            FROM unit_info u, property_info p
            WHERE p.ParcelNo = u.ParcelNo AND p.ParcelNo = $id
            ORDER BY ParcelNo, UnitNo";
    $result = mysqli_query($conn, $query);
    return $result;
}

// linked from main properties page's "more information" section
// SIMPLE 4 -Find all information of active leases in a particular property. Display tenant name.
function find_active_lease($id){
    global $conn;
    $query = "SELECT ParcelNo, UnitNo, Name as 'Tenant', StartOfLease, EndOfLease, TotalOccupants
            FROM lease_info, persons
            WHERE TenantID = ID AND ParcelNo = $id AND EndOfLease > CURDATE()
            ORDER BY UnitNo";
    $result = mysqli_query($conn, $query);
    return $result;
}

// main units page
// SIMPLE 5 - Display each unit's parcel number, property address and unit no, sort by the property they belong in
function all_units(){
    global $conn;
    $query = "SELECT u.ParcelNo, PropAddress, UnitNo
            FROM property_info p, unit_info u
            WHERE p.ParcelNo = u.ParcelNo
            ORDER BY ParcelNo";
    $result = mysqli_query($conn, $query);
    return $result;
}

// unit details page
// SIMPLE 6 - Display the unit's record, and a description of the unit using the unit type id and description
function more_unit_details(){
    global $conn;
    $query = "SELECT u.ParcelNo, UnitNo, CONCAT(u.UnitTypeID, ' - ',UnitDesc) as 'Unit Description'
            FROM unit_info u, unit_types ut
            WHERE u.UnitTypeID = ut.UnitTypeID";
    $result = mysqli_query($conn, $query);
    return $result;
}

// linked from unit details's 'view lease history' button
// SIMPLE 7 - Display the leases associated to a particular unit. Sort in descending order by the parcel number, unit number and start of lease date.
function find_unit_lease($id,$unit){
    global $conn;
    $query = "SELECT ParcelNo, UnitNo, Name as 'Tenant', StartOfLease, EndOfLease, TotalOccupants
            FROM lease_info, persons
            WHERE ParcelNo = $id AND UnitNo = $unit AND TenantID = ID
            ORDER BY ParcelNo ASC, UnitNo ASC, StartOfLease DESC";
    $result = mysqli_query($conn, $query);
    return $result;
}

// linked from unit details's 'view active lease' button
// SIMPLE 8 - Display the active lease of a particular unit.
function find_active_unit_lease($id,$unit){
    global $conn;
    $query = "SELECT ParcelNo, UnitNo, Name as 'Tenant', StartOfLease, EndOfLease, TotalOccupants
            FROM lease_info, persons
            WHERE ParcelNo = $id AND UnitNo = $unit AND TenantID = ID AND EndOfLease > CURDATE()";
    $result = mysqli_query($conn, $query);
    return $result;
}

// main lease page
// SIMPLE 9 - Display all lease, showing tenant's name. Sort by each unit.
function all_lease(){
    global $conn;
    $query = "SELECT ParcelNo, UnitNo, Name as 'Tenant', StartOfLease, EndOfLease, TotalOccupants
            FROM lease_info, persons
            WHERE TenantID = ID
            ORDER BY ParcelNo, UnitNo, StartOfLease DESC";
    $result = mysqli_query($conn, $query);
    return $result;
}

// main persons page
// SIMPLE 10 - Display all records in the persons table
function fetch_all($table){
    global $conn;
    $query = "SELECT * FROM $table";
    $all_records = mysqli_query($conn, $query);
    return $all_records;
}

// person's details page - 'Owner of' section
// SIMPLE 11 - Display the parcel number of each property a person owns
function all_owner(){
    global $conn;
    $query = "SELECT ID, ParcelNo
            FROM property_info, persons
            WHERE OwnerID = ID";
    $result = mysqli_query($conn, $query);
    return $result;
}

// person's details page - 'Manager at' section
// SIMPLE 12 - Display the parcel number of each property a person manages
function all_manager(){
    global $conn;
    $query = "SELECT ID, ParcelNo
            FROM property_info, persons
            WHERE ManagerID = ID";
    $result = mysqli_query($conn, $query);
    return $result;
}

// used in add properties, add lease and add person forms, to generate the next ID
// SIMPLE 13 - Retrieve the latest ID used in person records
function count_records(){
    global $conn;
    $query = "SELECT MAX(ID) AS 'last_id' FROM persons";
    $result = mysqli_query($conn, $query);
    $count = mysqli_fetch_assoc($result);
    return $count;
}

// main properties page - 'more information' section, under 'average lease duration'
// MODERATE 1 - Display the average duration of stay (in years) for each property
function ave_lease_duration(){
    global $conn;
    $query = "SELECT ParcelNo, CONCAT(FORMAT(AVG(DATEDIFF(EndOfLease, StartOfLease)/30),0),' month/s') as 'Average Lease Duration'
            FROM lease_info
            GROUP BY ParcelNo";
    $result = mysqli_query($conn, $query);
    return $result;
}

// main properties page - 'more information' section, under 'total occupants'
// MODERATE 2 - Display the summary of the total number of occupants for each property
function sum_total_occupants(){
    global $conn;
    $query = "SELECT ParcelNo, SUM(TotalOccupants) as 'Total Occupants'
            FROM lease_info
            GROUP BY ParcelNo";
    $result = mysqli_query($conn, $query);
    return $result;
}

// linked from main properties page's 'more information' section
// MODERATE 3 - Count the active lease in each property
function count_active_lease(){
    global $conn;
    $query = "SELECT ParcelNo, COUNT(*) as 'Active Leases'
            FROM lease_info
            WHERE EndOfLease > CURDATE()
            GROUP BY ParcelNo";
    $result = mysqli_query($conn, $query);
    return $result;
}

// person details page - 'more information' section, 'number of properties owned'
// MODERATE 4 - Retrieve person's ID and the number of properties they own
function count_owned_property(){
    global $conn;
    $query = "SELECT OwnerID, COUNT(*) as 'Owned Properties'
            FROM property_info
            GROUP BY OwnerID";
    $result = mysqli_query($conn, $query);
    return $result;
}

// person details page - 'more information' section, 'number of properties managed'
// MODERATE 5 - Retrieve person's ID and the number of properties they manage
function count_managed_property(){
    global $conn;
    $query = "SELECT ManagerID, COUNT(*) as 'Managed Properties'
            FROM property_info
            GROUP BY ManagerID";
    $result = mysqli_query($conn, $query);
    return $result;
}

// property details page - 'more information' section, 'number of lease'
// MODERATE 6 - Retrieve person's ID and the number of leases each has
function count_lease(){
    global $conn;
    $query = "SELECT TenantID, COUNT(*) as 'Lease Count'
            FROM lease_info
            GROUP BY TenantID";
    $result = mysqli_query($conn, $query);
    return $result;
}

// property details page - 'more information' section, under 'number of units'
// DIFFICULT 1 - Display the count of units per unit type, for a particular property
function unit_type_per_property($id){
    global $conn;
    $query = "SELECT u.UnitTypeID, COUNT(*) as 'Count'
            FROM unit_info u, unit_types ut
            WHERE ParcelNo = $id AND u.UnitTypeID = ut.UnitTypeID
            GROUP BY UnitTypeID";
    $result = mysqli_query($conn, $query);
    return $result;
}

// person details page - 'more information' section, under 'property types owned'
// DIFFICULT 2 - Display the count of properties per property type, owned by a particular person
function count_per_prop_type($id){
    global $conn;
    $query = "SELECT PropType, COUNT(*) as 'Count'
            FROM property_info p, property_types pt
            WHERE OwnerID = $id AND p.PropTypeID = pt.PropTypeID
            GROUP BY PropType";
    $result = mysqli_query($conn, $query);
    return $result;
}

// unit types page
// DIFFICULT 3 - Display the count of units per unit type
function count_per_unit_type(){
    global $conn;
    $query = "SELECT ut.UnitTypeID, UnitDesc, COUNT(*) as 'Count'
            FROM unit_types ut, unit_info u
            WHERE ut.UnitTypeID = u.UnitTypeID
            GROUP BY UnitTypeID";
    $result = mysqli_query($conn, $query);
    return $result;
}

// property types page
// DIFFICULT 4 - Display the count of properties per property type
function count_per_property_type(){
    global $conn;
    $query = "SELECT pt.PropTypeID, PropType, COUNT(*) as 'Count'
            FROM property_types pt, property_info p
            WHERE pt.PropTypeID = p.PropTypeID
            GROUP BY PropTypeID
            ORDER BY PropTypeID";
    $result = mysqli_query($conn, $query);
    return $result;
}

// property types page
// DIFFICULT 5 - Display the least and greatest number of units each property type has 
function least_greatest(){
    global $conn;
    $query = "SELECT PropType, MIN(NoOfUnits) AS least, MAX(NoOfUnits) AS greatest
            FROM property_types pt, property_info p
            WHERE p.PropTypeID = pt.PropTypeID
            GROUP BY pt.PropType
            ORDER BY pt.PropTypeID";
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

function delete($table,$condition){
    global $conn;
    $query = "DELETE FROM $table WHERE $condition";
    $result = mysqli_query($conn, $query);
    return $result;
}

function add_lease($pNo, $unitNo, $tenantID, $start, $end, $occupants){
    global $conn;
    $query = "INSERT INTO lease_info (ParcelNo, UnitNo, TenantID, StartOfLease, EndOfLease, TotalOccupants) 
            VALUES ('$pNo', '$unitNo', '$tenantID', '$start', '$end', '$occupants')";
    $result = mysqli_query($conn, $query);
    return $result;
}

function add_unit($parcel_no,$unit_no,$unit_type){
    global $conn;
    $query = "INSERT INTO unit_info (ParcelNo, UnitNo, UnitTypeID) 
            VALUES ('$parcel_no', '$unit_no', '$unit_type')";
    $result = mysqli_query($conn, $query);
    return $result;
}

function add_unit_type($unit_type_id,$unit_desc){
    global $conn;
    $query = "INSERT INTO unit_types (UnitTypeID, UnitDesc) 
            VALUES ('$unit_type_id', '$unit_desc')";
    $result = mysqli_query($conn, $query);
    return $result;
}

function add_property_type($prop_type_id,$prop_type){
    global $conn;
    $query = "INSERT INTO property_types (PropTypeID, PropType) 
            VALUES ('$prop_type_id', '$prop_type')";
    $result = mysqli_query($conn, $query);
    return $result;
}

// used to exclude expired lease, linked in main lease page 'exclude expired lease' button
function active_lease(){
    global $conn;
    $query = "SELECT ParcelNo, UnitNo, Name as 'Tenant', StartOfLease, EndOfLease, TotalOccupants
            FROM lease_info, persons
            WHERE TenantID = ID AND EndOfLease > CURDATE()
            ORDER BY ParcelNo, UnitNo";
    $result = mysqli_query($conn, $query);
    return $result;
}

// simple select columns from table
function fetch($cols, $table){
    global $conn;
    $query = "SELECT $cols FROM $table";
    $all_records = mysqli_query($conn, $query);
    return $all_records;
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

function search_parcel($parcel){
    global $conn;
    $query = "SELECT ParcelNo, PropAddress, Name as 'Owner'
            FROM property_info p, persons pr
            WHERE p.OwnerID = pr.ID AND (ParcelNo LIKE '%$parcel%' OR PropAddress LIKE '%$parcel%')";
    $result = mysqli_query($conn, $query);
    return $result;
}

function search_person($name){
    global $conn;
    $query = "SELECT ID, Name, Address, GeneralNum, EmergencyNum, Email
            FROM persons
            WHERE Name LIKE '%$name%' OR ID LIKE '%$name%' OR Email LIKE '%$name%'";
    $result = mysqli_query($conn, $query);
    return $result;
}
?>