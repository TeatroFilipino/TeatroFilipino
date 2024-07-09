// Purpose: To execute actions depending on whether the owner is existing or not

// accessing html elements from add_property_form.php through their ids
const select_owner_div = document.getElementById("select_owner");
const add_new_owner_div = document.getElementById("add_new_owner");
existing_owner_id = document.getElementById("existing_owner_id");
new_owner_id = document.getElementById("new_owner_id");
ownr_name = document.getElementById("ownr_name");
ownr_address = document.getElementById("ownr_address");
ownr_general_num = document.getElementById("ownr_general_num");
ownr_emergency_num = document.getElementById("ownr_emergency_num");
ownr_email = document.getElementById("ownr_email");
new_manager_id = document.getElementById("new_manager_id");
new_manager_button = document.getElementById("new_manager");

function existing(){
    // display the div with id "select_owner" and hide the div with id "add_new_owner"
    select_owner_div.style.display = 'flex';
    add_new_owner_div.style.display = 'none';

    // remove the "required" attribute from the input fields that are not required if the owner is existing
    new_owner_id.removeAttribute("required");
    ownr_name.removeAttribute("required");
    ownr_address.removeAttribute("required");
    ownr_general_num.removeAttribute("required");

    // set the "required" attribute to the input fields that are required if the owner is new
    existing_owner_id.setAttribute("required","");

    // if previously inputted, set the fields to empty to not retain values
    new_owner_id.value = "";
    ownr_name.value = "";
    ownr_address.value = "";
    ownr_general_num.value = "";
    ownr_emergency_num.value = "";
    ownr_email.value = "";

    // for id auto-incrementation
    // if the owner is existing, set the manager id as the new_id
    new_manager_id.value = new_id;
}

function new_record(){
    // display the div with id "add_new_owner" and hide the div with id "select_owner"
    select_owner_div.style.display = 'none';
    add_new_owner_div.style.display = 'flex';

    // remove the "required" attribute from the input fields that are not required if the owner is new
    existing_owner_id.removeAttribute("required");

    // set the "required" attribute to the input fields that are required if the owner is new
    new_owner_id.setAttribute("required","");
    ownr_name.setAttribute("required","");
    ownr_address.setAttribute("required","");
    ownr_general_num.setAttribute("required","");

    // if previously inputted, set the fields to empty to not retain values
    existing_owner_id.value = "";

    // for id auto-incrementation
    // if the owner is new, set the owner id as the new_id
    new_owner_id.value = new_id;
    // if the owner is using the new_id 
    // and the radio button for new manager is checked, 
    // set the manager id as the new_id plus 1
    if ((new_owner_id.value == new_id) && (new_manager_button.checked)){
        new_manager_id.value = new_id+1;
    }
}

// when the radio button for existing owner is clicked, execute the function existing()
document.getElementById('existing_owner').addEventListener("click",existing);

// when the radio button for new owner is clicked, execute the function new_record()
document.getElementById('new_owner').addEventListener("click",new_record);