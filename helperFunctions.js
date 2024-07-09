// handles confirmation of delete actions and encodes the url with primary key values of the record to be deleted
function confirm_delete_property(id){
    if(confirm('Warning:\nAny associated lease or unit will be deleted along with the record.\nAre you sure you want to delete?')){
        bool = true;
        window.location.href='property_details.php?id='+id+'&delete='+bool;
    }
}

function confirm_delete_lease(parcelNo, unitNo, leaseStart) {
    if (confirm("Are you sure you want to delete this record?")) {
        bool = true;
        window.location.href = "leases.php?parcel_no=" + parcelNo + "&unit_no=" + unitNo + "&lease_start=" + leaseStart + "&delete=" + bool;
    }
}

function confirm_delete_person(id) {
    if (confirm("Warning:\nAny associated lease or property will be deleted along with the record.\nAre you sure you want to delete?")) {
        bool = true;
        window.location.href = "person_details.php?id=" + id + "&delete=" + bool;
    }
}

function confirm_delete_unit(parcelNo, unitNo) {
    if (confirm("Warning:\nAny associated lease will be deleted along with the record.\nAre you sure you want to delete?")) {
        bool = true;
        window.location.href = "unit_details.php?parcel_no=" + parcelNo + "&unit_no=" + unitNo + "&delete=" + bool;
    }
}

// handles the display of expired lease depending on user selection
function exclude_expired(){
    document.getElementById('all_leases').setAttribute("hidden","");
    document.getElementById('active_lease_only').removeAttribute("hidden");
    document.getElementById('exclude_button').style.display = "none";
    document.getElementById('include_button').style.display = "flex";
}

function include_expired(){
    document.getElementById('all_leases').removeAttribute("hidden");
    document.getElementById('active_lease_only').setAttribute("hidden","");
    document.getElementById('exclude_button').style.display = "flex";
    document.getElementById('include_button').style.display = "none";
}

function property_active_lease(){
    document.getElementById("all_leases").hidden = true;
    document.getElementById("active_lease_only").hidden = true;
    document.getElementById("include_button").hidden = true;
    document.getElementById("exclude_button").hidden = true;
}

function getUnits(){
    parcel_no = document.getElementById('existing_parcel_no').value;
    window.location.href = "add_lease_form.php?existing_parcel_no=" + parcel_no;
}
