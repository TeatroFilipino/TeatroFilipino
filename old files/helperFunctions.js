// Purpose: If the user clicks the "Delete" button, a confirmation box will appear. 
// If the user clicks "OK", the page will redirect to properties.php with the id of the property to be deleted 
// and the boolean value "true" for the delete variable.
// If the user clicks "Cancel", nothing will happen.

function confirm_delete_property(id){
    if(confirm('Are you sure you want to delete this record?')){
        bool = true;
        window.location.href='properties.php?id='+id+'&delete='+bool;
    }
}

function confirm_delete_unit_type(id){
    if(confirm('Are you sure you want to delete this record?')){
        bool = true;
        window.location.href='unit_types.php?id='+id+'&delete='+bool;
    }
}

function confirm_delete_prop_type(id){
    if(confirm('Are you sure you want to delete this record?')){
        bool = true;
        window.location.href='property_types.php?id='+id+'&delete='+bool;
    }
}

function confirm_delete_lease(parcelNo, unitNo) {
    if (confirm("Are you sure you want to delete this lease?")) {
        window.location.href = "delete_leases.php?parcelNo=" + parcelNo + "&unitNo=" + unitNo;
    }
}

function exclude_expired(){
    document.getElementById('all_leases').setAttribute("hidden","");
    document.getElementById('expired_lease_excluded').removeAttribute("hidden");
    document.getElementById('exclude_button').setAttribute("hidden","");
    document.getElementById('include_button').removeAttribute("hidden");
}

function include_expired(){
    document.getElementById('all_leases').removeAttribute("hidden");
    document.getElementById('expired_lease_excluded').setAttribute("hidden","");
    document.getElementById('exclude_button').removeAttribute("hidden");
    document.getElementById('include_button').setAttribute("hidden","");
}