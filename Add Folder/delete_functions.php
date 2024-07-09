<!-- PURPOSE: calls the delete function from query_functions.php and handles the resulting alert and page redirect -->

<?php

include ('connection.php');

function delete_property($id){
    $delete_result = delete("property_info","ParcelNo = $id"); // the delete function is called from query_functions.php

    // if the delete function returns true, an alert is displayed and the page is reloaded
        if($delete_result){
            echo '<script>
                    alert("Property deleted successfully.");
                    window.location.replace("properties.php");
                </script>';
        }
        else {
            echo '<script>
                    alert("Error: '.mysqli_error($conn).'");
                    window.location.replace("property_details.php?id='.$id.'");
                </script>';
        }
}

function delete_lease($pNo, $unitNo, $start){
    $delete_result = delete("lease_info","ParcelNo = '$pNo' AND UnitNo = '$unitNo' AND StartOfLease = '$start'"); // the delete function is called from query_functions.php
    // if the delete function returns true, an alert is displayed and the page is reloaded
        if($delete_result){
            echo '<script>
                    alert("Lease deleted successfully.");
                    window.location.replace("leases.php");
                </script>';
        }
        else {
            echo '<script>
                    alert("Error: '.mysqli_error($conn).'");
                    window.location.replace("leases.php");
                </script>';
        }
}

function delete_person($id){
    $delete_result = delete("persons","ID = $id"); // the delete function is called from query_functions.php

    // if the delete function returns true, an alert is displayed and the page is reloaded
        if($delete_result){
            echo '<script>
                    alert("Person deleted successfully.");
                    window.location.replace("persons.php");
                </script>';
        }
        else {
            echo '<script>
                    alert("Error: '.mysqli_error($conn).'");
                    window.location.replace("person_details.php?id='.$id.'");
                </script>';
        }
}

function delete_unit($pNo, $unitNo){
    $delete_result = delete("unit_info","ParcelNo = '$pNo' AND UnitNo = '$unitNo'"); // the delete function is called from query_functions.php

    // if the delete function returns true, an alert is displayed and the page is reloaded
        if($delete_result){
            echo '<script>
                    alert("Unit deleted successfully.");
                    window.location.replace("units.php");
                </script>';
        }
        else {
            echo '<script>
                    alert("Error: '.mysqli_error($conn).'");
                    window.location.replace("unit_details.php?parcel_no='.$pNo.'&unit_no='.$unitNo.'");
                </script>';
        }
}
?>